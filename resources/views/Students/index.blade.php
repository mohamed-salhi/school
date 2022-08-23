@extends('layouts.master')
@section('css')

    @section('title')
        قائمة الطلاب
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.list_students')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('Students.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_tran.add_student')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{($student->Gender==1)?'ذكر':'انتى'}}</td>
                                                <td>{{$student->grade->Name}}</td>
                                                <td>{{$student->classroom->Name_Class}}</td>
                                                <td>{{$student->section->Name_Section}}</td>
                                                <td>
                                                    <a href="{{route('Students.edit',$student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <form class="d-inline" method="POST" action="{{route('Students.destroy',$student->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="return confirm('are you sure')" type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    <a  href="{{route('Students.show',$student->id)}}" class="btn btn-warning btn-sm" ><i class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
