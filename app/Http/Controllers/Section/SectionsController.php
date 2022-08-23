<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Grades=Grade::with('Sections')->get();

       $list_Grades=Grade::all();
        $Teacher=Teacher::select('Name', 'id')->get();


       return view('Sections.index',compact('Grades','list_Grades','Teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        try {
            $validated = $request->validated();

            Section::create([

                'Name_Section'=>['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar],
                'status'=>1,
                'Grade_id'=>$request->Grade_id,
                'class_room_id'=>$request->Class_id
            ])->Techer()->attach($request->Teacher);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Sections.index');

        } catch (\Exception $e) {
            return redirect()->route('Sections.index')->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request)
    {
        {
            try {
                $validated = $request->validated();
$section=Section::findOrFail($request->id);

if($request->Status==1){
    $a=1;
}else{
    $a=0;
}
                if (isset($request->Teacher)) {
                   $section->Techer()->sync($request->Teacher);
                } else {
                    $section->Techer()->sync(array());
                }
                $section->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
                $section->Grade_id = $request->Grade_id;
                $section->class_room_id = $request->Class_id;
                $section->status=$a;

                $section->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->route('Sections.index');

            } catch (\Exception $e) {
                return redirect()->route('Sections.index')->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Section::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('Sections.index');
        }
        catch (\Exception $e) {
            return redirect()->route('Sections.index')->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }



}
