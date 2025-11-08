<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Pastikan ini ada

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'Pengumuman',
                'slug' => Str::slug('Pengumuman'), // TAMBAHKAN INI
                'description' => 'Pengumuman resmi dari sekolah',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Kegiatan Sekolah',
                'slug' => Str::slug('Kegiatan Sekolah'), // TAMBAHKAN INI
                'description' => 'Berbagai kegiatan yang dilakukan di sekolah',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Prestasi',
                'slug' => Str::slug('Prestasi'), // TAMBAHKAN INI
                'description' => 'Prestasi yang diraih oleh siswa dan guru',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Tips Pendidikan',
                'slug' => Str::slug('Tips Pendidikan'), // TAMBAHKAN INI
                'description' => 'Tips dan informasi seputar pendidikan',
                'order' => 4,
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            // Gunakan firstOrCreate agar seeder aman dijalankan berulang kali
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        // Get admin user
        $user = User::first();
        if (!$user) {
            // Jika tidak ada user sama sekali, hentikan seeder post
            // atau buat user dummy di sini jika perlu
            $this->command->warn('Tidak ada user di database. Post tidak dibuat.');
            return;
        }


        // Create sample posts
        $posts = [
            // ... data post Anda (tidak perlu diubah) ...
        ];

        foreach ($posts as $post) {
            // Tambahkan slug juga untuk post
            $post['slug'] = Str::slug($post['title']);
            Post::firstOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
