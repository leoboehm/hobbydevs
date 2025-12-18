<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'category',
        'skills',
        'salary_range',
        'duration',
        'start_date',
        'deadline',
        'application_start_date',
        'application_deadline'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'deadline' => 'datetime',
        'application_start_date' => 'datetime',
        'application_deadline' => 'datetime',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
