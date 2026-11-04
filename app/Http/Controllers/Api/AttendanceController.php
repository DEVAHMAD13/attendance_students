<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Database\UniqueConstraintViolationException;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = attendance::with('students')->latest();
        
        if ($request->filled('date')) {
            $request->validate(['date' => 'date_format:Y-m-d']);
            $query->where('attendance_date', $request->date);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'card_uid'  => 'required|string',
            'source' => 'nullable|string|max:100',
        ]);

        $student = student::where('card_uid', $data['card_uid'])->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Unknown Card',
            ], 404);
        }

        $today = now()->toDateString();

        $exists = Attendance::where('student_id', $student->id)
            ->where('attendance_date', $today)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Already Registered',
                'student' => ['full_name' => $student->full_name],
            ], 409);
        }

        try {
            Attendance::create([
                'student_id'      => $student->id,
                'attendance_date' => $today,
                'attendance_time' => now()->toTimeString(),
                'status'          => 'present',
                'source'          => 'esp32_rfid',
            ]);
        } catch (UniqueConstraintViolationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Already Registered',
                'student' => ['full_name' => $student->full_name],
            ], 409);
        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance Saved',
            'student' => [
                'full_name'    => $student->full_name,
                'student_code' => $student->student_code,
            ],
        ], 201);
    }
}