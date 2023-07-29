<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AttemptExamController extends Controller
{
    public function index() {
        return Inertia::render('AttemptExam/Dashboard');
    }

    public function instruction() {
        return Inertia::render('AttemptExam/Instruction');
    }

    public function attempt() {
        return Inertia::render('AttemptExam/Attempt');
    }
}
