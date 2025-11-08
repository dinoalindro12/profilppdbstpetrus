<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            [
                'key' => 'contact_rate_limit',
                'value' => '5',
                'description' => 'Jumlah maksimal pesan kontak per jam per IP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_rate_limit_hours',
                'value' => '1',
                'description' => 'Jangka waktu rate limit (dalam jam)',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};