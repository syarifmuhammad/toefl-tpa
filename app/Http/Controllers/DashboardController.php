<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->has('category') && $request->category == 'tpa') {
            $schedule = Schedule::join('question_banks', 'schedules.questionbank_id', '=', 'question_banks.id')->select("schedules.*", "questionbanks.category as category")->where('category', 'tpa')->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc');
        } else {
            $schedule = Schedule::join('question_banks', 'schedules.questionbank_id', '=', 'question_banks.id')->select("schedules.*", "questionbanks.category as category")->where('category', 'toefl')->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc');
        }
        
        $category = $request->has('category') ? $request->category : 'toefl';

        if ($user["is_admin"]) {
            return redirect('admin');
        } else {
            return Inertia::render('Dashboard', [
                'schedule' => $schedule->paginate(),
                'category' => $category,
            ]);
        }
    }
}
