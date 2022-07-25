<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClassRoom extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['Name_Class'];
    protected $guarded=[];

    public function Grade(){
        return $this->belongsTo(Grade::class,);
    }
}
