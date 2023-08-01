<?php

namespace App\Http\Controllers;

use App\Models\AttemptSchedule;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Redirect;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        
        $my_schedule = AttemptSchedule::join('schedules', 'attempt_schedules.schedule_id', '=', 'schedules.id')->join('question_banks', 'schedules.questionbank_id', '=', 'question_banks.id')->select('attempt_schedules.id as attempt_schedule_id', 'schedules.*', 'question_banks.category')->where('user_id', Auth::id())->orderBy('schedules.tanggal', 'desc')->first();
        
        $category = $request->has('category') ? $request->category : 'toefl';

        $schedules = Schedule::withCount(['attempt_schedules' => function (EloquentBuilder $q) {
            $q->where('status', 1);
        }])->whereHas('questionbank', function (EloquentBuilder $q) use ($category) {
            $q->where('category', $category);
        })->whereDate('tanggal', '>=', Carbon::today()->toDateString());

        if ($user["is_admin"]) {
            return redirect('admin');
        } else {
            return Inertia::render('Dashboard', [
                'my_schedule' => $my_schedule,
                'schedules' => $schedules->orderBy('tanggal', 'desc')->paginate(),
                'category' => $category,
            ]);
        }
    }
}
