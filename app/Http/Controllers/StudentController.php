<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create(Request $request)
    {
        return view('students.create');
    }
}
