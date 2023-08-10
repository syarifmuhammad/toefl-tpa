<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    //

    public function save(Request $request, $bank_soal_id) {
        DB::beginTransaction();

        try {

        $question = Question::where('question_bank_id', $bank_soal_id)->where('id', $request->id)->first();
        
        $page = $request->page;
        $pageLast = Question::where('question_bank_id', $bank_soal_id)->orderBy('page', 'desc')->first();
        $pageLast = $pageLast ? $pageLast->page : 0;

        if ($page - $pageLast > 1) {
            $page = $pageLast+1;
        }

        if (!$question) {
            $question = new Question();
            $question->question_bank_id = $bank_soal_id;
            $question->page = $page;
        }

        $question->category = $request->category;
        $question->value = $request->value;

        if ($question->image != null) {
            if (Storage::exists($question->image)) {
                Storage::disk('public')->delete($question->image);
            }
        }

        if ($request->image != null) {
            $question->image = $request->file('image')->store('question_image', 'public');
        }
        $question->save();

        Choice::where('question_id', $question->id)->delete();
        foreach($request->choices as $choice) {
            $newChoice = new Choice();
            $newChoice->question_id = $question->id;
            $newChoice->value = $choice['value'];
            $newChoice->true = $choice['true'];
            $newChoice->save();
        }
        DB::commit();
    } catch(Exception $e) {
        return $e->getMessage();
        DB::rollBack();
    }

    return redirect()->route('admin.bank_soal.detail', [ 'id' => $bank_soal_id, 'page' => $page ]);
        
    }
}
