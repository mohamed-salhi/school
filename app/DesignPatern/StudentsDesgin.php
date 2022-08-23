<?php

namespace App\DesignPatern;

use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentsDesgin implements StudentsDesginInterface {


    public function create_student()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();

        return view('Students.create',$data);
    }

    public function Get_Class_Room($id)
    {
       $list_class=ClassRoom::where('grade_id',$id)->pluck('Name_Class','id');
       return $list_class;
    }

    public function Get_Sections($id)
    {
        $list_section=Section::where('class_room_id',$id)->pluck('Name_Section','id');
        return $list_section;    }


    public function store_student($request)
    {

        DB::beginTransaction();
        try {
      $student=  Student::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'Gender'=>$request->gender_id,
            'nationalitie_id'=>$request->nationalitie_id,
            'blood_id'=>$request->blood_id,
            'Date_Birth'=>$request->Date_Birth,
            'Grade_id'=>$request->Grade_id,
            'Classroom_id'=>$request->Classroom_id,
          'section_id'=>$request->section_id,
         'academic_year'=>$request->academic_year,
        ]);
        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$request->name, $file->getClientOriginalName(),'upload_attachments');

                // insert in image_table

                Image::create([
                  'filename'=>  $name,
                  'imageable_id'=>$student->id,
                  'imageable_type'=>  'App\Models\Student',

                ]);
            }
        }
        DB::commit(); // insert data
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.create');

    }

catch (\Exception $e){
DB::rollback();
return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}

}
    public function index()
    {
        $students= Student::all();
      return view('Students.index',compact('students'));
    }

    public function edit_student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $data['Students'] = Student::findOrFail($id);

        return view('Students.edit',$data);
    }

    public function update($request)
    {
      $Student=  Student::findOrFail($request->id);
        $Student->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'Gender'=>$request->gender_id,
            'nationalitie_id'=>$request->nationalitie_id,
            'blood_id'=>$request->blood_id,
            'Date_Birth'=>$request->Date_Birth,
            'Grade_id'=>$request->Grade_id,
            'Classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'academic_year'=>$request->academic_year,
        ]);

        toastr()->success(trans('updated.success'));
        return redirect()->route('Students.index');
    }

    public function delete_student($id)
    {
        Student::destroy($id);
        toastr()->success(trans('delted.success'));
        return redirect()->route('Students.index');    }

    public function show_student($id)
    {
          $Student=Student::findOrFail($id);
        return view('Students.show',compact('Student'));
    }
    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function Download_attachment($studentsname, $filename)
    {
return response()->download(public_path('attachments/students'.'/'.$studentsname.'/'.$filename));


    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
