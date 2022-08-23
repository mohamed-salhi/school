<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Teachers=Teacher::all();
        $specializations=Specialization::all();

        return view('Techers.index',compact('Teachers','specializations'));
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
    public function store(Request $request)
    {
       $request->validate([
           'Email' => 'required|unique:teachers,Email',
           'Password' => 'required',
           'Name' => 'required',
           'Specialization_id' => 'required',
           'Gender' => 'required',
           'Joining_Date' => 'required|date|date_format:Y-m-d',
           'Address' => 'required',
       ]);
       Teacher::create([
          'Email'=>$request->Email,
          'Password'=>$request->Password,
          'Name'=>$request->Name,
          'Specialization_id'=>$request->Specialization_id,
           'Gender'=>$request->Gender,
           'Joining_Date'=>$request->Joining_Date,
           'Address'=>$request->Address
       ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('Teachers.index');
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
    public function edit($request)
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
    public function update(Request $request)
    {
        $request->validate([
            'Password' => 'required',
            'Name' => 'required',
            'Specialization_id' => 'required',
            'Gender' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'Address' => 'required',
        ]);
        $id=$request->id;
        $Teacher=  Teacher::findOrFail($id);
        $Teacher->update([
            'Email'=>$request->Email,
            'Password'=>$request->Password,
            'Name'=>$request->Name,
            'Specialization_id'=>$request->Specialization_id,
            'Gender'=>$request->Gender,
            'Joining_Date'=>$request->Joining_Date,
            'Address'=>$request->Address
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('Teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Teacher::destroy($request->id);
        toastr()->success(trans('messages.success'));
        return redirect()->route('Teachers.index');
    }
}
