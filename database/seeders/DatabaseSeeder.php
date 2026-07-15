<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use App\Models\Feedback;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PointHistory;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === ADMIN USER ===
        $admin = User::create([
            'name' => 'Admin Lapak',
            'email' => 'admin@lapak.com',
            'phone' => '081234567890',
            'address' => 'Jalan Martadinata',
            'role' => 'admin',
            'points' => 0,
            'member_level' => 'ultra_pro_max',
            'password' => Hash::make('admin123'),
        ]);

        // === MEMBER USERS ===
        $member1 = User::create([
            'name' => 'Hendry Kurniawan',
            'email' => 'hendry@email.com',
            'phone' => '081234567891',
            'address' => 'Jl. Sudirman No. 15, Jakarta',
            'role' => 'user',
            'points' => 450,
            'member_level' => 'silver',
            'password' => Hash::make('member123'),
        ]);

        $member2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@email.com',
            'phone' => '081234567892',
            'address' => 'Jl. Gatot Subroto No. 22, Jakarta',
            'role' => 'user',
            'points' => 120,
            'member_level' => 'bronze',
            'password' => Hash::make('member123'),
        ]);

        $member3 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'phone' => '081234567893',
            'address' => 'Jl. Thamrin No. 8, Jakarta',
            'role' => 'user',
            'points' => 780,
            'member_level' => 'gold',
            'password' => Hash::make('member123'),
        ]);

        $member4 = User::create([
            'name' => 'Rina Wijaya',
            'email' => 'rina@email.com',
            'phone' => '081234567894',
            'address' => 'Jl. Diponegoro No. 5, Bandung',
            'role' => 'user',
            'points' => 1450,
            'member_level' => 'diamond',
            'password' => Hash::make('member123'),
        ]);

        $member5 = User::create([
            'name' => 'Andi Prasetyo',
            'email' => 'andi.prasetyo@email.com',
            'phone' => '081234567895',
            'address' => 'Jl. Ahmad Yani No. 12, Surabaya',
            'role' => 'user',
            'points' => 2500,
            'member_level' => 'ultra_pro_max',
            'password' => Hash::make('member123'),
        ]);

        // === MENU CATEGORIES ===
        $catAyam = MenuCategory::create(['name' => 'Ayam & Unggas', 'slug' => 'ayam', 'icon' => '🍗', 'sort_order' => 1]);
        $catIkan = MenuCategory::create(['name' => 'Ikan & Seafood', 'slug' => 'ikan-seafood', 'icon' => '🐟', 'sort_order' => 2]);
        $catDaging = MenuCategory::create(['name' => 'Daging', 'slug' => 'daging', 'icon' => '🥩', 'sort_order' => 3]);
        $catSayuran = MenuCategory::create(['name' => 'Sayuran', 'slug' => 'sayuran', 'icon' => '🥬', 'sort_order' => 4]);
        $catTelurTahu = MenuCategory::create(['name' => 'Telur, Tahu & Tempe', 'slug' => 'telur-tahu-tempe', 'icon' => '🥚', 'sort_order' => 5]);
        $catLainnya = MenuCategory::create(['name' => 'Lainnya', 'slug' => 'lainnya', 'icon' => '🍽️', 'sort_order' => 6]);

        // === MENUS (data asli dari daftar menu LAPAK 1 PUTRI 2 PUTRA) ===
        $menus = [
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Jantung Pisang Bunga Pepaya', 'description' => 'Tumisan jantung pisang dan bunga pepaya, gurih dan sedikit pahit khas', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-jantung-pisang-bunga-pepaya.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Daun Singkong', 'description' => 'Daun singkong rebus bumbu santan, menu rumahan favorit sehari-hari', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-daun-singkong.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Sambal Ikan Layang', 'description' => 'Ikan layang goreng dengan sambal pedas khas rumahan', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => true, 'image_path' => '/images/menu/sambal-ikan-layang.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Terong Teri Balado', 'description' => 'Terong balado dipadukan teri kering yang gurih renyah', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-terong-teri-balado.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Presto', 'description' => 'Ayam presto empuk hingga ke tulang, bumbu meresap sempurna', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => true, 'image_path' => '/images/menu/ayam-presto.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Sambal Baby Cumi', 'description' => 'Baby cumi segar dimasak sambal pedas gurih', 'price' => 40000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sambal-baby-cumi.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Ikan Kuah Kuning', 'description' => 'Ikan segar berkuah kuning khas rempah nusantara', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ikan-kuah-kuning.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Kecap', 'description' => 'Ayam masak kecap manis dengan bawang dan cabai', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => true, 'image_path' => '/images/menu/ayam-kecap.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catDaging->id, 'name' => 'Semur Daging Rusa', 'description' => 'Daging rusa semur empuk berkuah kecap rempah', 'price' => 40000, 'unit' => 'porsi', 'stock_status' => 'terbatas', 'is_hot' => false, 'image_path' => '/images/menu/semur-daging-rusa.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Semur Hati Ayam', 'description' => 'Hati ayam semur kecap, lembut dan kaya rasa', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/semur-hati-ayam.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Kol + Udang', 'description' => 'Kol tumis dipadukan udang segar, ringan dan gurih', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-kol-udang.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Udang Krispy Tanpa Kulit', 'description' => 'Udang crispy tanpa kulit, renyah dan praktis dimakan', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => true, 'image_path' => '/images/menu/udang-krispy-tanpa-kulit.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Udang Sambal', 'description' => 'Udang segar dimasak sambal pedas khas rumahan', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/udang-sambal.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Sawi + Udang', 'description' => 'Sawi tumis segar dengan udang, sederhana dan bergizi', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-sawi-udang.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Kacang Panjang + Tahu', 'description' => 'Kacang panjang tumis dengan tahu, menu rumahan sehari-hari', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-kacang-panjang-tahu.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Sop', 'description' => 'Sop sayuran segar dengan wortel, kentang, dan kol', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-sop.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Serundeng', 'description' => 'Ayam suwir berbalut serundeng kelapa gurih', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ayam-serundeng.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catDaging->id, 'name' => 'Bebek Paleko', 'description' => 'Bebek masak paleko pedas khas, bumbu meresap kuat', 'price' => 40000, 'unit' => 'porsi', 'stock_status' => 'terbatas', 'is_hot' => true, 'image_path' => '/images/menu/bebek-paleko.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Pare + Telur', 'description' => 'Pare tumis dengan telur, sedikit pahit dan menyehatkan', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-pare-telur.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Pepaya + Tempe', 'description' => 'Pepaya muda tumis dengan tempe, ringan dan segar', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-pepaya-tempe.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catTelurTahu->id, 'name' => 'Telur Tahu Kecap', 'description' => 'Telur dan tahu masak kecap manis pedas', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/telur-tahu-kecap.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catTelurTahu->id, 'name' => 'Telur Balado', 'description' => 'Telur rebus balado pedas khas rumahan', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/telur-balado.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Kacang Panjang + Tahu (Varian 2)', 'description' => 'Kacang panjang dan tahu bumbu berbeda dari varian pertama', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-kacang-panjang-tahu-2.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Sawi + Telur', 'description' => 'Sawi tumis dengan telur orak-arik, praktis dan bergizi', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-sawi-telur.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Opor Ayam', 'description' => 'Ayam opor santan gurih dengan rempah khas', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => true, 'image_path' => '/images/menu/opor-ayam.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Ikan Layang Bumbu Kuning', 'description' => 'Ikan layang goreng bumbu kuning meresap', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ikan-layang-bumbu-kuning.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Bening Bayam + Kacang Panjang', 'description' => 'Bayam dan kacang panjang berkuah bening, segar dan ringan', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-bening-bayam-kacang-panjang.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catLainnya->id, 'name' => 'Perkedel Jagung', 'description' => 'Perkedel jagung manis renyah, digoreng fresh', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/perkedel-jagung.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Ikan Suir', 'description' => 'Ikan suir bumbu pedas gurih, cocok untuk lauk nasi', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ikan-suir.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ampela Semur', 'description' => 'Ampela ayam semur kecap, kenyal dan gurih', 'price' => 25000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ampela-semur.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catLainnya->id, 'name' => 'Mie Goreng', 'description' => 'Mie goreng bumbu spesial dengan sayuran', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/mie-goreng.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Bumbu Bali', 'description' => 'Ayam bumbu bali pedas manis khas', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ayam-bumbu-bali.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catIkan->id, 'name' => 'Ikan Asin Kakap + Pete', 'description' => 'Ikan asin kakap goreng dengan pete, aroma khas menggugah', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ikan-asin-kakap-pete.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Kecap (Varian 2)', 'description' => 'Ayam kecap dengan racikan bumbu sedikit berbeda', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ayam-kecap-2.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catTelurTahu->id, 'name' => 'Tempe Orek + Kacang Merah', 'description' => 'Tempe orek manis dipadukan kacang merah', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/tempe-orek-kacang-merah.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Filet', 'description' => 'Ayam filet tanpa tulang, empuk dan praktis', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/ayam-filet.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catAyam->id, 'name' => 'Ayam Rica-Rica', 'description' => 'Ayam bumbu rica-rica pedas khas Manado', 'price' => 30000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => true, 'image_path' => '/images/menu/ayam-rica-rica.jpeg', 'is_preorder_available' => true],
            ['category_id' => $catSayuran->id, 'name' => 'Sayur Kangkung + Daun Pepaya', 'description' => 'Kangkung tumis dipadukan daun pepaya, khas dan menyehatkan', 'price' => 20000, 'unit' => 'porsi', 'stock_status' => 'tersedia', 'is_hot' => false, 'image_path' => '/images/menu/sayur-kangkung-daun-pepaya.jpeg', 'is_preorder_available' => true],
        ];

        $createdMenus = [];
        foreach ($menus as $menu) {
            $createdMenus[] = Menu::create($menu);
        }

        // === SAMPLE REVIEWS ===
        $reviewData = [
            ['user_id' => $member1->id, 'menu_id' => $createdMenus[4]->id, 'rating' => 5, 'comment' => 'Ayam prestonya empuk banget sampai ke tulang! Bumbunya meresap.', 'reviewer_name' => 'Hendry K.', 'is_member' => true],
            ['user_id' => $member3->id, 'menu_id' => $createdMenus[4]->id, 'rating' => 4, 'comment' => 'Enak, tapi kadang agak asin. Overall recommended!', 'reviewer_name' => 'Budi S.', 'is_member' => true],
            ['user_id' => null, 'menu_id' => $createdMenus[4]->id, 'rating' => 5, 'comment' => 'Best ayam presto in town! 🔥', 'reviewer_name' => 'Andi', 'is_member' => false],
            ['user_id' => $member2->id, 'menu_id' => $createdMenus[24]->id, 'rating' => 5, 'comment' => 'Opor ayamnya mantap! Kuah santannya gurih, dagingnya empuk.', 'reviewer_name' => 'Siti N.', 'is_member' => true],
            ['user_id' => $member1->id, 'menu_id' => $createdMenus[24]->id, 'rating' => 5, 'comment' => 'Kualitas opor konsisten, selalu enak setiap pesan.', 'reviewer_name' => 'Hendry K.', 'is_member' => true],
            ['user_id' => null, 'menu_id' => $createdMenus[2]->id, 'rating' => 4, 'comment' => 'Sambal ikan layangnya pedas mantap, ikannya segar.', 'reviewer_name' => 'Dewi', 'is_member' => false],
            ['user_id' => $member3->id, 'menu_id' => $createdMenus[36]->id, 'rating' => 5, 'comment' => 'Ayam rica-ricanya pedas nampol, cocok buat pecinta pedas!', 'reviewer_name' => 'Budi S.', 'is_member' => true],
            ['user_id' => null, 'menu_id' => $createdMenus[1]->id, 'rating' => 4, 'comment' => 'Sayur daun singkongnya segar dan nendang!', 'reviewer_name' => 'Rini', 'is_member' => false],
        ];

        foreach ($reviewData as $review) {
            Review::create($review);
        }

        // === SAMPLE ORDERS (last 5 months for admin charts) ===
        $orderDates = [
            now()->subMonths(4)->startOfMonth()->addDays(2),
            now()->subMonths(4)->startOfMonth()->addDays(10),
            now()->subMonths(4)->startOfMonth()->addDays(18),
            now()->subMonths(3)->startOfMonth()->addDays(5),
            now()->subMonths(3)->startOfMonth()->addDays(12),
            now()->subMonths(3)->startOfMonth()->addDays(20),
            now()->subMonths(3)->startOfMonth()->addDays(25),
            now()->subMonths(2)->startOfMonth()->addDays(3),
            now()->subMonths(2)->startOfMonth()->addDays(8),
            now()->subMonths(2)->startOfMonth()->addDays(15),
            now()->subMonths(2)->startOfMonth()->addDays(22),
            now()->subMonths(2)->startOfMonth()->addDays(28),
            now()->subMonths(1)->startOfMonth()->addDays(1),
            now()->subMonths(1)->startOfMonth()->addDays(7),
            now()->subMonths(1)->startOfMonth()->addDays(14),
            now()->subMonths(1)->startOfMonth()->addDays(21),
            now()->subMonths(1)->startOfMonth()->addDays(26),
            now()->subDays(20),
            now()->subDays(15),
            now()->subDays(10),
            now()->subDays(7),
            now()->subDays(5),
            now()->subDays(3),
            now()->subDays(1),
        ];

        $members = [$member1, $member2, $member3];
        $paymentMethods = ['gopay', 'ovo', 'dana', 'bca', 'mandiri', 'bri', 'qris'];

        foreach ($orderDates as $i => $date) {
            $member = $members[$i % 3];
            $numItems = rand(1, 4);
            $selectedMenus = collect($createdMenus)->random($numItems);
            $subtotal = 0;
            $items = [];

            foreach ($selectedMenus as $menu) {
                $qty = rand(1, 3);
                $itemSubtotal = $menu->price * $qty;
                $subtotal += $itemSubtotal;
                $items[] = [
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'quantity' => $qty,
                    'price' => $menu->price,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $discount = $subtotal >= 100000 ? intval($subtotal * 0.05) : 0;
            $total = $subtotal - $discount;

            $order = Order::create([
                'user_id' => $member->id,
                'order_number' => Order::generateOrderNumber() . '-' . $i,
                'customer_name' => $member->name,
                'customer_phone' => $member->phone,
                'customer_address' => $member->address,
                'notes' => $i % 3 === 0 ? 'Sambal dipisah' : null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'points_earned' => 10,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => 'paid',
                'order_status' => 'delivered',
                'paid_at' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($items as $item) {
                OrderItem::create(array_merge($item, ['order_id' => $order->id]));
            }
        }

        // === SAMPLE POINT HISTORIES ===
        PointHistory::create(['user_id' => $member1->id, 'points' => 50, 'type' => 'earn', 'description' => 'Bonus Pendaftaran Member']);
        PointHistory::create(['user_id' => $member1->id, 'points' => 80, 'type' => 'earn', 'description' => 'Belanja Rp 80.000']);
        PointHistory::create(['user_id' => $member1->id, 'points' => -20, 'type' => 'redeem', 'description' => 'Tukar Diskon Rp 2.000']);
        PointHistory::create(['user_id' => $member1->id, 'points' => 120, 'type' => 'earn', 'description' => 'Belanja Rp 120.000']);
        PointHistory::create(['user_id' => $member1->id, 'points' => 60, 'type' => 'earn', 'description' => 'Belanja Rp 60.000']);

        PointHistory::create(['user_id' => $member2->id, 'points' => 50, 'type' => 'earn', 'description' => 'Bonus Pendaftaran Member']);
        PointHistory::create(['user_id' => $member2->id, 'points' => 70, 'type' => 'earn', 'description' => 'Belanja Rp 70.000']);

        PointHistory::create(['user_id' => $member3->id, 'points' => 50, 'type' => 'earn', 'description' => 'Bonus Pendaftaran Member']);
        PointHistory::create(['user_id' => $member3->id, 'points' => 350, 'type' => 'earn', 'description' => 'Belanja Rp 350.000 (Grosir)']);
        PointHistory::create(['user_id' => $member3->id, 'points' => 200, 'type' => 'earn', 'description' => 'Belanja Rp 200.000']);
        PointHistory::create(['user_id' => $member3->id, 'points' => -50, 'type' => 'redeem', 'description' => 'Tukar Diskon Rp 5.000']);
        PointHistory::create(['user_id' => $member3->id, 'points' => 230, 'type' => 'earn', 'description' => 'Belanja Rp 230.000']);

        // === SAMPLE CHAT MESSAGES ===
        ChatMessage::create(['user_id' => $admin->id, 'message' => '🎉 Selamat datang di Sobat Lapak Chat Room! Di sini kita bisa sharing info menu terbaru dan promo.', 'type' => 'admin_announcement', 'created_at' => now()->subDays(10)]);
        ChatMessage::create(['user_id' => $member1->id, 'message' => 'Halo semua! Senang gabung di sini. Rendang sapi kemarin mantap banget! 🔥', 'type' => 'member', 'created_at' => now()->subDays(9)]);
        ChatMessage::create(['user_id' => $member3->id, 'message' => 'Setuju! Rendangnya memang juara. BTW ada yang sudah coba paket keluarga?', 'type' => 'member', 'created_at' => now()->subDays(8)]);
        ChatMessage::create(['user_id' => $member2->id, 'message' => 'Belum coba paket keluarga, tapi ayam goreng lengkuasnya enak banget! 😋', 'type' => 'member', 'created_at' => now()->subDays(7)]);
        ChatMessage::create(['user_id' => $admin->id, 'message' => '📢 PROMO MINGGU INI: Diskon 10% untuk semua Paket Hemat! Berlaku sampai hari Minggu.', 'type' => 'admin_announcement', 'created_at' => now()->subDays(3)]);
        ChatMessage::create(['user_id' => $member1->id, 'message' => 'Promonya keren! Langsung pesan paket hemat deh 💪', 'type' => 'member', 'created_at' => now()->subDays(2)]);

        // === SAMPLE FEEDBACKS ===
        Feedback::create(['user_id' => $member1->id, 'name' => 'Hendry Kurniawan', 'email' => 'hendry@email.com', 'type' => 'masukan', 'subject' => 'Tambah Menu Ikan', 'message' => 'Saran saya untuk menambahkan menu ikan bakar atau ikan goreng. Pasti banyak yang suka!', 'status' => 'read']);
        Feedback::create(['user_id' => null, 'name' => 'Anonim', 'email' => 'anonim@email.com', 'type' => 'saran', 'subject' => 'Jam Operasional', 'message' => 'Kalau bisa buka dari jam 6 pagi supaya bisa pesan untuk sarapan.', 'status' => 'pending']);
        Feedback::create(['user_id' => $member2->id, 'name' => 'Siti Nurhaliza', 'email' => 'siti@email.com', 'type' => 'komplain', 'subject' => 'Pesanan Terlambat', 'message' => 'Pesanan saya kemarin terlambat 30 menit. Mohon ditingkatkan lagi kecepatan pengirimannya.', 'status' => 'responded', 'response' => 'Mohon maaf atas keterlambatannya, Bu Siti. Kami akan meningkatkan kecepatan pengiriman. Sebagai kompensasi, kami berikan bonus 50 poin.']);
    }
}