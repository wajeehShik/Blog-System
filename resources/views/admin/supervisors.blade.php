@extends('layouts.dashborad.app')
@section("title")
<h1><i class="fa fa-users"></i> مشرفين</h1>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    @can('مشرفين-انشاء')
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافةمشرف </a>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">الصورة </th>
                                <th class="border-bottom-0">رقم الجوال </th>
                                <th class="border-bottom-0"> ايميل </th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">البلد </th>
                                <th class="border-bottom-0">الصلاحيه </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->name }}</td>

                                <td>{{$x->online?'نشط':"غير نشط"}}</td>
                                <td><img src="{{ asset('assets/users/'.$x->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $x->mobile }}</td>
                                <td>{{ $x->email }}</td>
                                <td>{{ $x->status==1?'مفعل':'غير مفعل' }}</td>
                                <td>
                                    @if (!empty($x->role))
                                    @foreach ($x->role as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->id != $x->id )
                                    @can('مشرفين-تعديل')
                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$x->name}}" data-id="{{ $x->id }}" data-toggle="modal" id="showEditModelCategory" href="javascript:void(0)" title="تعديل"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('مشرفين-حذف')
                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $x->id }}" data-name="{{ $x->name }}" data-toggle="modal" id="deleteCoateory" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endcan
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مشرف</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.supervisors.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم</label>
                            <input type="text" class="form-control" id="" name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> ايميل</label>
                            <input type="email" class="form-control" id="" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> رقم الجوال</label>
                            <input type="number" class="form-control" id="" name="mobile" value="{{old('mobile')}}">
                            @error('mobile')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">password</label>
                            <input type="password" class="form-control" id="" name="password">
                            @error('password')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">status</label>
                            <select name="status" class="form-control">
                                <option value="0">غير فعال</option>
                                <option value="1">فعال</option>
                            </select>
                            @error('status')
                            <span class="btn btn-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">صلاحياته</label>
                            <select name="role[]" multiple id="role" class="form-control">

                                @foreach ($roles as $role)
                                <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                                @error('role')
                                <span class="btn btn-danger">{{$message}}</span>
                                @enderror
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
    <!-- edit model -->
    <div class="modal" id="editmodelNutrl">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> تعديل حاله</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.supervisors.update')}}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="docotor_id" name="id">

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">اسم</label>
                                        <input type="text" class="form-control" id="docotor_name" name="name">
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="exampleInputEmail1">status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0">غير فعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                        @error('status')
                                        <span class="btn btn-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">صلاحياته</label>
                                        <select name="role[]" multiple id="role" id="role" class="form-control">
                                            @foreach ($roles as $role)
                                            <option value="{{$role}}">{{$role}}</option>
                                            @endforeach
                                            @error('role')
                                            <span class="btn btn-danger">{{$message}}</span>
                                            @enderror
                                        </select>
                                    </div>

                                </div>
                                <hr>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<x-delete-model route="admin.supervisors.delete" />
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@push('scripts')
<script>
    /**show */
    $('body').on('click', '#showModelNutr', function() {
        var nutr_val = $(this).data('id');
        $.get('/admin/supervisors/edit/' + nutr_val, function(data) {
            $('#showElementModel').modal('show');

        });

    });
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {

        $('#element_details').find('tbody tr').remove();
    })
    //edit
    var id_cheched = [];
    $('body').on('click', '#showEditModelCategory', function() {

        var docotor_id = $(this).data('id');
        var docotor_name = $(this).data('name');

        var nutr_val = $(this).data('value');
        $.get('/admin/supervisors/edit/' + docotor_id, function(data) {
            $('#editmodelNutrl').modal('show');

            $('#docotor_id').val(docotor_id);
            $('#docotor_name').val(docotor_name);

            $(`#status option[value='${data[0].status}']`).prop('selected', true);
            data[0].role.forEach(function(el) {
                id_cheched.push(el);
                $(`#role option[value='${el}']`).prop('selected', true);
            });
            // status
            // role
            let trCount = $("#invoice_details_edit").find('tr.cloning_row:last').length;
            let numberIncr = trCount > 0 ? parseInt($("#invoice_details_edit").find('tr.cloning_row:last').attr('id')) + 1 : 0;
            data.forEach(function(el) {
                $("#invoice_details_edit").find('tbody').append($('' +
                    `<tr class="cloning_row" id="${numberIncr}">
            <td><input type="checkbox"  value=" name="permission[]" class="element " ></td>
            </tr>`))
                numberIncr++;
            });

        });
    });
    $('#editmodelNutrl').on('hidden.bs.modal', function(event) {
        console.log(id_cheched)
        id_cheched.forEach(function(el) {
            console.log(el)
            $(`#role option[value='${el}']`).prop('selected', false);

        })
    })
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {

        $('#element_details').find('tbody tr').remove();
    })
</script>
@endpush