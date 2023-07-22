<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use App\Models\Schedule;

class AdminController extends Controller
{

  public function __construct(Request $request, Redirector $redirect)
  {
    $this->middleware(function ($request, $next){
      $is_admin =  Auth::user()['is_admin'];
      if ($is_admin === 0) {
        return redirect('/');
      }
      return $next($request);
    });
  }
  
  public function index()
  {
    $schedule = Schedule::paginate(50);
    
    return Inertia::render('Admin/Dashboard', [
      'schedule' => $schedule
    ]);
  }

  public function monitor($id)
  {
    return Inertia::render('Admin/MonitorUjian');
  }

  public function bank_soal(Request $request)
  { 
    return Inertia::render('Admin/BankSoal/Index');
  }

  public function add_soal()
  {
    
    return Inertia::render('Admin/AddSoal');
  }


  public function bankSoalAdd(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'category' => 'required',
      // 'content' => 'required',
    ]);

    QuestionBank::create([
      'name' => $request->name,
      'category' => $request->category,
    ]);
  }

  public function bankSoalDetail($id)
  {
    return Inertia::render('Admin/BankSoal/Detail');
  }

  public function GroupQuestionAdd(Request$request){
    
  }
}
