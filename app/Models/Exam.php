<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'classroom_id',
        'creator_id',
        'start_at',
        'ends_at',
        'duration',
        'status',
        'settings'
    ];
}
