<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function viewStdDashboard()
    {
        return view('student.nodue_apply');
    }
}
