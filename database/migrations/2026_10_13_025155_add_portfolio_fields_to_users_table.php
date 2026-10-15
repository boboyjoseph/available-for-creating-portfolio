<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->boolean('is_super_admin')->default(false)->after('password');
            $table->enum('plan', ['free', 'pro'])->default('free')->after('is_super_admin');
            $table->boolean('is_active')->default(true)->after('plan');
            $table->string('theme')->default('modern')->after('is_active');
            $table->text('bio')->nullable()->after('theme');
            $table->string('avatar')->nullable()->after('bio');
            $table->json('social_links')->nullable()->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 'is_super_admin', 'plan', 'is_active',
                'theme', 'bio', 'avatar', 'social_links',
            ]);
        });
    }
};