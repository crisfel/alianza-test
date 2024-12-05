<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static find(int $id)
 * @method static get()
 * @method static where(string $string, string $role)
 * @property mixed $name
 * @property mixed|string $lastName
 * @property mixed|string $phone
 * @property mixed|string $identification
 * @property mixed|string $address
 * @property mixed|string $last_Name
 * @property mixed|string $city
 * @property mixed|string $department
 * @property mixed|string $email
 * @property mixed|string $password
 * @property mixed|string $role
 * @property mixed|string $last_name
 * @property bool|int|mixed|null $boss_id
 */
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

    public function boss()
    {
        return $this->belongsTo(User::class, 'boss_id');
    }

    public function userPositions()
    {
        return $this->hasMany(UserPosition::class);
    }
}
