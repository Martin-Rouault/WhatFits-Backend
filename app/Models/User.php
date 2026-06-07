<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function builds(): HasMany
    {
        return $this->hasMany(Build::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email === env('ADMIN_EMAIL') && $this->hasVerifiedEmail();
    }
}
