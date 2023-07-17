<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_bank_id',
        'category',
        'contents',
    ];
}
