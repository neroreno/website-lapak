# Product Requirement Document (PRD)

**Nama Proyek:** LAPAK 1 PUTRI 2 PUTRA (Website Jualan Aneka Lauk Pauk)
**Versi:** 2.1 (Pembaruan Sistem Loyalitas Poin, Ketentuan Syarat Member, dan Perbaikan Bug Visual)
**Status:** Siap Implementasi Full-Stack
**Tanggal Pembaruan:** 15 Juli 2026

---

## 1. Pendahuluan & Tujuan Utama
LAPAK 1 PUTRI 2 PUTRA adalah platform e-commerce kuliner modern yang berfokus pada penjualan aneka makanan matang dan lauk-pauk harian secara online. Pembaruan Versi 2.1 ini berfokus pada perombakan sistem loyalitas pelanggan (poin dan voucher), penerapan syarat transaksi ketat untuk pendaftaran member (Sobat Lapak), penyesuaian alur belanja member, serta perbaikan beberapa bug teknis dan visual pada antarmuka pengguna (UI) maupun dasbor admin.

---

## 2. Alur Transaksi, Aksesibilitas Member, & Notifikasi Otomatis
Sistem wajib menyediakan pembaruan status pemesanan, pelacakan transaksi pelanggan non-member, serta pembatasan hak akses registrasi dengan mekanisme berikut:

*   **Pembatasan Akses Registrasi Sobat Lapak (Syarat 10x Transaksi):** 
    *   Pengguna Umum (Non-Member) **tidak dapat** langsung mengakses fitur "Login/Daftar".
    *   Jika pengguna menekan tombol "Login/Daftar", sistem wajib memicu munculnya notifikasi/pop-up bertuliskan: **"Harus melakukan 10x transaksi"**.
    *   Syarat untuk membuka hak akses pendaftaran member Sobat Lapak adalah minimal telah melakukan **10 kali pembelian/transaksi sukses** di website ini, **tanpa minimal nominal pembelian** dari setiap menu.
*   **Notifikasi & Pelacakan Transaksi Non-Member:** 
    *   Setiap kali Pelanggan Umum (Non-Member) menyelesaikan pembelian sukses di website ini, sistem akan memunculkan notifikasi yang berisi informasi **jumlah total akumulasi pembelian saat ini (skala hitungan 1 sampai 10)**.
    *   **Fitur Reset Otomatis 3 Bulan:** Akumulasi jumlah transaksi Pelanggan Umum tersebut akan otomatis di-reset kembali menjadi 0 (nol) jika pelanggan yang bersangkutan tidak melakukan aktivitas transaksi pembelian sama sekali di website ini selama **3 bulan berturut-turut**.
*   **Notifikasi & Informasi Pembayaran Berhasil:** Ketika pembayaran sukses diverifikasi oleh sistem, pelanggan akan langsung menerima notifikasi pop-up/banner konfirmasi keberhasilan pembayaran di layar perangkat mereka.
*   **Tampilan Struk Belanja Digital:** Setelah pembayaran berhasil, halaman akan otomatis menampilkan struk belanja digital yang berisi informasi rincian pembelian (id transaksi, daftar menu, kuantitas, harga, total bayar, metode pembayaran, tanggal/waktu transaksi, dan status: *Lunas*).
*   **Notifikasi Penerimaan Pesanan:** Segera setelah pesanan masuk ke sistem admin, sistem akan mengirimkan notifikasi otomatis ke akun pelanggan dengan pesan konfirmasi yang menyatakan bahwa: **"Pesanan Anda sudah diterima dan akan segera disiapkan."**

---

