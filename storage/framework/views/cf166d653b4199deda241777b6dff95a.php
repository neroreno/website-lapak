<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login ke akun Sobat Lapak — LAPAK 1 PUTRI 2 PUTRA">
    <title>Login — LAPAK 1 PUTRI 2 PUTRA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-emerald-50 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-200">
                    <span class="text-white text-2xl"></span>
                </div>
                <div class="text-left">
                    <div class="font-extrabold text-amber-600 text-lg leading-tight">LAPAK 1 PUTRI</div>
                    <div class="font-extrabold text-emerald-600 text-lg leading-tight">2 PUTRA</div>
                </div>
            </a>
        </div>

        
        <div class="bg-white rounded-3xl shadow-xl shadow-amber-100/50 border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-8 py-6">
                <h1 class="text-white font-extrabold text-2xl">Masuk ke Akun</h1>
                <p class="text-amber-100 text-sm mt-1">Login untuk mengakses fitur Sobat Lapak</p>
            </div>

            <div class="p-8">
                <?php if($errors->any()): ?>
                <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200">
                    <p class="text-rose-600 text-sm font-semibold flex items-center gap-2">
                        <span>⚠️</span>
                        <?php echo e($errors->first()); ?>

                    </p>
                </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200">
                    <p class="text-rose-600 text-sm font-semibold flex items-center gap-2">
                        <span>⚠️</span>
                        <?php echo e(session('error')); ?>

                    </p>
                </div>
                <?php endif; ?>

                <form method="POST" action="/login" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="identifier" class="block text-sm font-semibold text-slate-700 mb-2">Email atau No. HP</label>
                        <input type="text" id="identifier" name="identifier" value="<?php echo e(old('identifier')); ?>" required autofocus
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="email@contoh.com atau 08xxxxxxxxxx">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="Masukkan password">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-400">
                        <label for="remember" class="text-sm text-slate-600">Ingat saya</label>
                    </div>

                    <button type="submit" id="btn-login"
                        class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 text-white font-extrabold text-base shadow-lg shadow-amber-200 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        Masuk
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">Belum punya akun?</p>
                    <?php if(session('guest_transaction_count', 0) >= 10): ?>
                        <a href="/register" class="inline-block mt-2 px-6 py-2.5 rounded-xl border-2 border-amber-400 text-amber-600 font-bold text-sm hover:bg-amber-50 transition-colors">
                            Daftar Sobat Lapak
                        </a>
                    <?php else: ?>
                        <button disabled class="inline-block mt-2 px-6 py-2.5 rounded-xl border-2 border-slate-300 text-slate-400 font-bold text-sm bg-slate-100 cursor-not-allowed">
                            Daftar Sobat Lapak (Butuh <?php echo e(10 - session('guest_transaction_count', 0)); ?> transaksi lagi)
                        </button>
                    <?php endif; ?>
                </div>

                
                <div class="mt-6 p-4 rounded-2xl bg-blue-50 border border-blue-200">
                    <p class="text-blue-700 text-xs font-bold mb-2">Akun Demo:</p>
                    <div class="space-y-1 text-xs text-blue-600">
                        <p><strong>Admin:</strong> admin@lapak.com / admin123</p>
                        <p><strong>Member:</strong> hendry@email.com / member123</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="text-center mt-6">
            <a href="/" class="text-sm text-slate-500 hover:text-amber-600 transition-colors">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\Website_Lapak1Putri2Putra_FixedHendri\resources\views\auth\login.blade.php ENDPATH**/ ?>