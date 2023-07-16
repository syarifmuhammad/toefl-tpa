<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;

class AdminController extends Controller
{
  private $is_admin;

  public function __construct(Request $request, Redirector $redirect)
  {
    $this->middleware(function ($request, $next){
      $this->is_admin =  Auth::user()['is_admin'];
      Log::debug($this->is_admin);
      return $next($request);
    });
    
    if ($this->is_admin === 0) {
      Log::debug('is_admin: '.$this->is_admin);
      $redirect->to('/')->send();
    }
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

  public function store_soal(Request $request)
  {
    dd($request->all());
  }
}
