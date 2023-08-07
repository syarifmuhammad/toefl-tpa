<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptTest extends Model
{
    use HasFactory;

    protected $table = 'attempt_tests';
    
    protected $fillable = [
        'user_id',
        'schedule_id',
        'answer',
        'score'
    ];

    protected $cast= [
        'answer'=>'array'
    ];

}
