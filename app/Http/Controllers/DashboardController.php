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

    public function index(Request $request) {
        // $schedule = Schedule::all(); //::paginate(10);
        $user = Auth::user();
        $profile_picture = $user["profile_picture"];
        if (strpos($profile_picture, "http") !== 0) {
            $profile_picture = "/images/profile_picture/" . $profile_picture;
        }
        $email = $user["email"];
        $phone = $user["phone"];
        
        

        if ($user["is_admin"]) {
            return redirect('admin');
        }
        else {
            return Inertia::render('Dashboard', [
                'schedule' => Schedule::paginate(15),
                'profile_picture' => $profile_picture,
                'email' => $email,
                'phone' => $phone
            ]);
        }
    }

}