## 3. Ekosistem Metode Pembayaran & Perbaikan Visual Keranjang
Untuk mempermudah transaksi, sistem menyediakan beragam opsi pembayaran non-tunai yang terintegrasi langsung di dalam aplikasi dengan penyesuaian desain:
*   **Perbaikan UI Tombol Metode Pembayaran [BUG FIX]:** Pada halaman Keranjang Belanja, komponen tombol **"Pilih Metode Pembayaran"** wajib diperbaiki warnanya agar serasi dan konsisten dengan tombol-tombol pada bagian sebelumnya, yaitu menggunakan **warna Orange**.
*   **Pilihan Metode Pembayaran Masing-Masing Minimal 3 Opsi:**
    *   **E-Wallet:** Terintegrasi minimal dengan 3 layanan utama (GOPAY, OVO, DANA).
    *   **Bank Transfer:** Terintegrasi minimal dengan 3 bank besar (Bank BCA, Bank Mandiri, Bank BRI) melalui akun virtual (*Virtual Account*).
*   **Fitur QRIS Dinamis Terhubung Perangkat:** Menyediakan fitur pembayaran menggunakan satu kode QRIS dinamis yang muncul di layar dan mendukung *deep-link* instan ke aplikasi pembayaran apabila diakses melalui handphone.

---

## 4. Diferensiasi 3 Tampilan Landing Page & Fitur Spesifik
Aplikasi dibagi menjadi 3 hak akses antarmuka halaman utama yang berbeda berdasarkan peran pengguna:

### A. Tampilan Halaman 1: Landing Page Umum (Non-Member)
Diperuntukkan bagi pengunjung kasual atau pelanggan non-member yang sedang mengumpulkan syarat transaksi:
*   **Display Makanan & Kategori:** Menampilkan seluruh menu lauk pauk yang ditawarkan secara estetik dan dikelompokkan berdasarkan kategori menu yang ada.
*   **Rating Default Semua Menu [BUG FIX]:** Memperbaiki bug visual di mana rating menu sebelumnya bernilai 0. Mulai versi ini, **semua rating menu diatur secara default bernilai 5**.
*   **Kolom Pencarian (Search Bar) & Keranjang Pesanan:** Fitur pencarian cepat berbasis teks untuk menemukan makanan dan menampung daftar lauk sebelum *checkout*.

### B. Tampilan Halaman 2: Landing Page Member (Sobat Lapak)
Diperuntukkan khusus bagi pengguna yang telah memenuhi syarat 10x transaksi dan berhasil mendaftarkan akun:
*   **Fleksibilitas Metode Pembelian Member:** Member memiliki akses penuh untuk melakukan dua metode pembelian di dalam website:
    1.  **Fitur PreOrder (PO):** Memesan menu hari ini untuk disiapkan dan dikirim keesokan harinya.
    2.  **Pembelian Langsung (Non-PreOrder):** Melakukan transaksi pembelian makanan secara langsung untuk diproses pada hari yang sama.
*   **Sistem Poin Baru (Skala Belanja Rp 5.000):** Skema poin lama dihapus. Poin dihitung berdasarkan nominal uang yang dikeluarkan saat melakukan transaksi belanja dengan ketentuan:
    *   Setiap kelipatan pengeluaran **Rp 5.000**, pengguna akan mendapatkan **20 Poin** (Berlaku kelipatan. *Contoh: Belanja Rp 100.000 = Mendapat 200 Poin*).
*   **Fitur Mekanisme Penukaran Voucher Belanja:** Poin yang terkumpul dapat ditukarkan menjadi voucher diskon dengan ketentuan sebagai berikut:
    *   **Voucher 1:** Ditukar dengan **50 poin** = Mendapatkan **Diskon 10%**.
    *   **Voucher 2:** Ditukar dengan **75 poin** = Mendapatkan **Diskon 15%**.
    *   **Voucher 3:** Ditukar dengan **100 poin** = Mendapatkan **Diskon 20%**.
