<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'skills',
        'availability',
        'past_experience',
        'motivation',
        'contact_info',
        'user_id',
        'project_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'skills' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function createApplication(array $data): self
    {
        return self::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'skills' => $data['skills'],
            'availability' => $data['availability'],
            'past_experience' => $data['pastExperience'],
            'motivation' => $data['motivation'],
            'contact_info' => $data['contactInfo'],
            'user_id' => $data['user_id'],
            'project_id' => $data['project_id'],
        ]);
    }

    public static function findByUserId(string $userId)
    {
        return self::where('user_id', $userId)->get();
    }

    public static function findByOwnerId(string $userId)
    {
        return self::with('project')->whereHas('project', function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        })->get();
    }
}
