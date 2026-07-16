<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LAPAK 1 PUTRI 2 PUTRA — Pesan aneka lauk-pauk segar harian langsung ke rumah Anda. Mudah, cepat, dan lezat!">
    <meta name="keywords" content="lauk pauk, pesan makanan, warung makan, catering harian, ayam goreng, rendang">
    <meta name="theme-color" content="#F59E0B">
    <title>LAPAK 1 PUTRI 2 PUTRA — Lauk-Pauk Segar Setiap Hari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-amber-50 text-slate-800 min-h-screen"
    x-data="lapakApp()"
    x-init="init()"
    @keydown.escape.window="cartOpen = false; reviewModalOpen = false; paymentModalOpen = false; receiptModalOpen = false; feedbackModalOpen = false">

    
    <div x-show="toast.show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-4 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="translate-y-4 opacity-0"
        class="fixed top-4 right-4 z-[100] max-w-sm" style="display:none;">
        <div :class="toast.type === 'success' ? 'bg-emerald-600' : toast.type === 'error' ? 'bg-rose-600' : 'bg-blue-600'" class="px-5 py-4 rounded-2xl shadow-2xl text-white">
            <p class="font-bold text-sm" x-text="toast.title"></p>
            <p class="text-xs mt-0.5 opacity-90" x-text="toast.message"></p>
        </div>
    </div>

    
    <div x-show="cartOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" @click="cartOpen = false" class="fixed inset-0 bg-black/50 cart-overlay z-40" style="display:none;"></div>

    
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

            <div class="flex-1 max-w-xs hidden sm:block">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input x-model="search" type="search" placeholder="Cari lauk pauk favoritmu..." id="search-desktop" class="w-full pl-9 pr-4 py-2 text-sm rounded-xl border border-amber-200 bg-amber-50 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(auth()->user()->isAdmin() ? '/admin' : '/member'); ?>" class="hidden sm:flex items-center gap-1.5 px-3 py-2 rounded-xl bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition-colors">
                    <span class="text-emerald-600">👤</span>
                    <span class="text-xs font-semibold text-emerald-700"><?php echo e(auth()->user()->name); ?></span>
                </a>
                <?php else: ?>
                <a href="/login" id="btn-login-header" class="hidden sm:flex items-center gap-1.5 px-3 py-2 rounded-xl bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition-colors">
                    <span class="text-emerald-600"></span>
                    <span class="text-xs font-semibold text-emerald-700">Login / Daftar</span>
                </a>
                <?php endif; ?>

                <button @click="cartOpen = true" id="btn-cart" class="relative flex items-center gap-1.5 px-3 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white transition-colors shadow-md shadow-amber-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h7m-7 0a1 1 0 100 2 1 1 0 000-2zm7 0a1 1 0 100 2 1 1 0 000-2z"/></svg>
                    <span class="text-sm font-semibold hidden sm:inline">Keranjang</span>
                    <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1.5 -right-1.5 min-w-5 h-5 px-1 rounded-full bg-rose-500 text-white text-xs font-bold flex items-center justify-center badge-pulse" style="display:none;"></span>
                </button>
            </div>
        </div>
    </header>

    
    <section class="hero-gradient border-b border-amber-100">
        <div class="max-w-5xl mx-auto px-4 py-8 sm:py-12">
            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Buka & Siap Melayani
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-800 leading-tight mb-2">LAPAK 1 PUTRI 2 PUTRA</h1>
                <p class="text-slate-500 text-sm sm:text-base max-w-md mx-auto">Sajian lauk-pauk segar &amp; lezat setiap hari — langsung ke meja makan Anda</p>
            </div>
            <div class="max-w-lg mx-auto">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input x-model="search" type="search" placeholder="Cari Lauk Pauk Favoritmu... (Ayam, Rendang, Sayur)" id="search-hero" class="w-full pl-12 pr-24 py-3.5 text-sm rounded-2xl border-2 border-amber-200 bg-white shadow-md focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 transition-all">
                    <button class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold transition-colors">Cari</button>
                </div>
            </div>
        </div>
    </section>

    
    <section class="sticky top-[65px] z-20 bg-white border-b border-amber-100 shadow-sm">
        <div class="max-w-5xl mx-auto px-4">
            <div class="flex gap-2 overflow-x-auto py-3 scrollbar-hide no-scrollbar">
                <button @click="activeCategory = 'semua'" :class="activeCategory === 'semua' ? 'category-tab-active' : 'bg-slate-100 text-slate-600 hover:bg-amber-50 hover:text-amber-700'" class="shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200">
                    <span></span><span>Semua Menu</span>
                </button>
                <template x-for="cat in categories" :key="cat.id">
                    <button @click="activeCategory = cat.slug" :class="activeCategory === cat.slug ? 'category-tab-active' : 'bg-slate-100 text-slate-600 hover:bg-amber-50 hover:text-amber-700'" class="shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200">
                        <span x-text="cat.icon"></span><span x-text="cat.name"></span>
                    </button>
                </template>
            </div>
        </div>
    </section>

    
    <main class="max-w-5xl mx-auto px-4 py-6 pb-28">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-slate-500">
                Menampilkan <span class="font-semibold text-amber-600" x-text="filteredMenus.length"></span> menu
                <span x-show="search !== ''" class="font-semibold text-slate-700" x-text="'untuk &quot;' + search + '&quot;'"></span>
            </p>
            <div class="flex items-center gap-1 text-xs text-emerald-600 font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Fresh today
            </div>
        </div>

        <div x-show="filteredMenus.length === 0" class="text-center py-16" style="display:none;">
            <div class="text-5xl mb-4">🔍</div>
            <p class="text-slate-500 font-medium">Tidak ada menu yang cocok</p>
            <button @click="search = ''; activeCategory = 'semua'" class="mt-4 px-5 py-2 rounded-xl bg-amber-500 text-white text-sm font-semibold hover:bg-amber-600 transition-colors">Lihat Semua Menu</button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
            <template x-for="item in filteredMenus" :key="item.id">
                <div class="menu-card bg-white rounded-2xl overflow-hidden shadow-sm border border-amber-50 hover:border-amber-200">
                    <div class="relative aspect-square overflow-hidden bg-amber-50">
                        <img :src="item.image_path" :alt="item.name" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" loading="lazy" onerror="this.src='https://placehold.co/400x400/FEF3C7/F59E0B?text='">
                        <span :class="{'stock-tersedia': item.stock_status === 'tersedia','stock-terbatas': item.stock_status === 'terbatas','stock-habis': item.stock_status === 'habis'}" class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-semibold" x-text="item.stock_status === 'tersedia' ? 'Tersedia' : item.stock_status === 'terbatas' ? 'Terbatas' : 'Habis'"></span>
                        <span x-show="item.is_hot" class="absolute top-2 right-2 px-2 py-0.5 rounded-full text-xs font-bold bg-rose-500 text-white"> Hot</span>
                    </div>
                    <div class="p-3">
                        <h3 class="font-bold text-slate-800 text-sm leading-tight mb-1" x-text="item.name"></h3>
                        <p class="text-xs text-slate-500 mb-1 line-clamp-2" x-text="item.description"></p>
                        
                        <div class="flex items-center gap-1 mb-2">
                            <template x-for="s in 5" :key="s">
                                <span class="text-xs" :class="s <= Math.round(item.avg_rating) ? 'text-amber-400' : 'text-slate-200'" x-text="'★'"></span>
                            </template>
                            <span class="text-xs text-slate-400" x-text="'(' + item.review_count + ')'"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-amber-600 text-sm" x-text="formatRupiah(item.price)"></span>
                            <span class="text-xs text-slate-400" x-text="'/' + item.unit"></span>
                        </div>
                        <div class="mt-2.5 flex gap-1.5">
                            <button x-show="item.stock_status !== 'habis'" @click="addToCart(item)" class="btn-add flex-1 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition-all flex items-center justify-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg> Tambah
                            </button>
                            <button x-show="item.stock_status === 'habis'" disabled class="flex-1 py-2 rounded-xl bg-slate-100 text-slate-400 text-xs font-bold cursor-not-allowed">Habis</button>
                            <button @click="openReviewModal(item)" class="py-2 px-2.5 rounded-xl border border-amber-200 text-amber-600 hover:bg-amber-50 transition-colors" title="Lihat Ulasan">
                                <span class="text-xs">⭐</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        
        <section class="mt-12 mb-8">
            <h2 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">⭐ Ulasan Pelanggan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php $__currentLoopData = $recentReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-amber-50">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-full <?php echo e($review->is_member ? 'bg-emerald-100' : 'bg-amber-100'); ?> flex items-center justify-center text-sm">
                            <?php echo e($review->is_member ? '👑' : '👤'); ?>

                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-700"><?php echo e($review->reviewer_name); ?></p>
                            <?php if($review->is_member): ?>
                            <span class="text-xs text-emerald-600 font-semibold">Sobat Lapak</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex gap-0.5 mb-2">
                        <?php for($s = 1; $s <= 5; $s++): ?>
                        <span class="text-sm <?php echo e($s <= $review->rating ? 'text-amber-400' : 'text-slate-200'); ?>">★</span>
                        <?php endfor; ?>
                    </div>
                    <p class="text-sm text-slate-600"><?php echo e($review->comment); ?></p>
                    <p class="text-xs text-slate-400 mt-2"><?php echo e($review->menu->name ?? ''); ?> • <?php echo e($review->created_at->diffForHumans()); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        
        <section class="mt-8 mb-8">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-amber-100">
                <h2 class="text-lg font-extrabold text-slate-800 mb-4">Masukan, Saran & Komplain</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <button @click="feedbackModalOpen = true; feedbackType = 'masukan'" class="p-4 rounded-2xl border-2 border-blue-200 hover:bg-blue-50 transition-colors text-center">
                        <div class="text-2xl mb-2">💡</div>
                        <p class="font-bold text-blue-700 text-sm">Masukan</p>
                    </button>
                    <button @click="feedbackModalOpen = true; feedbackType = 'saran'" class="p-4 rounded-2xl border-2 border-emerald-200 hover:bg-emerald-50 transition-colors text-center">
                        <div class="text-2xl mb-2">💬</div>
                        <p class="font-bold text-emerald-700 text-sm">Saran</p>
                    </button>
                    <button @click="feedbackModalOpen = true; feedbackType = 'komplain'" class="p-4 rounded-2xl border-2 border-rose-200 hover:bg-rose-50 transition-colors text-center">
                        <div class="text-2xl mb-2">📢</div>
                        <p class="font-bold text-rose-700 text-sm">Komplain</p>
                    </button>
                </div>
            </div>
        </section>
    </main>

    
    <aside x-show="cartOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed right-0 top-0 h-full w-full sm:w-96 bg-white z-50 shadow-2xl flex flex-col" style="display:none;">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-amber-50 to-white">
            <div>
                <h2 class="font-extrabold text-slate-800 text-lg">🛒 Keranjang Belanja</h2>
                <p class="text-xs text-slate-500" x-text="cartCount + ' item dipilih'"></p>
            </div>
            <button @click="cartOpen = false" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto cart-scrollbar px-4 py-3">
            <div x-show="cart.length === 0" class="flex flex-col items-center justify-center h-full text-center py-10" style="display:none;">
                <div class="text-5xl mb-3">🛒</div>
                <p class="font-semibold text-slate-600">Keranjang masih kosong</p>
                <button @click="cartOpen = false" class="mt-4 px-5 py-2 rounded-xl bg-amber-500 text-white text-sm font-semibold hover:bg-amber-600 transition-colors">Lihat Menu</button>
            </div>
            <div x-show="cart.length > 0" style="display:none;">
                <template x-for="(item, index) in cart" :key="item.id">
                    <div class="flex items-center gap-3 py-3 border-b border-slate-50">
                        <img :src="item.image_path" :alt="item.name" class="w-14 h-14 rounded-xl object-cover bg-amber-50" onerror="this.src='https://placehold.co/100x100/FEF3C7/F59E0B?text='">
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-slate-800 text-sm leading-tight truncate" x-text="item.name"></p>
                            <p class="text-amber-600 font-bold text-sm mt-0.5" x-text="formatRupiah(item.price)"></p>
                        </div>
                        <div class="flex items-center gap-1.5 shrink-0">
                            <button @click="decreaseQty(index)" class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 flex items-center justify-center text-lg font-bold transition-colors leading-none">−</button>
                            <span class="w-6 text-center font-bold text-sm" x-text="item.qty"></span>
                            <button @click="increaseQty(index)" class="w-7 h-7 rounded-lg bg-amber-100 hover:bg-amber-200 text-amber-700 flex items-center justify-center text-lg font-bold transition-colors leading-none">+</button>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="font-bold text-slate-800 text-sm" x-text="formatRupiah(item.price * item.qty)"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="cart.length > 0" class="border-t border-slate-100 bg-slate-50 px-4 py-4 space-y-3" style="display:none;">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-slate-600">Total Belanja:</span>
                <span class="font-extrabold text-xl text-amber-600" x-text="formatRupiah(cartTotal)"></span>
            </div>
            <div class="space-y-2.5">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">👤 Nama Pemesan</label>
                    <input x-model="checkout.nama" type="text" placeholder="Masukkan nama Anda" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all bg-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">📱 Nomor HP</label>
                    <input x-model="checkout.hp" type="tel" placeholder="08xxx" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all bg-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">📍 Alamat Pengiriman</label>
                    <textarea x-model="checkout.alamat" rows="2" placeholder="Tulis alamat lengkap Anda..." class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all bg-white resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">📝 Catatan</label>
                    <textarea x-model="checkout.catatan" rows="1" placeholder="Sambal dipisah, pedas..." class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all bg-white resize-none"></textarea>
                </div>
                <button @click="openPaymentModal()" class="w-full py-3.5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-base flex items-center justify-center gap-2 shadow-lg transition-colors">
                    💳 Pilih Metode Pembayaran
                </button>
            </div>
        </div>
    </aside>

    
    <div x-show="paymentModalOpen" x-transition class="fixed inset-0 z-[60] flex items-center justify-center p-4" style="display:none;">
        <div @click="paymentModalOpen = false" class="absolute inset-0 bg-black/60 cart-overlay"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden z-10 max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 px-6 py-5">
                <button @click="paymentModalOpen = false" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <h2 class="text-white font-extrabold text-xl">💳 Metode Pembayaran</h2>
                <p class="text-blue-100 text-sm mt-1">Total: <span class="font-bold" x-text="formatRupiah(cartTotal)"></span></p>
            </div>
            <div class="p-6 space-y-4">
                
                <div>
                    <h3 class="font-bold text-slate-700 text-sm mb-3">E-Wallet</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="selectPayment('gopay')" :class="selectedPayment === 'gopay' ? 'border-blue-500 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200'" class="p-3 rounded-xl border-2 text-center transition-all hover:border-blue-300">
                            <div class="text-2xl mb-1"></div>
                            <p class="text-xs font-bold text-slate-700">GoPay</p>
                        </button>
                        <button @click="selectPayment('ovo')" :class="selectedPayment === 'ovo' ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-200' : 'border-slate-200'" class="p-3 rounded-xl border-2 text-center transition-all hover:border-purple-300">
                            <div class="text-2xl mb-1"></div>
                            <p class="text-xs font-bold text-slate-700">OVO</p>
                        </button>
                        <button @click="selectPayment('dana')" :class="selectedPayment === 'dana' ? 'border-blue-500 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200'" class="p-3 rounded-xl border-2 text-center transition-all hover:border-blue-300">
                            <div class="text-2xl mb-1"></div>
                            <p class="text-xs font-bold text-slate-700">DANA</p>
                        </button>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-slate-700 text-sm mb-3">Bank Transfer (Virtual Account)</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="selectPayment('bca')" :class="selectedPayment === 'bca' ? 'border-blue-500 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200'" class="p-3 rounded-xl border-2 text-center transition-all hover:border-blue-300">
                            <div class="text-2xl mb-1"></div>
                            <p class="text-xs font-bold text-slate-700">BCA</p>
                        </button>
                        <button @click="selectPayment('mandiri')" :class="selectedPayment === 'mandiri' ? 'border-blue-500 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200'" class="p-3 rounded-xl border-2 text-center transition-all hover:border-blue-300">
                            <div class="text-2xl mb-1"></div>
                            <p class="text-xs font-bold text-slate-700">Mandiri</p>
                        </button>
                        <button @click="selectPayment('bri')" :class="selectedPayment === 'bri' ? 'border-blue-500 bg-blue-50 ring-2 ring-blue-200' : 'border-slate-200'" class="p-3 rounded-xl border-2 text-center transition-all hover:border-blue-300">
                            <div class="text-2xl mb-1"></div>
                            <p class="text-xs font-bold text-slate-700">BRI</p>
                        </button>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-slate-700 text-sm mb-3">QRIS</h3>
                    <button @click="selectPayment('qris')" :class="selectedPayment === 'qris' ? 'border-emerald-500 bg-emerald-50 ring-2 ring-emerald-200' : 'border-slate-200'" class="w-full p-4 rounded-xl border-2 text-center transition-all hover:border-emerald-300">
                        <div class="text-3xl mb-1"></div>
                        <p class="text-sm font-bold text-slate-700">Scan QRIS</p>
                        <p class="text-xs text-slate-500 mt-0.5">Bayar dengan scan QR dari aplikasi manapun</p>
                    </button>
                </div>

                
                <div x-show="selectedPayment === 'qris'" x-effect="selectedPayment === 'qris' && renderQris()" class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-200" style="display:none;">
                    <div class="relative w-48 h-48 mx-auto bg-white rounded-xl border-2 border-slate-300 flex items-center justify-center mb-3 qris-container p-2" id="qris-box"></div>
                    <p class="text-sm font-semibold text-slate-700">Scan QR Code di atas</p>
                    <p class="text-xs text-slate-500 mt-1">Gunakan aplikasi e-wallet atau m-banking Anda</p>
                    <p class="text-[10px] text-amber-600 font-semibold mt-2 bg-amber-50 border border-amber-200 rounded-lg py-1.5">Ini Hanya Mode Simulasi — belum terhubung ke penyedia QRIS resmi (bank/PJSP), hanya untuk demo alur pembayaran</p>
                </div>

                <button @click="processPayment()" :disabled="!selectedPayment || paymentLoading" :class="selectedPayment ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 hover:shadow-xl hover:-translate-y-0.5' : 'bg-slate-300 cursor-not-allowed'" class="w-full py-3.5 rounded-2xl text-white font-extrabold text-base shadow-lg transition-all flex items-center justify-center gap-2">
                    <span x-show="!paymentLoading">Bayar Sekarang</span>
                    <span x-show="paymentLoading" class="flex items-center gap-2"><svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Memproses...</span>
                </button>
            </div>
        </div>
    </div>

    
    <div x-show="receiptModalOpen" x-transition class="fixed inset-0 z-[70] flex items-center justify-center p-4" style="display:none;">
        <div @click="receiptModalOpen = false" class="absolute inset-0 bg-black/60 cart-overlay"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden z-10 max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 px-6 py-5 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-3xl">✅</span>
                </div>
                <h2 class="text-white font-extrabold text-xl">Pembayaran Berhasil!</h2>
                <p class="text-emerald-100 text-sm mt-1">Pesanan Anda sudah diterima dan akan segera disiapkan.</p>
            </div>
            <div class="p-6">
                <div class="bg-slate-50 rounded-2xl p-4 mb-4 border border-slate-200 receipt-paper">
                    <div class="text-center border-b border-dashed border-slate-300 pb-3 mb-3">
                        <p class="font-extrabold text-slate-800">LAPAK 1 PUTRI 2 PUTRA</p>
                        <p class="text-xs text-slate-500">Jl. Martadinata</p>
                        <p class="text-xs text-slate-400 mt-1">STRUK BELANJA DIGITAL</p>
                    </div>
                    <div class="space-y-1 text-sm mb-3">
                        <div class="flex justify-between"><span class="text-slate-500">No. Transaksi:</span><span class="font-bold text-slate-700" x-text="receiptData.order_number"></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Tanggal:</span><span class="text-slate-700" x-text="receiptData.date"></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Pembayaran:</span><span class="text-slate-700 uppercase" x-text="receiptData.payment_method"></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Status:</span><span class="font-bold text-emerald-600">LUNAS</span></div>
                    </div>
                    <div class="border-t border-dashed border-slate-300 pt-3">
                        <template x-for="item in receiptData.items" :key="item.menu_name">
                            <div class="flex justify-between text-sm py-1">
                                <span class="text-slate-700" x-text="item.quantity + 'x ' + item.menu_name"></span>
                                <span class="font-semibold text-slate-800" x-text="formatRupiah(item.subtotal)"></span>
                            </div>
                        </template>
                    </div>
                    <div class="border-t border-dashed border-slate-300 mt-3 pt-3 space-y-1">
                        <div class="flex justify-between text-sm"><span class="text-slate-500">Subtotal:</span><span x-text="formatRupiah(receiptData.subtotal)"></span></div>
                        <div x-show="receiptData.discount > 0" class="flex justify-between text-sm"><span class="text-emerald-600">Diskon:</span><span class="text-emerald-600" x-text="'-' + formatRupiah(receiptData.discount)"></span></div>
                        <div class="flex justify-between text-base font-extrabold border-t border-slate-300 pt-2 mt-2"><span>TOTAL:</span><span class="text-amber-600" x-text="formatRupiah(receiptData.total)"></span></div>
                    </div>
                    <div x-show="receiptData.points_earned > 0" class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-center">
                        <p class="text-sm font-bold text-amber-700"> Selamat! Anda mendapat +<span x-text="receiptData.points_earned"></span> poin!</p>
                    </div>
                </div>
                <button @click="receiptModalOpen = false; resetCheckout()" class="w-full py-3 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 text-white font-bold shadow-lg hover:shadow-xl transition-all">
                    Kembali ke Menu
                </button>
            </div>
        </div>
    </div>

    
    <div x-show="reviewModalOpen" x-transition class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-4" style="display:none;">
        <div @click="reviewModalOpen = false" class="absolute inset-0 bg-black/50 cart-overlay"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden z-10 max-h-[80vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-amber-400 to-amber-600 px-6 py-4">
                <button @click="reviewModalOpen = false" class="absolute top-3 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <h2 class="text-white font-extrabold text-lg" x-text="'⭐ Ulasan: ' + (reviewMenuItem?.name || '')"></h2>
            </div>
            <div class="p-5 space-y-4">
                
                <div class="space-y-3 max-h-48 overflow-y-auto">
                    <template x-for="r in menuReviews" :key="r.id">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-sm text-slate-700" x-text="r.reviewer_name"></span>
                                <span x-show="r.is_member" class="text-xs px-1.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-bold">Member</span>
                            </div>
                            <div class="flex gap-0.5 mb-1">
                                <template x-for="s in 5" :key="s"><span class="text-xs" :class="s <= r.rating ? 'text-amber-400' : 'text-slate-200'">★</span></template>
                            </div>
                            <p class="text-sm text-slate-600" x-text="r.comment"></p>
                        </div>
                    </template>
                    <p x-show="menuReviews.length === 0" class="text-center text-slate-400 text-sm py-4">Belum ada ulasan untuk menu ini</p>
                </div>
                
                <div class="border-t border-slate-100 pt-4">
                    <h3 class="font-bold text-sm text-slate-700 mb-3">✍️ Tulis Ulasan</h3>
                    <div class="flex gap-1 mb-3">
                        <template x-for="s in 5" :key="s">
                            <button @click="newReview.rating = s" class="text-2xl transition-transform hover:scale-110" :class="s <= newReview.rating ? 'text-amber-400' : 'text-slate-200'">★</button>
                        </template>
                    </div>
                    <input x-model="newReview.name" type="text" placeholder="Nama Anda" class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 mb-2">
                    <textarea x-model="newReview.comment" rows="2" placeholder="Tulis ulasan..." class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 resize-none"></textarea>
                    <button @click="submitReview()" class="w-full mt-2 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold transition-colors">Kirim Ulasan</button>
                </div>
            </div>
        </div>
    </div>

    
    <div x-show="feedbackModalOpen" x-transition class="fixed inset-0 z-[60] flex items-center justify-center p-4" style="display:none;">
        <div @click="feedbackModalOpen = false" class="absolute inset-0 bg-black/50 cart-overlay"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden z-10">
            <div :class="feedbackType === 'komplain' ? 'from-rose-500 to-rose-600' : feedbackType === 'saran' ? 'from-emerald-500 to-emerald-600' : 'from-blue-500 to-blue-600'" class="bg-gradient-to-r px-6 py-4">
                <button @click="feedbackModalOpen = false" class="absolute top-3 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <h2 class="text-white font-extrabold text-lg" x-text="feedbackType === 'komplain' ? '📢 Komplain' : feedbackType === 'saran' ? '💬 Saran' : '💡 Masukan'"></h2>
            </div>
            <div class="p-5 space-y-3">
                <input x-model="feedbackForm.name" type="text" placeholder="Nama Anda" class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                <input x-model="feedbackForm.email" type="email" placeholder="Email (opsional)" class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                <input x-model="feedbackForm.subject" type="text" placeholder="Subjek" class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                <textarea x-model="feedbackForm.message" rows="3" placeholder="Tulis pesan..." class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 resize-none"></textarea>
                <button @click="submitFeedback()" class="w-full py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm transition-colors">Kirim</button>
            </div>
        </div>
    </div>

    
    <nav class="fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-amber-100 shadow-lg">
        <div class="max-w-5xl mx-auto flex">
            <a href="/" class="bottom-nav-item active flex-1 flex flex-col items-center py-2.5 gap-0.5 transition-colors">
                <svg class="nav-icon w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="nav-label text-xs text-amber-500 font-semibold">Beranda</span>
            </a>
            <button @click="cartOpen = true" class="bottom-nav-item flex-1 flex flex-col items-center py-2.5 gap-0.5 relative transition-colors">
                <div class="relative">
                    <svg class="nav-icon w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h7m-7 0a1 1 0 100 2 1 1 0 000-2zm7 0a1 1 0 100 2 1 1 0 000-2z"/></svg>
                    <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1.5 -right-1.5 min-w-4 h-4 px-0.5 rounded-full bg-rose-500 text-white text-xs font-bold flex items-center justify-center" style="display:none;"></span>
                </div>
                <span class="nav-label text-xs text-slate-400 font-medium">Keranjang</span>
            </button>
            <?php if(auth()->guard()->check()): ?>
            <a href="/member" class="bottom-nav-item flex-1 flex flex-col items-center py-2.5 gap-0.5 transition-colors">
                <svg class="nav-icon w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="nav-label text-xs text-slate-400 font-medium">Sobat Lapak</span>
            </a>
            <?php else: ?>
            <a href="/login" class="bottom-nav-item flex-1 flex flex-col items-center py-2.5 gap-0.5 transition-colors">
                <svg class="nav-icon w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="nav-label text-xs text-slate-400 font-medium">Login</span>
            </a>
            <?php endif; ?>
        </div>
    </nav>

    
    <footer class="bg-slate-800 text-white pb-24">
        <div class="max-w-5xl mx-auto px-4 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center"><span class="text-white text-lg">🍗</span></div>
                        <div><div class="font-extrabold text-amber-400 text-sm">LAPAK 1 PUTRI</div><div class="font-extrabold text-emerald-400 text-sm">2 PUTRA</div></div>
                    </div>
                    <p class="text-slate-400 text-sm">Sajian lauk-pauk segar & lezat setiap hari untuk keluarga Indonesia.</p>
                </div>
                <div>
                    <h3 class="font-bold text-amber-400 mb-3">📍 Informasi</h3>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li>📌 Alamat: Jalan Martadinata</li>
                        <li>📞 Kontak: 081-234-567-890</li>
                        <li>🕐 Jam operasional 10:00 - 17:00 WIT</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-amber-400 mb-3">🔗 Menu</h3>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="/" class="hover:text-amber-400 transition-colors">Beranda</a></li>
                        <li><a href="/login" class="hover:text-amber-400 transition-colors">Login / Daftar</a></li>
                        <li><a href="/member" class="hover:text-amber-400 transition-colors">Sobat Lapak</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-8 pt-6 text-center">
                <p class="text-slate-500 text-sm">© 2026 LAPAK 1 PUTRI 2 PUTRA. All rights reserved.</p>
                <p class="text-slate-600 text-xs mt-1">Developed by <span class="text-amber-500 font-semibold">UbrotherrDev</span></p>
            </div>
        </div>
    </footer>

    <script>
        function lapakApp() {
            return {
                search: '', activeCategory: 'semua', cartOpen: false,
                paymentModalOpen: false, receiptModalOpen: false, reviewModalOpen: false, feedbackModalOpen: false,
                selectedPayment: '', paymentLoading: false,
                feedbackType: 'masukan',
                checkout: { nama: '', hp: '', alamat: '', catatan: '' },
                cart: [],
                categories: <?php echo json_encode($categories, 15, 512) ?>,
                menus: <?php echo json_encode($menus, 15, 512) ?>,
                reviewMenuItem: null, menuReviews: [],
                newReview: { rating: 5, name: '', comment: '' },
                feedbackForm: { name: '', email: '', subject: '', message: '' },
                receiptData: { order_number: '', date: '', payment_method: '', items: [], subtotal: 0, discount: 0, total: 0, points_earned: 0 },
                toast: { show: false, type: 'success', title: '', message: '' },
                guestTransactionCount: <?php echo e(session('guest_transaction_count', 0)); ?>,

                get filteredMenus() {
                    return this.menus.filter(item => {
                        const catSlug = item.category ? item.category.slug : '';
                        const matchCat = this.activeCategory === 'semua' || catSlug === this.activeCategory;
                        const matchSearch = item.name.toLowerCase().includes(this.search.toLowerCase()) || (item.description || '').toLowerCase().includes(this.search.toLowerCase());
                        return matchCat && matchSearch;
                    });
                },
                get cartCount() { return this.cart.reduce((s, i) => s + i.qty, 0); },
                get cartTotal() { return this.cart.reduce((s, i) => s + (i.price * i.qty), 0); },

                init() {
                    const saved = localStorage.getItem('lapak_cart');
                    if (saved) this.cart = JSON.parse(saved);
                    this.$watch('cart', val => localStorage.setItem('lapak_cart', JSON.stringify(val)));
                    <?php if(auth()->guard()->check()): ?>
                    this.checkout.nama = '<?php echo e(auth()->user()->name); ?>';
                    this.checkout.hp = '<?php echo e(auth()->user()->phone); ?>';
                    this.checkout.alamat = '<?php echo e(auth()->user()->address); ?>';
                    <?php endif; ?>
                },
                formatRupiah(n) { return 'Rp ' + n.toLocaleString('id-ID'); },
                showToast(type, title, message) {
                    this.toast = { show: true, type, title, message };
                    setTimeout(() => this.toast.show = false, 4000);
                },
                addToCart(item) {
                    const idx = this.cart.findIndex(c => c.id === item.id);
                    if (idx !== -1) { this.cart[idx].qty++; } else { this.cart.push({ ...item, qty: 1 }); }
                    this.showToast('success', '🛒 Ditambahkan!', item.name + ' masuk ke keranjang');
                },
                increaseQty(i) { this.cart[i].qty++; },
                decreaseQty(i) { this.cart[i].qty <= 1 ? this.cart.splice(i, 1) : this.cart[i].qty--; },
                selectPayment(method) { this.selectedPayment = method; },
                renderQris() {
                    this.$nextTick(() => {
                        const box = document.getElementById('qris-box');
                        if (!box || typeof QRCode === 'undefined') return;
                        box.innerHTML = '';
                        // Payload unik per transaksi: nama toko, total, dan referensi acak.
                        // Ini BUKAN payload QRIS resmi (EMVCo) — cuma simulasi visual untuk demo alur bayar.
                        const ref = 'SIM-' + Date.now().toString(36).toUpperCase();
                        const payload = `LAPAK1PUTRI2PUTRA|SIMULASI|TOTAL:${this.cartTotal}|REF:${ref}`;
                        new QRCode(box, { text: payload, width: 176, height: 176, correctLevel: QRCode.CorrectLevel.M });
                    });
                },
                openPaymentModal() {
                    if (!this.checkout.nama.trim()) { this.showToast('error', '⚠️ Error', 'Mohon isi nama pemesan!'); return; }
                    if (!this.checkout.hp.trim()) { this.showToast('error', '⚠️ Error', 'Mohon isi nomor HP!'); return; }
                    if (!this.checkout.alamat.trim()) { this.showToast('error', '⚠️ Error', 'Mohon isi alamat pengiriman!'); return; }
                    this.cartOpen = false;
                    this.paymentModalOpen = true;
                },
                async processPayment() {
                    if (!this.selectedPayment) return;
                    this.paymentLoading = true;
                    try {
                        const items = this.cart.map(c => ({ menu_id: c.id, quantity: c.qty }));
                        const res = await fetch('/checkout', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ customer_name: this.checkout.nama, customer_phone: this.checkout.hp, customer_address: this.checkout.alamat, notes: this.checkout.catatan, payment_method: this.selectedPayment, items })
                        });
                        const data = await res.json();
                        if (data.success) {
                            const payRes = await fetch('/payment/process', {
                                method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                                body: JSON.stringify({ order_id: data.order.id, payment_method: this.selectedPayment })
                            });
                            const payData = await payRes.json();
                            if (payData.success) {
                                this.receiptData = {
                                    order_number: payData.order.order_number, date: new Date().toLocaleString('id-ID'),
                                    payment_method: this.selectedPayment, items: payData.order.items,
                                    subtotal: payData.order.subtotal, discount: payData.order.discount,
                                    total: payData.order.total, points_earned: payData.points_earned
                                };
                                if (payData.guest_transaction_count !== undefined) {
                                    this.guestTransactionCount = payData.guest_transaction_count;
                                }
                                this.paymentModalOpen = false;
                                this.receiptModalOpen = true;
                                this.showToast('success', '✅ Pembayaran Berhasil!', payData.message);
                            }
                        }
                    } catch (e) { this.showToast('error', '❌ Error', 'Gagal memproses pembayaran. Coba lagi.'); }
                    this.paymentLoading = false;
                },
                resetCheckout() {
                    this.cart = []; this.checkout = { nama: '', hp: '', alamat: '', catatan: '' };
                    this.selectedPayment = ''; localStorage.removeItem('lapak_cart');
                    <?php if(auth()->guard()->check()): ?>
                    this.checkout.nama = '<?php echo e(auth()->user()->name); ?>';
                    this.checkout.hp = '<?php echo e(auth()->user()->phone); ?>';
                    this.checkout.alamat = '<?php echo e(auth()->user()->address); ?>';
                    <?php endif; ?>
                },
                async openReviewModal(item) {
                    this.reviewMenuItem = item; this.menuReviews = [];
                    this.reviewModalOpen = true;
                    try {
                        const res = await fetch(`/menu/${item.id}/reviews`);
                        this.menuReviews = await res.json();
                    } catch(e) {}
                },
                async submitReview() {
                    if (!this.newReview.name.trim()) { this.showToast('error', '⚠️', 'Mohon isi nama!'); return; }
                    try {
                        await fetch('/review', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ menu_id: this.reviewMenuItem.id, rating: this.newReview.rating, comment: this.newReview.comment, reviewer_name: this.newReview.name })
                        });
                        this.showToast('success', '⭐', 'Ulasan berhasil dikirim!');
                        this.newReview = { rating: 5, name: '', comment: '' };
                        this.openReviewModal(this.reviewMenuItem);
                    } catch(e) { this.showToast('error', '❌', 'Gagal mengirim ulasan.'); }
                },
                async submitFeedback() {
                    if (!this.feedbackForm.name.trim() || !this.feedbackForm.subject.trim() || !this.feedbackForm.message.trim()) {
                        this.showToast('error', '⚠️', 'Mohon isi semua field yang wajib!'); return;
                    }
                    try {
                        await fetch('/feedback', {
                            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                            body: JSON.stringify({ ...this.feedbackForm, type: this.feedbackType })
                        });
                        this.showToast('success', '✅', 'Terima kasih atas masukan Anda!');
                        this.feedbackModalOpen = false;
                        this.feedbackForm = { name: '', email: '', subject: '', message: '' };
                    } catch(e) { this.showToast('error', '❌', 'Gagal mengirim feedback.'); }
                }
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Website_Lapak1Putri2Putra_FixedHendri\resources\views\welcome.blade.php ENDPATH**/ ?>