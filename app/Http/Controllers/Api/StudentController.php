<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function Pest\Laravel\json;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = student::latest();

        if ($request->filled('code')) {
            $query->where('student_code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('name')) {
            $query->where('full_name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('uid')) {
            $query->where('card_uid', 'like', '%' . $request->uid . '%');
        }

        $students = $query->get();

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($students);
        }

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_code' => 'required|string|max:50|unique:students,student_code',
            'full_name'    => 'required|string|max:255',
            'card_uid'     => 'required|string|max:50|unique:students,card_uid',
        ]);

        $student = student::create($data);

        return response()->json($student, 201);
    }
    public function edit(student $students)
    {
        return response()->json(['studetn' => $students]);
    }
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_code' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('students', 'student_code')->ignore($student->id),
            ],
            'full_name' => 'sometimes|string|max:255',
            'card_uid'  => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('students', 'card_uid')->ignore($student->id),
            ],
        ]);

        $student->update($data);

        return response()->json($student);
    }
}
