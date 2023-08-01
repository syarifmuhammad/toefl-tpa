<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Exceptions\HttpResponseException;
use Inertia\Inertia;
use App\Models\Schedule;
use Illuminate\Support\Facades\Storage;

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
    // Log::info('bank soal');
    return Inertia::render('Admin/BankSoal/Index', [
      'questionBanks' => $questionBanks
    ]);
  }

  public function CheckSoal($file) {

  }

  public function bankSoalAdd(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'category' => 'required',
      'file' => 'required',
    ]);

    // test file
    if(!$request->file('file')) return;
    $file = $request->file('file');
    $fileName = date('YmdHis') . $file->getClientOriginalName();
    $file->move(public_path('soal/'), $fileName);
    $file = fopen('soal/'.$fileName, 'r');
    if(!$file) return fclose($file);
    
    Log::info("test $fileName");
    $num = 0;

    while (($line = fgetcsv($file)) !== FALSE) {
      $soal = $line[0];
      $correctAnswer = $line[1];
      $b = $line[3];
      $a = $line[2];
      $c = $line[4];
      $d = $line[5];
      if($num === 0 && ($soal != 'soal' || $correctAnswer != 'jawaban' || $a != 'a' || $b != 'b' || $c != 'c' || $d != 'd')){
        if(Storage::exists($file))Storage::delete($file);
        throw new Exception('format soal tidak sesuai');
      }
      $num++;
    }
    fclose($file);

    QuestionBank::create([
      'name' => $request->name,
      'category' => $request->category,
      'content' => 'soal/'.$fileName,
      'jumlah' => $num
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
    Log::info('bank soal update');
    
    $request->validate([
      'id' => 'required',
      'name' => 'required|string|max:255',
      'category' => 'required',
      'file' => 'required'
    ]);
    
    Log::info("$request->file('file')");

    // test file
    if(!$request->file('file')) return;
    $file = $request->file('file');
    $fileName = date('YmdHis') . $file->getClientOriginalName();
    $file->move(public_path('soal/'), $fileName);
    $file = fopen('soal/'.$fileName, 'r');
    if(!$file) return fclose($file);
    
    Log::info("test $fileName");
    $num = 0;

    while (($line = fgetcsv($file)) !== FALSE) {
      $soal = $line[0];
      $correctAnswer = $line[1];
      $b = $line[3];
      $a = $line[2];
      $c = $line[4];
      $d = $line[5];
      if($num === 0 && ($soal != 'soal' || $correctAnswer != 'jawaban' || $a != 'a' || $b != 'b' || $c != 'c' || $d != 'd')){
        if(Storage::exists($file))Storage::delete($file);
        throw new Exception('format soal tidak sesuai');
      }
      $num++;
    }
    fclose($file);

    QuestionBank::where('id', $request->id)->update([
      'name' => $request->name,
      'category' => $request->category,
      'content' => 'soal/'.$fileName,
      'jumlah' => $num
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
