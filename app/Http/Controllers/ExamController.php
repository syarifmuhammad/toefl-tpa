<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExamController extends Controller
{
    public function show(Request $request, $id): Response {
        return Inertia::render('Exam/Detail', [
            'id' => $id,
        ]);
    }

    public function history(Request $request): Response {
        return Inertia::render('Exam/History');
    }

    public function detail_history(Request $request): Response {
        return Inertia::render('Exam/DetailHistory');
    }

    public function payment(Request $request, $id): Response {
        return Inertia::render('Exam/FormPembayaran', [
            'id' => $id,
        ]);
    }
    
}
