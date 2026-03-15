<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Changelog v3 (standardisasi place_attributes):
     *  - Nama item seragam di semua tempat (AC, Wi-Fi, QRIS, Tunai, dll.)
     *  - Deskripsi formal satu kalimat, konsisten per jenis item
     *  - Item tema interior ditambahkan ke facility dengan nama/deskripsi standar
     *  - Typo dan campuran bahasa Inggris informal dihapus dari deskripsi
     *
     * Kamus standar yang digunakan:
     *
     * [facility]
     *   AC                  — Ruangan dilengkapi pendingin udara.
     *   Wi-Fi               — Jaringan internet nirkabel tersedia untuk tamu.
     *   Colokan Listrik     — Stop kontak tersedia untuk pengisian daya perangkat.
     *   Toilet              — Fasilitas toilet tersedia untuk tamu.
     *   Musholla            — Fasilitas tempat ibadah tersedia untuk tamu.
     *   Display Bakery      — Etalase produk bakeri tersedia untuk pemilihan langsung.
     *   Area Outdoor        — Terdapat area duduk di luar ruangan.
     *   Kipas Angin         — Ruangan dilengkapi kipas angin.
     *   Konsep Slow Bar     — Tata letak bar dirancang untuk pengalaman ngopi yang intimate dan personal.
     *   Konsep Home Roastery— Ruangan dirancang menyerupai suasana rumah dengan nuansa roastery.
     *   Konsep Industrial   — Interior menampilkan material raw dengan estetika industrial.
     *   Konsep Vintage      — Interior didekorasi dengan ornamen dan furnitur bergaya vintage.
     *   Konsep Taman Terbuka— Area ngopi memanfaatkan halaman rumah dengan penghijauan alami.
     *   Konsep Parisian     — Interior terinspirasi suasana toko roti bergaya Prancis klasik.
     *   Konsep Minimalis    — Ruangan dirancang dengan prinsip minimalis yang bersih dan teratur.
     *   Konsep Etnik Jawa   — Interior menampilkan dekorasi dan ornamen bernuansa tradisional Jawa.
     *   Konsep Modern Playful— Interior dirancang dengan sentuhan modern dan elemen dekoratif yang ekspresif.
     *
     * [parking]
     *   Parkir Motor    — Area parkir sepeda motor tersedia.
     *   Parkir Mobil    — Area parkir kendaraan roda empat tersedia.
     *
     * [capacity]
     *   Bar Seat        — Tempat duduk di meja bar tersedia.
     *   Meja Individu   — Meja perorangan atau berpasangan tersedia.
     *   Meja Grup       — Meja untuk rombongan tersedia.
     *   Area Lesehan    — Area duduk lesehan tersedia.
     *   Meja Kerja      — Meja dengan ruang memadai untuk laptop tersedia.
     *   Private Room    — Ruangan privat tersedia untuk reservasi khusus.
     *   Lantai 2        — Area duduk di lantai dua tersedia.
     *
     * [accessibility]
     *   Akses Rata Tanah   — Area masuk dan makan dapat diakses tanpa tangga.
     *   Akses Gang         — Lokasi berada di dalam gang, dapat diakses dengan sepeda motor.
     *   Akses Pintu Utama  — Pintu masuk utama lebar dan mudah dijangkau.
     *   Akses Teras        — Akses masuk melalui teras bangunan.
     *
     * [payment]
     *   QRIS            — Pembayaran digital via kode QR diterima.
     *   Tunai           — Pembayaran tunai diterima.
     *   Transfer Bank   — Pembayaran via transfer bank diterima.
     *   Kartu Debit     — Pembayaran dengan kartu debit diterima.
     *   Kartu Kredit    — Pembayaran dengan kartu kredit diterima.
     *
     * [service]
     *   Dine In         — Tamu dapat menikmati pesanan di tempat.
     *   Take Away       — Pesanan tersedia dalam kemasan untuk dibawa pulang.
     *   Self Service    — Tamu memesan dan mengambil pesanan secara mandiri.
     *   Table Service   — Pesanan diantarkan langsung ke meja oleh staf.
     *   Reservasi       — Pemesanan meja terlebih dahulu dapat dilakukan.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Hapus data lama (opsional)
            // Place::truncate();

            $faker = \Faker\Factory::create('id_ID');
            $faker->addProvider(new FakerPicsumImagesProvider($faker));

            // =========================================================================
            // 1. Sagarmatha Coffee Bar
            // =========================================================================
            Place::create([
                'name'               => 'Sagarmatha Coffee Bar',
                'description'        => 'Hidden gem di Pontianak Barat yang menawarkan pengalaman ngopi intimate dengan konsep slow bar industrial. Mengedepankan bahan natural, tempat ini menyajikan racikan kopi unik dengan gula lontar dan buah segar tanpa pemanis buatan. Suasananya yang tenang menjadikannya tempat pelarian sempurna dari hiruk-pikuk kota.',
                'longitude'          => 109.322011,
                'latitude'           => -0.017063,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Bar Seat'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                ],
                'coin_reward'        => 30,
                'exp_reward'         => 150,
                'min_price'          => 25000,
                'max_price'          => 50000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Slow bar industrial yang menyajikan kopi berbahan natural di lokasi tersembunyi.',
                        'address'           => 'Jl. H. Rais A. Rachman Gg. Selamat 3 No.36b, Sungai Jawi Dalam, Pontianak Barat',
                        'opening_hours'     => '09:00',
                        'closing_hours'     => '18:00',
                        'opening_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                        'contact_number'    => null,
                        'website'           => 'https://instagram.com/sagarmatha.coffee',
                    ],
                    'place_value'    => ['Suasana Tenang', 'Rasa Autentik', 'Menu Unik/Variasi', 'Estetika/Instagrammable'],
                    'food_type'      => ['Minuman dan Tambahan', 'Makanan Cepat Saji', 'Makanan Kemasan', 'Menu Campuran'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Sagarmatha Signature', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000,
                            'description' => 'Espresso dengan ekstrak nanas home-made dan rempah natural.'],
                        ['name' => 'Mauna Kea', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000,
                            'description' => 'Paduan unik kopi dengan ekstrak buah bit segar.'],
                        ['name' => 'Distillate', 'image_url' => $faker->imageUrl(640, 480), 'price' => 33000,
                            'description' => 'Kopi yang diproses dengan teknik distilasi, menghasilkan rasa bersih dan aroma yang terfokus.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Slow Bar', 'description' => 'Tata letak bar dirancang untuk pengalaman ngopi yang intimate dan personal.'],
                            ['name' => 'Toilet',          'description' => 'Fasilitas toilet tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Bar Seat',      'description' => 'Tempat duduk di meja bar tersedia.'],
                            ['name' => 'Meja Individu', 'description' => 'Meja perorangan atau berpasangan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Gang', 'description' => 'Lokasi berada di dalam gang, dapat diakses dengan sepeda motor.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',  'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Tunai', 'description' => 'Pembayaran tunai diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In', 'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 2. 2818 Coffee Roasters
            // =========================================================================
            Place::create([
                'name'               => '2818 Coffee Roasters',
                'description'        => 'Micro-roastery yang terletak di kawasan perumahan tenang, menawarkan kopi spesialti hasil sangrai sendiri. Tempat ini menjadi favorit para pekerja lepas karena suasananya yang hening dan kondusif. Selain kopi, tersedia juga menu pendamping seperti pastry dan camilan berat.',
                'longitude'          => 109.330338,
                'latitude'           => -0.054115,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Meja Kerja'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                ],
                'coin_reward'        => 40,
                'exp_reward'         => 80,
                'min_price'          => 20000,
                'max_price'          => 65000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Home roastery yang tenang dan ideal untuk fokus bekerja.',
                        'address'           => 'Gg. Purnama Agung 3, Parit Tokaya, Kec. Pontianak Selatan',
                        'opening_hours'     => '08:00',
                        'closing_hours'     => '21:00',
                        'opening_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => '082154619606',
                        'website'           => 'https://instagram.com/2818.coffeeroasters',
                    ],
                    'place_value'    => ['Suasana Tenang', 'Minuman dan Tambahan', 'Pelayanan Ramah', 'Work From Cafe'],
                    'food_type'      => ['Minuman dan Tambahan', 'Makanan Cepat Saji', 'Menu Campuran', 'Makanan Kemasan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Lemonade Coffee', 'image_url' => $faker->imageUrl(640, 480), 'price' => 26000,
                            'description' => 'Perpaduan espresso segar dengan lemon dan soda, memberikan sensasi asam-manis yang menyegarkan.'],
                        ['name' => 'Dirty Matcha', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000,
                            'description' => 'Matcha latte premium dengan shot espresso yang dituang di atasnya, menciptakan gradasi warna dan rasa yang unik.'],
                        ['name' => 'Sweet Coffee Shake', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000,
                            'description' => 'Milkshake berbasis kopi dengan tekstur creamy dan manis yang cocok untuk cuaca panas Pontianak.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Home Roastery', 'description' => 'Ruangan dirancang menyerupai suasana rumah dengan nuansa roastery.'],
                            ['name' => 'AC',              'description' => 'Ruangan dilengkapi pendingin udara.'],
                            ['name' => 'Wi-Fi',           'description' => 'Jaringan internet nirkabel tersedia untuk tamu.'],
                            ['name' => 'Colokan Listrik', 'description' => 'Stop kontak tersedia untuk pengisian daya perangkat.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir kendaraan roda empat tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Kerja', 'description' => 'Meja dengan ruang memadai untuk laptop tersedia.'],
                            ['name' => 'Meja Grup',  'description' => 'Meja untuk rombongan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Rata Tanah', 'description' => 'Area masuk dan makan dapat diakses tanpa tangga.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',         'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Transfer Bank', 'description' => 'Pembayaran via transfer bank diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',   'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Take Away', 'description' => 'Pesanan tersedia dalam kemasan untuk dibawa pulang.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 3. Ningrat Eatery
            // =========================================================================
            Place::create([
                'name'               => 'Ningrat Eatery',
                'description'        => 'Restoran keluarga yang menghadirkan nuansa Jawa modern di tengah kota Pontianak. Menyajikan hidangan Nusantara yang dikemas secara estetik dengan rasa yang tetap otentik. Tempatnya luas dan nyaman, sangat cocok untuk acara makan bersama keluarga besar atau kolega.',
                'longitude'          => 109.327116,
                'latitude'           => -0.063684,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Lesehan'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward'        => 60,
                'exp_reward'         => 50,
                'min_price'          => 25000,
                'max_price'          => 50000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Restoran bernuansa Jawa modern dengan menu Nusantara yang variatif.',
                        'address'           => 'Jl. Purnama Agung 7 (Sekitar Parit Tokaya), Pontianak Selatan.',
                        'opening_hours'     => '11:00',
                        'closing_hours'     => '21:00',
                        'opening_days'      => ['Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => '082148579657',
                        'website'           => 'https://instagram.com/ningrat.idn',
                    ],
                    'place_value'    => ['Ramah Keluarga', 'Suasana Homey', 'Rasa Autentik', 'Pelayanan Ramah'],
                    'food_type'      => ['Menu Komposit', 'Menu Campuran', 'Makanan Tradisional', 'Makanan Cepat Saji'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Mie Goreng Jawa Ala Ningrat', 'image_url' => $faker->imageUrl(640, 480), 'price' => 29500,
                            'description' => 'Mie goreng khas Jawa dengan bumbu tradisional, telur, dan pilihan lauk pelengkap.'],
                        ['name' => 'Gudeg Lengkap', 'image_url' => $faker->imageUrl(640, 480), 'price' => 35000,
                            'description' => 'Gudeg nangka muda masak santan dengan opor ayam, telur pindang, krecek, dan nasi pulen.'],
                        ['name' => 'Urap Lengkap', 'image_url' => $faker->imageUrl(640, 480), 'price' => 32800,
                            'description' => 'Sayuran segar rebus dilumuri bumbu kelapa parut berbumbu kencur dan cabai, disajikan dengan nasi dan lauk pilihan.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Etnik Jawa', 'description' => 'Interior menampilkan dekorasi dan ornamen bernuansa tradisional Jawa.'],
                            ['name' => 'AC',     'description' => 'Ruangan dilengkapi pendingin udara.'],
                            ['name' => 'Toilet', 'description' => 'Fasilitas toilet tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir kendaraan roda empat tersedia.'],
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Grup',    'description' => 'Meja untuk rombongan tersedia.'],
                            ['name' => 'Area Lesehan', 'description' => 'Area duduk lesehan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Rata Tanah', 'description' => 'Area masuk dan makan dapat diakses tanpa tangga.'],
                        ],
                        'payment' => [
                            ['name' => 'Tunai',        'description' => 'Pembayaran tunai diterima.'],
                            ['name' => 'Transfer Bank', 'description' => 'Pembayaran via transfer bank diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',   'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Reservasi', 'description' => 'Pemesanan meja terlebih dahulu dapat dilakukan.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 4. Tokokopi ODS
            // TODO: Jam buka perlu dikonfirmasi — info terbaru kemungkinan ~15:30–17:30.
            // =========================================================================
            Place::create([
                'name'               => 'Tokokopi ODS',
                'description'        => 'Kedai kopi ini menjadi tempat favorit anak muda Pontianak untuk bercerita. Tersembunyi di dalam gang dengan konsep bangunan industrial raw yang estetik. Menu andalannya adalah varian matcha dan kopi susu creamy yang ramah di kantong pelajar.',
                'longitude'          => 109.311196,
                'latitude'           => -0.031275,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward'        => 20,
                'exp_reward'         => 60,
                'min_price'          => 18000,
                'max_price'          => 35000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Spot nongkrong hidden gem dengan menu matcha dan kopi susu hits.',
                        'address'           => 'Jl. HM Suwignyo, Gg. Tegal Rejo IIIA, Pontianak Kota.',
                        'opening_hours'     => '09:00', // TODO: konfirmasi — kemungkinan berubah jadi ~15:30
                        'closing_hours'     => '16:00', // TODO: konfirmasi — kemungkinan berubah jadi ~17:30
                        'opening_days'      => ['Senin', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => null,
                        'website'           => 'https://instagram.com/tokokopi_ods',
                    ],
                    'place_value'    => ['Harga Terjangkau', 'Minuman dan Tambahan', 'Estetika/Instagrammable', 'Pelayanan Ramah'],
                    'food_type'      => ['Minuman dan Tambahan', 'Makanan Cepat Saji', 'Menu Campuran', 'Makanan Kemasan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Es Kopi Susu Rayu', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000,
                            'description' => 'Es kopi susu signature ODS dengan gula aren pilihan, creamy dan tidak terlalu manis.'],
                        ['name' => 'Spesial Tea', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000,
                            'description' => 'Teh premium pilihan yang diseduh dengan teknik khusus, tersedia dalam pilihan hangat dan dingin.'],
                        ['name' => 'Pure Matcha', 'image_url' => $faker->imageUrl(640, 480), 'price' => 35000,
                            'description' => 'Matcha grade premium tanpa campuran, rasa pahit segar yang pekat dan otentik.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Industrial', 'description' => 'Interior menampilkan material raw dengan estetika industrial.'],
                            ['name' => 'Wi-Fi',       'description' => 'Jaringan internet nirkabel tersedia untuk tamu.'],
                            ['name' => 'Area Outdoor', 'description' => 'Terdapat area duduk di luar ruangan.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Individu', 'description' => 'Meja perorangan atau berpasangan tersedia.'],
                            ['name' => 'Area Lesehan',  'description' => 'Area duduk lesehan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Gang', 'description' => 'Lokasi berada di dalam gang, dapat diakses dengan sepeda motor.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',  'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Tunai', 'description' => 'Pembayaran tunai diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Self Service', 'description' => 'Tamu memesan dan mengambil pesanan secara mandiri.'],
                            ['name' => 'Take Away',    'description' => 'Pesanan tersedia dalam kemasan untuk dibawa pulang.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 5. House of Tahron
            // =========================================================================
            Place::create([
                'name'               => 'House of Tahron',
                'description'        => 'Mengubah fungsi rumah tinggal menjadi restoran yang hangat, House of Tahron menawarkan suasana makan seperti di rumah nenek. Interiornya dipenuhi ornamen vintage yang unik. Menu andalannya adalah masakan rumahan (comfort food) dan pasta yang dimasak dengan hati.',
                'longitude'          => 109.3305,
                'latitude'           => -0.0401,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Teras Vintage'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward'        => 80,
                'exp_reward'         => 70,
                'min_price'          => 30000,
                'max_price'          => 85000,
                'status'             => true,
                'partnership_status' => false,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Restoran rumahan bergaya vintage dengan menu comfort food.',
                        'address'           => 'Jalan Alianyang, Gg. Kencana 1 No.4, Sungai Bangkong, Pontianak Kota',
                        'opening_hours'     => '09:00',
                        'closing_hours'     => '23:00',
                        'opening_days'      => ['Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => null,
                        'website'           => 'https://instagram.com/houseoftahron',
                    ],
                    'place_value'    => ['Suasana Homey', 'Bersejarah/Tradisional', 'Estetika/Instagrammable', 'Pelayanan Ramah'],
                    'food_type'      => ['Menu Komposit', 'Menu Campuran', 'Makanan Tradisional', 'Minuman dan Tambahan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Espresso On The Rock', 'image_url' => $faker->imageUrl(640, 480), 'price' => 25000,
                            'description' => 'Espresso, simple syrup, lemon.'],
                        ['name' => 'Earlgrey Cream', 'image_url' => $faker->imageUrl(640, 480), 'price' => 30000,
                            'description' => 'Cold brew earl grey topped with aromatic cream.'],
                        ['name' => 'Virgin Colada', 'image_url' => $faker->imageUrl(640, 480), 'price' => 27000,
                            'description' => 'Non-coffee mocktail with tropical juice and rum.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Vintage', 'description' => 'Interior didekorasi dengan ornamen dan furnitur bergaya vintage.'],
                            ['name' => 'AC',     'description' => 'Ruangan dilengkapi pendingin udara.'],
                            ['name' => 'Toilet', 'description' => 'Fasilitas toilet tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir kendaraan roda empat tersedia.'],
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Individu', 'description' => 'Meja perorangan atau berpasangan tersedia.'],
                            ['name' => 'Meja Grup',     'description' => 'Meja untuk rombongan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Teras', 'description' => 'Akses masuk melalui teras bangunan.'],
                        ],
                        'payment' => [
                            ['name' => 'Tunai',        'description' => 'Pembayaran tunai diterima.'],
                            ['name' => 'Transfer Bank', 'description' => 'Pembayaran via transfer bank diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',       'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Table Service', 'description' => 'Pesanan diantarkan langsung ke meja oleh staf.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 6. Rumangsa Kopi
            // =========================================================================
            Place::create([
                'name'               => 'Rumangsa Kopi',
                'description'        => 'Berlokasi di komplek perumahan dosen yang tenang, Rumangsa Kopi memanfaatkan halaman rumah yang asri sebagai area ngopi. Dikelilingi pohon rindang, tempat ini menawarkan kesejukan alami di tengah kota. Sangat direkomendasikan untuk Anda yang butuh ketenangan saat bekerja atau membaca.',
                'longitude'          => 109.352495,
                'latitude'           => -0.048739,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Taman'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Teras'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward'        => 25,
                'exp_reward'         => 130,
                'min_price'          => 15000,
                'max_price'          => 50000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Warung kopi di halaman rumah yang asri dan sejuk, buka sore hingga malam.',
                        'address'           => 'Jl. Karangan No.1, Komp. UNTAN, Pontianak.',
                        'opening_hours'     => '15:00',
                        'closing_hours'     => '23:00',
                        'opening_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => '08192020121',
                        'website'           => 'https://instagram.com/rumangsa.kopi',
                    ],
                    'place_value'    => ['Suasana Tenang', 'Minuman dan Tambahan', 'Pelayanan Ramah', 'Work From Cafe'],
                    'food_type'      => ['Minuman dan Tambahan', 'Makanan Cepat Saji', 'Menu Campuran', 'Makanan Kemasan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Rumansa', 'image_url' => $faker->imageUrl(640, 480), 'price' => 18000,
                            'description' => 'Es kopi susu gula aren yang creamy.'],
                        ['name' => 'Secret Mango', 'image_url' => $faker->imageUrl(640, 480), 'price' => 22000,
                            'description' => 'Minuman berbasis mangga segar yang manis dan menyegarkan, cocok untuk cuaca panas.'],
                        ['name' => 'Crispy Chicken Mayo', 'image_url' => $faker->imageUrl(640, 480), 'price' => 25000,
                            'description' => 'Ayam crispy renyah dengan saus mayo creamy, camilan berat yang pas menemani ngopi sore.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Taman Terbuka', 'description' => 'Area ngopi memanfaatkan halaman rumah dengan penghijauan alami.'],
                            ['name' => 'Wi-Fi',           'description' => 'Jaringan internet nirkabel tersedia untuk tamu.'],
                            ['name' => 'Colokan Listrik', 'description' => 'Stop kontak tersedia untuk pengisian daya perangkat.'],
                            ['name' => 'Area Outdoor',    'description' => 'Terdapat area duduk di luar ruangan.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Individu', 'description' => 'Meja perorangan atau berpasangan tersedia.'],
                            ['name' => 'Meja Grup',     'description' => 'Meja untuk rombongan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Rata Tanah', 'description' => 'Area masuk dan makan dapat diakses tanpa tangga.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',  'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Tunai', 'description' => 'Pembayaran tunai diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',   'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Take Away', 'description' => 'Pesanan tersedia dalam kemasan untuk dibawa pulang.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 7. Le Baker Street
            // =========================================================================
            Place::create([
                'name'               => 'Le Baker Street',
                'description'        => 'Bakery shop yang membawa nuansa Paris ke Pontianak. Dikenal dengan interiornya yang klasik dan elegan, tempat ini menyajikan aneka pastry otentik seperti Croissant dan Danish. Cocok untuk menikmati sarapan cantik atau afternoon tea.',
                'longitude'          => 109.288575,
                'latitude'           => -0.042840,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Lantai 2'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Etalase Roti'],
                ],
                'coin_reward'        => 50,
                'exp_reward'         => 60,
                'min_price'          => 25000,
                'max_price'          => 80000,
                'status'             => true,
                'partnership_status' => false,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Butik bakeri estetik dengan sajian pastry ala Prancis.',
                        'address'           => 'Jl. Ujung Pandang 2, Pontianak Kota.',
                        'opening_hours'     => '09:00',
                        'closing_hours'     => '22:00',
                        'opening_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => null,
                        'website'           => 'https://instagram.com/lebakerstreet4',
                    ],
                    'place_value'    => ['Estetika/Instagrammable', 'Minuman dan Tambahan', 'Menu Unik/Variasi', 'Harga Terjangkau'],
                    'food_type'      => ['Makanan Kemasan', 'Minuman dan Tambahan', 'Makanan Cepat Saji', 'Menu Campuran'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Sunkisspresso', 'image_url' => $faker->imageUrl(640, 480), 'price' => 23000,
                            'description' => 'Espresso dengan sentuhan jeruk segar dan sirup, menghadirkan rasa kopi yang cerah dan menyegarkan.'],
                        ['name' => 'Mr. Choco Chu', 'image_url' => $faker->imageUrl(640, 480), 'price' => 23000,
                            'description' => 'Minuman coklat rich dan creamy dengan topping whipped cream, pilihan favorit pencinta coklat.'],
                        ['name' => 'Rongin Strawberry', 'image_url' => $faker->imageUrl(640, 480), 'price' => 15000,
                            'description' => 'Minuman berbasis stroberi segar dengan rasa manis-asam yang menyegarkan, cocok untuk semua usia.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Parisian', 'description' => 'Interior terinspirasi suasana toko roti bergaya Prancis klasik.'],
                            ['name' => 'AC',             'description' => 'Ruangan dilengkapi pendingin udara.'],
                            ['name' => 'Display Bakery', 'description' => 'Etalase produk bakeri tersedia untuk pemilihan langsung.'],
                            ['name' => 'Toilet',         'description' => 'Fasilitas toilet tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir kendaraan roda empat tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Individu', 'description' => 'Meja perorangan atau berpasangan tersedia.'],
                            ['name' => 'Lantai 2',      'description' => 'Area duduk di lantai dua tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Pintu Utama', 'description' => 'Pintu masuk utama lebar dan mudah dijangkau.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',         'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Kartu Debit',  'description' => 'Pembayaran dengan kartu debit diterima.'],
                            ['name' => 'Kartu Kredit', 'description' => 'Pembayaran dengan kartu kredit diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',   'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Take Away', 'description' => 'Pesanan tersedia dalam kemasan untuk dibawa pulang.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 8. Disela Coffee
            // =========================================================================
            Place::create([
                'name'               => 'Disela Coffee',
                'description'        => 'Coffee shop mungil yang benar-benar berada "di sela" bangunan, menawarkan ketenangan di tengah keramaian Jalan Tanjung Pura. Mengusung desain minimalis Jepang yang clean, tempat ini sangat nyaman untuk ngopi sebentar atau bekerja dengan fokus tinggi.',
                'longitude'          => 109.346876,
                'latitude'           => -0.034913,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Meja Bar'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Depan'],
                ],
                'coin_reward'        => 30,
                'exp_reward'         => 100,
                'min_price'          => 25000,
                'max_price'          => 50000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Coffee shop minimalis yang nyempil namun sangat nyaman.',
                        'address'           => 'Jl. Tanjung Pura Gg. Kelantan No.1-2, Kec. Pontianak Kota',
                        'opening_hours'     => '08:00',
                        'closing_hours'     => '22:30', // Weekday. Weekend tutup 23:30.
                        'opening_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => '081351610601',
                        'website'           => 'https://instagram.com/disela.roastery',
                    ],
                    'place_value'    => ['Suasana Tenang', 'Estetika/Instagrammable', 'Minuman dan Tambahan', 'Work From Cafe'],
                    'food_type'      => ['Minuman dan Tambahan', 'Menu Campuran', 'Makanan Cepat Saji', 'Makanan Kemasan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Disela', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000,
                            'description' => 'Es kopi susu signature yang balance.'],
                        ['name' => 'Coconela', 'image_url' => $faker->imageUrl(640, 480), 'price' => 24000,
                            'description' => 'Minuman berbasis kelapa dengan sentuhan segar, rasa tropis yang ringan dan menyegarkan.'],
                        ['name' => 'Spring Garden', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000,
                            'description' => 'Minuman teh herbal dengan campuran buah segar, menghadirkan kesegaran taman di setiap tegukan.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Minimalis', 'description' => 'Ruangan dirancang dengan prinsip minimalis yang bersih dan teratur.'],
                            ['name' => 'AC',    'description' => 'Ruangan dilengkapi pendingin udara.'],
                            ['name' => 'Wi-Fi', 'description' => 'Jaringan internet nirkabel tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Bar Seat',      'description' => 'Tempat duduk di meja bar tersedia.'],
                            ['name' => 'Meja Individu', 'description' => 'Meja perorangan atau berpasangan tersedia.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Pintu Utama', 'description' => 'Pintu masuk utama lebar dan mudah dijangkau.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',  'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Tunai', 'description' => 'Pembayaran tunai diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',   'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Take Away', 'description' => 'Pesanan tersedia dalam kemasan untuk dibawa pulang.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 9. Bakso Cahaya Abadi
            // =========================================================================
            Place::create([
                'name'               => 'Bakso Cahaya Abadi',
                'description'        => 'Spot bakso kekinian di Pontianak Selatan dengan konsep vintage yang instagrammable. Menawarkan pengalaman makan bakso yang berbeda — pilih bakso favoritmu dari etalase dan nikmati kuah kaldu sapi gurih yang dibuat fresh. Ramai dikunjungi anak muda yang ingin makan enak tanpa merogoh kocek dalam.',
                'longitude'          => 109.340494,
                'latitude'           => -0.059785,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Makan'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Etalase Bakso'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward'        => 20,
                'exp_reward'         => 40,
                'min_price'          => 25000,
                'max_price'          => 50000,
                'status'             => true,
                'partnership_status' => false,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Spot bakso kekinian bergaya vintage dengan konsep pilih sendiri dari etalase.',
                        'address'           => 'Jl. Adi Perdana No.A17, Parit Tokaya, Pontianak Selatan.',
                        'opening_hours'     => '08:00',
                        'closing_hours'     => '23:00',
                        'opening_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => '089676981619',
                        'website'           => 'https://instagram.com/baksocahayaabadi',
                    ],
                    'place_value'    => ['Harga Terjangkau', 'Menu Unik/Variasi', 'Estetika/Instagrammable', 'Makanan dan Tambahan'],
                    'food_type'      => ['Sup/Soto', 'Menu Komposit', 'Menu Campuran', 'Makanan Cepat Saji'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Bakso Abadi', 'image_url' => $faker->imageUrl(640, 480), 'price' => 50000,
                            'description' => 'Paket lengkap: bakso daging sapi kenyal, tahu, mie kuning, dan kwetiau dalam kuah kaldu gurih.'],
                        ['name' => 'Bakso Lava', 'image_url' => $faker->imageUrl(640, 480), 'price' => 13000,
                            'description' => 'Bakso berukuran besar dengan isian keju mozzarella yang meleleh saat dibelah.'],
                        ['name' => 'Nasi Goreng Bakso', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000,
                            'description' => 'Nasi goreng bumbu khas dengan potongan bakso sapi sebagai topping, pilihan kenyang yang praktis.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Vintage', 'description' => 'Interior didekorasi dengan ornamen dan furnitur bergaya vintage.'],
                            ['name' => 'Kipas Angin', 'description' => 'Ruangan dilengkapi kipas angin.'],
                            ['name' => 'Toilet',      'description' => 'Fasilitas toilet tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir kendaraan roda empat tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Grup',       'description' => 'Meja untuk rombongan tersedia.'],
                            ['name' => 'Meja Panjang',    'description' => 'Meja panjang bersama tersedia untuk tamu yang datang sendiri maupun berkelompok.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Rata Tanah', 'description' => 'Area masuk dan makan dapat diakses tanpa tangga.'],
                        ],
                        'payment' => [
                            ['name' => 'Tunai', 'description' => 'Pembayaran tunai diterima.'],
                            ['name' => 'QRIS',  'description' => 'Pembayaran digital via kode QR diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',   'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Take Away', 'description' => 'Pesanan tersedia dalam kemasan untuk dibawa pulang.'],
                        ],
                    ],
                ],
            ]);

            // =========================================================================
            // 10. Popina
            // =========================================================================
            Place::create([
                'name'               => 'Popina',
                'description'        => 'Bistro hits di kawasan Paris 1 dengan interior modern yang playful dan instagrammable. Didirikan oleh Chef Riall Arief, Finalis MasterChef Indonesia Season 7, tempat ini menyajikan menu fusion kreatif mulai dari Sei Sapi hingga dessert berkualitas. Spot yang sempurna untuk arisan atau makan malam romantis.',
                'longitude'          => 109.359345,
                'latitude'           => -0.060487,
                'image_urls'         => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Musholla'],
                ],
                'coin_reward'        => 70,
                'exp_reward'         => 60,
                'min_price'          => 25000,
                'max_price'          => 50000,
                'status'             => true,
                'partnership_status' => true,
                'additional_info'    => [
                    'place_detail' => [
                        'short_description' => 'Bistro fusion modern karya finalis MasterChef Indonesia dengan menu kreatif.',
                        'address'           => 'Jl. Parit Haji Husein 1 (Paris 1), Gg. Palasari No. 4, Pontianak.',
                        'opening_hours'     => '10:00',
                        'closing_hours'     => '22:00',
                        'opening_days'      => ['Senin', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number'    => '089515737725',
                        'website'           => 'https://instagram.com/popina.cafe',
                    ],
                    'place_value'    => ['Estetika/Instagrammable', 'Makanan dan Tambahan', 'Menu Unik/Variasi', 'Ramah Keluarga'],
                    'food_type'      => ['Menu Komposit', 'Menu Campuran', 'Makanan Cepat Saji', 'Minuman dan Tambahan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu'           => [
                        ['name' => 'Nasi Ayam Goreng Sambal Bawang', 'image_url' => $faker->imageUrl(640, 480), 'price' => 25000,
                            'description' => 'Ayam goreng crispy dengan sambal bawang pedas yang harum, disajikan dengan nasi putih hangat.'],
                        ['name' => 'Nasi Sei Sapi Sambal Luat', 'image_url' => $faker->imageUrl(640, 480), 'price' => 30000,
                            'description' => 'Daging sapi asap khas NTT (sei) dengan sambal luat pedas segar, dipadukan nasi putih pulen.'],
                        ['name' => 'Nasi Ayam Bakar Bumbu Bali', 'image_url' => $faker->imageUrl(640, 480), 'price' => 36000,
                            'description' => 'Ayam bakar dengan bumbu khas Bali.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Konsep Modern Playful', 'description' => 'Interior dirancang dengan sentuhan modern dan elemen dekoratif yang ekspresif.'],
                            ['name' => 'AC',       'description' => 'Ruangan dilengkapi pendingin udara.'],
                            ['name' => 'Musholla', 'description' => 'Fasilitas tempat ibadah tersedia untuk tamu.'],
                            ['name' => 'Toilet',   'description' => 'Fasilitas toilet tersedia untuk tamu.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir kendaraan roda empat tersedia.'],
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir sepeda motor tersedia.'],
                        ],
                        'capacity' => [
                            ['name' => 'Meja Grup',    'description' => 'Meja untuk rombongan tersedia.'],
                            ['name' => 'Private Room', 'description' => 'Ruangan privat tersedia untuk reservasi khusus.'],
                        ],
                        'accessibility' => [
                            ['name' => 'Akses Pintu Utama', 'description' => 'Pintu masuk utama lebar dan mudah dijangkau.'],
                        ],
                        'payment' => [
                            ['name' => 'QRIS',         'description' => 'Pembayaran digital via kode QR diterima.'],
                            ['name' => 'Kartu Debit',  'description' => 'Pembayaran dengan kartu debit diterima.'],
                            ['name' => 'Kartu Kredit', 'description' => 'Pembayaran dengan kartu kredit diterima.'],
                        ],
                        'service' => [
                            ['name' => 'Dine In',       'description' => 'Tamu dapat menikmati pesanan di tempat.'],
                            ['name' => 'Table Service', 'description' => 'Pesanan diantarkan langsung ke meja oleh staf.'],
                            ['name' => 'Reservasi',     'description' => 'Pemesanan meja terlebih dahulu dapat dilakukan.'],
                        ],
                    ],
                ],
            ]);
        });
    }
}