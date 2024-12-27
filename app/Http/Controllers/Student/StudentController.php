<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\Student;

class StudentController extends Controller
{
    public function viewStdDashboard()
    {
        return view('student.nodue_apply');
    }

    public function view_std_management(Request $request){

        $query = Student::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('student_id', 'like', '%' . $request->search . '%')
                  ->orWhere('programme_id', 'like', '%' . $request->search . '%');
        }
    
        // Sorting functionality
        $sortField = $request->get('sortField', 'programme_id'); // Default sorting field
        $sortOrder = $request->get('sortOrder', 'asc'); // Default sorting order
        $query->orderBy($sortField, $sortOrder);
    
        // Paginate results
        $students = $query->paginate(10);
    
        
        return view('admin.student.student', compact('students','sortField', 'sortOrder'));
    }

    public function import(Request $request) { 
        $request->validate([ 
            'file' => 'required|mimes:xlsx,csv', 
        ]); 
        Excel::import(new StudentsImport, $request->file('file')); 
        return back()->with('success', 'Students imported successfully.'); 
    }
}
