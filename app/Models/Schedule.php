<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $appends = [
        'is_exam_ready',
    ];

    public function questionbank()
    {
        return $this->belongsTo(QuestionBank::class, 'questionbank_id', 'id');
    }

    public function attempt_schedules()
    {
        return $this->hasMany(AttemptSchedule::class, 'schedule_id', 'id');
    }

    private function checkIsExamReady($status, $waktu_mulai, $waktu_berakhir) {
        return $status == 1 && Carbon::parse($waktu_mulai)->lessThan(Carbon::parse($waktu_berakhir));
    }

    protected function IsExamReady(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->checkIsExamReady($this->status, $this->waktu_mulai, $this->waktu_berakhir),
        );
    }
}
