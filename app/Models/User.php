<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'is_super_admin',
        'plan',
        'is_active',
        'theme',
        'bio',
        'avatar',
        'social_links',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
            'is_active' => 'boolean',
            'social_links' => 'array',
        ];
    }

    // Relationships (gagamitin natin later)
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function canAccessAdminPanel(\Filament\AdminPanel $adminpanel): bool
    {
        if ($adminpanel->getId() === 'admin')
            {
                return $this->is_super_admin === true;
            }
            return $this->is_active === true;
    }
}