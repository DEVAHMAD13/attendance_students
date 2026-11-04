<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;

class attendance extends Controller
{
public function index(Request $request)
{
    $date = $request->input('date', now()->format('Y-m-d'));

    $records = Attendance::with('student')
        ->where('attendance_date', $date)
        ->orderBy('attendance_time', 'desc')
        ->get()
        ->map(function ($att) {
            return [
                'id' => $att->id,
                'student_id' => $att->student_id,
                'student_code' => $att->student ? $att->student->student_code : '-',
                'full_name' => $att->student ? $att->student->full_name : 'Unknown',
                'attendance_date' => $att->attendance_date,
                'attendance_time' => $att->attendance_time,
                'status' => $att->status,
                'source' => $att->source,
            ];
        });

    return view('students.index',);
}
}
