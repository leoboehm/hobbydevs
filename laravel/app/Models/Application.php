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
}