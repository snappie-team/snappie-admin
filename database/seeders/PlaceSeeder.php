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
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Hapus data lama (opsional)
            // Place::truncate();

            $faker = \Faker\Factory::create('id_ID');
            $faker->addProvider(new FakerPicsumImagesProvider($faker));

            // =========================================================================
            // 1. Sagarmatha Coffee Bar (The True Hidden Gem)
            // =========================================================================
            Place::create([
                'name' => 'Sagarmatha Coffee Bar',
                'description' => 'Hidden gem di Pontianak Barat yang menawarkan pengalaman ngopi intimate dengan konsep slow bar industrial. Mengedepankan bahan natural, tempat ini menyajikan racikan kopi unik dengan gula lontar dan buah segar tanpa pemanis buatan. Suasananya yang tenang menjadikannya tempat pelarian sempurna dari hiruk-pikuk kota.',
                'longitude' => 109.322011,
                'latitude' => -0.017063,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Bar Seat'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                ],
                'coin_reward' => 30,
                'exp_reward' => 150,
                'min_price' => 25000,
                'max_price' => 50000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Slow bar industrial yang menyajikan kopi berbahan natural di lokasi tersembunyi.',
                        'address' => 'Jl. H. Rais A. Rachman Gg. Selamat 3 No.36b, Sungai Jawi Dalam, Pontianak Barat',
                        'opening_hours' => '09:00',
                        'closing_hours' => '18:00', // Actual closing time
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                        'contact_number' => null,
                        'website' => 'https://instagram.com/sagarmatha.coffee',
                    ],
                    'place_value' => ['Suasana Tenang', 'Rasa Autentik', 'Menu Unik/Variasi', 'Estetika/Instagrammable'],
                    'food_type' => ['Minuman dan Tambahan', 'Makanan Cepat Saji', 'Makanan Kemasan', 'Menu Campuran'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Sagarmatha Signature', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000, 'description' => 'Espresso dengan ekstrak nanas home-made dan rempah natural.'],
                        ['name' => 'Mauna Kea', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000, 'description' => 'Paduan unik kopi dengan ekstrak buah bit segar.'],
                        ['name' => 'Distillate', 'image_url' => $faker->imageUrl(640, 480), 'price' => 33000, 'description' => 'Paduan unik kopi dengan ekstrak buah bit segar.'],
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'WiFi Gratis', 'description' => 'Koneksi stabil untuk browsing ringan.'],
                            ['name' => 'Toilet', 'description' => 'Bersih dan terawat.'],
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Tersedia.'],
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir terbatas di dalam gang.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Kecil', 'description' => 'Ideal untuk 2-3 orang.'],
                            ['name' => 'Bar Seat', 'description' => 'Duduk berhadapan langsung dengan barista.']
                        ],
                        'accessibility' => [
                            ['name' => 'Tangga', 'description' => 'Akses ke lantai 2 menggunakan tangga.']
                        ],
                        'payment' => [
                            ['name' => 'QRIS', 'description' => 'Metode pembayaran utama.'],
                            ['name' => 'Tunai', 'description' => 'Metode pembayaran utama.']
                        ],
                        'service' => [
                            ['name' => 'Dine In', 'description' => 'Disarankan untuk pengalaman terbaik.'],
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 2. 2818 Coffee Roasters (Specialty Coffee)
            // =========================================================================
            Place::create([
                'name' => '2818 Coffee Roasters',
                'description' => 'Micro-roastery yang terletak di kawasan perumahan tenang, menawarkan kopi spesialti hasil sangrai sendiri. Tempat ini menjadi favorit para pekerja lepas karena suasananya yang hening dan kondusif. Selain kopi, tersedia juga menu pendamping seperti pastry dan camilan berat.',
                'longitude' => 109.330338,
                'latitude' => -0.054115,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Meja Kerja'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                ],
                'coin_reward' => 40,
                'exp_reward' => 80,
                'min_price' => 20000,
                'max_price' => 65000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Home roastery yang tenang dan ideal untuk fokus bekerja.',
                        'address' => 'Gg. Purnama Agung 3, Parit Tokaya, Kec. Pontianak Selatan',
                        'opening_hours' => '08:00',
                        'closing_hours' => '21:00',
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => '082154619606',
                        'website' => 'https://instagram.com/2818.coffeeroasters',
                    ],
                    'place_value' => ['Work From Cafe', 'Suasana Tenang', 'Jaringan Lancar', 'Rasa Autentik'],
                    'food_type' => ['Minuman dan Tambahan', 'Makanan Cepat Saji', 'Menu Campuran', 'Makanan Kemasan'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Lemonade Coffee', 'image_url' => $faker->imageUrl(640, 480), 'price' => 26000, 'description' => 'Espresso house blend dengan gula aren legit.'],
                        ['name' => 'Dirty Matcha', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000, 'description' => 'Makaroni panggang dengan keju melimpah.'],
                        ['name' => 'Sweet Coffee Shake', 'image_url' => $faker->imageUrl(640, 480), 'price' => 28000, 'description' => 'Coklat pekat dengan tekstur fudgy.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Colokan Listrik', 'description' => 'Tersedia hampir di setiap meja.'],
                            ['name' => 'AC', 'description' => 'Ruangan indoor sejuk.'],
                            ['name' => 'WiFi Kencang', 'description' => 'Cocok untuk work from cafe.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Aman di halaman rumah.'],
                            ['name' => 'Parkir Mobil', 'description' => 'Terbatas di bahu jalan gang.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Kerja', 'description' => 'Meja tinggi nyaman untuk laptop.'],
                            ['name' => 'Communal Table', 'description' => 'Meja panjang untuk grup kecil.']
                        ],
                        'accessibility' => [
                            ['name' => 'Rata Tanah', 'description' => 'Mudah diakses dari jalan.']
                        ],
                        'payment' => [
                            ['name' => 'QRIS', 'description' => 'Scan QR tersedia.'],
                            ['name' => 'Transfer Bank', 'description' => 'Bisa transfer langsung.']
                        ],
                        'service' => [
                            ['name' => 'Dine In', 'description' => 'Suasana hening dihargai.'],
                            ['name' => 'Take Away', 'description' => 'Kemasan botol tersedia.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 3. Ningrat Eatery (Modern Indonesian)
            // =========================================================================
            Place::create([
                'name' => 'Ningrat Eatery',
                'description' => 'Restoran keluarga yang menghadirkan nuansa Jawa modern di tengah kota Pontianak. Menyajikan hidangan Nusantara yang dikemas secara estetik dengan rasa yang tetap otentik. Tempatnya luas dan nyaman, sangat cocok untuk acara makan bersama keluarga besar atau kolega.',
                'longitude' => 109.327116,
                'latitude' => -0.063684,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Lesehan'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward' => 60,
                'exp_reward' => 50,
                'min_price' => 25000,
                'max_price' => 50000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Restoran bernuansa Jawa modern dengan menu Nusantara yang variatif.',
                        'address' => 'Jl. Purnama Agung 7 (Sekitar Parit Tokaya), Pontianak Selatan.',
                        'opening_hours' => '11:00',
                        'closing_hours' => '21:00',
                        'opening_days' => ['Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => '082148579657',
                        'website' => 'https://instagram.com/ningrat.idn',
                    ],
                    'place_value' => ['Ramah Keluarga', 'Suasana Homey', 'Rasa Autentik', 'Pelayanan Ramah'],
                    'food_type' => ['Menu Komposit', 'Sup/Soto', 'Menu Campuran', 'Makanan Tradisional'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Mie Goreng Jawa Ala Ningrat', 'image_url' => $faker->imageUrl(640, 480), 'price' => 29500, 'description' => 'Nasi goreng signature dengan lauk lengkap.'],
                        ['name' => 'Gudeg Lengkap', 'image_url' => $faker->imageUrl(640, 480), 'price' => 35000, 'description' => 'Sup iga sapi kuah bening segar.'],
                        ['name' => 'Urap Lengkap', 'image_url' => $faker->imageUrl(640, 480), 'price' => 32800, 'description' => 'Bebek goreng empuk dengan sambal khas.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'AC', 'description' => 'Area makan dalam ruangan sejuk.'],
                            ['name' => 'Photo Spot', 'description' => 'Dekorasi etnik Jawa yang instagrammable.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Mobil', 'description' => 'Area parkir memadai.'],
                            ['name' => 'Parkir Motor', 'description' => 'Tersedia.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Besar', 'description' => 'Cocok untuk rombongan 6-10 orang.'],
                            ['name' => 'Area Lesehan', 'description' => 'Tersedia opsi duduk lesehan.']
                        ],
                        'accessibility' => [
                            ['name' => 'Ramah Anak', 'description' => 'Space luas untuk anak-anak.']
                        ],
                        'payment' => [
                            ['name' => 'Tunai', 'description' => 'Bisa.'],
                            ['name' => 'Transfer', 'description' => 'Bisa.']
                        ],
                        'service' => [
                            ['name' => 'Reservasi', 'description' => 'Bisa booking meja sebelumnya.'],
                            ['name' => 'Dine In', 'description' => 'Penyajian makanan cepat.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 4. Tokokopi ODS (Youth Hangout)
            // =========================================================================
            Place::create([
                'name' => 'Tokokopi ODS',
                'description' => 'Kedai kopi ini menjadi tempat favorit anak muda Pontianak untuk bercerita. Tersembunyi di dalam gang dengan konsep bangunan industrial raw yang estetik. Menu andalannya adalah varian matcha dan kopi susu creamy yang ramah di kantong pelajar.',
                'longitude' => 109.311196,
                'latitude' => -0.031275,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward' => 20,
                'exp_reward' => 60,
                'min_price' => 18000,
                'max_price' => 35000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Spot nongkrong hidden gem dengan menu matcha dan kopi susu hits.',
                        'address' => 'Jl. HM Suwignyo, Gg. Tegal Rejo IIIA, Pontianak Kota.',
                        'opening_hours' => '09:00',
                        'closing_hours' => '16:00',
                        'opening_days' => ['Senin', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => null,
                        'website' => 'https://instagram.com/tokokopi_ods',
                    ],
                    'place_value' => ['Harga Terjangkau', 'Nongkrong', 'Estetika/Instagrammable', 'Suasana Tenang'],
                    'food_type' => ['Minuman dan Tambahan', 'Mi Instan', 'Menu Campuran', 'Makanan Cepat Saji'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Es Kopi Susu Rayu', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000, 'description' => 'Matcha premium yang creamy dan pekat.'],
                        ['name' => 'Spesial Tea', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000, 'description' => 'Signature kopi susu gula aren.'],
                        ['name' => 'Pure Matcha', 'image_url' => $faker->imageUrl(640, 480), 'price' => 35000, 'description' => 'Camilan manis pendamping kopi.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Outdoor Area', 'description' => 'Area duduk santai di teras.'],
                            ['name' => 'WiFi Gratis', 'description' => 'Koneksi cukup untuk media sosial.'],
                            ['name' => 'Stopkontak', 'description' => 'Tersedia di beberapa titik.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Area parkir di halaman rumah.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Kecil', 'description' => 'Cocok untuk 2-4 orang.'],
                            ['name' => 'Lesehan', 'description' => 'Tersedia area duduk santai.']
                        ],
                        'accessibility' => [
                            ['name' => 'Jalan Gang', 'description' => 'Akses masuk hanya muat satu motor.']
                        ],
                        'payment' => [
                            ['name' => 'QRIS', 'description' => 'Diutamakan non-tunai.'],
                            ['name' => 'Tunai', 'description' => 'Bisa.']
                        ],
                        'service' => [
                            ['name' => 'Self Service', 'description' => 'Ambil dan bereskan pesanan sendiri.'],
                            ['name' => 'Take Away', 'description' => 'Cup sealer rapi.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 5. House of Tahron (Homey Vintage)
            // =========================================================================
            Place::create([
                'name' => 'House of Tahron',
                'description' => 'Mengubah fungsi rumah tinggal menjadi restoran yang hangat, House of Tahron menawarkan suasana makan seperti di rumah nenek. Interiornya dipenuhi ornamen vintage yang unik. Menu andalannya adalah masakan rumahan (comfort food) dan pasta yang dimasak dengan hati.',
                'longitude' => 109.3305,
                'latitude' => -0.0401,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Teras Vintage'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward' => 80,
                'exp_reward' => 70,
                'min_price' => 30000,
                'max_price' => 85000,
                'status' => true,
                'partnership_status' => false,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Restoran rumahan bergaya vintage dengan menu comfort food.',
                        'address' => 'Jalan Alianyang, Gg. Kencana 1 No.4, Sungai Bangkong, Pontianak Kota',
                        'opening_hours' => '09:00',
                        'closing_hours' => '23:00',
                        'opening_days' => ['Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => null,
                        'website' => 'https://instagram.com/houseoftahron',
                    ],
                    'place_value' => ['Suasana Homey', 'Bersejarah/Tradisional', 'Estetika/Instagrammable', 'Pelayanan Ramah'],
                    'food_type' => ['Menu Komposit', 'Menu Campuran', 'Makanan Tradisional', 'Minuman dan Tambahan'],
                    'menu_image_url' => 'https://via.placeholder.com/640x480?text=Menu+Tahron',
                    'menu' => [
                        ['name' => 'Espresso On The Rock', 'image_url' => $faker->imageUrl(640, 480), 'price' => 25000, 'description' => 'Espresso, symple syrup, lemon.'],
                        ['name' => 'Earlgrey Cream', 'image_url' => $faker->imageUrl(640, 480), 'price' => 30000, 'description' => 'Coldbrew earlgrey topped with aromatic cream.'],
                        ['name' => 'Virgin Colada', 'image_url' => $faker->imageUrl(640, 480), 'price' => 27000, 'description' => 'Non-coffee mocktail with tropical juice and rhum.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'AC', 'description' => 'Sejuk dan nyaman.']
                        ],
                        'parking' => [
                            ['name' => 'Carport', 'description' => 'Parkir mobil terbatas di garasi rumah.']
                        ],
                        'capacity' => [
                            ['name' => 'Private Spot', 'description' => 'Sudut tenang untuk pasangan.']
                        ],
                        'accessibility' => [
                            ['name' => 'Teras', 'description' => 'Akses masuk melalui teras rumah.']
                        ],
                        'payment' => [
                            ['name' => 'Tunai', 'description' => 'Diutamakan.'],
                            ['name' => 'Transfer', 'description' => 'BCA Available.']
                        ],
                        'service' => [
                            ['name' => 'Table Service', 'description' => 'Pelayanan ramah seperti bertamu.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 6. Rumangsa Kopi (Hidden Nature)
            // =========================================================================
            Place::create([
                'name' => 'Rumangsa Kopi',
                'description' => 'Berlokasi di komplek perumahan dosen yang tenang, Rumangsa Kopi memanfaatkan halaman rumah yang asri sebagai area ngopi. Dikelilingi pohon rindang, tempat ini menawarkan kesejukan alami di tengah kota. Sangat direkomendasikan untuk Anda yang butuh ketenangan saat bekerja atau membaca.',
                'longitude' => 109.352495,
                'latitude' => -0.048739,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Taman'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Teras'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward' => 25,
                'exp_reward' => 130,
                'min_price' => 15000,
                'max_price' => 50000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Warung kopi di halaman rumah yang asri dan sejuk.',
                        'address' => 'Jl. Karangan No.1, Komp. UNTAN, Pontianak.',
                        'opening_hours' => '08:00',
                        'closing_hours' => '24:00',
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => '08192020121',
                        'website' => 'https://instagram.com/rumangsa.kopi',
                    ],
                    'place_value' => ['Suasana Tenang', 'Work From Cafe', 'Pet Friendly', 'Harga Terjangkau'],
                    'food_type' => ['Minuman dan Tambahan', 'Makanan Tradisional', 'Menu Campuran', 'Makanan Cepat Saji'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Rumansa', 'image_url' => $faker->imageUrl(640, 480), 'price' => 18000, 'description' => 'Es kopi susu gula aren yang creamy.'],
                        ['name' => 'Secret Mango', 'image_url' => $faker->imageUrl(640, 480), 'price' => 22000, 'description' => 'Donat gula klasik, teman ngopi terbaik.'],
                        ['name' => 'Crispy Chicken Mayo', 'image_url' => $faker->imageUrl(640, 480), 'price' => 25000, 'description' => 'V60 dengan beans lokal pilihan.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Outdoor Garden', 'description' => 'Duduk di bawah pohon rindang.'],
                            ['name' => 'WiFi', 'description' => 'Koneksi stabil.'],
                            ['name' => 'Stopkontak', 'description' => 'Tersedia di area teras.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Luas dan aman di halaman.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Taman', 'description' => 'Meja besi/kayu outdoor.'],
                            ['name' => 'Teras', 'description' => 'Area semi-indoor.']
                        ],
                        'accessibility' => [
                            ['name' => 'Rata Tanah', 'description' => 'Mudah diakses dari jalan komplek.']
                        ],
                        'payment' => [
                            ['name' => 'QRIS', 'description' => 'Tersedia.'],
                            ['name' => 'Tunai', 'description' => 'Bisa.']
                        ],
                        'service' => [
                            ['name' => 'Dine In', 'description' => 'Suasana santai.'],
                            ['name' => 'Take Away', 'description' => 'Bisa.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 7. Le Baker Street (Parisian Bakery)
            // =========================================================================
            Place::create([
                'name' => 'Le Baker Street',
                'description' => 'Bakery shop yang membawa nuansa Paris ke Pontianak. Dikenal dengan interiornya yang klasik dan elegan, tempat ini menyajikan aneka pastry otentik seperti Croissant dan Danish. Cocok untuk menikmati sarapan cantik atau afternoon tea.',
                'longitude' => 109.288575,
                'latitude' => -0.042840,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Lantai 2'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Etalase Roti'],
                ],
                'coin_reward' => 50,
                'exp_reward' => 60,
                'min_price' => 25000,
                'max_price' => 80000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Butik bakery estetik dengan sajian pastry ala Prancis.',
                        'address' => 'Jl. Ujung Pandang 2, Pontianak Kota.',
                        'opening_hours' => '09:00',
                        'closing_hours' => '22:00',
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => null,
                        'website' => 'https://instagram.com/lebakerstreet',
                    ],
                    'place_value' => ['Estetika/Instagrammable', 'Rasa Autentik', 'Menu Unik/Variasi', 'Nongkrong'],
                    'food_type' => ['Makanan Kemasan', 'Menu Campuran', 'Minuman dan Tambahan', 'Menu Komposit'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Sunkisspresso', 'image_url' => $faker->imageUrl(640, 480), 'price' => 23000, 'description' => 'Croissant buttery dengan topping almond melimpah.'],
                        ['name' => 'Mr. Choco Chu', 'image_url' => $faker->imageUrl(640, 480), 'price' => 23000, 'description' => 'Cake keju lembut yang lumer di mulut.'],
                        ['name' => 'Rongin Strawberry', 'image_url' => $faker->imageUrl(640, 480), 'price' => 15000, 'description' => 'Kopi panas dengan foam tebal.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Indoor AC', 'description' => 'Dingin dan wangi roti.'],
                            ['name' => 'Toilet', 'description' => 'Tersedia.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Mobil', 'description' => 'Tersedia di depan ruko.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Kecil', 'description' => 'Cocok untuk tea time berdua.'],
                            ['name' => 'Lantai 2', 'description' => 'Area duduk lebih luas.']
                        ],
                        'accessibility' => [
                            ['name' => 'Pintu Kaca', 'description' => 'Mudah dibuka.']
                        ],
                        'payment' => [
                            ['name' => 'Debit/Credit', 'description' => 'Bisa.'],
                            ['name' => 'QRIS', 'description' => 'Tersedia.']
                        ],
                        'service' => [
                            ['name' => 'Take Away', 'description' => 'Box kemasan premium.'],
                            ['name' => 'Dine In', 'description' => 'Piring keramik cantik.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 8. Disela Coffee (Hidden Minimalist)
            // =========================================================================
            Place::create([
                'name' => 'Disela Coffee',
                'description' => 'Coffee shop mungil yang benar-benar berada "di sela" bangunan, menawarkan ketenangan di tengah keramaian Jalan Dr. Sutomo. Mengusung desain minimalis Jepang yang clean, tempat ini sangat nyaman untuk ngopi sebentar atau bekerja dengan fokus tinggi.',
                'longitude' => 109.346876,
                'latitude' => -0.034913,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Meja Bar'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Depan'],
                ],
                'coin_reward' => 30,
                'exp_reward' => 100,
                'min_price' => 25000,
                'max_price' => 50000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Coffee shop minimalis yang nyempil namun sangat nyaman.',
                        'address' => 'Jl. Tanjung Pura Gg. Kelantan No.1-2, Kec. Pontianak Kota',
                        'opening_hours' => '08:00',
                        'closing_hours' => '22:30',
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => '081351610601',
                        'website' => 'https://instagram.com/disela.roastery',
                    ],
                    'place_value' => ['Suasana Tenang', 'Work From Cafe', 'Estetika/Instagrammable', 'Pelayanan Ramah'],
                    'food_type' => ['Minuman dan Tambahan', 'Menu Campuran', 'Makanan Tradisional', 'Makanan Cepat Saji'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Disela', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000, 'description' => 'Es kopi susu signature yang balance.'],
                        ['name' => 'Coconela', 'image_url' => $faker->imageUrl(640, 480), 'price' => 24000, 'description' => 'Teh leci segar.'],
                        ['name' => 'Spring Garden', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000, 'description' => 'Camilan gurih dengan bumbu rujak pedas.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'AC', 'description' => 'Sangat sejuk.'],
                            ['name' => 'WiFi Kencang', 'description' => 'Cocok untuk kerja.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Tersedia di depan ruko.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Bar', 'description' => 'Menghadap jendela.'],
                            ['name' => 'Meja Kecil', 'description' => 'Terbatas.'
                            ]
                        ],
                        'accessibility' => [
                            ['name' => 'Pintu Geser', 'description' => 'Akses mudah.']
                        ],
                        'payment' => [
                            ['name' => 'QRIS', 'description' => 'Utama.'],
                            ['name' => 'Tunai', 'description' => 'Bisa.']
                        ],
                        'service' => [
                            ['name' => 'Take Away', 'description' => 'Cup praktis.'],
                            ['name' => 'Dine In', 'description' => 'Self service.'
                            ]
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 9. Bakso Cahaya Abadi (Legendary)
            // =========================================================================
            Place::create([
                'name' => 'Bakso Cahaya Abadi',
                'description' => 'Legenda kuliner Pontianak yang tak lekang oleh waktu. Dikenal dengan tekstur baksonya yang kenyal dan kuah kaldu sapi asli yang gurih. Tanpa dekorasi mewah, tempat ini selalu ramai dikunjungi warga lokal yang mencari rasa bakso autentik.',
                'longitude' => 109.340494,
                'latitude' => -0.059785,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Makan'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Dapur'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Parkir'],
                ],
                'coin_reward' => 20,
                'exp_reward' => 40,
                'min_price' => 25000,
                'max_price' => 50000,
                'status' => true,
                'partnership_status' => false,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Warung bakso legendaris dengan cita rasa kaldu sapi yang khas.',
                        'address' => 'Jl. Adi Perdana No.A17, Parit Tokaya, Pontianak Selatan.',
                        'opening_hours' => '08:00',
                        'closing_hours' => '23:00',
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => '089676981619',
                        'website' => 'https://instagram.com/baksocahayaabadi',
                    ],
                    'place_value' => ['Rasa Autentik', 'Bersejarah/Tradisional', 'Harga Terjangkau', 'Pelayanan Ramah'],
                    'food_type' => ['Sup/Soto', 'Menu Komposit', 'Gaya Tionghoa', 'Makanan Cepat Saji'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Bakso Abadi', 'image_url' => $faker->imageUrl(640, 480), 'price' => 50000, 'description' => 'Bakso, tahu, mie kuning, dan kwetiau.'],
                        ['name' => 'Bakso Lava', 'image_url' => $faker->imageUrl(640, 480), 'price' => 13000, 'description' => 'Jeruk Pontianak murni segar.'],
                        ['name' => 'Nasi Goreng Bakso', 'image_url' => $faker->imageUrl(640, 480), 'price' => 20000, 'description' => 'Gorengan pelengkap yang wajib dicoba.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Kipas Angin', 'description' => 'Area makan terbuka.'],
                            ['name' => 'Toilet', 'description' => 'Sederhana.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Motor', 'description' => 'Di depan ruko.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Panjang', 'description' => 'Konsep sharing table.'],
                            ['name' => 'Kapasitas Besar', 'description' => 'Bisa menampung banyak orang.']
                        ],
                        'accessibility' => [
                            ['name' => 'Rata Tanah', 'description' => 'Akses langsung dari parkiran.']
                        ],
                        'payment' => [
                            ['name' => 'Tunai', 'description' => 'Metode utama.'],
                            ['name' => 'QRIS', 'description' => 'Tersedia.']
                        ],
                        'service' => [
                            ['name' => 'Cepat Saji', 'description' => 'Pelayanan sangat gesit.'],
                            ['name' => 'Dine In', 'description' => 'Langsung makan panas-panas.']
                        ]
                    ]
                ]
            ]);

            // =========================================================================
            // 10. Popina (Chic Bistro)
            // =========================================================================
            Place::create([
                'name' => 'Popina',
                'description' => 'Bistro hits di kawasan Paris 1 dengan interior modern yang playful dan instagrammable. Dimiliki oleh alumni Masterchef, tempat ini menyajikan menu fusion kreatif mulai dari Se\'i Sapi hingga dessert berkualitas. Spot yang sempurna untuk arisan atau makan malam romantis.',
                'longitude' => 109.359345,
                'latitude' => -0.060487,
                'image_urls' => [
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Indoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Area Outdoor'],
                    ['url' => $faker->imageUrl(640, 480), 'description' => 'Musholla'],
                ],
                'coin_reward' => 70,
                'exp_reward' => 60,
                'min_price' => 25000,
                'max_price' => 50000,
                'status' => true,
                'partnership_status' => true,
                'additional_info' => [
                    'place_detail' => [
                        'short_description' => 'Bistro fusion modern dengan menu kreatif dan gelato.',
                        'address' => 'Jl. Parit Haji Husein 1 (Paris 1), Gg. Palasari No. 4, Pontianak.',
                        'opening_hours' => '12:00',
                        'closing_hours' => '22:00',
                        'opening_days' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        'contact_number' => null,
                        'website' => 'https://instagram.com/popina.cafe',
                    ],
                    'place_value' => ['Estetika/Instagrammable', 'Menu Unik/Variasi', 'Ramah Keluarga', 'Pelayanan Ramah'],
                    'food_type' => ['Menu Komposit', 'Menu Campuran', 'Minuman dan Tambahan', 'Gaya Padang'],
                    'menu_image_url' => $faker->imageUrl(640, 480),
                    'menu' => [
                        ['name' => 'Nasi Ayam Goreng Sambal Bawang', 'image_url' => $faker->imageUrl(640, 480), 'price' => 25000, 'description' => 'Daging asap khas Kupang dengan sambal pedas asam.'],
                        ['name' => 'Nasi Sei Sapi Sambal Luat', 'image_url' => $faker->imageUrl(640, 480), 'price' => 30000, 'description' => 'Ikan cakalang suwir pedas khas Manado.'],
                        ['name' => 'Nasi Ayam Bakar Bumbu Bali', 'image_url' => $faker->imageUrl(640, 480), 'price' => 36000, 'description' => 'Ayam bakar dengan bumbu khas Bali.']
                    ],
                    'place_attributes' => [
                        'facility' => [
                            ['name' => 'Indoor AC', 'description' => 'Dingin dengan dekorasi cantik.'],
                            ['name' => 'Musholla', 'description' => 'Bersih.']
                        ],
                        'parking' => [
                            ['name' => 'Parkir Luas', 'description' => 'Area parkir mobil memadai.']
                        ],
                        'capacity' => [
                            ['name' => 'Meja Grup', 'description' => 'Cocok untuk arisan/kumpul keluarga.'],
                            ['name' => 'Private Room', 'description' => 'Tersedia untuk reservasi.']
                        ],
                        'accessibility' => [
                            ['name' => 'Pintu Kaca', 'description' => 'Akses mudah.']
                        ],
                        'payment' => [
                            ['name' => 'Debit/Credit', 'description' => 'Bisa.'],
                            ['name' => 'QRIS', 'description' => 'Bisa.']
                        ],
                        'service' => [
                            ['name' => 'Table Service', 'description' => 'Pelayanan sangat membantu.'],
                            ['name' => 'Reservasi', 'description' => 'Disarankan saat akhir pekan.']
                        ]
                    ]
                ]
            ]);
        });
    }
}