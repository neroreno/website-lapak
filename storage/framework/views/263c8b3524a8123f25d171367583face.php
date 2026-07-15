<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Daftar akun Sobat Lapak — LAPAK 1 PUTRI 2 PUTRA. Nikmati diskon eksklusif dan poin premium.">
    <title>Daftar Sobat Lapak — LAPAK 1 PUTRI 2 PUTRA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-emerald-50 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-200">
                    <span class="text-white text-2xl">🍗</span>
                </div>
                <div class="text-left">
                    <div class="font-extrabold text-amber-600 text-lg leading-tight">LAPAK 1 PUTRI</div>
                    <div class="font-extrabold text-emerald-600 text-lg leading-tight">2 PUTRA</div>
                </div>
            </a>
        </div>

        
        <div class="bg-white rounded-3xl shadow-xl shadow-amber-100/50 border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
                <h1 class="text-white font-extrabold text-2xl">Daftar Sobat Lapak</h1>
                <p class="text-emerald-100 text-sm mt-1">Bergabung untuk poin premium, diskon, dan fitur eksklusif</p>
            </div>

            <div class="p-8">
                
                <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200">
                    <p class="font-bold text-amber-800 text-sm mb-2">🎁 Keuntungan Sobat Lapak:</p>
                    <ul class="space-y-1 text-xs text-amber-700">
                        <li>✅ 50 poin bonus pendaftaran</li>
                        <li>✅ Diskon otomatis untuk belanja ≥ Rp 100.000</li>
                        <li>✅ Fitur PreOrder menu esok hari</li>
                        <li>✅ Akses Chat Room Sobat Lapak</li>
                    </ul>
                </div>

                <?php if($errors->any()): ?>
                <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200">
                    <ul class="space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-rose-600 text-sm font-medium flex items-center gap-2">
                            <span>⚠️</span> <?php echo e($error); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form method="POST" action="/register" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">👤 Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required autofocus
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="Nama lengkap Anda">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5">📱 Nomor HP (Aktif)</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="08xxxxxxxxxx">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">📧 Email</label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="email@contoh.com">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-slate-700 mb-1.5">📍 Alamat Tempat Tinggal</label>
                        <textarea id="address" name="address" rows="2" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all resize-none"
                            placeholder="Alamat lengkap Anda"><?php echo e(old('address')); ?></textarea>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">🔒 Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="Minimal 6 karakter">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">🔒 Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm focus:outline-none focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:bg-white transition-all"
                            placeholder="Ulangi password">
                    </div>

                    <button type="submit" id="btn-register"
                        class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-extrabold text-base shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        ✨ Daftar Sekarang & Dapatkan 50 Poin
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">Sudah punya akun?</p>
                    <a href="/login" class="inline-block mt-2 px-6 py-2.5 rounded-xl border-2 border-amber-400 text-amber-600 font-bold text-sm hover:bg-amber-50 transition-colors">
                        🔑 Masuk ke Akun
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="/" class="text-sm text-slate-500 hover:text-amber-600 transition-colors">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
<?php /**PATH D:\laragon\www\LAPAK_1_PUTRI_2_PUTRA_FIXED\resources\views/auth/register.blade.php ENDPATH**/ ?>