<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;

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
    return Inertia::render('Admin/Dashboard');
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

  public function bankSoal()
  {
    return Inertia::render('Admin/BankSoal/Index');
  }

  public function bankSoalAdd(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'type' => 'required',
    ]);

    QuestionBank::create([
      'name' => $request->name,
      'type' => $request->type,
    ]);
  }

  public function bankSoalDetail($id)
  {
    return Inertia::render('Admin/BankSoal/Detail');
  }

  public function GroupQuestionAdd(Request$request){
    
  }
}
