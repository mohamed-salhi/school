@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        قائمة المعلمين
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.List_Teachers')}}
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

                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                                    اضافة معلم
                                </button>
                                <div class="table-responsive">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المعلم</th>
                                            <th>النوع</th>
                                            <th>تاريخ التعيين</th>
                                            <th>التخصص</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($Teachers as $Teacher)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$Teacher->Name}}</td>
                                                <td>{{($Teacher->Gender==1)?'ذكر':'انتى'}}</td>
                                                <td>{{$Teacher->Joining_Date}}</td>
                                                <td>{{$Teacher->specializations->Name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$Teacher->id}}" title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Teacher{{ $Teacher->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_Teacher{{$Teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('Teachers.destroy','test')}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Teacher_trans.Delete_Teacher') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('My_Classes_trans.Warning_Grade') }}</p>
                                                                <input type="hidden" name="id"  value="{{$Teacher->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="edit{{$Teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                {{ trans('Grades_trans.edit_Grade') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                    <form action="{{route('Teachers.update','test')}}" method="post">
                                                        {{method_field('patch')}}
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="title">{{trans('Teacher_trans.Email')}}</label>
                                                                <input type="hidden" value="{{$Teacher->id}}" name="id">
                                                                <input type="email" name="Email" value="{{$Teacher->Email}}" class="form-control">
                                                                @error('Email')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col">
                                                                <label for="title">{{trans('Teacher_trans.Password')}}</label>
                                                                <input type="password" name="Password" value="{{$Teacher->Password}}" class="form-control">
                                                                @error('Password')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <br>


                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                                                                <input type="text" name="Name" value="{{ $Teacher->Name }}" class="form-control">
                                                                @error('Name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="form-row">
                                                            <div class="form-group col">
                                                                <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                                                                <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                                                    @foreach($specializations as $specialization)
                                                                        <option value="{{$specialization->id}}" {{($Teacher->Specialization_id==$specialization->id)?'selected':''}}>{{$specialization->Name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('Specialization_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col">
                                                                <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                                                                <select class="custom-select my-1 mr-sm-2" name="Gender">
                                                                    <option value="1" {{($Teacher->Gender==1)?'selected':''}}>ذكر</option>
                                                                    <option  value="0" {{($Teacher->Gender==0)?'selected':''}}>انثى</option>
                                                                </select>
                                                                @error('Gender_id')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                                                                <div class='input-group date'>
                                                                    <input class="form-control" type="text"  id="datepicker-action"  value="{{$Teacher->Joining_Date}}" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                                                </div>
                                                                @error('Joining_Date')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                                                            <textarea class="form-control" name="Address"
                                                                      id="exampleFormControlTextarea1" rows="4">{{$Teacher->Address}}</textarea>
                                                            @error('Address')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Parent_trans.Next')}}</button>
                                                    </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('Grades_trans.add_Grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('Teachers.store')}}" method="post">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="title">{{trans('Teacher_trans.Email')}}</label>
                                                        <input type="email" name="Email" class="form-control">
                                                        @error('Email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="title">{{trans('Teacher_trans.Password')}}</label>
                                                        <input type="password" name="Password" class="form-control">
                                                        @error('Password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>


                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                                                        <input type="text" name="Name" class="form-control">
                                                        @error('Name_ar')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="form-group col">
                                                        <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                                                        <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                            @foreach($specializations as $specialization)
                                                                <option value="{{$specialization->id}}">{{$specialization->Name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('Specialization_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                                                        <select class="custom-select my-1 mr-sm-2" name="Gender">
                                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>

                                                                <option value="1">ذكر</option>
                                                                <option value="0">انثى</option>

                                                        </select>
                                                        @error('Gender_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                                                        <div class='input-group date'>
                                                            <input class="form-control" type="text"  id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                                        </div>
                                                        @error('Joining_Date')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                                                    <textarea class="form-control" name="Address"
                                                              id="exampleFormControlTextarea1" rows="4"></textarea>
                                                    @error('Address')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
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
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
