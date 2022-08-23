<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function Grade()
    {
        return $this->belongsTo(Grade::class, 'from_grade_id');
    }

    public function ClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'from_Classroom_id');
    }

    public function Section()
    {
        return $this->belongsTo(Section::class, 'from_section_id');
    }
    public function to_Grade()
    {
        return $this->belongsTo(Grade::class, 'to_grade_id');
    }

    public function to_ClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'to_Classroom_id');
    }

    public function to_Section()
    {
        return $this->belongsTo(Section::class, 'to_section_id');
    }

}

