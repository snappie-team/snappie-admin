<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Reward;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamificationSeeder extends Seeder
{
    /**
     * Tanggal akhir periode kupon — ubah satu tempat ini untuk semua reward.
     */
    private const REWARD_PERIOD_END = '31 Agustus 2026';

    /**
     * Syarat & ketentuan default yang berlaku untuk semua kupon.
     * Dipakai ulang di setiap reward agar tidak ada teks yang tidak sengaja berbeda.
     */
    private function defaultSyaratKetentuan(): array
    {
        $period = self::REWARD_PERIOD_END;

        return [
            "Periode penukaran s.d {$period}.",
            'Kupon berlaku selama 3 hari setelah penukaran dengan Koin.',
            'Kode kupon yang muncul setelah tekan "Pakai" hanya berlaku selama 1 jam.',
            'Kode kupon hanya dapat digunakan 1 kali saat pembayaran.',
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->seedAchievements(); // 6 Core Actions x 3 Levels
            $this->seedChallenges();   // 9 Challenges (None, Daily, Weekly)
            $this->seedRewards();      // 4 Rewards
        });
    }

    /**
     * Seed Achievements (One-time, Leveling System)
     */
    private function seedAchievements(): void
    {
        $series = [
            // 1. CHECK-IN SERIES
            'checkin' => [
                ['name' => 'Langkah Pertama',   'target' => 1,   'coin' => 50,  'xp' => 20,  'desc' => 'Melakukan check-in pertama kali di tempat kuliner.'],
                ['name' => 'Penjelajah Kuliner', 'target' => 20,  'coin' => 150, 'xp' => 100, 'desc' => 'Sudah check-in di 20 tempat kuliner yang berbeda.'],
                ['name' => 'Legenda Pontianak',  'target' => 100, 'coin' => 500, 'xp' => 300, 'desc' => 'Check-in di 100 tempat kuliner — tak ada sudut kota yang terlewat.'],
            ],
            // 2. REVIEW SERIES
            'review' => [
                ['name' => 'Pengulas Pemula', 'target' => 1,  'coin' => 50,  'xp' => 25,  'desc' => 'Menulis ulasan pertama untuk sebuah tempat kuliner.'],
                ['name' => 'Selera Tajam',    'target' => 10, 'coin' => 200, 'xp' => 100, 'desc' => 'Konsisten memberikan 10 ulasan kuliner yang berarti.'],
                ['name' => 'Lidah Emas',      'target' => 50, 'coin' => 600, 'xp' => 400, 'desc' => 'Menulis 50 ulasan — menjadi suara terpercaya komunitas kuliner.'],
            ],
            // 3. POST SERIES
            'post' => [
                ['name' => 'Mulai Bersuara',     'target' => 1,  'coin' => 50,  'xp' => 20,  'desc' => 'Membuat postingan pertama di forum komunitas Snappie.'],
                ['name' => 'Pencerita Kuliner',  'target' => 10, 'coin' => 200, 'xp' => 100, 'desc' => 'Aktif berbagi pengalaman kuliner lewat 10 postingan.'],
                ['name' => 'Kurator Hidden Gem', 'target' => 50, 'coin' => 500, 'xp' => 300, 'desc' => 'Membuat 50 postingan — wajah dan suara komunitas Snappie.'],
            ],
            // 4. COIN EARNED SERIES
            'coin_earned' => [
                ['name' => 'Kolektor', 'target' => 1000,  'coin' => 100,  'xp' => 50,   'desc' => 'Berhasil mengumpulkan 1.000 Koin pertama di Snappie.'],
                ['name' => 'Juragan',  'target' => 5000,  'coin' => 500,  'xp' => 250,  'desc' => 'Total Koin yang terkumpul sudah mencapai 5.000.'],
                ['name' => 'Sultan',   'target' => 20000, 'coin' => 2000, 'xp' => 1000, 'desc' => 'Mengumpulkan 20.000 Koin — penguasa ekonomi di Snappie.'],
            ],
            // 5. XP EARNED SERIES
            //    reward_xp = 0 pada semua level untuk mencegah infinite XP loop.
            'xp_earned' => [
                ['name' => 'Pendatang Baru', 'target' => 500,   'coin' => 100,  'xp' => 0, 'desc' => 'Mengumpulkan 500 XP — langkah pertama mengenal Snappie.'],
                ['name' => 'Warga Tetap',    'target' => 2500,  'coin' => 300,  'xp' => 0, 'desc' => 'Total XP mencapai 2.500 — sudah jadi bagian dari komunitas.'],
                ['name' => 'Veteran',        'target' => 10000, 'coin' => 1000, 'xp' => 0, 'desc' => 'Mengumpulkan 10.000 XP — salah satu pengguna paling berpengalaman di Snappie.'],
            ],
            // 6. TOP RANK SERIES (target = threshold rank leaderboard)
            'top_rank' => [
                ['name' => 'Bintang Lokal',   'target' => 10, 'coin' => 200,  'xp' => 100,  'desc' => 'Masuk Top 10 leaderboard bulanan Snappie.',        'filter' => ['max_rank' => 10]],
                ['name' => 'Langganan Top 5', 'target' => 5,  'coin' => 1000, 'xp' => 500,  'desc' => 'Berhasil masuk Top 5 leaderboard bulanan Snappie.', 'filter' => ['max_rank' => 5]],
                ['name' => 'Raja Leaderboard','target' => 1,  'coin' => 5000, 'xp' => 2500, 'desc' => 'Meraih peringkat 1 leaderboard bulanan Snappie.',   'filter' => ['max_rank' => 1]],
            ],
        ];

        $displayOrder = 1;

        foreach ($series as $action => $levels) {
            $previousAchievementId = null;

            foreach ($levels as $index => $data) {
                $level = $index + 1;
                $code  = "ach_{$action}_{$level}";

                $achievement = Achievement::updateOrCreate(
                    ['code' => $code],
                    [
                        'name'                    => $data['name'],
                        'type'                    => 'achievement',
                        'description'             => $data['desc'],
                        'criteria_action'         => $action,
                        'criteria_target'         => $data['target'],
                        'criteria_filters'        => $data['filter'] ?? null,
                        'coin_reward'             => $data['coin'],
                        'reward_xp'               => $data['xp'],
                        'reset_schedule'          => 'none',
                        'level'                   => $level,
                        'required_achievement_id' => $previousAchievementId,
                        'display_order'           => $displayOrder++,
                        'status'                  => true,
                    ]
                );

                $previousAchievementId = $achievement->id;
            }
        }
    }

    /**
     * Seed Challenges (Recurring, Reset Schedule)
     */
    private function seedChallenges(): void
    {
        $challenges = [

            // ── RESET: NONE (Special / One-time Missions) ─────────────────

            [
                'code'   => 'special_follow',
                'name'   => 'Cari Teman Jajan',
                'action' => 'follow',
                'target' => 5,
                'coin'   => 100,
                'xp'     => 50,
                'reset'  => 'none',
                'desc'   => 'Ikuti 5 pengguna lain di Snappie dan bangun jaringan teman jajanmu.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Temukan pengguna lain melalui fitur Pencarian atau feed Forum.',
                        'Buka profil pengguna yang ingin diikuti.',
                        'Ketuk tombol "Ikuti" pada halaman profil mereka.',
                        'Ulangi hingga mengikuti 5 pengguna berbeda.',
                        'Klaim reward setelah target terpenuhi.',
                    ],
                ],
            ],
            [
                'code'   => 'special_comment',
                'name'   => 'Suara Jajanan',
                'action' => 'comment',
                'target' => 10,
                'coin'   => 150,
                'xp'     => 75,
                'reset'  => 'none',
                'desc'   => 'Berikan 10 komentar pada postingan di forum Snappie.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka tab Forum dan pilih postingan yang menarik.',
                        'Ketuk "Berikan Komentar" di bagian bawah postingan.',
                        'Tulis komentarmu dan kirim.',
                        'Ulangi pada postingan berbeda hingga total 10 komentar.',
                        'Klaim reward setelah target terpenuhi.',
                    ],
                ],
            ],
            [
                'code'   => 'special_rank',
                'name'   => 'Raja Papan Skor',
                'action' => 'rank',
                'target' => 1,
                'coin'   => 500,
                'xp'     => 250,
                'reset'  => 'none',
                'desc'   => 'Raih peringkat 1 di leaderboard Snappie minimal satu kali.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Kumpulkan XP sebanyak-banyaknya melalui check-in, review, dan postingan.',
                        'Pantau posisimu di halaman Leaderboard.',
                        'Pertahankan aktivitas hingga menduduki peringkat 1.',
                        'Klaim reward setelah berhasil masuk posisi teratas.',
                    ],
                ],
            ],

            // ── RESET: DAILY ───────────────────────────────────────────────

            [
                'code'   => 'chal_daily_checkin',
                'name'   => 'Makan Siang Dulu!',
                'action' => 'checkin',
                'target' => 1,
                'coin'   => 20,
                'xp'     => 10,
                'reset'  => 'daily',
                'desc'   => 'Lakukan 1 check-in di tempat kuliner hari ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka halaman detail tempat kuliner yang sedang kamu kunjungi.',
                        'Ketuk tombol "Check-in" dan konfirmasi lokasimu.',
                        'Check-in berhasil — reward siap diklaim!',
                    ],
                ],
            ],
            [
                'code'   => 'chal_daily_comment',
                'name'   => 'Nyinyir Sehat',
                'action' => 'comment',
                'target' => 10,
                'coin'   => 25,
                'xp'     => 10,
                'reset'  => 'daily',
                'desc'   => 'Tinggalkan 10 komentar di forum Snappie hari ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka tab Forum dan jelajahi postingan terbaru.',
                        'Ketuk "Berikan Komentar" pada postingan pilihanmu.',
                        'Tulis komentar dan kirim.',
                        'Ulangi hingga 10 komentar hari ini terpenuhi.',
                        'Klaim reward setelah target tercapai.',
                    ],
                ],
            ],
            [
                'code'   => 'chal_daily_post',
                'name'   => 'Cerita Kuliner Hari Ini',
                'action' => 'post',
                'target' => 1,
                'coin'   => 30,
                'xp'     => 15,
                'reset'  => 'daily',
                'desc'   => 'Bagikan 1 postingan kuliner di forum Snappie hari ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka tab Forum dan ketuk tombol buat postingan.',
                        'Tambahkan foto dan cerita singkat pengalamanmu.',
                        'Publikasikan postingan ke komunitas Snappie.',
                        'Klaim reward setelah postingan berhasil diunggah.',
                    ],
                ],
            ],

            // ── RESET: WEEKLY ──────────────────────────────────────────────

            [
                'code'   => 'chal_weekly_checkin',
                'name'   => 'Keliling Kuliner Minggu Ini',
                'action' => 'checkin',
                'target' => 3,
                'coin'   => 250,
                'xp'     => 125,
                'reset'  => 'weekly',
                'desc'   => 'Check-in di 3 tempat kuliner berbeda dalam minggu ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Kunjungi tempat kuliner yang ingin dicoba.',
                        'Buka halaman detail tempat tersebut di Snappie.',
                        'Ketuk tombol "Check-in" dan konfirmasi lokasimu.',
                        'Ulangi di 2 tempat lain yang berbeda dalam minggu yang sama.',
                        'Klaim reward setelah 3 check-in mingguan terpenuhi.',
                    ],
                ],
            ],
            [
                'code'   => 'chal_weekly_review',
                'name'   => 'Kritik Membangun',
                'action' => 'review',
                'target' => 3,
                'coin'   => 150,
                'xp'     => 75,
                'reset'  => 'weekly',
                'desc'   => 'Tulis ulasan jujur untuk 3 tempat kuliner dalam minggu ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka halaman detail tempat kuliner yang sudah dikunjungi.',
                        'Ketuk "Berikan Ulasan" dan beri rating bintang.',
                        'Tulis deskripsi pengalamanmu secara jujur.',
                        'Ulangi untuk 2 tempat lain dalam minggu yang sama.',
                        'Klaim reward setelah 3 ulasan mingguan selesai.',
                    ],
                ],
            ],
            [
                'code'   => 'chal_weekly_post',
                'name'   => 'Food Blogger Dadakan',
                'action' => 'post',
                'target' => 5,
                'coin'   => 300,
                'xp'     => 150,
                'reset'  => 'weekly',
                'desc'   => 'Buat 5 postingan kuliner di forum Snappie dalam minggu ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka tab Forum dan ketuk tombol buat postingan.',
                        'Bagikan foto dan cerita dari pengalaman kulinermu.',
                        'Publikasikan postingan ke komunitas Snappie.',
                        'Ulangi hingga 5 postingan dalam minggu ini terpenuhi.',
                        'Klaim reward setelah semua postingan mingguan selesai.',
                    ],
                ],
            ],
        ];

        $displayOrder = 50;

        foreach ($challenges as $data) {
            Achievement::updateOrCreate(
                ['code' => $data['code']],
                [
                    'name'                    => $data['name'],
                    'type'                    => 'challenge',
                    'description'             => $data['desc'],
                    'criteria_action'         => $data['action'],
                    'criteria_target'         => $data['target'],
                    'coin_reward'             => $data['coin'],
                    'reward_xp'               => $data['xp'],
                    'reset_schedule'          => $data['reset'],
                    'level'                   => null,
                    'required_achievement_id' => null,
                    'display_order'           => $displayOrder++,
                    'status'                  => true,
                    'additional_info'         => $data['additional_info'] ?? null,
                ]
            );
        }
    }

    /**
     * Seed Rewards
     */
    private function seedRewards(): void
    {
        $sk = $this->defaultSyaratKetentuan();

        $rewards = [
            [
                'name'             => 'Kupon Diskon 5% di Popina',
                'description'      => 'Tukar Koinmu dan nikmati potongan harga 5% untuk 1 menu di Popina.',
                'coin_requirement' => 150,
                'stock'            => 1,
                'additional_info'  => [
                    'deskripsi'        => 'BELI 1 MENU DI POPINA, DAPAT POTONGAN 5%',
                    'cara_pakai'       => [
                        'Tukar kupon ini dengan 150 Koin di halaman Reward.',
                        'Datang ke Popina dan pesan menu pilihanmu.',
                        'Ketuk "Pakai" saat proses pembayaran.',
                        'Tunjukkan kode kupon yang muncul kepada kasir.',
                    ],
                    'syarat_ketentuan' => $sk,
                ],
            ],
            [
                'name'             => 'Kupon Beli 1 Gratis 1 di Rumangsa Kopi',
                'description'      => 'Tukar Koinmu dan dapatkan promo beli 1 gratis 1 minuman di Rumangsa Kopi.',
                'coin_requirement' => 300,
                'stock'            => 5,
                'additional_info'  => [
                    'deskripsi'        => 'BELI 1 MINUMAN DI RUMANGSA KOPI, GRATIS 1 LAGI',
                    'cara_pakai'       => [
                        'Tukar kupon ini dengan 300 Koin di halaman Reward.',
                        'Datang ke Rumangsa Kopi dan pesan 1 minuman.',
                        'Ketuk "Pakai" saat proses pembayaran.',
                        'Tunjukkan kode kupon yang muncul kepada kasir untuk mendapatkan 1 minuman gratis.',
                    ],
                    'syarat_ketentuan' => $sk,
                ],
            ],
            [
                'name'             => 'Kupon Diskon 5% di Ningrat Eatery',
                'description'      => 'Tukar Koinmu dan hemat 5% untuk makan kenyang di Ningrat Eatery.',
                'coin_requirement' => 750,
                'stock'            => 10,
                'additional_info'  => [
                    'deskripsi'        => 'MAKAN DI NINGRAT EATERY, DAPAT POTONGAN 5%',
                    'cara_pakai'       => [
                        'Tukar kupon ini dengan 750 Koin di halaman Reward.',
                        'Datang ke Ningrat Eatery dan pesan makananmu.',
                        'Ketuk "Pakai" saat proses pembayaran.',
                        'Tunjukkan kode kupon yang muncul kepada kasir.',
                    ],
                    'syarat_ketentuan' => $sk,
                ],
            ],
            [
                'name'             => 'Kupon Diskon 5% di Sagarmatha',
                'description'      => 'Tukar Koinmu dan raih potongan harga 5% untuk jajan di Sagarmatha.',
                'coin_requirement' => 1500,
                'stock'            => 10,
                'additional_info'  => [
                    'deskripsi'        => 'JAJAN DI SAGARMATHA, DAPAT POTONGAN 5%',
                    'cara_pakai'       => [
                        'Tukar kupon ini dengan 1.500 Koin di halaman Reward.',
                        'Datang ke Sagarmatha dan pesan menu pilihanmu.',
                        'Ketuk "Pakai" saat proses pembayaran.',
                        'Tunjukkan kode kupon yang muncul kepada kasir.',
                    ],
                    'syarat_ketentuan' => $sk,
                ],
            ],
        ];

        foreach ($rewards as $reward) {
            Reward::updateOrCreate(
                ['name' => $reward['name']],
                [
                    'description'      => $reward['description'],
                    'coin_requirement' => $reward['coin_requirement'],
                    'stock'            => $reward['stock'],
                    'status'           => true,
                    'started_at'       => now(),
                    'ended_at'         => now()->addMonths(6),
                    'additional_info'  => $reward['additional_info'] ?? null,
                ]
            );
        }
    }
}