<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_active',
        'password',
        'role',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if ($user->hasRole('customer')) {
                $user->role = 'customer';

                
            } elseif ($user->hasRole('admin')) {
                $user->role = 'admin';
            }
        });
    }

            // Accessor for status
            public function getStatusAttribute()
            {
                return $this->is_active ? 'Active' : 'Inactive';
            }

            // Mark user as inactive when they log out
            public function markAsInactive()
            {
                $this->update(['is_active' => false]);
            }

            // Mark user as active when they log in
            public function markAsActive()
            {
                $this->update(['is_active' => true]);
            }




    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    
    // Move scopeSearch() outside of casts()
    public function scopeSearch($query, $value) {
        return $query->where('name', 'like', "%{$value}%")
                     ->orWhere('email', 'like', "%{$value}%");
    }
    



    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }


    // role 
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
