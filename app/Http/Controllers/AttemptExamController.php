<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Log;
use App\Models\Schedule;
use App\Models\AttemptSchedule;
use App\Models\QuestionBank;
use Illuminate\Support\Facades\Storage;

class AttemptExamController extends Controller
{
    public function index(Request $request) {
        $userId = auth()->user()->id;
        $scheduleId = $request->get('id');
        $attemptSchedule = AttemptSchedule::find($scheduleId);
        $schedule = Schedule::find($attemptSchedule['schedule_id']);
        $questionbank = QuestionBank::find($schedule['questionbank_id']);

        Log::debug('test exam '.$questionbank);

        return Inertia::render('AttemptExam/Dashboard',[
            'scehdule' => $schedule
        ]);
    }

    public function instruction() {
        return Inertia::render('AttemptExam/Instruction');
    }

    public function attempt(Request $request) {
        $userId = auth()->user()->id;
        $scheduleId = $request->get('id');
        $attemptSchedule = AttemptSchedule::find($scheduleId);
        $schedule = Schedule::find($attemptSchedule['schedule_id']);
        $questionbank = QuestionBank::find($schedule['questionbank_id']);

        $soal =  $questionbank["content"];
        $file = null;
        
        if (!file_exists($soal)) {
            Log::debug('error=>' . $soal . ' (not found) ');
            return "soal not found";
        }
        $file = fopen($soal, 'r');
        $num = 0;
        $soalCsv = array();

        while (($line = fgetcsv($file)) !== FALSE) {

            $temp = array(
                'soal' => $line[0],
                'correctAnswer' => $line[1],
                'a' => $line[2],
                'b' => $line[3],
                'c' => $line[4],
                'd' => $line[5],
                'img' => $line[6],
                'audio' => $line[7]
            );
            array_push($soalCsv, $temp);
            
            $num++;
        }
        fclose($file);
        if(count($soalCsv)){
            $soalCsv = array_slice($soalCsv,1);
        }

        return Inertia::render('AttemptExam/Attempt', [
            'soal' => $soalCsv
        ]);
               
    }
    
}
