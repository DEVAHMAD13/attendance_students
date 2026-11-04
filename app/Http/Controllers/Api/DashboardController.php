<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\student;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_students'   => student::count(),
            'today_attendances'=> attendance::where('attendance_date', now()->toDateString())->count(),
        ]);
    }
}