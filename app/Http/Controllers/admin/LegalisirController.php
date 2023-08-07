<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LegalisirController extends Controller
{
    public function index() {
        return Inertia::render('Admin/Legalisir/Index');
    }

    public function show(Request $id) {
        return Inertia::render('Admin/Legalisir/Detail');
    }
}
