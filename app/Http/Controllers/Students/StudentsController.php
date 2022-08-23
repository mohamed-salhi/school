<?php

namespace App\Http\Controllers\Students;

use App\DesignPatern\StudentsDesginInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequset;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
   protected $Students;
   public function __construct(StudentsDesginInterface $Students)
   {
       $this->Students=$Students;
   }

    public function index()
    {
       return $this->Students->index();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return $this->Students->create_student();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequset $request)
    {
        return $this->Students->store_student($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->Students->show_student($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->Students->edit_student($id);

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
        return $this->Students->update($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->Students->delete_student($id);

    }
    public function classes_room($id)
    {
       return $this->Students->Get_Class_Room($id);
    }
    public function Get_Sections($id)
    {
        return $this->Students->Get_Sections($id);
    }
    public function Upload_attachment(Request $request){
        return $this->Students->Upload_attachment($request);

    }
    public function Download_attachment($studentsname, $filename){
        return $this->Students->Download_attachment($studentsname, $filename);

    }
    public function Delete_attachment(Request $request){
        return $this->Students->Delete_attachment($request);

    }
}
