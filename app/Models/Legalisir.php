<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legalisir extends Model
{
    use HasFactory;

    protected $table = 'legalisirs';

    protected $fillable = [
        'user',
        'certificate',
        'payment',
        'status'
    ];
}
