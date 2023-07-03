<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response {
        // $schedule = Schedule::all(); //::paginate(10);

        return Inertia::render('Dashboard', [
            'schedule' => Schedule::paginate(15)
        ]);
    }

}
