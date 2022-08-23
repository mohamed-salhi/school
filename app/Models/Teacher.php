<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function specializations(){
        return $this->belongsTo(Specialization::class,'Specialization_id');
    }
    public function Section(){
        return $this->belongsToMany(Section::class,'teachers_sections');
    }
}
