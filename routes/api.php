<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['status' => 'ok']));

Route::get('/students', [StudentController::class, 'index']);
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::patch('/students/{student}/update', [StudentController::class, 'update']);

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::post('/attendance/store', [AttendanceController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index']);