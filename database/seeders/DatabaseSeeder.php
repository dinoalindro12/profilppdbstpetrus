<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.dev',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'phone' => '081234567890',
        ]);
        $this->call([
            ProfileSeeder::class,
            AcademicSeeder::class,
            PpdbSeeder::class,
            NewsSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}