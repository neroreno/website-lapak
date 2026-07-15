<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = MenuCategory::orderBy('sort_order')->get();
        $menus = Menu::with(['category', 'reviews'])->get()->map(function ($menu) {
            $menu->avg_rating = $menu->averageRating();
            $menu->review_count = $menu->reviews->count();
            return $menu;
        });
        $recentOrders = Order::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subDays(30))
            ->with('items')
            ->latest()
            ->get();
        $pointHistories = $user->pointHistories()->latest()->take(10)->get();
        $chatMessages = ChatMessage::with('user')->latest()->take(50)->get()->reverse()->values();

        // Member reviews
        $memberReviews = Review::where('is_member', true)->with(['menu', 'user'])->latest()->take(10)->get();

        $vouchers = $user->vouchers()->latest()->get();

        return view('member', compact('user', 'categories', 'menus', 'recentOrders', 'pointHistories', 'chatMessages', 'memberReviews', 'vouchers'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subDays(30))
            ->with('items')
            ->latest()
            ->get();

        return response()->json($orders);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:gopay,ovo,dana,bca,mandiri,bri,qris',
            'is_preorder' => 'required|boolean',
            'voucher_id' => 'nullable|exists:user_vouchers,id',
        ]);

        $user = Auth::user();
        $subtotal = 0;
        $orderItems = [];

        foreach ($validated['items'] as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            if ($validated['is_preorder'] && !$menu->is_preorder_available) {
                return response()->json(['success' => false, 'message' => "{$menu->name} tidak tersedia untuk PreOrder."], 422);
            }
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

        $discount = 0;
        if (!empty($validated['voucher_id'])) {
            $voucher = $user->vouchers()->where('id', $validated['voucher_id'])->where('status', 'active')->first();
            if ($voucher && $voucher->expires_at > now()) {
                $discount = intval($subtotal * ($voucher->discount_percentage / 100));
                $voucher->update(['status' => 'used']);
            }
        }

        $total = $subtotal - $discount;

        $pointsEarned = floor($total / 5000) * 20;

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $user->name,
            'customer_phone' => $user->phone,
            'customer_address' => $user->address,
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'points_earned' => $pointsEarned,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
            'is_preorder' => $validated['is_preorder'],
            'delivery_date' => $validated['is_preorder'] ? now()->addDay()->toDateString() : now()->toDateString(),
            'paid_at' => now(),
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create(array_merge($item, ['order_id' => $order->id]));
        }

        $user->points += $pointsEarned;
        $user->save();

        $user->pointHistories()->create([
            'points' => $pointsEarned,
            'type' => 'earn',
            'description' => ($validated['is_preorder'] ? 'PreOrder - ' : 'Belanja - ') . 'Rp ' . number_format($total, 0, ',', '.'),
            'order_id' => $order->id,
        ]);

        return response()->json([
            'success' => true,
            'order' => $order->load('items'),
            'points_earned' => $pointsEarned,
            'message' => "Pembayaran berhasil! " . ($validated['is_preorder'] ? "Pesanan akan dikirim besok." : "Pesanan akan segera disiapkan.") . " Anda mendapat +{$pointsEarned} poin!",
        ]);
    }

    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        Review::create([
            'user_id' => $user->id,
            'menu_id' => $validated['menu_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'reviewer_name' => $user->name,
            'is_member' => true,
        ]);

        return response()->json(['success' => true, 'message' => 'Ulasan berhasil dikirim!']);
    }

    public function getChat()
    {
        $messages = ChatMessage::with('user')->latest()->take(50)->get()->reverse()->values();
        return response()->json($messages);
    }

    public function sendChat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        $chat = ChatMessage::create([
            'user_id' => $user->id,
            'message' => $validated['message'],
            'type' => 'member',
        ]);

        return response()->json([
            'success' => true,
            'message' => $chat->load('user'),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $user->update($validated);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!']);
    }

    public function exchangeVoucher(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:10_percent,15_percent,20_percent',
        ]);

        $user = Auth::user();
        
        $pointsNeeded = match($validated['type']) {
            '10_percent' => 50,
            '15_percent' => 75,
            '20_percent' => 100,
        };

        $discount = match($validated['type']) {
            '10_percent' => 10,
            '15_percent' => 15,
            '20_percent' => 20,
        };

        if ($user->points < $pointsNeeded) {
            return response()->json(['success' => false, 'message' => 'Poin tidak mencukupi.'], 422);
        }

        $todayExchanges = $user->vouchers()
            ->where('voucher_type', $validated['type'])
            ->whereDate('created_at', now()->toDateString())
            ->count();

        if ($todayExchanges > 0) {
            return response()->json(['success' => false, 'message' => 'Anda sudah menukarkan voucher jenis ini hari ini.'], 422);
        }

        $user->points -= $pointsNeeded;
        $user->save();

        $user->vouchers()->create([
            'voucher_type' => $validated['type'],
            'discount_percentage' => $discount,
            'status' => 'stored',
        ]);

        $user->pointHistories()->create([
            'points' => -$pointsNeeded,
            'type' => 'redeem',
            'description' => "Tukar Voucher Diskon $discount%",
        ]);

        return response()->json([
            'success' => true,
            'remaining_points' => $user->points,
            'message' => "Berhasil menukarkan $pointsNeeded poin menjadi Voucher Diskon $discount%.",
        ]);
    }

    public function activateVoucher(Request $request)
    {
        $validated = $request->validate([
            'voucher_id' => 'required|exists:user_vouchers,id',
        ]);

        $user = Auth::user();
        $voucher = $user->vouchers()->where('id', $validated['voucher_id'])->where('status', 'stored')->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Voucher tidak ditemukan atau sudah aktif.'], 404);
        }

        $voucher->update([
            'status' => 'active',
            'activated_at' => now(),
            'expires_at' => now()->addHours(24),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Voucher berhasil diaktifkan dan berlaku selama 24 jam.',
        ]);
    }
}
