<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;

    protected $table = 'QuestionBanks';

    protected $fillable = [
        'name',
        'type',
    ];
}
