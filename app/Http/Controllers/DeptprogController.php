<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DeptprogController extends Controller
{
    public function view_dept_management(){

        $departments = Department::all();
        return view('admin.dept_prog.dept_management',compact('departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Department::create($request->all());

        return redirect()->route('admin.dept_management')->with('success', 'Department added successfully!');
    }
}
