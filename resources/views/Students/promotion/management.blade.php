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
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete"
                                        title="تراجع الكل">تراجع الكل</button><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th class="text-danger">المرحلة الدراسية القديمة</th>
                                            <th class="text-danger">الصف القديم</th>
                                            <th class="text-danger">القسم القديم</th>
                                            <th class="text-danger">لسنة القديم</th>
                                            <th class="text-info">المرحلة الدراسية الجديدة</th>
                                            <th class="text-info">الصف الجديد</th>
                                            <th class="text-info">القسم الجديد</th>
                                            <th class="text-info">لسنة الجديدة</th>

                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promoiton as $promoitons)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promoitons->student->name}}</td>
                                                <td>{{$promoitons->Grade->Name}}</td>
                                                <td>{{$promoitons->ClassRoom->Name_Class}}</td>
                                                <td>{{$promoitons->Section->Name_Section}}</td>
                                                <td>{{$promoitons->from_year_id}}</td>
                                                <td>{{$promoitons->to_Grade->Name}}</td>
                                                <td>{{$promoitons->to_ClassRoom->Name_Class}}</td>
                                                <td>{{$promoitons->to_Section->Name_Section}}</td>
                                                <td>{{$promoitons->to_year_id}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button>
                                                    <form class="d-inline" method="POST" action="{{route('promotion.destroy',$promoitons->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="return confirm('are you sure')" type="submit"  class="btn btn-outline-danger" >ارجاع الطالب</button>
                                                    </form>
                                                </td>
                                            </tr>


                                        @endforeach
                                    </table>
                                    <div class="modal fade"
                                         id="delete"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تراجع الكل
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('promotion.destroy', 'text') }}" method="post">
                                                    @method('delete')
                                                        @csrf
                                                       {{ trans('Grades_trans.Warning_Grade') }}
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
