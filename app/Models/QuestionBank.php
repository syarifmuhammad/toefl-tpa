<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;

    protected $table = 'question_banks';

    protected $fillable = [
        'name',
        'category',
        'title',
        'content',
        'group_questions'
    ]; 
}