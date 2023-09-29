@extends('layouts.dashborad.app')
@section('title')
<h1><i class="fa fa-message"></i> صلاحيات</h1>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    @can('صلاحيات-انشاء')
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافةصلاحيه </a>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم الصلاحيه</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $x->name }}</td>
                                <td>
                                    @can('صلاحيات-رؤيا')
                                    <a class="modal-effect btn btn-sm btn-info" href="#" data-id="{{ $x->id }}" data-toggle="modal" id="showModelRoles" title="حذف"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('صلاحيات-تعديل')
                                    <a class="modal-effect btn btn-sm btn-info" href="#" data-id="{{ $x->id }}" data-name_role="{{$x->name}}" data-toggle="modal" id="EditModelNutr" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('صلاحيات-حذف')
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $x->id }}" data-name="{{ $x->name }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
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
                    <h6 class="modal-title">اضافة صلاحيه</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.roles.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">اسم </label>
                                        <input type="text" class="form-control" id="" name="name">
                                    </div>
                                </div>
                                <hr>
                                <table class="table" id="invoice_details">
                                    <thead>
                                        <tr>
                                            <th>اسم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr class="cloning_row" id="0">
                                            <td>
                                                <input type="checkbox" name="permission[]" value="{{$permission->id}}" class="" id="{{$permission->name.$permission->id}}">
                                                <label for="{{$permission->name.$permission->id}}">{{ $permission->name }}</label>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <!-- End Basic modal -->
    <!-- edit model -->

</div>
<!-- showElementModel -->
<div class="modal" id="showElementModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">مستخدم صلاحيه</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <table class="table key-buttons text-md-nowrap" id="element_details">
                    <thead>
                        <tr>
                            <td>صلاحية</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
</div>
<!-- EditElementModel -->
<div class="modal" id="EditElementModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل صلاحيه</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.roles.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="" id="id">
                    <div class="form-group">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">اسم </label>
                                    <input type="text" class="form-control" id="name_role" name="name">
                                </div>
                            </div>
                            <hr>
                            <table class="table" id="invoice_details">
                                <thead>
                                    <tr>
                                        <th>اسم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr class="cloning_row" id="0">
                                        <td>
                                            <input type="checkbox" name="permission[]" value="{{$permission->id}}" id="{{$permission->id}}-{{$permission->name}}" class="">
                                            <label for="{{$permission->id}}-{{$permission->name}}">{{ $permission->name }}</label>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

<!-- delete -->
<x-delete-model route="admin.roles.delete" />
</div>
</div>
@endsection
@push('scripts')
<script>
    /**show */
    $('body').on('click', '#showModelRoles', function() {

        var id = $(this).data('id');
        $.get('/admin/roles/show/' + id, function(data) {
            $('#showElementModel').modal('show');
            data.forEach(function(el) {
                //console.log(el)
                $('#element_details').find('tbody').append($('' +
                    '<tr>' +
                    '<td>' + el['name'] + '</td>' +
                    '<tr>'
                ));
            });
        });
    });
    /***edit */
    var id_checker = [];
    $('body').on('click', '#EditModelNutr', function() {
        var id = $(this).data('id');
        var name_role = $(this).data('name_role');
        // console.log(id);
        $.get('/admin/roles/edit/' + id, function(data) {
            $('#EditElementModel').modal('show');
            $("#id").val(id);
            $("#name_role").val(name_role);
            console.log(data);
            data.forEach(function(el) {
                id_checker.push(`${el.id}-${el.name}`);
                // console.log(el)
                $("#" + el.id + '-' + el.name).prop('checked', true);
            });
        })
    })
    //لما يروح الضغط عن اضهار العناصر
    $('#EditElementModel').on('hidden.bs.modal', function(event) {
        console.log(id_checker)
        id_checker.forEach(function(el) {
            console.log(el)
            $("#" + el).prop('checked', false);
        })
    })
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {

        $('#element_details').find('tbody tr').remove();
    })
</script>
@endpush