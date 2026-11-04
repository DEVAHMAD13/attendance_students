<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(Request $request)
    {
        $query = student::latest()->get();
        if ($request->filled('code')) {
            $query->where('student_code', 'like', '%' . $request->code . '%');
        }

        // البحث بالاسم الكامل
        if ($request->filled('name')) {
            $query->where('full_name', 'like', '%' . $request->name . '%');
        }

        // البحث بـ UID البطاقة
        if ($request->filled('uid')) {
            $query->where('card_uid', 'like', '%' . $request->uid . '%');
        }
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($query);
        }

        return view('students.index');
    }
    function create()
    {
        return view('students.create');
    }
    function edit(student $student)
    {
        return view('students.edit', compact('student'));
    }
}
