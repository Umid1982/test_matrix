<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_ref'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function matrixTables()
    {
        return $this->hasMany(MatrixTable::class, 'id_user');
    }

    public function invitedMatrixTables()
    {
        return $this->hasMany(MatrixTable::class, 'user1')
            ->orWhere('user2', $this->id)
            ->orWhere('user3', $this->id);
    }
    public function referrals()
    {
        return $this->hasMany(User::class, 'id_ref');
    }

    public function balances()
    {
        return $this->hasMany(UserBalance::class, 'id_user');
    }
}
