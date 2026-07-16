<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard — LAPAK 1 PUTRI 2 PUTRA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen" x-data="adminApp()" x-init="init()">

    
    <div x-show="toast.show" x-transition class="fixed top-4 right-4 z-[100] max-w-sm" style="display:none;">
        <div class="bg-slate-800 text-white px-5 py-4 rounded-2xl shadow-xl flex items-center gap-3">
            <span x-text="toast.type === 'success' ? '✅' : '❌'"></span>
            <p class="font-semibold text-sm" x-text="toast.message"></p>
        </div>
    </div>

    
    <div class="flex h-screen overflow-hidden">
        
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex shrink-0">
            <div class="p-5 border-b border-slate-800">
                <div class="flex items-center gap-2 mb-1">
                    <h1 class="font-extrabold text-amber-400">LAPAK ADMIN</h1>
                </div>
                <p class="text-xs text-slate-400">v7.0 Dashboard</p>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-amber-500 text-white' : 'text-slate-300 hover:bg-slate-800'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors">
                    <span></span> Ringkasan
                </button>
                <button @click="activeTab = 'orders'" :class="activeTab === 'orders' ? 'bg-amber-500 text-white' : 'text-slate-300 hover:bg-slate-800'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors">
                    <span></span> Pesanan
                </button>
                <button @click="activeTab = 'sales'" :class="activeTab === 'sales' ? 'bg-amber-500 text-white' : 'text-slate-300 hover:bg-slate-800'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors">
                    <span></span> Laporan Penjualan
                </button>
                <button @click="activeTab = 'menus'" :class="activeTab === 'menus' ? 'bg-amber-500 text-white' : 'text-slate-300 hover:bg-slate-800'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors">
                    <span></span> Kelola Menu
                </button>
                <button @click="activeTab = 'chat'" :class="activeTab === 'chat' ? 'bg-amber-500 text-white' : 'text-slate-300 hover:bg-slate-800'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors">
                    <span></span> Pengumuman
                </button>
                <button @click="activeTab = 'feedbacks'" :class="activeTab === 'feedbacks' ? 'bg-amber-500 text-white' : 'text-slate-300 hover:bg-slate-800'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors">
                    <span></span> Aspirasi & Komplain
                    <?php if($pendingFeedbacks > 0): ?><span class="ml-auto bg-rose-500 text-white text-[10px] px-2 py-0.5 rounded-full"><?php echo e($pendingFeedbacks); ?></span><?php endif; ?>
                </button>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <form action="/logout" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-rose-400 hover:bg-rose-950 transition-colors">
                        <span></span> Keluar
                    </button>
                </form>
            </div>
        </aside>

        
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center shrink-0">
                <h2 class="font-extrabold text-slate-800 text-lg uppercase" x-text="activeTab.replace('dashboard', 'Ringkasan').replace('orders', 'Kelola Pesanan').replace('sales', 'Laporan Penjualan 5 Bulan').replace('menus', 'Manajemen Menu').replace('chat', 'Kirim Pengumuman').replace('feedbacks', 'Masukan Pelanggan')"></h2>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-slate-600"><?php echo e(auth()->user()->name); ?> (Admin)</span>
                    <a href="/" target="_blank" class="px-3 py-1.5 rounded-lg bg-slate-100 text-xs font-bold text-slate-600 hover:bg-slate-200 transition-colors border border-slate-200">Lihat Web ↗</a>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 bg-slate-50">
                
                
                <div x-show="activeTab === 'dashboard'" x-transition>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <p class="text-slate-500 text-sm font-semibold mb-1">Total Pesanan</p>
                            <p class="text-3xl font-black text-slate-800"><?php echo e(number_format($totalOrders)); ?></p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <p class="text-slate-500 text-sm font-semibold mb-1">Total Pendapatan</p>
                            <p class="text-3xl font-black text-amber-600">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <p class="text-slate-500 text-sm font-semibold mb-1">Pesanan Aktif (PO)</p>
                            <p class="text-3xl font-black text-blue-600"><?php echo e($pendingOrders); ?></p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <p class="text-slate-500 text-sm font-semibold mb-1">Total Member</p>
                            <p class="text-3xl font-black text-emerald-600"><?php echo e($totalMembers); ?></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center">
                                <h3 class="font-bold text-slate-800">Pesanan Masuk Terbaru</h3>
                                <button @click="activeTab = 'orders'" class="text-xs font-bold text-amber-600">Lihat Semua →</button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                                        <tr><th class="px-5 py-3">No Pesanan</th><th class="px-5 py-3">Pelanggan</th><th class="px-5 py-3">Total</th><th class="px-5 py-3">Status</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <?php $__currentLoopData = $recentOrders->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-slate-50">
                                            <td class="px-5 py-3 font-semibold"><?php echo e($order->order_number); ?> <?php if($order->is_preorder): ?><span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full ml-1">PO</span><?php endif; ?></td>
                                            <td class="px-5 py-3"><?php echo e($order->customer_name); ?></td>
                                            <td class="px-5 py-3 font-bold text-slate-700">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></td>
                                            <td class="px-5 py-3"><span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase <?php if($order->order_status=='pending'): ?> bg-amber-100 text-amber-700 <?php elseif($order->order_status=='delivered'): ?> bg-emerald-100 text-emerald-700 <?php else: ?> bg-blue-100 text-blue-700 <?php endif; ?>"><?php echo e($order->order_status); ?></span></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                            <h3 class="font-bold text-slate-800 mb-4">Menu Terlaris</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $topMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-sm text-slate-700"><?php echo e($menu->menu_name); ?></p>
                                        <p class="text-xs text-slate-400"><?php echo e($menu->total_qty); ?> porsi terjual</p>
                                    </div>
                                    <span class="font-bold text-sm text-emerald-600">Rp <?php echo e(number_format($menu->total_revenue, 0, ',', '.')); ?></span>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div x-show="activeTab === 'orders'" x-transition style="display:none;">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-800 text-white uppercase text-xs">
                                    <tr>
                                        <th class="px-5 py-4">No. Order / Waktu</th>
                                        <th class="px-5 py-4">Pelanggan</th>
                                        <th class="px-5 py-4">Detail Items</th>
                                        <th class="px-5 py-4">Total</th>
                                        <th class="px-5 py-4">Status & Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-5 py-4 align-top">
                                            <p class="font-bold text-slate-800"><?php echo e($order->order_number); ?></p>
                                            <p class="text-xs text-slate-500 mt-1"><?php echo e($order->created_at->format('d M Y, H:i')); ?></p>
                                            <?php if($order->is_preorder): ?> <span class="inline-block mt-1 bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded-full">PRE-ORDER</span> <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-4 align-top">
                                            <p class="font-bold text-slate-700"><?php echo e($order->customer_name); ?></p>
                                            <p class="text-xs text-slate-500"><?php echo e($order->customer_phone); ?></p>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 max-w-[150px]"><?php echo e($order->customer_address); ?></p>
                                        </td>
                                        <td class="px-5 py-4 align-top">
                                            <ul class="text-xs space-y-1 text-slate-600">
                                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>• <?php echo e($item->quantity); ?>x <?php echo e($item->menu_name); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php if($order->notes): ?> <p class="text-[10px] font-semibold text-rose-600 mt-2 p-1.5 bg-rose-50 rounded">Catatan: <?php echo e($order->notes); ?></p> <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-4 align-top">
                                            <p class="font-black text-amber-600">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">VIA <?php echo e($order->payment_method); ?></p>
                                        </td>
                                        <td class="px-5 py-4 align-top">
                                            <select @change="updateOrderStatus(<?php echo e($order->id); ?>, $event.target.value)" class="w-full text-xs font-bold border-slate-300 rounded-lg p-2 focus:ring-amber-500 focus:border-amber-500"
                                                :class="{
                                                    'bg-amber-50 text-amber-800': '<?php echo e($order->order_status); ?>' === 'pending',
                                                    'bg-blue-50 text-blue-800': '<?php echo e($order->order_status); ?>' === 'confirmed' || '<?php echo e($order->order_status); ?>' === 'preparing',
                                                    'bg-emerald-50 text-emerald-800': '<?php echo e($order->order_status); ?>' === 'delivered'
                                                }">
                                                <option value="pending" <?php if($order->order_status == 'pending'): ?> selected <?php endif; ?>>Pending</option>
                                                <option value="confirmed" <?php if($order->order_status == 'confirmed'): ?> selected <?php endif; ?>>Confirmed / Diterima</option>
                                                <option value="preparing" <?php if($order->order_status == 'preparing'): ?> selected <?php endif; ?>>Sedang Disiapkan</option>
                                                <option value="ready" <?php if($order->order_status == 'ready'): ?> selected <?php endif; ?>>Siap Dikirim</option>
                                                <option value="delivered" <?php if($order->order_status == 'delivered'): ?> selected <?php endif; ?>>Selesai / Dikirim</option>
                                                <option value="cancelled" <?php if($order->order_status == 'cancelled'): ?> selected <?php endif; ?>>Dibatalkan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div x-show="activeTab === 'sales'" x-transition style="display:none;" class="space-y-6">
                    
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 flex flex-wrap gap-4 items-end justify-between shadow-sm">
                        <div class="flex flex-wrap gap-4 items-end">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1">Filter Tahun</label>
                                <div class="flex gap-2">
                                    <button @click="changeYear(2024)" :class="selectedYear === 2024 ? 'bg-amber-500 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors">2024</button>
                                    <button @click="changeYear(2025)" :class="selectedYear === 2025 ? 'bg-amber-500 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors">2025</button>
                                    <button @click="changeYear(2026)" :class="selectedYear === 2026 ? 'bg-amber-500 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors">2026</button>
                                </div>
                            </div>
                            <div class="text-sm text-slate-500">
                                Total Omzet <strong x-text="selectedYear"></strong>:
                                <span class="font-black text-amber-600 text-base" x-text="'Rp ' + totalYearRevenue.toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                        <button @click="exportCSV()" class="px-5 py-2.5 bg-slate-800 text-white text-sm font-bold rounded-xl hover:bg-slate-900 transition-all flex items-center gap-2">
                            <span>📄</span> Unduh CSV
                        </button>
                    </div>

                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <h3 class="font-bold text-slate-800 mb-1">Omzet Penjualan per Bulan</h3>
                            <p class="text-xs text-slate-400 mb-4" x-text="'Tahun ' + selectedYear"></p>
                            <div class="relative" style="height:250px;">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>

                        
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <h3 class="font-bold text-slate-800 mb-1">Tren Jumlah Pesanan</h3>
                            <p class="text-xs text-slate-400 mb-4" x-text="'Tahun ' + selectedYear"></p>
                            <div class="relative" style="height:250px;">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>

                        
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <h3 class="font-bold text-slate-800 mb-1">Distribusi Metode Pembayaran</h3>
                            <p class="text-xs text-slate-400 mb-4">Semua waktu</p>
                            <div class="relative flex justify-center" style="height:250px;">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div x-show="activeTab === 'menus'" x-transition style="display:none;">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6 shadow-sm flex justify-between items-center">
                        <div>
                            <h3 class="font-extrabold text-slate-800">Daftar Menu Makanan</h3>
                            <p class="text-sm text-slate-500">Kelola stok, harga, dan ketersediaan PreOrder.</p>
                        </div>
                        <button @click="openMenuModal()" class="px-4 py-2 bg-amber-500 text-white font-bold text-sm rounded-xl">➕ Tambah Menu Baru</button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex gap-4">
                            <img src="<?php echo e($menu->image_path); ?>" class="w-16 h-16 rounded-lg object-cover bg-slate-100" onerror="this.src='https://placehold.co/100x100'">
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm text-slate-800 truncate"><?php echo e($menu->name); ?></p>
                                <p class="text-amber-600 font-bold text-sm mb-2">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></p>
                                <div class="flex gap-2">
                                    <select class="text-xs px-2 py-1 rounded bg-slate-50 border border-slate-200" onchange="alert('Di versi ini, manajemen CRUD menu belum terhubung API untuk update stok, hanya UI demo.')">
                                        <option value="tersedia" <?php echo e($menu->stock_status == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                                        <option value="terbatas" <?php echo e($menu->stock_status == 'terbatas' ? 'selected' : ''); ?>>Terbatas</option>
                                        <option value="habis" <?php echo e($menu->stock_status == 'habis' ? 'selected' : ''); ?>>Habis</option>
                                    </select>
                                    <?php if($menu->is_preorder_available): ?>
                                    <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-1 rounded font-bold">PO AKTIF</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div x-show="activeTab === 'chat'" x-transition style="display:none;" class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-3">📢</div>
                            <h3 class="font-extrabold text-slate-800 text-xl">Kirim Pengumuman ke Member</h3>
                            <p class="text-sm text-slate-500 mt-1">Pesan akan muncul di Chat Room Sobat Lapak</p>
                        </div>
                        <textarea x-model="announcementText" rows="4" placeholder="Ketik pengumuman promo, menu baru, atau info operasional..." class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 mb-4 resize-none"></textarea>
                        <button @click="sendAnnouncement()" :disabled="!announcementText" class="w-full py-3 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition-colors shadow-lg disabled:opacity-50">
                            🚀 Broadcast Pengumuman
                        </button>
                    </div>
                </div>

                
                <div x-show="activeTab === 'feedbacks'" x-transition style="display:none;" class="space-y-4">
                    <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white p-5 rounded-2xl border <?php echo e($fb->status == 'pending' ? 'border-amber-400 shadow-md ring-1 ring-amber-100' : 'border-slate-200 shadow-sm opacity-70'); ?>">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <div class="flex gap-2 items-center mb-1">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase text-white <?php echo e($fb->type == 'komplain' ? 'bg-rose-500' : ($fb->type == 'saran' ? 'bg-emerald-500' : 'bg-blue-500')); ?>"><?php echo e($fb->type); ?></span>
                                    <span class="text-xs text-slate-400"><?php echo e($fb->created_at->format('d M Y, H:i')); ?></span>
                                </div>
                                <h4 class="font-bold text-slate-800 text-lg"><?php echo e($fb->subject); ?></h4>
                                <p class="text-xs font-semibold text-slate-500">Dari: <?php echo e($fb->name); ?> <?php echo e($fb->user_id ? '(Member)' : ''); ?></p>
                            </div>
                            <span class="px-3 py-1 text-xs font-bold rounded-full <?php echo e($fb->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-500'); ?>"><?php echo e(strtoupper($fb->status)); ?></span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mb-4">
                            <p class="text-sm text-slate-700">"<?php echo e($fb->message); ?>"</p>
                        </div>
                        
                        <?php if($fb->status == 'pending'): ?>
                        <div class="flex gap-2">
                            <input type="text" :id="'fb-reply-' + <?php echo e($fb->id); ?>" placeholder="Tulis balasan..." class="flex-1 px-4 py-2 text-sm border border-slate-200 rounded-xl focus:border-amber-500">
                            <button @click="respondFeedback(<?php echo e($fb->id); ?>)" class="px-4 py-2 bg-slate-800 text-white font-bold text-sm rounded-xl">Kirim Balasan</button>
                        </div>
                        <?php else: ?>
                        <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl">
                            <p class="text-xs font-bold text-emerald-800 mb-1">Respon Admin:</p>
                            <p class="text-sm text-emerald-700"><?php echo e($fb->response); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div x-show="menuModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" style="display:none;">
                    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl relative">
                        <button @click="menuModalOpen = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 font-bold text-xl">×</button>
                        <h3 class="font-bold text-xl text-slate-800 mb-4">Tambah Menu Baru</h3>
                        <form @submit.prevent="submitMenu" class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori</label>
                                <select x-model="menuForm.category_id" class="w-full px-4 py-2 border rounded-xl bg-slate-50 focus:border-amber-400" required>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Menu</label>
                                <input type="text" x-model="menuForm.name" class="w-full px-4 py-2 border rounded-xl bg-slate-50 focus:border-amber-400" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi</label>
                                <textarea x-model="menuForm.description" class="w-full px-4 py-2 border rounded-xl bg-slate-50 focus:border-amber-400"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Harga (Rp)</label>
                                    <input type="number" x-model="menuForm.price" class="w-full px-4 py-2 border rounded-xl bg-slate-50 focus:border-amber-400" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Satuan</label>
                                    <input type="text" x-model="menuForm.unit" class="w-full px-4 py-2 border rounded-xl bg-slate-50 focus:border-amber-400" placeholder="Porsi/Ekor/Gelas" required>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Status Stok</label>
                                    <select x-model="menuForm.stock_status" class="w-full px-4 py-2 border rounded-xl bg-slate-50 focus:border-amber-400">
                                        <option value="tersedia">Tersedia</option>
                                        <option value="terbatas">Terbatas</option>
                                        <option value="habis">Habis</option>
                                    </select>
                                </div>
                                <div class="flex items-center gap-2 pt-6">
                                    <input type="checkbox" id="po-avail" x-model="menuForm.is_preorder_available" class="w-4 h-4 text-amber-500 rounded border-slate-300">
                                    <label for="po-avail" class="text-sm font-semibold text-slate-700">Tersedia untuk PO</label>
                                </div>
                            </div>
                            <div class="pt-4 flex justify-end gap-2">
                                <button type="button" @click="menuModalOpen = false" class="px-4 py-2 rounded-xl text-slate-500 hover:bg-slate-100 font-bold">Batal</button>
                                <button type="submit" class="px-4 py-2 rounded-xl bg-amber-500 text-white font-bold hover:bg-amber-600 shadow-md">Simpan Menu</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function adminApp() {
            return {
                activeTab: 'dashboard',
                selectedYear: <?php echo e(now()->year); ?>,
                reportYear: <?php echo e(now()->year); ?>,
                announcementText: '',
                toast: { show: false, type: '', message: '' },

                allSalesData: <?php echo json_encode($allSalesData, 15, 512) ?>,
                paymentDist: <?php echo json_encode($paymentDistribution, 15, 512) ?>,

                menuModalOpen: false,
                menuForm: { category_id: '<?php echo e($categories->first()?->id ?? ""); ?>', name: '', description: '', price: '', unit: 'Porsi', stock_status: 'tersedia', is_hot: false, is_preorder_available: true },

                chartInstances: {},

                get currentYearData() {
                    return this.allSalesData[this.selectedYear] || [];
                },

                get totalYearRevenue() {
                    return this.currentYearData.reduce((sum, m) => sum + m.total_revenue, 0);
                },

                init() {
                    this.$watch('activeTab', (val) => {
                        if (val === 'sales') {
                            setTimeout(() => this.renderCharts(), 350);
                        }
                    });
                },

                changeYear(year) {
                    this.selectedYear = year;
                    this.reportYear = year;
                    setTimeout(() => this.renderCharts(), 50);
                },

                destroyChart(id) {
                    if (this.chartInstances[id]) {
                        this.chartInstances[id].destroy();
                        delete this.chartInstances[id];
                    }
                },

                renderCharts() {
                    const data = this.currentYearData;
                    const labels = data.map(d => d.month);
                    const revenues = data.map(d => d.total_revenue);
                    const orders = data.map(d => d.total_orders);

                    // --- Bar Chart: Omzet ---
                    this.destroyChart('barChart');
                    this.chartInstances['barChart'] = new Chart(document.getElementById('barChart'), {
                        type: 'bar',jam 
                        data: {
                            labels,
                            datasets: [{
                                label: 'Omzet (Rp)',
                                data: revenues,
                                backgroundColor: 'rgba(245, 158, 11, 0.85)',
                                borderColor: '#D97706',
                                borderWidth: 1,
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: { y: { ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') } } }
                        }
                    });

                    // --- Line Chart: Tren Order ---
                    this.destroyChart('lineChart');
                    this.chartInstances['lineChart'] = new Chart(document.getElementById('lineChart'), {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Jumlah Pesanan',
                                data: orders,
                                borderColor: '#059669',
                                backgroundColor: 'rgba(5, 150, 105, 0.12)',
                                tension: 0.4,
                                fill: true,
                                borderWidth: 3,
                                pointBackgroundColor: '#059669',
                                pointRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                        }
                    });

                    // --- Pie / Doughnut Chart: Metode Bayar ---
                    this.destroyChart('pieChart');
                    const pieLabels = this.paymentDist.map(p => p.payment_method ? p.payment_method.toUpperCase() : 'LAINNYA');
                    const pieData   = this.paymentDist.map(p => p.count);
                    this.chartInstances['pieChart'] = new Chart(document.getElementById('pieChart'), {
                        type: 'doughnut',
                        data: {
                            labels: pieLabels.length ? pieLabels : ['Belum Ada Data'],
                            datasets: [{
                                data: pieData.length ? pieData : [1],
                                backgroundColor: ['#3B82F6','#8B5CF6','#10B981','#F59E0B','#EF4444','#64748B','#06B6D4'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'right', labels: { boxWidth: 14 } } }
                        }
                    });
                },

                showToast(type, message) {
                    this.toast = { show: true, type, message };
                    setTimeout(() => this.toast.show = false, 3000);
                },

                async updateOrderStatus(id, status) {
                    try {
                        const res = await fetch(`/admin/orders/${id}/status`, {
                            method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                            body: JSON.stringify({ status })
                        });
                        if(res.ok) this.showToast('success', 'Status pesanan berhasil diupdate!');
                    } catch(e) { this.showToast('error', 'Gagal update status'); }
                },

                exportCSV() {
                    window.location.href = `/admin/sales/export?month=0&year=${this.selectedYear}`;
                },

                async sendAnnouncement() {
                    try {
                        const res = await fetch('/admin/chat/announce', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                            body: JSON.stringify({ message: this.announcementText })
                        });
                        if(res.ok) {
                            this.showToast('success', 'Pengumuman terkirim ke Sobat Lapak!');
                            this.announcementText = '';
                        }
                    } catch(e) { this.showToast('error', 'Gagal kirim pengumuman'); }
                },

                openMenuModal() {
                    this.menuForm = { category_id: '<?php echo e($categories->first()?->id ?? ""); ?>', name: '', description: '', price: '', unit: 'Porsi', stock_status: 'tersedia', is_hot: false, is_preorder_available: true };
                    this.menuModalOpen = true;
                },

                async submitMenu() {
                    try {
                        const res = await fetch('/admin/menus', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify(this.menuForm)
                        });
                        const data = await res.json();
                        if (data.success) {
                            this.showToast('success', 'Menu berhasil ditambahkan!');
                            this.menuModalOpen = false;
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            this.showToast('error', data.message || 'Gagal menambahkan menu');
                        }
                    } catch(e) {
                        this.showToast('error', 'Terjadi kesalahan sistem');
                    }
                },

                async respondFeedback(id) {
                    const input = document.getElementById('fb-reply-' + id);
                    if(!input.value) return;
                    try {
                        const res = await fetch(`/admin/feedbacks/${id}/respond`, {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                            body: JSON.stringify({ response: input.value })
                        });
                        if(res.ok) {
                            this.showToast('success', 'Balasan berhasil dikirim!');
                            setTimeout(() => location.reload(), 1000);
                        }
                    } catch(e) { this.showToast('error', 'Gagal mengirim balasan'); }
                }
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Website_Lapak1Putri2Putra_FixedHendri\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>