*   **Aturan Penggunaan & Masa Kedaluwarsa Voucher:**
    *   **Limit Penukaran:** Ketiga jenis voucher tersebut hanya dapat ditukarkan maksimal **sehari sekali untuk masing-masing voucher** dan kuota penukaran akan di-reset pada hari berikutnya.
    *   **Sistem Penyimpanan & Aktivasi Manual:** Setelah poin berhasil ditukarkan, voucher tidak langsung aktif melainkan tersimpan terlebih dahulu ke dalam inventaris akun pengguna. Voucher tidak akan hangus selama disimpan dan belum diaktifkan.
    *   **Jangka Waktu Aktif (24 Jam):** Pengguna harus mengaktifkan voucher secara manual sebelum digunakan. Setelah diaktifkan, sistem akan menghitung mundur masa berlaku voucher selama **24 jam sebelum voucher hangus**.
    *   **Batasan Penggunaan per Transaksi:** Hanya **1 voucher yang dapat diaktifkan dan digunakan untuk setiap 1 transaksi**. Voucher lain yang dimiliki pengguna tetap tersimpan dan dapat digunakan pada transaksi yang berbeda.
*   **Manajemen Akun & Riwayat Pembelanjaan 1 Bulan:** Profil keanggotaan dan ringkasan seluruh transaksi selama 30 hari terakhir.
*   **Fitur "Sobat Lapak" Chat Room:** Ruang obrolan internal antar-member di dalam website.
*   ***Catatan Modifikasi Fitur Member:*** 
    *   Fitur Leveling/Tiering keanggotaan resmi **dihilangkan**.
    *   Keuntungan berupa "Poin premium lebih besar" pada bagian pendaftaran resmi **dihilangkan**.

### C. Tampilan Halaman 3: Dasbor Admin
Halaman panel kendali operasional backend untuk pemilik lapak dengan perbaikan sistem visual:
*   **Perbaikan Bug Grafik Penjualan [BUG FIX]:** Memperbaiki eror sistem pada visualisasi laporan penjualan 5 bulan terakhir. Komponen **Grafik Chart (Bar/Pie Chart)** dan **Grafik Line (Garis Tren)** wajib dipastikan dapat merender data penjualan secara akurat tanpa *crash*.
*   **Penyederhanaan UI Dasbor [UI CLEANUP]:** Menghilangkan ikon-ikon yang terlalu padat, berlebihan, dan tidak fungsional dari seluruh halaman dasbor yang ada di dalam website agar tampilan terlihat lebih bersih dan profesional.
*   **Riwayat Pemesanan Otomatis & File Laporan Unduhan:** Pencatatan pesanan member secara real-time dan penyediaan tombol unduh laporan resmi.
*   **Fitur Informasi Masukan, Saran, & Komplain:** Panel penampung formulir aspirasi, kritik, dan keluhan pelanggan.

---

## 5. Sistem Autentikasi: Halaman Registrasi Member
*   **Halaman Registrasi (Buat Akun Baru):** Halaman ini hanya akan terbuka bagi pengguna umum yang sudah terverifikasi melakukan 10x transaksi. Form pendaftaran wajib mengisi informasi profil secara lengkap yang meliputi:
    1. Nama Lengkap
    2. Nomor HP (Aktif)
    3. Email
    4. Alamat Tempat Tinggal (Utama)
*   ***Catatan Modifikasi:*** Poin informasi mengenai *"Poin premium lebih besar"* pada tampilan antarmuka pendaftaran ini resmi **dihilangkan**.

---

## 6. Informasi Tambahan (About Me & Developer)
Pada bagian kaki halaman (*footer*) atau halaman informasi website ini, wajib mencantumkan informasi kredensial yang telah diperbaiki:
*   **Nama Website:** LAPAK 1 PUTRI 2 PUTRA
*   **Alamat Jualan Fisik:** Jalan Martadinata
*   **Perbaikan Jam Operasional [BUG FIX]:** Memperbaiki kesalahan penulisan informasi pada keterangan About Me, diubah secara konstan menjadi: **"Jam operasional 10:00 - 17:00 WIT"**.
*   **Kontak Penjual:** [Nomor Telepon/Hubungi Kami yang dapat dihubungi pelanggan]
*   **Pihak Developer Website:** UbrotherrDev