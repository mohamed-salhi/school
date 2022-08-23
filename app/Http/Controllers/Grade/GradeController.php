<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreRequest;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades=Grade::all();
        return view('Grades.index',compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a new blog post.
     *
* @param  \App\Http\Requests\StoreRequest  $request
* @return Illuminate\Http\Response
*/
    public function store(StoreRequest $request)
    {
//     if(Grade::where('Name_en',$request->Name)->orWhere('Name_ar',$request->Name)){
//         return redirect()->route('Grades.index')->withErrors([trans('Grades_trans.exists')]);
//
//     }

        try {
            $validated = $request->validated();
            Grade::create([
                'Name' => ['en' => $request->Name_en, 'ar' => $request->Name],
                'Note' => $request->Notes,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Grades.index');

        } catch (\Exception $e) {
            return redirect()->route('Grades.index')->withErrors(['error' => $e->getMessage()]);


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
    public function update(StoreRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $grade=Grade::findOrFail($request->id);
            $grade->update([
                'Name'=>['en' => $request->Name_en, 'ar' => $request->Name],
                'Note'=>$request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');

        }catch (\Exception $e){
            return redirect()->route('Grades.index')->withErrors(['error'=>$e->getMessage()]);
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
            $ClassRoom=Grade::findOrFail($request->id)->ClassRoom->count();
           if($ClassRoom>0){
               toastr()->warning(trans('Grades_trans.delete_Grade_Error'));
               return redirect()->route('Grades.index');
           }else{
             Grade::destroy($request->id);
               toastr()->success(trans('messages.Delete'));
               return redirect()->route('Grades.index');
           }



        }catch (\Exception $e){
            return redirect()->route('Grades.index')->withErrors(['error'=>$e->getMessage()]);
        }
    }
}
