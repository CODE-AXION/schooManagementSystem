<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademicBatchController extends Controller
{
    public function create()
    {
        return view('academic_batches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch' => 'required',
        ]);

        // Use a regular expression to find dates in the string
        $pattern = '/\d{4}-\d{2}-\d{2}/';
        preg_match_all($pattern, $request->batch, $matches);

        $dates = $matches[0];

        $startDate = reset($dates); // Get the first date
        $endDate = end($dates); // Get the last date


        dd($endDate);

        dd($request->all());
    }
}
