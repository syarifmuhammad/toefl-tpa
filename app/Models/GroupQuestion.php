<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupQuestion extends Model
{
    use HasFactory;

    protected $table = 'group_question';
    protected $fillable = [
        'category',
        'contents',
        'questions'
    ];
}
