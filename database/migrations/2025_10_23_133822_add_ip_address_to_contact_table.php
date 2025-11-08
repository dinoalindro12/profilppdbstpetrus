<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->string('ip_address')->nullable()->after('message');
            $table->text('user_agent')->nullable()->after('ip_address');
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent', 'deleted_at']);
        });
    }
};