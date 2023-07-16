<?php

namespace App\Http\Controllers;

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

  public function store_soal(Request $request)
  {
    dd($request->all());
  }
}
