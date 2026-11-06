<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'course_code'=>'BSIT',
            'course_name'=>'Bachelor of Science in Information Technology',
            'description'=>'Information technology program'
        ]);
        Course::create([
            'course_code'=>'BSCS',
            'course_name'=>'Bachelor of Science in Computer Science',
            'description'=>'Computer science program'
        ]);
    }
}
