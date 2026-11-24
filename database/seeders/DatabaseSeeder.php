<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure Admin user
        User::firstOrCreate(
            ['email' => 'admin@perpusku.id'],
            [
                'name' => 'Administrator PerpusKu',
                'password' => Hash::make('adminperpus123'),
                'role' => 'admin',
            ]
        );

        // Seed initial library books if empty
        if (Book::count() === 0) {
            $books = [
                [
                    'title' => 'Bumi Manusia',
                    'author' => 'Pramoedya Ananta Toer',
                    'code' => 'NV-001',
                    'category' => 'Fiksi',
                    'stock' => 5,
                    'cover' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=600&auto=format&fit=crop&q=80',
                    'description' => 'Kisah epik perjuangan Minke di era kolonial Hindia Belanda dengan latar sosial dan kemanusiaan yang kuat.',
                ],
                [
                    'title' => 'Laskar Pelangi',
                    'author' => 'Andrea Hirata',
                    'code' => 'NV-002',
                    'category' => 'Fiksi',
                    'stock' => 8,
                    'cover' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=600&auto=format&fit=crop&q=80',
                    'description' => 'Inspirasi perjuangan sepuluh anak di Belitung dalam meraih mimpi dan pendidikan di tengah keterbatasan.',
                ],
                [
                    'title' => 'Filosofi Teras',
                    'author' => 'Henry Manampiring',
                    'code' => 'FL-001',
                    'category' => 'Filsafat',
                    'stock' => 4,
                    'cover' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3edd5?w=600&auto=format&fit=crop&q=80',
                    'description' => 'Penerapan filsafat Stoisisme kuno untuk menghadapi emosi negatif dan menjalani hidup dengan lebih tenang.',
                ],
                [
                    'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                    'author' => 'Yuval Noah Harari',
                    'code' => 'SJ-001',
                    'category' => 'Sejarah',
                    'stock' => 6,
                    'cover' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&auto=format&fit=crop&q=80',
                    'description' => 'Eksplorasi mendalam bagaimana spesies kera tak berdaya berevolusi menguasai bumi melalui revolusi kognitif.',
                ],
                [
                    'title' => 'Atomic Habits',
                    'author' => 'James Clear',
                    'code' => 'SD-001',
                    'category' => 'Pengembangan Diri',
                    'stock' => 7,
                    'cover' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=600&auto=format&fit=crop&q=80',
                    'description' => 'Metode perubahan kecil 1% setiap hari yang menghasilkan dampak luar biasa dalam pembentukan kebiasaan hidup.',
                ],
                [
                    'title' => 'Clean Code: Panduan Agile Software Craftsmanship',
                    'author' => 'Robert C. Martin',
                    'code' => 'TK-001',
                    'category' => 'Teknologi',
                    'stock' => 3,
                    'cover' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&auto=format&fit=crop&q=80',
                    'description' => 'Prinsip, pola, dan praktik menulis kode perangkat lunak yang bersih, mudah dipelihara, dan berstandar industri.',
                ],
            ];

            foreach ($books as $b) {
                Book::create($b);
            }
        }
    }
}
