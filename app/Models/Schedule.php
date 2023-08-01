<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'category', // cth. toefl/tpa
        // 'question_bank',
        'tanggal', // cth. 10 jun
        'kuota', // cth. 40
        'terisi', // cth. 20
        'status', // ready not ready
        // 'cost' 
    ];

    // protected $casts = [
    //     'waktu' => 'datetime:H:i',
    // ];

    public function questionbank()
    {
        return $this->belongsTo(QuestionBank::class, 'questionbank_id', 'id');
    }

    public function attempt_schedules()
    {
        return $this->hasMany(AttemptSchedule::class, 'schedule_id', 'id');
    }
}
