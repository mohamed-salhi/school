<?php

namespace App\DesignPatern;

interface StudentsDesginInterface{

public function create_student();
    public function edit_student($id);
    public function delete_student($id);
    public function update($request);
    public function show_student($id);
public function Get_Class_Room($id);
public function Get_Sections($id);
public function store_student($request);
public function index();
    public function Upload_attachment($request);
    public function Download_attachment($studentsname,$filename);
    public function Delete_attachment($request);


}
