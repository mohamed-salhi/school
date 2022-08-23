<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function grade(){
      return  $this->belongsTo(Grade::class,'Grade_id');
    }
    public function classroom(){
        return  $this->belongsTo(ClassRoom::class,'Classroom_id');
    }
    public function section(){
        return  $this->belongsTo(Section::class,'section_id');
    }
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function Nationality(){
        return  $this->belongsTo(Nationalitie::class,'nationalitie_id');
    }
    public function myparent(){
        return  $this->belongsTo(My_parent::class,'parent_id');
    }
}
