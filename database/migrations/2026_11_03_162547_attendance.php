<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();                                         
            $table->foreignId('student_id')                       
                  ->constrained('students')
                  ->cascadeOnDelete();                            
            $table->date('attendance_date');                       
            $table->time('attendance_time');                      
            $table->string('status')->default('present');        
            $table->string('source')->default('esp32_rfid');       
            $table->timestamps();                                 

            // القيد الحاسم: منع تكرار حضور نفس الطالب في نفس اليوم
            $table->unique(['student_id', 'attendance_date'], 'uniq_student_day');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};