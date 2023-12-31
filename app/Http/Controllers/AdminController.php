<?php

namespace App\Http\Controllers;

use App\Models\AttemptSchedule;
use App\Models\AttemptTest;
use App\Models\Choice;
use App\Models\Question;
use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\Exception;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Inertia\Inertia;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

  public function index()
  {
    $today = Carbon::today()->toDateString();
    $schedule = Schedule::join('question_banks', 'schedules.questionbank_id', '=', 'question_banks.id')->select("schedules.*", "question_banks.category as category")->withCount(['attempt_schedules' => function (EloquentBuilder $q) {
      $q->where('status', 1);
    }])->whereDate('tanggal', $today)->orderBy('tanggal', 'asc')->paginate(100);
    return Inertia::render('Admin/Dashboard', [
      'schedule' => $schedule
    ]);
  }

  public function monitor($id)
  {
    $today = Carbon::today()->toDateString();
    $schedule = Schedule::withCount(['attempt_schedules' => function (EloquentBuilder $q) {
      $q->where('status', 1);
    }])->with('questionbank')->whereDate('tanggal', $today)->find($id);



    if (!$schedule) {
      return to_route('admin.dashboard');
    }
    $attempt_test_count = AttemptTest::where('schedule_id', $id)->get()->count();

    $now = Carbon::now();
    $waktu_berakhir = Carbon::parse($schedule->waktu_berakhir);
    if ($now->lessThan($waktu_berakhir)) {
      $schedule->durasi = $waktu_berakhir->diffInSeconds($now);
    } else {
      $schedule->durasi = 0;
    }

    $participants = AttemptSchedule::with('user')->where('schedule_id', $id)->paginate(100);

    return Inertia::render('Admin/MonitorUjian', [
      'schedule' => $schedule,
      'participants' => $participants,
      'attempt_test_count' => $attempt_test_count,
    ]);
  }

  public function mulai_ujian($id)
  {
    $schedule = Schedule::find($id);
    $schedule->status = 1;
    $schedule->waktu_mulai = Carbon::now();;
    $schedule->waktu_berakhir = Carbon::now()->addHours(2);
    $schedule->save();
    return to_route('admin.monitor', $id);
  }

  //Bank Soal
  public function bank_soal(Request $request)
  {
    $questionBanks = QuestionBank::withCount('questions')->paginate(50);
    // Log::info('bank soal');
    return Inertia::render('Admin/BankSoal/Index', [
      'questionBanks' => $questionBanks
    ]);
  }

  public function bankSoalAdd(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'category' => 'required',
      'jam' => 'required|integer',
      'menit' => 'required|integer|max:60',
      'detik' => 'required|integer|max:60',
    ]);

    QuestionBank::create([
      'name' => $request->name,
      'category' => $request->category,
      'durasi' => $request->jam * 3600 + $request->menit * 60 + $request->detik,
    ]);

    // test file
    // if (!$request->file('file')) return;
    // $file = $request->file('file');
    // $fileName = date('YmdHis') . $file->getClientOriginalName();
    // $file->move(public_path('soal/'), $fileName);
    // $file = fopen('soal/' . $fileName, 'r');
    // if (!$file) return fclose($file);

    // Log::info("test $fileName");
    // $num = 0;

    // while (($line = fgetcsv($file)) !== FALSE) {


    //   $soal = $line[0];
    //   $correctAnswer = $line[1];
    //   $b = $line[3];
    //   $a = $line[2];
    //   $c = $line[4];
    //   $d = $line[5];
    //   $img = $line[6];
    //   $audio = $line[7];
    //   $page = $line[8];
    //   Log::debug($audio.'-'.$page);

    //   if($num === 0 && ($soal != 'soal' || $correctAnswer != 'jawaban' || $a != 'a' || $b != 'b' || $c != 'c' || $d != 'd' || $img != 'img' || $audio != 'audio' || $page != 'page')){
    //     if(file_exists('soal/'.$fileName))Storage::delete('soal/'.$fileName);
    //     throw ValidationException::withMessages(['error' => ['format soal tidak sesuai']]);
    //   }
    //   $num++;
    // }
    // fclose($file);
    // $schedule->durasi = $request->jam * 3600 + $request->menit * 60 + $request->detik;
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
    // Log::info('bank soal update');

    $request->validate([
      'id' => 'required',
      'name' => 'required|string|max:255',
      'category' => 'required',
      'jam' => 'required|integer',
      'menit' => 'required|integer|max:60',
      'detik' => 'required|integer|max:60',
    ]);

    // Log::info("$request->file('file')");

    // // test file
    // if (!$request->file('file')) return;
    // $file = $request->file('file');
    // $fileName = date('YmdHis') . $file->getClientOriginalName();
    // $file->move(public_path('soal/'), $fileName);
    // $file = fopen('soal/' . $fileName, 'r');
    // if (!$file) return fclose($file);

    // Log::info("test $fileName");
    // $num = 0;

    // while (($line = fgetcsv($file)) !== FALSE) {
    //   $soal = $line[0];
    //   $correctAnswer = $line[1];
    //   $b = $line[3];
    //   $a = $line[2];
    //   $c = $line[4];
    //   $d = $line[5];
    //   if ($num === 0 && ($soal != 'soal' || $correctAnswer != 'jawaban' || $a != 'a' || $b != 'b' || $c != 'c' || $d != 'd')) {
    //     if (Storage::exists('soal/' . $fileName)) Storage::delete('soal/' . $fileName);
    //     throw ValidationException::withMessages(['error' => ['format soal tidak sesuai']]);
    //   }
    //   $num++;
    // }
    // fclose($file);

    $questionBanks = QuestionBank::where('id', $request->id);

    if ($questionBanks->category != $request->category) {
      Question::where('question_bank_id', $request->id)->delete();
    }


    $questionBanks->update([
      'name' => $request->name,
      'category' => $request->category,
      'durasi' => $request->jam * 3600 + $request->menit * 60 + $request->detik,
    ]);
  }


  //Soal
  public function detail(Request $request, $id)
  {
    $questions_bank = QuestionBank::find($id);
    if (!$questions_bank) {
      abort(404);
    }

    $page = $request->has('page') ? $request->page : 1;

    $list_questions = Question::select('id', 'page')->where('question_bank_id', $id)->orderBy('page')->orderBy('id')->get();

    $questions = Question::with('choices')->where([
      'question_bank_id' => $id,
      'page' => $page,
    ])->get();

    return Inertia::render('Admin/BankSoal/Detail', [
      'id' => intval($id),
      'question_bank' => $questions_bank,
      'page' => intval($page),
      'list_questions' => $list_questions,
      'questions' => $questions,
    ]);
  }

  public function add_soal()
  {
    return Inertia::render('Admin/AddSoal');
  }

  public function soal_store(Request $request)
  {
    //versi Rifqi Attaufi
    $request->validate([
      'id_bank_soal' => 'required',
      'soal' => 'required',
      'jawaban' => 'required',
    ]);

    $question = Question::create([
      'question_bank_id' => $request->id_bank_soal,
      'question' => $request->soal,
      'image' => $request->image,
      'page' => $request->page,
    ]);

    foreach ($request->jawaban as $value) {
      $choices = Choice::create([
        'value' => $value->value,
      ]);

      if ($value->answer == true) {
        $question->correct_answer = $choices->id;
        $question->save();
      }
    }
  }


  public function GroupQuestionAdd(Request $request)
  {
  }
}
