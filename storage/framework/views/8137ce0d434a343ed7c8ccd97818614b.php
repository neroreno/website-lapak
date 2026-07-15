<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sobat Lapak — Halaman Member LAPAK 1 PUTRI 2 PUTRA">
    <title>Sobat Lapak — LAPAK 1 PUTRI 2 PUTRA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-amber-50 text-slate-800 min-h-screen"
    x-data="memberApp()"
    x-init="init()"
    @keydown.escape.window="cartOpen = false; reviewModalOpen = false; preorderModalOpen = false; receiptModalOpen = false">

    
    <div x-show="toast.show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-4 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="translate-y-4 opacity-0"
        class="fixed top-4 right-4 z-[100] max-w-sm" style="display:none;">
        <div :class="toast.type === 'success' ? 'bg-emerald-600' : toast.type === 'error' ? 'bg-rose-600' : 'bg-blue-600'" class="px-5 py-4 rounded-2xl shadow-2xl text-white">
            <p class="font-bold text-sm" x-text="toast.title"></p>
            <p class="text-xs mt-0.5 opacity-90" x-text="toast.message"></p>
        </div>
    </div>

    
    <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-sm border-b border-amber-100 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between gap-3">
            <a href="/" class="flex items-center gap-2 shrink-0">
                <div class="flex items-center justify-center w-12 h-12 shrink-0">
                    <svg viewBox="0 0 54 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-12 h-9">
                        <circle cx="6" cy="10" r="4" fill="#F59E0B"/>
                        <path d="M3 19 Q1 22 1 27 H11 Q11 22 9 19" fill="#F59E0B"/>
                        <circle cx="3.5" cy="7" r="1.3" fill="#EC4899"/>
                        <circle cx="8.5" cy="7" r="1.3" fill="#EC4899"/>
                        <path d="M2.5 22 Q6 27 9.5 22 L11 33 H1 Z" fill="#EC4899"/>
                        <circle cx="27" cy="9" r="5.5" fill="#1E40AF"/>
                        <path d="M22 20 Q21 24 21 33 H33 Q33 24 32 20" fill="#1E40AF"/>
                        <rect x="23" y="24" width="3.5" height="9" rx="1" fill="#1D4ED8"/>
                        <rect x="27.5" y="24" width="3.5" height="9" rx="1" fill="#1D4ED8"/>
                        <circle cx="48" cy="10" r="4" fill="#F59E0B"/>
                        <path d="M45 19 Q43 22 43 27 H53 Q53 22 51 19" fill="#F59E0B"/>
                        <circle cx="45.5" cy="7" r="1.3" fill="#EC4899"/>
                        <circle cx="50.5" cy="7" r="1.3" fill="#EC4899"/>
                        <path d="M44.5 22 Q48 27 51.5 22 L53 33 H43 Z" fill="#EC4899"/>
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <div class="font-extrabold text-amber-600 text-sm leading-tight">LAPAK 1 PUTRI</div>
                    <div class="font-extrabold text-emerald-600 text-sm leading-tight">2 PUTRA</div>
                </div>
            </a>

            <div class="flex-1 hidden sm:flex justify-center gap-6">
                <button @click="activeTab = 'katalog'" :class="activeTab === 'katalog' ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-slate-500 hover:text-amber-600 font-medium'" class="pb-1 transition-colors">🍽️ Katalog</button>
                <button @click="activeTab = 'chat'" :class="activeTab === 'chat' ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-slate-500 hover:text-amber-600 font-medium'" class="pb-1 transition-colors">💬 Chat Room</button>
                <button @click="activeTab = 'riwayat'" :class="activeTab === 'riwayat' ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-slate-500 hover:text-amber-600 font-medium'" class="pb-1 transition-colors">📋 Riwayat Belanja</button>
                <button @click="activeTab = 'profil'" :class="activeTab === 'profil' ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-slate-500 hover:text-amber-600 font-medium'" class="pb-1 transition-colors">👤 Profil Member</button>
            </div>

            <div class="flex items-center gap-2">
                <button @click="cartOpen = true" id="btn-cart" class="relative flex items-center gap-1.5 px-3 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white transition-colors shadow-md shadow-amber-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h7m-7 0a1 1 0 100 2 1 1 0 000-2zm7 0a1 1 0 100 2 1 1 0 000-2z"/></svg>
                    <span class="text-sm font-semibold hidden sm:inline">Keranjang</span>
                    <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1.5 -right-1.5 min-w-5 h-5 px-1 rounded-full bg-rose-500 text-white text-xs font-bold flex items-center justify-center badge-pulse" style="display:none;"></span>
                </button>
                <form action="/logout" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-6 pb-28">

        
        <div x-show="activeTab === 'katalog'" x-transition>
            <div class="mb-6 p-5 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-600 text-white shadow-lg shadow-amber-200/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold mb-1">Halo, <?php echo e($user->name); ?>! 👑</h1>
                    <p class="text-amber-50 text-sm">Pesanan khusus member Sobat Lapak. Pesan untuk hari ini atau PreOrder untuk besok!</p>
                </div>
                <div class="bg-white/20 px-4 py-2.5 rounded-xl border border-white/30 text-center shrink-0">
                    <p class="text-xs text-amber-50 font-medium">Poin Anda</p>
                    <p class="text-2xl font-black"><?php echo e($user->points); ?><span class="text-base ml-1">⭐</span></p>
                </div>
            </div>

            
            <div class="flex gap-2 overflow-x-auto py-2 mb-4 scrollbar-hide no-scrollbar">
                <button @click="activeCategory = 'semua'" :class="activeCategory === 'semua' ? 'category-tab-active' : 'bg-white border border-slate-200 text-slate-600 hover:bg-amber-50 hover:text-amber-700'" class="shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm">
                    <span>🍽️</span><span>Semua Menu</span>
                </button>
                <template x-for="cat in categories" :key="cat.id">
                    <button @click="activeCategory = cat.slug" :class="activeCategory === cat.slug ? 'category-tab-active' : 'bg-white border border-slate-200 text-slate-600 hover:bg-amber-50 hover:text-amber-700'" class="shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm">
                        <span x-text="cat.icon"></span><span x-text="cat.name"></span>
                    </button>
                </template>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                <template x-for="item in filteredMenus" :key="item.id">
                    <div class="menu-card bg-white rounded-2xl overflow-hidden shadow-sm border border-amber-100 hover:border-amber-300 relative" :class="!item.is_preorder_available ? 'opacity-70' : ''">
                        <div x-show="!item.is_preorder_available" class="absolute inset-0 z-10 bg-white/50 backdrop-blur-[1px] flex items-center justify-center p-4">
                            <span class="bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">Tidak Tersedia untuk PO</span>
                        </div>
                        <div class="relative aspect-square overflow-hidden bg-amber-50">
                            <img :src="item.image_path" :alt="item.name" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" loading="lazy" onerror="this.src='https://placehold.co/400x400/FEF3C7/F59E0B?text=🍽️'">
                        </div>
                        <div class="p-3">
                            <h3 class="font-bold text-slate-800 text-sm leading-tight mb-1" x-text="item.name"></h3>
                            <div class="flex items-center gap-1 mb-2">
                                <template x-for="s in 5" :key="s">
                                    <span class="text-xs" :class="s <= Math.round(item.avg_rating) ? 'text-amber-400' : 'text-slate-200'" x-text="'★'"></span>
                                </template>
                                <span class="text-xs text-slate-400" x-text="'(' + item.review_count + ')'"></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-extrabold text-amber-600 text-sm" x-text="formatRupiah(item.price)"></span>
                            </div>
                            <button @click="addToCart(item)" class="w-full mt-2.5 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold transition-all shadow-md">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            
            <div class="mt-12 bg-white rounded-3xl shadow-sm border border-amber-100 p-6">
                <h2 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">👑 Ulasan Sobat Lapak</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php $__currentLoopData = $memberReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-amber-50 rounded-2xl p-4 border border-amber-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold"><?php echo e(substr($review->reviewer_name, 0, 1)); ?></div>
                            <div>
                                <p class="font-bold text-sm text-slate-800"><?php echo e($review->reviewer_name); ?></p>
                                <p class="text-xs text-amber-600 font-semibold"><?php echo e($review->menu->name ?? 'Menu'); ?></p>
                            </div>
                            <div class="ml-auto text-amber-400 text-sm tracking-widest">
                                <?php for($i = 0; $i < $review->rating; $i++): ?>★<?php endfor; ?>
                            </div>
                        </div>
                        <p class="text-sm text-slate-700 italic">"<?php echo e($review->comment); ?>"</p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div x-show="activeTab === 'chat'" x-transition style="display:none;" class="bg-white rounded-3xl shadow-sm border border-amber-100 overflow-hidden flex flex-col h-[70vh]">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 p-4 shrink-0">
                <h2 class="text-white font-extrabold text-lg flex items-center gap-2">💬 Sobat Lapak Chat Room</h2>
                <p class="text-emerald-100 text-xs mt-0.5">Ruang ngobrol member & info promo dari admin</p>
            </div>
            
            <div id="chat-container" class="flex-1 p-4 overflow-y-auto bg-slate-50 space-y-4">
                <template x-for="chat in chats" :key="chat.id">
                    <div>
                        
                        <div x-show="chat.type === 'admin_announcement'" class="my-4 max-w-lg mx-auto bg-amber-100 border border-amber-300 rounded-2xl p-4 shadow-sm text-center">
                            <p class="text-xs font-bold text-amber-700 mb-1">📢 PENGUMUMAN LAPAK</p>
                            <p class="text-sm text-amber-900 font-semibold" x-text="chat.message"></p>
                            <p class="text-[10px] text-amber-600 mt-2" x-text="new Date(chat.created_at).toLocaleString('id-ID')"></p>
                        </div>

                        
                        <div x-show="chat.type === 'member' && chat.user_id === <?php echo e($user->id); ?>" class="flex justify-end mb-2">
                            <div class="max-w-[75%]">
                                <p class="text-[10px] text-slate-400 text-right mb-0.5" x-text="chat.user?.name + ' (Anda)'"></p>
                                <div class="bg-emerald-500 text-white p-3 rounded-2xl rounded-tr-none shadow-sm">
                                    <p class="text-sm" x-text="chat.message"></p>
                                </div>
                                <p class="text-[10px] text-slate-400 text-right mt-1" x-text="new Date(chat.created_at).toLocaleTimeString('id-ID')"></p>
                            </div>
                        </div>

                        
                        <div x-show="chat.type === 'member' && chat.user_id !== <?php echo e($user->id); ?>" class="flex justify-start mb-2">
                            <div class="max-w-[75%]">
                                <p class="text-[10px] text-slate-500 mb-0.5 font-semibold" x-text="chat.user?.name"></p>
                                <div class="bg-white border border-slate-200 text-slate-700 p-3 rounded-2xl rounded-tl-none shadow-sm">
                                    <p class="text-sm" x-text="chat.message"></p>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1" x-text="new Date(chat.created_at).toLocaleTimeString('id-ID')"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="p-3 bg-white border-t border-slate-200 shrink-0 flex gap-2">
                <input x-model="chatInput" @keyup.enter="sendChat()" type="text" placeholder="Ketik pesan..." class="flex-1 px-4 py-2.5 bg-slate-100 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-0 rounded-full text-sm transition-colors">
                <button @click="sendChat()" class="w-10 h-10 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center transition-colors shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </div>
        </div>

        
        <div x-show="activeTab === 'riwayat'" x-transition style="display:none;" class="space-y-4">
            <h2 class="text-xl font-extrabold text-slate-800 mb-4 flex items-center gap-2">📋 Riwayat Belanja (30 Hari Terakhir)</h2>
            
            <template x-for="order in orders" :key="order.id">
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-start mb-3 border-b border-slate-100 pb-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-slate-800" x-text="order.order_number"></p>
                                <span x-show="order.is_preorder" class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold uppercase">PreOrder</span>
                            </div>
                            <p class="text-xs text-slate-500" x-text="new Date(order.created_at).toLocaleString('id-ID')"></p>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase" 
                                :class="order.order_status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'"
                                x-text="order.order_status">
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-1 mb-3">
                        <template x-for="item in order.items" :key="item.id">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600" x-text="item.quantity + 'x ' + item.menu_name"></span>
                                <span class="font-medium text-slate-800" x-text="formatRupiah(item.subtotal)"></span>
                            </div>
                        </template>
                    </div>

                    <div class="border-t border-dashed border-slate-200 pt-3 flex justify-between items-end">
                        <div>
                            <p class="text-xs text-slate-500 mb-0.5" x-text="'Bayar via ' + order.payment_method.toUpperCase()"></p>
                            <p x-show="order.points_earned > 0" class="text-xs font-bold text-amber-600" x-text="'+' + order.points_earned + ' Poin'"></p>
                        </div>
                        <div class="text-right">
                            <p x-show="order.discount > 0" class="text-xs text-emerald-600 mb-0.5" x-text="'Diskon: -' + formatRupiah(order.discount)"></p>
                            <p class="font-extrabold text-slate-800 text-base" x-text="formatRupiah(order.total)"></p>
                        </div>
                    </div>
                </div>
            </template>
            <div x-show="orders.length === 0" class="text-center py-10 bg-white rounded-3xl border border-slate-200">
                <p class="text-slate-500">Belum ada pesanan dalam 30 hari terakhir.</p>
            </div>
        </div>

        
        <div x-show="activeTab === 'profil'" x-transition style="display:none;" class="space-y-6">
            
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-amber-100">
                <div class="h-24 bg-gradient-to-br from-amber-400 via-amber-500 to-emerald-500"></div>
                <div class="px-6 pb-6">
                    <div class="flex items-end gap-4 -mt-10 mb-4">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-200 border-4 border-white shadow-lg flex items-center justify-center text-4xl shrink-0">👤</div>
                        <div class="pb-1">
                            <h1 class="font-extrabold text-slate-800 text-xl" x-text="user.name"></h1>
                            <p class="text-slate-500 text-sm" x-text="user.email"></p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-slate-600">⭐ Akumulasi Poin</span>
                                <span class="font-extrabold text-amber-600 text-xl" x-text="user.points + ' Poin'"></span>
                            </div>
                            <div class="mt-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200">
                                <p class="text-xs font-semibold text-emerald-800 mb-1">Tukar Poin jadi Voucher Diskon!</p>
                                <p class="text-[10px] text-emerald-600 mb-2">Tukar poin dengan voucher (Batas 1x per jenis per hari)</p>
                                <div class="space-y-2">
                                    <button @click="exchangeVoucher('10_percent', 50)" class="w-full py-2 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition-colors">
                                        Tukar 50 Poin (Diskon 10%)
                                    </button>
                                    <button @click="exchangeVoucher('15_percent', 75)" class="w-full py-2 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition-colors">
                                        Tukar 75 Poin (Diskon 15%)
                                    </button>
                                    <button @click="exchangeVoucher('20_percent', 100)" class="w-full py-2 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition-colors">
                                        Tukar 100 Poin (Diskon 20%)
                                    </button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200">
                            <h3 class="font-bold text-sm text-slate-700 mb-3">🎫 Inventaris Voucher Saya</h3>
                            <div class="space-y-2 max-h-60 overflow-y-auto pr-1">
                                <template x-for="v in vouchers" :key="v.id">
                                    <div class="p-3 bg-white border border-amber-100 rounded-xl shadow-sm">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="font-bold text-amber-600 text-sm" x-text="'Diskon ' + v.discount_percentage + '%'"></p>
                                                <p class="text-[10px] text-slate-400" x-show="v.status==='active'" x-text="'Aktif hingga: ' + new Date(v.expires_at).toLocaleString('id-ID')"></p>
                                            </div>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase"
                                                :class="v.status === 'stored' ? 'bg-slate-100 text-slate-600' : (v.status === 'active' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600')"
                                                x-text="v.status"></span>
                                        </div>
                                        <button x-show="v.status === 'stored'" @click="activateVoucher(v.id)" class="w-full py-1.5 bg-amber-500 text-white text-xs font-bold rounded-lg hover:bg-amber-600 transition-colors">
                                            Aktifkan (Berlaku 24 Jam)
                                        </button>
                                    </div>
                                </template>
                                <div x-show="vouchers.length === 0" class="text-center py-4">
                                    <p class="text-xs text-slate-400">Belum ada voucher. Tukarkan poin Anda!</p>
                                </div>
                            </div>
                        </div>

                        
                        <div class="space-y-3">
                            <h3 class="font-bold text-sm text-slate-700 mb-2">Ubah Data Diri</h3>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Nama</label>
                                <input x-model="profileForm.name" type="text" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Nomor HP</label>
                                <input x-model="profileForm.phone" type="text" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Alamat</label>
                                <textarea x-model="profileForm.address" rows="2" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 resize-none"></textarea>
                            </div>
                            <button @click="updateProfile()" class="px-4 py-2 bg-slate-800 text-white text-sm font-bold rounded-xl hover:bg-slate-900 transition-colors">Simpan Profil</button>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100"><h3 class="font-bold text-slate-700">📋 Riwayat Poin Terakhir</h3></div>
                <div class="divide-y divide-slate-50">
                    <template x-for="r in pointHistories" :key="r.id">
                        <div class="flex items-center gap-3 px-5 py-3.5">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-lg shrink-0" :class="r.type === 'earn' ? 'bg-emerald-50' : 'bg-amber-50'">
                                <span x-text="r.type === 'earn' ? '➕' : '🎁'"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-700 text-sm" x-text="r.description"></p>
                                <p class="text-xs text-slate-400" x-text="new Date(r.created_at).toLocaleDateString('id-ID')"></p>
                            </div>
                            <span :class="r.type === 'earn' ? 'text-emerald-600 bg-emerald-50' : 'text-amber-600 bg-amber-50'" class="font-extrabold text-sm px-2.5 py-0.5 rounded-full" x-text="(r.type === 'earn' ? '+' : '') + r.points + ' Poin'"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </main>

    
    <aside x-show="cartOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed right-0 top-0 h-full w-full sm:w-96 bg-white z-50 shadow-2xl flex flex-col" style="display:none;">
        <div class="flex items-center justify-between px-5 py-4 border-b border-emerald-100 bg-gradient-to-r from-emerald-50 to-white">
            <div>
                <h2 class="font-extrabold text-slate-800 text-lg">🛒 Keranjang Belanja</h2>
                <p class="text-xs text-slate-500" x-text="cartCount + ' item'"></p>
            </div>
            <button @click="cartOpen = false" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto cart-scrollbar px-4 py-3">
            <div x-show="cart.length === 0" class="flex flex-col items-center justify-center h-full text-center py-10" style="display:none;">
                <div class="text-5xl mb-3">🛒</div>
                <p class="font-semibold text-slate-600">Keranjang masih kosong</p>
            </div>
            <div x-show="cart.length > 0" style="display:none;">
                <template x-for="(item, index) in cart" :key="item.id">
                    <div class="flex items-center gap-3 py-3 border-b border-slate-50">
                        <img :src="item.image_path" :alt="item.name" class="w-12 h-12 rounded-xl object-cover bg-slate-50">
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-slate-800 text-sm leading-tight truncate" x-text="item.name"></p>
                            <p class="text-amber-600 font-bold text-sm mt-0.5" x-text="formatRupiah(item.price)"></p>
                        </div>
                        <div class="flex items-center gap-1.5 shrink-0">
                            <button @click="decreaseQty(index)" class="w-6 h-6 rounded-lg bg-slate-100 text-slate-600 font-bold leading-none">−</button>
                            <span class="w-4 text-center font-bold text-sm" x-text="item.qty"></span>
                            <button @click="increaseQty(index)" class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-700 font-bold leading-none">+</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="cart.length > 0" class="border-t border-slate-100 bg-slate-50 px-4 py-4 space-y-3" style="display:none;">
            <div class="flex justify-between text-sm"><span class="text-slate-600">Subtotal:</span><span class="font-bold" x-text="formatRupiah(cartTotal)"></span></div>
            <div x-show="selectedVoucher" class="flex justify-between text-sm"><span class="text-emerald-600 font-semibold">Voucher Diskon:</span><span class="font-bold text-emerald-600" x-text="'-' + formatRupiah(discountAmount)"></span></div>
            <div class="flex items-center justify-between pt-2 border-t border-slate-200">
                <span class="font-bold text-slate-700">Total:</span>
                <span class="font-black text-xl text-emerald-600" x-text="formatRupiah(cartTotal - discountAmount)"></span>
            </div>
            
            <div class="space-y-2">
                <select x-model="isPreorder" class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-emerald-400 bg-white">
                    <option value="0">Pembelian Langsung (Hari Ini)</option>
                    <option value="1">PreOrder (Untuk Besok)</option>
                </select>
                <select x-model="selectedVoucherId" class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-emerald-400 bg-white">
                    <option value="">-- Pilih Voucher Aktif (Opsional) --</option>
                    <template x-for="v in activeVouchers" :key="v.id">
                        <option :value="v.id" x-text="'Diskon ' + v.discount_percentage + '%'"></option>
                    </template>
                </select>
                <select x-model="paymentMethod" class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-emerald-400 bg-white">
                    <option value="">Pilih Metode Pembayaran...</option>
                    <option value="qris">QRIS (Scan & Pay)</option>
                    <option value="gopay">GoPay</option>
                    <option value="ovo">OVO</option>
                    <option value="dana">DANA</option>
                    <option value="bca">Transfer BCA</option>
                    <option value="mandiri">Transfer Mandiri</option>
                    <option value="bri">Transfer BRI</option>
                </select>
                <input x-model="notes" type="text" placeholder="Catatan pesanan..." class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 bg-white">
                <button @click="processCheckout()" :disabled="!paymentMethod || loading" :class="paymentMethod ? 'bg-gradient-to-r from-emerald-500 to-emerald-600' : 'bg-slate-300'" class="w-full py-3.5 rounded-2xl text-white font-extrabold text-base shadow-lg mt-2 transition-colors">
                    <span x-show="!loading">Konfirmasi Pesanan</span>
                    <span x-show="loading">Memproses...</span>
                </button>
            </div>
        </div>
    </aside>

    
    <nav class="fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-amber-100 shadow-lg sm:hidden">
        <div class="flex justify-around">
            <button @click="activeTab = 'katalog'" class="p-3 text-center flex-1" :class="activeTab==='katalog'?'text-amber-600':'text-slate-400'"><div class="text-xl">🍽️</div><span class="text-[10px] font-bold">Menu</span></button>
            <button @click="activeTab = 'chat'" class="p-3 text-center flex-1" :class="activeTab==='chat'?'text-amber-600':'text-slate-400'"><div class="text-xl">💬</div><span class="text-[10px] font-bold">Chat</span></button>
            <button @click="activeTab = 'riwayat'" class="p-3 text-center flex-1" :class="activeTab==='riwayat'?'text-amber-600':'text-slate-400'"><div class="text-xl">📋</div><span class="text-[10px] font-bold">Riwayat</span></button>
            <button @click="activeTab = 'profil'" class="p-3 text-center flex-1" :class="activeTab==='profil'?'text-amber-600':'text-slate-400'"><div class="text-xl">👤</div><span class="text-[10px] font-bold">Profil</span></button>
        </div>
    </nav>

    
    <footer class="bg-slate-800 text-white pb-24 sm:pb-8 mt-12">
        <div class="max-w-5xl mx-auto px-4 py-8">
            <div class="text-center">
                <p class="text-slate-400 text-sm mb-2">LAPAK 1 PUTRI 2 PUTRA</p>
                <p class="text-slate-400 text-sm mb-2">Alamat : Jalan Martadinata No. 64</p>
                <p class="text-slate-400 text-sm mb-2">Jam operasional 10:00 - 17:00 WIT</p>
                <p class="text-slate-500 text-xs">© 2026 LAPAK 1 PUTRI 2 PUTRA. All rights reserved.</p>
                <p class="text-slate-600 text-xs mt-1">Developed by <span class="text-amber-500 font-semibold">UbrotherrDev</span></p>
            </div>
        </div>
    </footer>

    <script>
        function memberApp() {
            return {
                activeTab: 'katalog', search: '', activeCategory: 'semua',
                cartOpen: false, loading: false,
                cart: [], categories: <?php echo json_encode($categories, 15, 512) ?>, menus: <?php echo json_encode($menus, 15, 512) ?>,
                user: <?php echo json_encode($user, 15, 512) ?>,
                orders: <?php echo json_encode($recentOrders, 15, 512) ?>,
                pointHistories: <?php echo json_encode($pointHistories, 15, 512) ?>,
                chats: <?php echo json_encode($chatMessages, 15, 512) ?>,
                vouchers: <?php echo json_encode($vouchers ?? [], 15, 512) ?>,
                paymentMethod: '', notes: '', chatInput: '',
                isPreorder: '0', selectedVoucherId: '',
                profileForm: { name: '<?php echo e($user->name); ?>', phone: '<?php echo e($user->phone); ?>', address: '<?php echo e($user->address); ?>' },
                toast: { show: false, type: '', title: '', message: '' },

                get filteredMenus() {
                    return this.menus.filter(item => {
                        const catSlug = item.category ? item.category.slug : '';
                        const matchCat = this.activeCategory === 'semua' || catSlug === this.activeCategory;
                        const matchSearch = item.name.toLowerCase().includes(this.search.toLowerCase());
                        return matchCat && matchSearch;
                    });
                },
                get activeVouchers() {
                    return this.vouchers.filter(v => v.status === 'active' && new Date(v.expires_at) > new Date());
                },
                get selectedVoucher() {
                    return this.activeVouchers.find(v => v.id == this.selectedVoucherId);
                },
                get cartCount() { return this.cart.reduce((s, i) => s + i.qty, 0); },
                get cartTotal() { return this.cart.reduce((s, i) => s + (i.price * i.qty), 0); },
                get discountAmount() {
                    if (this.selectedVoucher) {
                        return Math.floor(this.cartTotal * (this.selectedVoucher.discount_percentage / 100));
                    }
                    return 0;
                },

                init() {
                    const saved = localStorage.getItem('lapak_member_cart');
                    if (saved) this.cart = JSON.parse(saved);
                    this.$watch('cart', val => localStorage.setItem('lapak_member_cart', JSON.stringify(val)));
                    this.scrollToBottomChat();
                    this.startChatPolling();
                },
                startChatPolling() {
                    // Polling tiap 4 detik supaya pesan dari member lain / pengumuman admin
                    // muncul otomatis tanpa reload manual.
                    this.chatPollInterval = setInterval(() => this.pollChat(), 4000);
                    // Hemat request: berhenti polling kalau tab browser tidak aktif,
                    // lanjut lagi begitu user kembali membuka tab.
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            clearInterval(this.chatPollInterval);
                        } else {
                            this.pollChat();
                            this.chatPollInterval = setInterval(() => this.pollChat(), 4000);
                        }
                    });
                },
                async pollChat() {
                    try {
                        const res = await fetch('/member/chat', { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return;
                        const fresh = await res.json();
                        if (fresh.length !== this.chats.length) {
                            const wasAtBottom = this.isChatScrolledToBottom();
                            this.chats = fresh;
                            if (wasAtBottom) this.scrollToBottomChat();
                        }
                    } catch (e) { /* diamkan, coba lagi di polling berikutnya */ }
                },
                isChatScrolledToBottom() {
                    const el = document.getElementById('chat-container');
                    if (!el) return true;
                    return el.scrollHeight - el.scrollTop - el.clientHeight < 80;
                },
                formatRupiah(n) { return 'Rp ' + n.toLocaleString('id-ID'); },
                showToast(type, title, message) {
                    this.toast = { show: true, type, title, message };
                    setTimeout(() => this.toast.show = false, 4000);
                },
                addToCart(item) {
                    if (this.isPreorder === '1' && !item.is_preorder_available) {
                        this.showToast('error', '⚠️ Tidak Tersedia', item.name + ' tidak bisa di-PreOrder.');
                        return;
                    }
                    const idx = this.cart.findIndex(c => c.id === item.id);
                    if (idx !== -1) { this.cart[idx].qty++; } else { this.cart.push({ ...item, qty: 1 }); }
                    this.showToast('success', '🛒 Ditambahkan', item.name + ' masuk Keranjang');
                },
                increaseQty(i) { this.cart[i].qty++; },
                decreaseQty(i) { this.cart[i].qty <= 1 ? this.cart.splice(i, 1) : this.cart[i].qty--; },
                scrollToBottomChat() {
                    setTimeout(() => {
                        const el = document.getElementById('chat-container');
                        if(el) el.scrollTop = el.scrollHeight;
                    }, 100);
                },
                
                async sendChat() {
                    if(!this.chatInput.trim()) return;
                    try {
                        const res = await fetch('/member/chat', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ message: this.chatInput })
                        });
                        const data = await res.json();
                        if(data.success) {
                            this.chats.push(data.message);
                            this.chatInput = '';
                            this.scrollToBottomChat();
                        }
                    } catch(e) {}
                },

                async updateProfile() {
                    try {
                        const res = await fetch('/member/profile', {
                            method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify(this.profileForm)
                        });
                        const data = await res.json();
                        if(data.success) {
                            this.user.name = this.profileForm.name;
                            this.showToast('success', '✅ Profil Disimpan', data.message);
                        }
                    } catch(e) { this.showToast('error', '❌ Error', 'Gagal update profil'); }
                },

                async exchangeVoucher(type, pointsNeeded) {
                    if(!confirm('Tukar ' + pointsNeeded + ' Poin untuk Voucher ini?')) return;
                    try {
                        const res = await fetch('/member/vouchers/exchange', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ type })
                        });
                        const data = await res.json();
                        if(data.success) {
                            this.user.points = data.remaining_points;
                            this.showToast('success', '🎉 Berhasil', data.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', '⚠️ Gagal', data.message);
                        }
                    } catch(e) { this.showToast('error', '❌ Error', 'Gagal menukar poin'); }
                },

                async activateVoucher(voucherId) {
                    if(!confirm('Aktifkan voucher ini sekarang? Voucher hanya berlaku 24 jam setelah diaktifkan.')) return;
                    try {
                        const res = await fetch('/member/vouchers/activate', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ voucher_id: voucherId })
                        });
                        const data = await res.json();
                        if(data.success) {
                            this.showToast('success', '✅ Aktif', data.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', '⚠️ Gagal', data.message);
                        }
                    } catch(e) { this.showToast('error', '❌ Error', 'Gagal mengaktifkan voucher'); }
                },

                async processCheckout() {
                    if(this.cart.length === 0 || !this.paymentMethod) return;
                    this.loading = true;
                    try {
                        const items = this.cart.map(c => ({ menu_id: c.id, quantity: c.qty }));
                        const res = await fetch('/member/checkout', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ 
                                payment_method: this.paymentMethod, 
                                notes: this.notes, 
                                items,
                                is_preorder: this.isPreorder === '1',
                                voucher_id: this.selectedVoucherId || null
                            })
                        });
                        const data = await res.json();
                        if(data.success) {
                            this.cart = []; this.paymentMethod = ''; this.notes = ''; this.selectedVoucherId = '';
                            this.cartOpen = false;
                            this.showToast('success', '🎉 Sukses!', data.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            this.showToast('error', '⚠️ Gagal', data.message);
                        }
                    } catch(e) { this.showToast('error', '❌ Error', 'Terjadi kesalahan sistem'); }
                    this.loading = false;
                }
            }
        }
    </script>
</body>
</html><?php /**PATH D:\laragon\www\LAPAK_1_PUTRI_2_PUTRA_FIXED\resources\views/member.blade.php ENDPATH**/ ?>