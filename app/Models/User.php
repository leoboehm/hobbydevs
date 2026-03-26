<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'type',
        'firstname',
        'lastname',
        'email',
        'password',
        'skills',
        'experience',
        'bio',
        'rating',
        'interests'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'skills' => '',
        'experience' => '',
        'bio' => '',
        'rating' => 0,
        'interests' => ''
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'skills' => 'array',
    ];

    public static function emailExists(string $email): bool
    {
        return self::where('email', $email)->exists();
    }

    public function updateProfile(array $data): bool
    {
        return $this->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'skills' => $data['skills'] ?? [],
            'experience' => $data['experience'] ?? '',
            'bio' => $data['bio'] ?? '',
            'rating' => $data['rating'] ?? $this->rating,
            'interests' => $data['interests'] ?? ''
        ]);
    }
}
