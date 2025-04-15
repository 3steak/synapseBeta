<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajout colonnes pour login magique.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login_token', 100)->nullable()->after('remember_token')
                ->comment('Token unique utilisé pour le login magique par email');
            $table->timestamp('login_token_expiry')->nullable()->after('login_token')
                ->comment('Expiration du token de login magique');
        });
    }

    /**
     * Supprime colonnes login magin si rollback
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['login_token', 'login_token_expiry']);
        });
    }
};
