<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use HasRoles;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'login_token_expiry' => 'datetime',
    ];

    /**
     * Génère un token magique pour la connexion.
     *
     * @return string
     */
    public function generateLoginToken(): string
    {
        $token = Str::random(64);
        $this->login_token = $token;
        $this->login_token_expiry = Carbon::now()->addMinutes(15);
        $this->save();

        return $token;
    }

    /**
     * Vérifie si un token est valide (valeur + date d’expiration).
     *
     * @param string $token
     * @return bool
     */
    public function isValidLoginToken(string $token): bool
    {
        return $this->login_token === $token &&
            $this->login_token_expiry &&
            now()->lessThan($this->login_token_expiry);
    }
}
