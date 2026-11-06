<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('school_year',20);
            $table->enum('semester',['1st','2nd','Summer']);
            $table->enum('status',['Enrolled','Dropped','Completed'])->default('Enrolled');
            $table->timestamps();
            $table->unique(['student_id','course_id','school_year','semester']);
        });
    }
    public function down(): void { Schema::dropIfExists('enrollments'); }
};
