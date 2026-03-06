<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan transaksi database agar data konsisten (terutama untuk Foreign Key Prerequisite)
        DB::transaction(function () {
            // Hapus data lama jika diperlukan (opsional, hati-hati di production)
            // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            // Achievement::truncate();
            // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->seedAchievements(); // 6 Core Actions x 3 Levels
            $this->seedChallenges();   // 9 Challenges (None, Daily, Weekly)
            $this->seedRewards();      // 3 Dummy Rewards
        });
    }

    /**
     * Seed Achievements (One-time, Leveling System)
     */
    private function seedAchievements()
    {
        // Konfigurasi berdasarkan Tabel Desain Achievement V3.3
        $series = [
            // 1. CHECK-IN SERIES
            'checkin' => [
                ['name' => 'Langkah Awal', 'target' => 1, 'coin' => 50, 'xp' => 20, 'desc' => 'Check-in pertama kali.'],
                ['name' => 'Penjelajah Kota', 'target' => 20, 'coin' => 150, 'xp' => 100, 'desc' => 'Eksplorasi menengah.'],
                ['name' => 'Legenda Peta', 'target' => 100, 'coin' => 500, 'xp' => 300, 'desc' => 'Eksplorasi expert.'],
            ],
            // 2. REVIEW SERIES
            'review' => [
                ['name' => 'Komentator', 'target' => 1, 'coin' => 50, 'xp' => 25, 'desc' => 'Review pertama.'],
                ['name' => 'Kritikus Tajam', 'target' => 10, 'coin' => 200, 'xp' => 100, 'desc' => 'Konsisten mereview.'],
                ['name' => 'Lidah Emas', 'target' => 50, 'coin' => 600, 'xp' => 400, 'desc' => 'Opinion leader.'],
            ],
            // 3. POST SERIES
            'post' => [
                ['name' => 'Iseng Posting', 'target' => 1, 'coin' => 50, 'xp' => 20, 'desc' => 'Postingan pertama.'],
                ['name' => 'Jurnalis Makanan', 'target' => 10, 'coin' => 200, 'xp' => 100, 'desc' => 'Sharing aktif.'],
                ['name' => 'Kurator Hidden Gem', 'target' => 50, 'coin' => 500, 'xp' => 300, 'desc' => 'Influencer konten.'],
            ],
            // 4. COIN EARNED SERIES
            'coin_earned' => [
                ['name' => 'Tabungan Awal', 'target' => 1000, 'coin' => 100, 'xp' => 50, 'desc' => 'Akumulasi koin awal.'],
                ['name' => 'Juragan Kecil', 'target' => 5000, 'coin' => 500, 'xp' => 250, 'desc' => 'Akumulasi menengah.'],
                ['name' => 'Sultan Snappie', 'target' => 20000, 'coin' => 2000, 'xp' => 1000, 'desc' => 'Wealthy user.'],
            ],
            // 5. XP EARNED SERIES (Reward XP = 0 untuk mencegah loop)
            'xp_earned' => [
                ['name' => 'Pendatang Baru', 'target' => 500, 'coin' => 100, 'xp' => 0, 'desc' => 'Level up awal.'],
                ['name' => 'Warga Tetap', 'target' => 2500, 'coin' => 300, 'xp' => 0, 'desc' => 'Level up lanjut.'],
                ['name' => 'Sesepuh Kota', 'target' => 10000, 'coin' => 1000, 'xp' => 0, 'desc' => 'Top level user.'],
            ],
            // 6. TOP RANK SERIES (Menggunakan Target sebagai threshold rank)
            'top_rank' => [
                ['name' => 'Bintang Lokal', 'target' => 10, 'coin' => 200, 'xp' => 100, 'desc' => 'Masuk Top 10 Leaderboard.', 'filter' => ['max_rank' => 10]],
                ['name' => 'Selebriti Kota', 'target' => 5, 'coin' => 1000, 'xp' => 500, 'desc' => 'Masuk Top 5 Leaderboard.', 'filter' => ['max_rank' => 5]],
                ['name' => 'Penguasa Kuliner', 'target' => 1, 'coin' => 5000, 'xp' => 2500, 'desc' => 'Raih Peringkat 1 Leaderboard.', 'filter' => ['max_rank' => 1]],
            ],
        ];

        $displayOrder = 1;

        foreach ($series as $action => $levels) {
            $previousAchievementId = null; // Reset parent ID untuk setiap series baru

            foreach ($levels as $index => $data) {
                $level = $index + 1;
                // $code = "ach_{$action}_{$level}";

                // Membuat Achievement Record
                $achievement = Achievement::updateOrCreate(
                    // ['code' => $code], // Kunci unik
                    [
                        'name' => $data['name'],
                        'code' => "ach_$action",
                        'type' => 'achievement', // Konstanta TYPE_ACHIEVEMENT
                        'description' => $data['desc'],
                        'criteria_action' => $action,
                        'criteria_target' => $data['target'],
                        'criteria_filters' => $data['filter'] ?? null, // Filter opsional (untuk rank)
                        'coin_reward' => $data['coin'],
                        'reward_xp' => $data['xp'],
                        'reset_schedule' => 'none', // Konstanta RESET_NONE
                        'level' => $level,
                        'required_achievement_id' => $previousAchievementId, // Link ke level sebelumnya
                        'display_order' => $displayOrder++,
                        'status' => true,
                    ]
                );

                // Set ID saat ini sebagai parent untuk iterasi level berikutnya
                $previousAchievementId = $achievement->id;
            }
        }
    }

    /**
     * Seed Challenges (Recurring, Reset Schedule)
     */
    private function seedChallenges()
    {
        // Konfigurasi berdasarkan Tabel Desain Challenge V3.3
        $challenges = [
            // 1. Tipe RESET: NONE (Special Missions)
            [
                'code' => 'special_coin_earned',
                'name' => 'Mencari Teman',
                'action' => 'follow',
                'target' => 5,
                'coin' => 100,
                'xp' => 50,
                'reset' => 'none',
                'desc' => 'Ikuti (follow) 5 user lain.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka profil user yang ingin diikuti',
                        'Klik tombol "Follow" pada profil user',
                        'Ulangi untuk 5 user berbeda',
                        'Challenge akan selesai setelah mencapai target',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
            [
                'code' => 'special_exp_earned',
                'name' => 'Suara Netizen',
                'action' => 'comment',
                'target' => 10,
                'coin' => 150,
                'xp' => 75,
                'reset' => 'none',
                'desc' => 'Berikan 10 komentar total.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka feed atau detail postingan',
                        'Klik "Berikan Komentar"',
                        'Tulis komentar Anda',
                        'Kirim komentar',
                        'Ulangi untuk mencapai 10 komentar total',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
            [
                'code' => 'special_follow',
                'name' => 'Raja Leaderboard',
                'action' => 'rank',
                'target' => 1,
                'coin' => 500,
                'xp' => 250,
                'reset' => 'none',
                'desc' => 'Raih peringkat 1 di leaderboard.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Tingkatkan aktivitas Anda di aplikasi',
                        'Kumpulkan poin melalui check-in, review, dan posting',
                        'Pantau posisi Anda di leaderboard',
                        'Raih peringkat 1',
                        'Klaim reward secara manual'
                    ]
                ]
            ],

            // 2. Tipe RESET: DAILY (Harian)
            [
                'code' => 'chal_daily_like',
                'name' => 'Absen Dulu',
                'action' => 'checkin',
                'target' => 1,
                'coin' => 20,
                'xp' => 10,
                'reset' => 'daily',
                'desc' => 'Check-in 1x hari ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka fitur "Check-in"',
                        'Pilih tempat yang ingin dikunjungi',
                        'Klik tombol "Check-in"',
                        'Konfirmasi check-in Anda',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
            [
                'code' => 'chal_daily_comment',
                'name' => 'Receh Harian',
                'action' => 'comment',
                'target' => 10,
                'coin' => 10,
                'xp' => 25,
                'reset' => 'daily',
                'desc' => 'Berikan 10 komentar hari ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka feed atau detail postingan',
                        'Klik "Berikan Komentar"',
                        'Tulis komentar Anda',
                        'Kirim komentar',
                        'Ulangi untuk mencapai 10 komentar hari ini',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
            [
                'code' => 'chal_daily_post',
                'name' => 'Story Hari Ini',
                'action' => 'post',
                'target' => 1,
                'coin' => 30,
                'xp' => 15,
                'reset' => 'daily',
                'desc' => 'Buat 1 postingan hari ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka fitur "Buat Postingan"',
                        'Pilih foto atau tulis cerita Anda',
                        'Tambahkan deskripsi yang menarik',
                        'Bagikan postingan Anda',
                        'Klaim reward secara manual'
                    ]
                ]
            ],

            // 3. Tipe RESET: WEEKLY (Mingguan)
            [
                'code' => 'chal_weekly_checkin',
                'name' => 'Jurnal Mingguan',
                'action' => 'checkin',
                'target' => 3,
                'coin' => 250,
                'xp' => 125,
                'reset' => 'weekly',
                'desc' => 'Check-in 3x minggu ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Buka fitur "Check-in"',
                        'Kunjungi 3 tempat berbeda minggu ini',
                        'Check-in di setiap tempat',
                        'Pantau progress challenge Anda',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
            [
                'code' => 'chal_weekly_review',
                'name' => 'Mengejar Level',
                'action' => 'review',
                'target' => 3,
                'coin' => 150,
                'xp' => 75,
                'reset' => 'weekly',
                'desc' => 'Tulis 3 ulasan minggu ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Kunjungi tempat kuliner yang ingin direview',
                        'Klik "Berikan Ulasan" pada bagian ulasan',
                        'Berikan rating penilaian sesuai pengalaman Anda',
                        'Tulis deskripsi ulasan',
                        'Ulangi untuk mencapai 3 ulasan minggu ini',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
            [
                'code' => 'chal_weekly_post',
                'name' => 'Petualang Minggu Ini',
                'action' => 'post',
                'target' => 5,
                'coin' => 300,
                'xp' => 150,
                'reset' => 'weekly',
                'desc' => 'Buat 5 postingan minggu ini.',
                'additional_info' => [
                    'cara_kerja' => [
                        'Bagikan cerita tentang pengalaman Anda',
                        'Tambahkan foto dan deskripsi menarik',
                        'Sebarkan cerita Anda ke komunitas',
                        'Ulangi untuk mencapai 5 postingan minggu ini',
                        'Pantau progress challenge Anda',
                        'Klaim reward secara manual'
                    ]
                ]
            ],
        ];

        $displayOrder = 50; // Mulai urutan setelah achievements

        foreach ($challenges as $data) {
            Achievement::updateOrCreate(
                ['code' => $data['code']],
                [
                    'name' => $data['name'],
                    'type' => 'challenge', // Konstanta TYPE_CHALLENGE
                    'description' => $data['desc'],
                    'criteria_action' => $data['action'],
                    'criteria_target' => $data['target'],
                    'coin_reward' => $data['coin'],
                    'reward_xp' => $data['xp'],
                    'reset_schedule' => $data['reset'],
                    'level' => null,
                    'required_achievement_id' => null,
                    'display_order' => $displayOrder++,
                    'status' => true,
                    'additional_info' => $data['additional_info'] ?? null,
                ]
            );
        }
    }

    /**
     * Seed Rewards
     */
    private function seedRewards()
    {
        $rewards = [
            [
                'name' => 'Kupon Untuk Jajan Potongan Harga 5%',
                'description' => 'Jajan di Popina dengan potongan harga 5% menu rahasia!',
                'coin_requirement' => 150,
                'stock' => 1,
                'additional_info' => [
                    'deskripsi' => 'BELI 1 MENU DI POPINA DAPAT POTONGAN 5%',
                    'cara_pakai' => ['Tukar kupon dengan 150 Koin.',
                        'Beli 1 menu di Popina, dan tekan “Pakai” saat akan melakukan pembayaran.',
                        'Berikan kode kupon yang muncul saat pembayaran.'],
                    'syarat_ketentuan' => ['Periode penukaran s.d 31 Agustus 2025.',
                        'Kupon berlaku selama 3 hari setelah penukaran dengan koin.',
                        'Kode kupon yang muncul setelah tekan “Pakai” hanya berlaku selama 1 jam.',
                        'Kode kupon hanya dapat digunakan 1 kali saat pembayaran.']
                ]
            ],
            [
                'name' => 'Kupon Untuk Sruput Beli 1 Gratis 1',
                'description' => 'Pesan kopi di Rumangsa Kopi dan dapatkan promonya!',
                'coin_requirement' => 300,
                'stock' => 5,
                'additional_info' => [
                    'deskripsi' => 'BELI 1 GRATIS 1 MINUMAN DI RUMANGSA KOPI',
                    'cara_pakai' => [
                        'Tukar kupon dengan 300 Koin.',
                        'Beli 1 minuman di Rumangsa Kopi, dan tekan “Pakai” saat akan melakukan pembayaran.',
                        'Berikan kode kupon yang muncul saat pembayaran.'
                    ],
                    'syarat_ketentuan' => [
                        'Periode penukaran s.d 31 Agustus 2025.',
                        'Kupon berlaku selama 3 hari setelah penukaran dengan koin.',
                        'Kode kupon yang muncul setelah tekan “Pakai” hanya berlaku selama 1 jam.',
                        'Kode kupon hanya dapat digunakan 1 kali saat pembayaran.'
                    ]
                ]
            ],
            [
                'name' => 'Kupon Makanan Kenyang Potongan Harga 5%',
                'description' => 'Makan kenyang di Ningrat Eatery dan dapatkan potongan harganya!',
                'coin_requirement' => 750,
                'stock' => 10,
                'additional_info' => [
                    'deskripsi' => 'MAKAN DI NINGRAT EATERY DAPAT POTONGAN 5%',
                    'cara_pakai' => [
                        'Tukar kupon dengan 750 Koin.',
                        'Makan di Ningrat Eatery, dan tekan “Pakai” saat akan melakukan pembayaran.',
                        'Berikan kode kupon yang muncul saat pembayaran.'
                    ],
                    'syarat_ketentuan' => [
                        'Periode penukaran s.d 31 Agustus 2025.',
                        'Kupon berlaku selama 3 hari setelah penukaran dengan koin.',
                        'Kode kupon yang muncul setelah tekan “Pakai” hanya berlaku selama 1 jam.',
                        'Kode kupon hanya dapat digunakan 1 kali saat pembayaran.'
                    ]
                ]
            ],
            [
                'name' => 'Kupon untuk Jajan Potongan Harga 5%',
                'description' => 'Jajan di Sagarmatha dengan potongan harga 5% menu rahasia!',
                'coin_requirement' => 1500,
                'stock' => 0,
                'additional_info' => [
                    'deskripsi' => 'JAJAN DI SAGARMATHA DAPAT POTONGAN 5%',
                    'cara_pakai' => [
                        'Tukar kupon dengan 1500 Koin.',
                        'Jajan di Sagarmatha, dan tekan “Pakai” saat akan melakukan pembayaran.',
                        'Berikan kode kupon yang muncul saat pembayaran.'
                    ],
                    'syarat_ketentuan' => [
                        'Periode penukaran s.d 31 Agustus 2025.',
                        'Kupon berlaku selama 3 hari setelah penukaran dengan koin.',
                        'Kode kupon yang muncul setelah tekan “Pakai” hanya berlaku selama 1 jam.',
                        'Kode kupon hanya dapat digunakan 1 kali saat pembayaran.'
                    ]
                ]
            ]
        ];

        foreach ($rewards as $reward) {
            \App\Models\Reward::updateOrCreate(
                ['name' => $reward['name']],
                [
                    'description' => $reward['description'],
                    'coin_requirement' => $reward['coin_requirement'],
                    'stock' => $reward['stock'],
                    'status' => true,
                    'started_at' => now(),
                    'ended_at' => now()->addMonths(6),
                    'additional_info' => $reward['additional_info'] ?? null,
                ]
            );
        }
    }
}