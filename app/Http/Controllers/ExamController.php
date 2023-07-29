<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaftarJadwalUjianRequest;
use App\Http\Resources\AttemptScheduleResource;
use App\Models\AttemptSchedule;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ExamController extends Controller
{
    public function show($id): Response {
        $schedule = Schedule::with('questionbank')->find($id);
        return Inertia::render('Jadwal/Detail', [
            'schedule'=> $schedule,
        ]);
    }

    public function history(Request $request): Response {
        return Inertia::render('Jadwal/History');
    }

    public function detail_history(Request $request, $id): Response {
        $history = AttemptSchedule::find($id);
        return Inertia::render('Jadwal/DetailHistory', [
            'history' => new AttemptScheduleResource($history)
        ]);
    }

    public function payment(Request $request, $id): Response {
        $schedule = Schedule::with('questionbank')->find($id);
        return Inertia::render('Jadwal/FormPembayaran', [
            'schedule'=> $schedule,
        ]);
    }

    public function daftar(DaftarJadwalUjianRequest $request, $id) {
        $attempt_schedule = new AttemptSchedule();
        $attempt_schedule->user_id = Auth::id();
        $attempt_schedule->schedule_id = $id;
        $attempt_schedule->payment_type = $request->payment_type;
        $attempt_schedule->status = 0;
        $attempt_schedule->save();
        return redirect()->route('jadwal.history.detail', $attempt_schedule->id);
    }
    
}
