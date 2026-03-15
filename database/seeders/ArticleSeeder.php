<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Changelog v2:
     *  - Semua artikel diganti dengan artikel aktual dari internet
     *  - Topik difokuskan ke kuliner Pontianak dan tren kuliner/kopi Indonesia
     *  - Setiap artikel memiliki link yang berbeda dan relevan dengan isinya
     *  - Deskripsi diparafrase dari konten asli artikel, bukan disalin
     *  - Image URL menggunakan Unsplash dengan tema yang sesuai
     */
    public function run(): void
    {
        $articles = [

            // ── KULINER PONTIANAK (5 artikel) ────────────────────────────────────

            [
                'author'      => 'Tim Amazing Borneo',
                'title'       => 'Jelajah Rasa Pontianak 2025: Panduan Wisata Kuliner Tak Terlupakan',
                'category'    => 'Kuliner Pontianak',
                'description' => 'Pontianak bukan hanya dikenal dengan Tugu Khatulistiwa, tetapi juga sebagai surga kuliner yang memadukan cita rasa Melayu, Tionghoa, dan Dayak. Di tahun 2025, pesona kuliner kota ini semakin berkembang dengan hadirnya kafe-kafe estetik dan restoran modern yang tetap mempertahankan kelezatan tradisional. Mulai dari Mie Tiaw, Choi Pan, Es Krim Angi, hingga Kopi Pontianak yang legendaris — setiap sudut kota menyimpan pengalaman rasa yang wajib dicoba.',
                'image_url'   => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800',
                'link'        => 'https://www.amazingborneo.id/jelajah-rasa-pontianak-2025-panduan-wisata-kuliner-tak-terlupakan/',
            ],
            [
                'author'      => 'Tim Amazing Borneo',
                'title'       => 'Kuliner Khas Pontianak yang Wajib Dicoba: Jelajah Rasa Khatulistiwa',
                'category'    => 'Kuliner Pontianak',
                'description' => 'Dari Choi Pan yang gurih kenyal, Kwe Cap yang hangat mengenyangkan, Mie Tiaw Sapi dengan wok hei yang kuat, hingga Pengkang — ketan bakar berisi ebi yang aromatik — kuliner Pontianak mencerminkan akulturasi budaya yang kaya. Tak ketinggalan Es Krim Angi berbahan santan kelapa asli dengan topping kacang merah, serta Bubur Pedas yang kaya rempah. Setiap hidangan punya cerita dan keunikan tersendiri yang menjadikan Pontianak destinasi impian para pecinta kuliner.',
                'image_url'   => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800',
                'link'        => 'https://www.amazingborneo.id/jelajah-rasa-khatulistiwa-kuliner-khas-pontianak-yang-wajib-dicoba/',
            ],
            [
                'author'      => 'Tim Amazing Borneo',
                'title'       => 'Wisata Kuliner Pontianak: Sensasi Rasa Khatulistiwa yang Tak Terlupakan',
                'category'    => 'Kuliner Pontianak',
                'description' => 'Jelajahi pusat kuliner malam di Jalan Gajah Mada yang ramai, atau singgah di Pasar Flamboyan untuk aneka jajanan pasar tradisional. Pontianak menawarkan pengalaman kuliner yang lengkap — dari Mi Tiaw Sapi yang menggoyang lidah, Bingke yang manis dan legit, hingga Kopi O di kopitiam legendaris seperti Warung Kopi Asiang. Budaya ngopi yang kental menjadi bagian tak terpisahkan dari kehidupan sehari-hari warga Kota Khatulistiwa.',
                'image_url'   => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800',
                'link'        => 'https://www.amazingborneo.id/wisata-kuliner-pontianak-sensasi-rasa-khatulistiwa-yang-tak-terlupakan/',
            ],
            [
                'author'      => 'Tim Amazing Borneo',
                'title'       => '10 Oleh-Oleh Khas Pontianak yang Wajib Dibawa Pulang',
                'category'    => 'Kuliner Pontianak',
                'description' => 'Kunjungan ke Pontianak belum lengkap tanpa membawa pulang oleh-oleh khasnya. Choi Pan yang bisa dibawa beku, Amplang kerupuk ikan tenggiri yang renyah, Kue Bingka dengan berbagai varian rasa, hingga Kopi Liberika khas Kubu Raya dengan aroma floral yang unik. Setiap oleh-oleh bukan sekadar cinderamata, melainkan cerminan kekayaan cita rasa dan tradisi kuliner yang telah diwariskan turun-temurun di Kota Khatulistiwa.',
                'image_url'   => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=800',
                'link'        => 'https://www.amazingborneo.id/10-oleh-oleh-khas-pontianak-yang-wajib-dibawa-pulang/',
            ],
            [
                'author'      => 'Tim Amazing Borneo',
                'title'       => 'Panduan Wisata Kuliner Pontianak dan Singkawang: Surga Rasa Kalimantan Barat',
                'category'    => 'Kuliner Pontianak',
                'description' => 'Kalimantan Barat menyimpan dua surga kuliner sekaligus: Pontianak dengan hidangan peranakan Tionghoa dan kuliner Melayu yang autentik, serta Singkawang dengan Bakmi Kepiting dan Bubur Paddas khas Melayu yang penuh rempah. Panduan ini mengulas tempat-tempat terbaik untuk mencicipi choi pan yang lembut, bubur pedas yang menggugah selera, kopi legendaris, hingga hidangan laut segar — lengkap dengan tips menavigasi kedua kota untuk pengalaman kuliner yang maksimal.',
                'image_url'   => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
                'link'        => 'https://www.amazingborneo.id/paket-tour-kuliner-pontianak-singkawang-jelajahi-surga-rasa-kalimantan-barat/',
            ],

            // ── TREN KULINER INDONESIA (3 artikel) ───────────────────────────────

            [
                'author'      => 'Redaksi Media Indonesia',
                'title'       => 'Tren Kuliner Viral 2025 Dorong Pertumbuhan UMKM dan Industri Makanan Minuman',
                'category'    => 'Tren Kuliner',
                'description' => 'Industri makanan dan minuman Indonesia tumbuh 6,49 persen hingga kuartal ketiga 2025, melampaui target tahun sebelumnya. Tren ini didorong oleh perubahan perilaku konsumsi Generasi Z yang menyukai menu unik, sederhana, dan fotogenik — mulai dari camilan keju inovatif, dessert bertekstur lumer, donat topping variatif, hingga minuman fusion berbasis matcha dan kopi creamy. Media sosial seperti TikTok dan Instagram menjadi katalisator utama yang membuat UMKM kuliner tumbuh pesat dan berkontribusi sekitar 61,9 persen terhadap PDB nasional.',
                'image_url'   => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800',
                'link'        => 'https://mediaindonesia.com/kuliner/849225/tren-kuliner-viral-2025-dorong-pertumbuhan-umkm-dan-industri-makanan-minuman',
            ],
            [
                'author'      => 'Redaksi Jawa Pos',
                'title'       => 'Ramai Diburu: 8 Makanan dan Minuman Viral di TikTok Sepanjang 2025',
                'category'    => 'Tren Kuliner',
                'description' => 'TikTok kembali menjadi etalase utama tren kuliner Indonesia sepanjang 2025. Dari Cimol Bojot jajanan aci kenyal asal Bandung, Dimsum Mentai dengan saus creamy yang gurih pedas, hingga Es Teler Teko yang viral karena penyajiannya dalam teko besar — semua ramai diburu warganet. Candied Salmon dengan tampilan mengilap seperti permen juga mencuri perhatian, membuktikan bahwa kekuatan visual dan kreativitas penyajian menjadi faktor penentu viralitas kuliner di era digital.',
                'image_url'   => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800',
                'link'        => 'https://www.jawapos.com/kuliner/017014685/ramai-diburu-8-makanan-dan-minuman-viral-di-tiktok-2025',
            ],
            [
                'author'      => 'Redaksi Kompas.id',
                'title'       => 'Mengintip Tren dan Tantangan Bisnis Kopi 2025',
                'category'    => 'Tren Kuliner',
                'description' => 'Pasar kopi Indonesia diperkirakan tumbuh 11 persen per tahun hingga 2030, didorong oleh generasi muda yang menjadikan kedai kopi sebagai ruang kerja, tempat bersosialisasi, dan simbol gaya hidup. Tren kopi spesialti terus menguat karena konsumen semakin peduli terhadap kualitas biji, teknik penyeduhan, dan keberlanjutan produksi. Survei menunjukkan bahwa 40 persen konsumen memilih stop kontak sebagai fasilitas paling penting di kedai kopi, diikuti Wi-Fi dan AC — cerminan bahwa kedai kopi kini bukan sekadar tempat minum, melainkan kantor kedua.',
                'image_url'   => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800',
                'link'        => 'https://www.kompas.id/artikel/mengintip-tren-dan-tantangan-bisnis-kopi-2025',
            ],

            // ── KOPI & CAFE (2 artikel) ───────────────────────────────────────────

            [
                'author'      => 'Redaksi Haroem Media',
                'title'       => 'Specialty Coffee: Tren Bisnis Coffee Shop 2025 yang Menjanjikan',
                'category'    => 'Kopi & Cafe',
                'description' => 'Kopi spesialti — kopi berkualitas tinggi yang memenuhi standar penilaian Specialty Coffee Association dengan skor minimal 80 dari 100 — diprediksi semakin mendominasi industri coffee shop di 2025. Konsumen kini tidak hanya mencari rasa, tetapi juga ingin mengetahui asal biji kopi, metode pengolahan, dan cerita di balik setiap cangkir. Coffee shop yang mampu menawarkan pengalaman premium dan edukasi kepada pelanggan berpotensi menjadi pembeda di tengah persaingan industri kopi yang semakin ketat.',
                'image_url'   => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800',
                'link'        => 'https://haroem.com/food/maulida/specialty-coffee-tren-bisnis-coffee-shop-2025-yang-menjanjikan/',
            ],
            [
                'author'      => 'Redaksi Jaya Agung Mesin',
                'title'       => '5 Tren Kopi Kekinian 2025 yang Bikin Nagih dan Wajib Dicoba',
                'category'    => 'Kopi & Cafe',
                'description' => 'Cold brew dengan rasa yang lebih halus dan rendah asam diprediksi tumbuh menjadi pasar senilai $1,69 miliar di 2025. Selain itu, kopi floral dengan sentuhan aroma bunga, kopi fungsional dengan tambahan adaptogen atau kolagen, hingga tren kustomisasi yang memungkinkan konsumen memilih setiap detail minuman semakin digemari. Kelima tren ini tidak hanya mengubah cara menikmati kopi, tetapi juga membuka peluang besar bagi pelaku usaha untuk berinovasi dan menciptakan menu yang relevan dengan selera Gen Z.',
                'image_url'   => 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=800',
                'link'        => 'https://jayaagungmesin.com/kopi-kekinian/',
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