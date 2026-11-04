<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();                                    // id داخلي فريد
            $table->string('student_code')->unique();        // رمز الطالب، فريد
            $table->string('full_name');                     // اسم الطالب، مطلوب
            $table->string('card_uid')->unique();            // UID البطاقة، فريد
            $table->timestamps();                            // created_at + updated_at
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};