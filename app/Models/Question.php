<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    
    protected $fillable = [
        'group_question_id',
        'question',
    ];

    public function choices() {
        return $this->hasMany(Choice::class, 'question_id', 'id');
    }
}
