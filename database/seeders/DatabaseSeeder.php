<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sekolah.dev'],
            [
                'name'      => 'Administrator',
                'password'  => bcrypt('password'),
                'role'      => 'super_admin',
                'phone'     => '081234567890',
                'is_active' => true,
            ]
        );
        $this->call([
            ProfileSeeder::class,
            AcademicSeeder::class,
            PpdbSeeder::class,
            NewsSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}