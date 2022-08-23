<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['Name_Section'];
    protected $guarded=[];
    public function Grade(){
        return $this->belongsTo(Grade::class);
    }

    public function My_classs()
    {
        return $this->belongsTo(ClassRoom::class,'class_room_id');
    }
    public function Techer(){
        return $this->belongsToMany(Teacher::class,'teachers_sections');
    }
}
