<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::orderBy('sort_order')->get();
        $menus = Menu::with(['category', 'reviews'])->get()->map(function ($menu) {
            $menu->avg_rating = $menu->averageRating();
            $menu->review_count = $menu->reviews->count();
            return $menu;
        });
        $recentReviews = Review::with('menu')->latest()->take(6)->get();

        return view('welcome', compact('categories', 'menus', 'recentReviews'));
    }

    public function getReviews($menuId)
    {
        $reviews = Review::where('menu_id', $menuId)->latest()->get();
        return response()->json($reviews);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:gopay,ovo,dana,bca,mandiri,bri,qris',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $subtotal = 0;
        $orderItems = [];

        foreach ($validated['items'] as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            $itemSubtotal = $menu->price * $item['quantity'];
            $subtotal += $itemSubtotal;
            $orderItems[] = [
                'menu_id' => $menu->id,
                'menu_name' => $menu->name,
                'quantity' => $item['quantity'],
                'price' => $menu->price,
                'subtotal' => $itemSubtotal,
            ];
        }

        // Calculate discount for members
        $discount = 0;
        $pointsUsed = 0;
        $user = Auth::user();

        if ($user && $subtotal >= 100000) {
            $discount = intval($subtotal * 0.05);
        }

        $total = $subtotal - $discount;

        // Calculate points: 10 poin per transaction (regular)
        // For bulk: points = (quantity × base_points) + (2 × base_points)
        $totalQty = collect($validated['items'])->sum('quantity');
        if ($totalQty >= 5) {
            // Grosir formula
            $pointsEarned = ($totalQty * 10) + (2 * 10);
        } else {
            $pointsEarned = 10;
        }

        $order = Order::create([
            'user_id' => $user?->id,
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'points_earned' => $pointsEarned,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create(array_merge($item, ['order_id' => $order->id]));
        }

        return response()->json([
            'success' => true,
            'order' => $order->load('items'),
            'message' => 'Pesanan berhasil dibuat!',
        ]);
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|in:gopay,ovo,dana,bca,mandiri,bri,qris',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        // Simulate payment processing
        $order->update([
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
            'paid_at' => now(),
        ]);

        // ==========================================
        // LOGIKA BARU: HITUNG TRANSAKSI GUEST & NOTIFIKASI (Poin 1 & 2)
        // ==========================================
        $user = $order->user;
        $guestNotification = null;

        if (!$user) {
            // Cek masa berlaku 3 bulan. Jika lewat, reset transaksi ke 0
            if (session()->has('last_transaction_time') && now()->diffInMonths(session('last_transaction_time')) >= 3) {
                session()->forget(['guest_transaction_count', 'last_transaction_time']);
            }

            // Tambah hitungan transaksi guest
            $currentCount = session()->get('guest_transaction_count', 0) + 1;
            session()->put('guest_transaction_count', $currentCount);
            session()->put('last_transaction_time', now());

            // Siapkan text notifikasi total pembelian dari 1-10
            $guestNotification = "Pembelian Anda yang ke-{$currentCount} berhasil!";
            if ($currentCount >= 10) {
                $guestNotification .= " Selamat! Anda sekarang memenuhi syarat untuk mendaftar menjadi Member Sobat Lapak.";
            } else {
                $guestNotification .= " Kumpulkan hingga 10 transaksi untuk membuka fitur pendaftaran member.";
            }
        }

        // Award points to user if logged in
        if ($user) {
            // Ubah perhitungan poin: Skala 5 ribu dapat 20 poin (Poin 11)
            $pointsEarned = floor($order->total / 5000) * 20;

            // Update points_earned di tabel order agar sinkron
            $order->update(['points_earned' => $pointsEarned]);

            $user->points += $pointsEarned;
            $user->save();
            
            // Catatan: fitur level di bawah ini bisa Anda hapus/komentari (Poin 10)
            // $user->updateMemberLevel(); 

            $user->pointHistories()->create([
                'points' => $pointsEarned,
                'type' => 'earn',
                'description' => 'Belanja ' . number_format($order->total, 0, ',', '.'),
                'order_id' => $order->id,
            ]);
        }

        return response()->json([
            'success' => true,
            'order' => $order->load('items'),
            'points_earned' => $user ? $order->points_earned : 0,
            'guest_transaction_count' => session()->get('guest_transaction_count', 0),
            'guest_notification' => $guestNotification, // Kirim notifikasi ini ke frontend Anda
            'message' => 'Pembayaran berhasil! ' . ($guestNotification ?? 'Pesanan Anda sudah diterima dan akan segera disiapkan.'),
        ]);
    }

    public function receipt(Order $order)
    {
        $order->load('items');
        return response()->json([
            'order' => $order,
            'items' => $order->items,
        ]);
    }

    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'reviewer_name' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        Review::create([
            'user_id' => $user?->id,
            'menu_id' => $validated['menu_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'reviewer_name' => $validated['reviewer_name'],
            'is_member' => $user !== null,
        ]);

        return response()->json(['success' => true, 'message' => 'Ulasan berhasil dikirim!']);
    }

    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'type' => 'required|in:masukan,saran,komplain',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        Feedback::create([
            'user_id' => $user?->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'type' => $validated['type'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return response()->json(['success' => true, 'message' => 'Terima kasih atas masukan Anda!']);
    }
}
