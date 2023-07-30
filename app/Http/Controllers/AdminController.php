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

  //Bank Soal
  public function bank_soal(Request $request)
  {
    $questionBanks = QuestionBank::paginate(50);

    return Inertia::render('Admin/BankSoal/Index', [
      'questionBanks' => $questionBanks
    ]);
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

  public function bankSoalDelete(Request $request)
  {
    $request->validate([
      'id' => 'required',
    ]);

    QuestionBank::where('id', $request->id)->delete();
  }

  public function bankSoalUpdate(Request $request)
  {
    $request->validate([
      'id' => 'required',
      'name' => 'required|string|max:255',
      'category' => 'required',
      // 'content' => 'required',
    ]);

    QuestionBank::where('id', $request->id)->update([
      'name' => $request->name,
      'category' => $request->category,
    ]);
  }


  //Soal
  public function add_soal()
  {

    return Inertia::render('Admin/AddSoal');
  }

  public function bankSoalDetail($id)
  {
    return Inertia::render('Admin/BankSoal/Detail');
  }

  public function GroupQuestionAdd(Request $request)
  {
  }
}
