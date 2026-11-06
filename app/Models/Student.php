<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'email', 'phone',
        'gender', 'birth_date', 'address', 'course', 'year_level'
    ];

    protected $casts = ['birth_date' => 'date'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
