<?php

namespace App\Http\Controllers\ClassRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomRequest;
use App\Http\Requests\StoreRequest;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Grades=Grade::all();
        $My_Classes=ClassRoom::all();
        return view('ClassRoom.index',compact('Grades','My_Classes'));
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
    public function store(ClassRoomRequest $request)
    {
        $List_Classes = $request->List_Classes;

//        if(ClassRoom::where('Name_Class',$request->Name)->orWhere('Name_Class',$request->Name)){
//            return redirect()->route('Classrooms.index')->withErrors([trans('Grades_trans.exists')]);
//
//        }
        try {
          $validated = $request->validated();

            foreach ($List_Classes as $List_Class) {
                ClassRoom::create([
                    'Name_Class' =>['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']],
                    'Grade_id' =>  $List_Class['Grade_id'],
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');

        }catch (\Exception $e){
            return redirect()->route('Classrooms.index')->withErrors(['error'=>$e->getMessage()]);
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
    public function update(ClassRoomRequest $request, $id)
    {
        try {
            $validated = $request->validated();

          $ClassRoom=  ClassRoom::findOrFail($id);
            $ClassRoom->update([
                    'Name_Class' =>['en' => $request->Name_en, 'ar' => $request->Name],
                    'Grade_id' =>  $request->Grade_id,
                ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Classrooms.index');

        }catch (\Exception $e){
            return redirect()->route('Classrooms.index')->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
       ClassRoom::destroy($req->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');

    }
    public function delete_all(Request $req){
       $delete_all=explode(',',$req->delete_all_id);
//       if($delete_all[0] == 'on'){
//           $a= count($delete_all);
//          for($i=0;$i<$a;$i++){
//              ClassRoom::destroy($delete_all[$i]);
//          }
//           toastr()->success(trans('messages.Delete'));
//           return redirect()->route('Classrooms.index');
//       }else{
//           foreach ($delete_all as $id){
//
//               toastr()->success(trans('messages.Delete'));
//               return redirect()->route('Classrooms.index');
//           }
//       }
              ClassRoom::whereIn('id',$delete_all)->delete();
              toastr()->success(trans('messages.Delete'));
              return redirect()->route('Classrooms.index');
    }
    public function Filter(Request $request){
        $Grades=Grade::all();
        $My_Classes = ClassRoom::whereIn('grade_id', request()->sarech )->get();
        return view('ClassRoom.index',compact('Grades','My_Classes'));

    }
}
