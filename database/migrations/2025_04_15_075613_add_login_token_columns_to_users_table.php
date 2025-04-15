<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprime cette ligne si elle est là :
            // $table->string('login_token')->nullable()->after('remember_token');

            // Garde uniquement celle-ci :
            $table->timestamp('login_token_expires_at')->nullable()->after('login_token');
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['login_token', 'login_token_expires_at']);
        });
    }
};
