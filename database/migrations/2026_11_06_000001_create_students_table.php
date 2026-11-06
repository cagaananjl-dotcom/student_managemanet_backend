<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id',50)->unique();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email')->unique();
            $table->string('phone',30)->nullable();
            $table->string('gender',20)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('course',100);
            $table->unsignedTinyInteger('year_level');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('students'); }
};
