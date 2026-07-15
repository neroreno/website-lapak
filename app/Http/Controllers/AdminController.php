<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Feedback;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Summary stats
        $totalOrders = Order::where('payment_status', 'paid')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $totalMembers = User::where('role', 'user')->count();
        $pendingOrders = Order::where('order_status', 'pending')->orWhere('order_status', 'confirmed')->count();

        // Recent orders
        $recentOrders = Order::with(['items', 'user'])->latest()->take(10)->get();

        // Sales data per year (2024-2026), monthly breakdown
        $years = [2024, 2025, 2026];
        $allSalesData = [];
        foreach ($years as $year) {
            $yearData = [];
            for ($m = 1; $m <= 12; $m++) {
                $monthOrders = Order::where('payment_status', 'paid')
                    ->whereYear('paid_at', $year)
                    ->whereMonth('paid_at', $m)
                    ->get();
                $yearData[] = [
                    'month'         => \Carbon\Carbon::create($year, $m, 1)->translatedFormat('M'),
                    'month_number'  => $m,
                    'year'          => $year,
                    'total_orders'  => $monthOrders->count(),
                    'total_revenue' => (int) $monthOrders->sum('total'),
                ];
            }
            $allSalesData[$year] = $yearData;
        }

        // Top selling menus
        $topMenus = DB::table('order_items')
            ->select('menu_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->groupBy('menu_name')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        // Payment method distribution
        $paymentDistribution = Order::where('payment_status', 'paid')
            ->select('payment_method', DB::raw('COUNT(*) as count'))
            ->groupBy('payment_method')
            ->get();

        // Pending feedbacks count
        $pendingFeedbacks = Feedback::where('status', 'pending')->count();

        // Categories for menu management
        $categories = MenuCategory::orderBy('sort_order')->get();
        $menus = Menu::with('category')->get();

        // All feedbacks
        $feedbacks = Feedback::with('user')->latest()->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalMembers', 'pendingOrders',
            'recentOrders', 'allSalesData', 'topMenus', 'paymentDistribution',
            'pendingFeedbacks', 'categories', 'menus', 'feedbacks'
        ));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['order_status' => $validated['status']]);

        return response()->json(['success' => true, 'message' => 'Status pesanan diperbarui!']);
    }

    public function salesReport(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $orders = Order::where('payment_status', 'paid')
            ->whereYear('paid_at', $year)
            ->whereMonth('paid_at', $month)
            ->with('items')
            ->latest()
            ->get();

        return response()->json([
            'orders' => $orders,
            'total_revenue' => $orders->sum('total'),
            'total_orders' => $orders->count(),
            'avg_order' => $orders->count() > 0 ? intval($orders->avg('total')) : 0,
        ]);
    }

    public function exportSales(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $orders = Order::where('payment_status', 'paid')
            ->whereYear('paid_at', $year)
            ->whereMonth('paid_at', $month)
            ->with('items')
            ->latest()
            ->get();

        $filename = "laporan-penjualan-{$year}-{$month}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            // BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['No', 'No. Pesanan', 'Pelanggan', 'Items', 'Subtotal', 'Diskon', 'Total', 'Metode Bayar', 'Status', 'Tanggal']);

            foreach ($orders as $i => $order) {
                $items = $order->items->map(fn($item) => "{$item->quantity}x {$item->menu_name}")->implode(', ');
                fputcsv($file, [
                    $i + 1,
                    $order->order_number,
                    $order->customer_name,
                    $items,
                    $order->subtotal,
                    $order->discount,
                    $order->total,
                    strtoupper($order->payment_method ?? '-'),
                    $order->order_status,
                    $order->paid_at?->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function respondFeedback(Request $request, $id)
    {
        $validated = $request->validate([
            'response' => 'required|string',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'response' => $validated['response'],
            'status' => 'responded',
        ]);

        return response()->json(['success' => true, 'message' => 'Respon berhasil dikirim!']);
    }

    public function storeMenu(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'stock_status' => 'required|in:tersedia,terbatas,habis',
            'is_hot' => 'boolean',
            'is_preorder_available' => 'boolean',
        ]);

        $menu = Menu::create($validated);

        return response()->json(['success' => true, 'menu' => $menu, 'message' => 'Menu berhasil ditambahkan!']);
    }

    public function updateMenu(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'stock_status' => 'required|in:tersedia,terbatas,habis',
            'is_hot' => 'boolean',
            'is_preorder_available' => 'boolean',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($validated);

        return response()->json(['success' => true, 'menu' => $menu, 'message' => 'Menu berhasil diperbarui!']);
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json(['success' => true, 'message' => 'Menu berhasil dihapus!']);
    }

    public function sendAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        $chat = ChatMessage::create([
            'user_id' => $user->id,
            'message' => $validated['message'],
            'type' => 'admin_announcement',
        ]);

        return response()->json(['success' => true, 'message' => 'Pengumuman berhasil dikirim!']);
    }
}
