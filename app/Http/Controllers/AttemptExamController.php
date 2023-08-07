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
use App\Models\AttemptTest;
use Illuminate\Support\Facades\Storage;

class AttemptExamController extends Controller
{
    public function index(Request $request) {
        $userId = auth()->user()->id;
        $scheduleId = $request->get('id');
        $attemptSchedule = AttemptSchedule::find($scheduleId);
        $schedule = Schedule::find($attemptSchedule['schedule_id']);
        $questionbank = QuestionBank::find($schedule['questionbank_id']);
        
        return Inertia::render('AttemptExam/Dashboard',[
            'schedule' => $schedule,
            'questionbank' => $questionbank,
        ]);
    }

    public function instruction() {
        return Inertia::render('AttemptExam/Instruction');
    }

    public function attempt(Request $request) {
        $userId = auth()->user()->id;
        $scheduleId = $request->get('id');
        $page = $request->get('page');
        $attemptSchedule = AttemptSchedule::find($scheduleId);
        $schedule = Schedule::find($attemptSchedule['schedule_id']);
        $questionbank = QuestionBank::find($schedule['questionbank_id']);

        Log::debug("question-> ".$questionbank);

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
                'audio' => $line[7],
                'page' => $line[8],
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

    public function submit(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'attempt_schedule_id' => 'required',
        ]);
        $answer = $request->input('answer');
        $attemptScheduleId = $request->input('attempt_schedule_id');
        Log::debug($answer);

        $attemptSchedule = AttemptSchedule::find($attemptScheduleId);
        $userId = $attemptSchedule['user_id'];
        $scheduleId = $attemptSchedule['schedule_id'];
        $schedule = Schedule::find($scheduleId);
        $questionbank = QuestionBank::find($schedule['questionbank_id']);
        
        $soal =  $questionbank["content"];
        $file = null;
        
        if (!file_exists($soal)) {
            Log::debug('error=>' . $soal . ' (not found) ');
            return "soal not found";
        }
        $file = fopen($soal, 'r');
        $num = 0;
        $score = 0;
        Log::debug($answer);
        while (($line = fgetcsv($file)) !== FALSE) {

            if($num == 0){
                $num++;
                continue;
            }
            $correctAnswer = $line[1];
            if($answer) {
                // Log::debug($num);
                // Log::debug($correctAnswer."<>".$answer[$num-1]);
                if($correctAnswer === $answer[$num-1]){
                    $score++;
                }
            }
            $num++;
        }

        fclose($file);
        if($num){
            $score = ceil(($score * 100)/$num);
            Log::debug($score);
        }
        $answer = json_encode($answer);
        Log::debug($answer);
        


        AttemptTest::create([
            'user_id' => $userId,
            'schedule_id' => $scheduleId,
            'answer' => json_encode($answer),
            'score' => $score
        ]);
        
        return 'your score: ' . $score;
    }

}
