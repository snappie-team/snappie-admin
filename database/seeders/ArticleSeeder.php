<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'author' => 'Tim Snappie',
                'title' => '10 Destinasi Wisata Alam Tersembunyi di Indonesia',
                'category' => 'Wisata',
                'description' => 'Indonesia memiliki ribuan destinasi wisata alam yang belum banyak diketahui wisatawan. Dari air terjun tersembunyi di pedalaman Kalimantan hingga pantai-pantai perawan di Maluku, setiap sudut Nusantara menyimpan keindahan yang menunggu untuk dijelajahi. Artikel ini mengulas 10 destinasi wisata alam yang wajib masuk bucket list kamu di tahun ini.',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Tim Snappie',
                'title' => 'Tips Fotografi Landscape untuk Pemula',
                'category' => 'Tips & Trik',
                'description' => 'Ingin mengabadikan keindahan alam dengan foto yang memukau? Tidak perlu kamera mahal, cukup dengan smartphone dan teknik yang tepat, kamu bisa menghasilkan foto landscape berkualitas. Pelajari komposisi rule of thirds, golden hour, dan teknik framing yang akan membuat foto perjalananmu naik level.',
                'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Rina Kusuma',
                'title' => 'Kuliner Khas Nusantara yang Wajib Dicoba Saat Traveling',
                'category' => 'Kuliner',
                'description' => 'Setiap daerah di Indonesia punya kuliner khas yang sayang untuk dilewatkan. Dari rendang Padang, gudeg Jogja, papeda Maluku, hingga coto Makassar — menjelajahi Indonesia tidak lengkap tanpa mencicipi ragam kulinernya. Simak rekomendasi kuliner khas dari 34 provinsi yang bisa kamu coba saat berkunjung.',
                'image_url' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Andi Prasetyo',
                'title' => 'Panduan Mendaki Gunung untuk Pemula',
                'category' => 'Petualangan',
                'description' => 'Mendaki gunung menjadi aktivitas yang semakin populer di kalangan anak muda. Namun, persiapan yang matang sangat penting untuk keselamatan dan kenyamanan. Artikel ini membahas persiapan fisik, perlengkapan wajib, etika mendaki, dan rekomendasi gunung ramah pemula di Jawa dan Bali.',
                'image_url' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Dewi Lestari',
                'title' => 'Eco-Tourism: Cara Berwisata yang Ramah Lingkungan',
                'category' => 'Edukasi',
                'description' => 'Wisata berkelanjutan bukan sekadar tren, tapi kebutuhan. Dengan semakin banyaknya destinasi wisata yang rusak akibat overtourism, penting bagi kita untuk mulai menerapkan prinsip eco-tourism. Mulai dari membawa tumbler sendiri, tidak membuang sampah sembarangan, hingga mendukung komunitas lokal — setiap langkah kecil berdampak besar.',
                'image_url' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Tim Snappie',
                'title' => 'Spot Instagramable di Bandung yang Belum Mainstream',
                'category' => 'Wisata',
                'description' => 'Bandung selalu punya tempat baru yang menarik untuk dikunjungi. Selain destinasi populer seperti Kawah Putih dan Tangkuban Perahu, ada banyak spot tersembunyi yang cocok untuk hunting foto. Dari kafe estetik di Dago hingga taman-taman tersembunyi di Lembang, temukan spot favoritmu berikutnya di sini.',
                'image_url' => 'https://images.unsplash.com/photo-1555899434-94d1368aa7af?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Budi Santoso',
                'title' => 'Mengenal Budaya Lokal Lewat Wisata Desa',
                'category' => 'Budaya',
                'description' => 'Wisata desa menawarkan pengalaman autentik yang tidak bisa kamu dapatkan di hotel berbintang. Tinggal bersama warga lokal, belajar membatik, menanam padi, atau membuat kerajinan tangan — semua itu adalah cara terbaik untuk memahami kekayaan budaya Indonesia. Berikut 5 desa wisata terbaik yang bisa kamu kunjungi.',
                'image_url' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Sari Wulandari',
                'title' => 'Traveling Hemat: Jelajah Indonesia dengan Budget Minim',
                'category' => 'Tips & Trik',
                'description' => 'Siapa bilang traveling harus mahal? Dengan perencanaan yang tepat, kamu bisa menjelajah Indonesia dengan budget minim tanpa mengorbankan pengalaman. Dari tips mencari tiket promo, memilih penginapan murah berkualitas, hingga memanfaatkan transportasi lokal — semua trik hemat ada di sini.',
                'image_url' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Tim Snappie',
                'title' => 'Snorkeling dan Diving: Surga Bawah Laut Indonesia',
                'category' => 'Petualangan',
                'description' => 'Indonesia adalah rumah bagi Segitiga Terumbu Karang, pusat keanekaragaman hayati laut dunia. Raja Ampat, Bunaken, Komodo, dan Wakatobi hanyalah sebagian kecil dari surga bawah laut yang bisa kamu jelajahi. Artikel ini membahas spot diving terbaik, persiapan, dan sertifikasi yang kamu butuhkan.',
                'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
            [
                'author' => 'Hana Putri',
                'title' => 'Staycation vs Traveling: Mana yang Lebih Cocok Untukmu?',
                'category' => 'Lifestyle',
                'description' => 'Tidak selalu harus pergi jauh untuk refreshing. Staycation di hotel atau resort terdekat bisa jadi alternatif liburan yang tidak kalah menyenangkan. Tapi kapan sebaiknya staycation dan kapan harus traveling? Simak perbandingan lengkapnya termasuk estimasi budget dan rekomendasi destinasi untuk keduanya.',
                'image_url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800',
                'link' => 'https://jogja.disway.id/gaya-hidup/read/697842/tempat-makan-ini-masuk-daftar-destinasi-kuliner-unggulan-di-pontianak-simak-ulasan-lengkapnya-berikut-ini',
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title']],
                $article,
            );
        }

        $this->command->info('Articles seeded: ' . count($articles) . ' articles');
    }
}
