<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_auth_id')->nullable();
            $table->string('google_auth_token')->nullable();
            $table->string('google_auth_refresh_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_auth_id');
            $table->dropColumn('google_auth_token');
            $table->dropColumn('google_auth_refresh_token');
        });
    }
};
