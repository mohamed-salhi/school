<?php

namespace App\DesignPatern;

use App\Models\Grade;
use App\Models\promotions;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionsDesgin implements PromotionDesginInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('Students.promotion.index',compact('Grades'));    }

    public function store($request)
    {


        DB::beginTransaction();

        try {
        $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',   $request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->from_year_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
        }

        // update in table student
        foreach ($students as $student){

            $ids = explode(',',$student->id);
            student::where('id', $student->id)
                ->update([
                    'Grade_id'=>$request->Grade_id_new,
                    'Classroom_id'=>$request->Classroom_id_new,
                    'section_id'=>$request->section_id_new,
                    'academic_year'=>$request->to_year_id
                ]);

            // insert in to promotions
            promotions::updateOrCreate([
                'student_id'=>$student->id,
                'from_grade_id'=>$request->Grade_id,
                'from_section_id'=>$request->section_id,
                'from_Classroom_id'=>$request->Classroom_id,
                'from_year_id'=>$request->from_year_id,
                'to_grade_id'=>$request->Grade_id_new,
                'to_Classroom_id'=>$request->Classroom_id_new,
                'to_section_id'=>$request->section_id_new,
                'to_year_id'=>$request->to_year_id,

            ]);

        }
            DB::commit();

            toastr()->success(trans('messages.success'));
        return redirect()->back();

    } catch (\Exception $e) {
DB::rollback();
return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
    }

    public function management()
    {
$promoiton= promotions::all();
return view('Students.promotion.management',compact('promoiton'));

    }

    public function delete($id)
    {
//        DB::beginTransaction();

//        try {
            if($id=='text'){
                $promoiton= promotions::all();
                  foreach ($promoiton as $item){
                      $ids=explode(',',$item->student_id);
                      Student::whereIn('id',$ids)->update([
                          'Grade_id'=>$item->from_grade_id,
                          'Classroom_id'=>$item->from_Classroom_id,
                          'section_id'=>$item->from_section_id,
                          'academic_year'=>$item->from_year_id
                      ]);
                  }
                  promotions::truncate();
                toastr()->success(trans('messages.success'));
                return redirect()->back();

            }else{
                $promoiton=promotions::findOrFail($id);
                Student::where('id',$promoiton->student_id)->update([
                    'Grade_id'=>$promoiton->from_grade_id,
                    'Classroom_id'=>$promoiton->from_Classroom_id,
                    'section_id'=>$promoiton->from_section_id,
                    'academic_year'=>$promoiton->from_year_id
                ]);
                promotions::destroy($id);
                toastr()->success(trans('messages.success'));
                return redirect()->back();

            }
//            DB::commit();



//        } catch (\Exception $e) {
////          DB::rollback();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }
    }
}
