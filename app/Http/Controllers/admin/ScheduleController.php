<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ScheduleRequest;
use App\Models\QuestionBank;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('questionbank')->paginate(100);
        $questionbanks = QuestionBank::all();
        return Inertia::render('Admin/Jadwal/Index', [
            'schedules' => $schedules,
            'questionbanks' => $questionbanks,
        ]);
    }

    public function show($id)
    {
        
        return Inertia::render('Admin/Jadwal/Detail');
    }

    public function store(ScheduleRequest $request)
    {
        $schedule = new Schedule;
        $schedule->questionbank_id = $request->questionbank_id;
        $schedule->tanggal = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));
        $schedule->kuota = $request->kuota;
        $schedule->biaya = 200000;
        $schedule->status = 0;
        $schedule->save();

        return to_route('admin.jadwal_tes.index');
    }

    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->questionbank_id = $request->questionbank_id;
        $schedule->tanggal = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));
        $schedule->kuota = $request->kuota;
        $schedule->save();

        return to_route('admin.jadwal_tes.index');
    }

    public function destroy($id)
    {
        Schedule::find($id)->delete();
        return to_route('admin.jadwal_tes.index');
    }
}
