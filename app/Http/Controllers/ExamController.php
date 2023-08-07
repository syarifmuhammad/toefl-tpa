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
    public function show($id)
    {
        $attempt_schedule = AttemptSchedule::where('user_id', Auth::id())->where('schedule_id', $id)->first();
        if ($attempt_schedule) {
            return to_route('jadwal.history.detail', $attempt_schedule->id);
        }
        $schedule = Schedule::with('questionbank')->find($id);
        return Inertia::render('Jadwal/Detail', [
            'schedule' => $schedule,
        ]);
    }

    public function history(Request $request): Response
    {
        $histories = AttemptSchedule::with('schedule')->where('user_id', Auth::id())->paginate();
        return Inertia::render('Jadwal/History', [
            'histories' => AttemptScheduleResource::collection($histories)
        ]);
    }

    public function detail_history(Request $request, $id): Response
    {
        $history = AttemptSchedule::with('schedule')->find($id);
        $user = Auth::user();
        return Inertia::render('Jadwal/DetailHistory', [
            'history' => new AttemptScheduleResource($history),
            'user' => $user,
        ]);
    }

    public function payment(Request $request, $id): Response
    {
        $schedule = Schedule::with('questionbank')->find($id);
        return Inertia::render('Jadwal/FormPembayaran', [
            'schedule' => $schedule,
        ]);
    }

    public function daftar(DaftarJadwalUjianRequest $request, $id)
    {
        $schedule = Schedule::withCount(['attempt_schedules' => function (EloquentBuilder $q) {
            $q->where('status', 1);
        }])->where('id', $id);
        if (!$schedule->exists()) {
            abort(404);
        }
        $attempt_schedule = new AttemptSchedule();
        $attempt_schedule->user_id = Auth::id();
        $attempt_schedule->schedule_id = $id;
        $attempt_schedule->payment_type = $request->payment_type;
        $attempt_schedule->status = 0;
        $attempt_schedule->save();
        return redirect()->route('jadwal.history.detail', $attempt_schedule->id);
    }
}
