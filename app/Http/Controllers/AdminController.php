<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
  public function index()
  {
    return Inertia::render('Admin/Dashboard');
  }

  public function monitor($id)
  {
    return Inertia::render('Admin/MonitorUjian');
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
