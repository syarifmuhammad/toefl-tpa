<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptSchedule extends Model
{
    use HasFactory;

    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bukti_pembayaran() {
        return $this->hasOne(BuktiPembayaranPendaftaran::class, 'id', 'id');
    }
}
