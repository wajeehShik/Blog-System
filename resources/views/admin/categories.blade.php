@extends('layouts.dashborad.app')
@section('title')
<h1><i class="fa fa-th-list"></i> اقسام</h1>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة قسم</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="ajax_responce_serarchDiv">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">المستخدم</th>
                                <th class="border-bottom-0"> صورة</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">الاب</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->admin->name}}</td>
                                <td><img src="{{asset('assets/categories/'.$category->image)}}" width="150px" height="150px"></td>
                                <td>{{ $category->status=="active"?'مفعل':'غير مفعل' }}</td>

                                <td>{{ $category->parent->name}}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $category->id }}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم</label>
                            <input type="text" class="form-control" id="name_add" name="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select class="form-control" id="status_add" name="status">
                                <option value="no_active" {{old('status')=='no_active'?"selected":""}}>غير مفعل</option>
                                <option value="active" {{old('status')=='active'?"selected":""}}>مفعل</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاب</label>
                            <select class="form-control" id="parent_id_add" name="parent_id">
                                <option value="">-</option>
                                @foreach($parents as $parent)
                                <option value="{{$parent->id}}" @if(old('parent_id')==$parent->id) selected @endif>{{$parent->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">صورة</label>
                            <input type="file" class="form-control" id="" name="image">
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
    </div>
    <!-- edit -->
    <div class="modal fade" id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.categories.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="cat_id">

                            <label for="exampleInputEmail1">اسم القسم</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select class="form-control" id="status" name="status">
                                <option value="no_active" {{old('status')=='no_active'?"selected":""}}>غير مفعل</option>
                                <option value="active" {{old('status')=='active'?"selected":""}}>مفعل</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاب</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="">-</option>
                                @foreach($parents as $parent)
                                <option value="{{$parent->id}}" @if(old('parent_id')==$parent->id) selected @endif>{{$parent->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">صورة</label>
                            <input type="file" class="form-control" id="" name="image">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete category -->
    <x-delete-model route="admin.categories.delete" />
    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@push('scripts')
<!-- Internal Data tables -->
<script>
    <?php if (!$errors->any()) { ?>
        $("#name_add").val("");
        $("#status_add").val("");
    <?php } ?>
    $('body').on('click', '#showEditModelCategory', function() {
        var cat_id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: '/admin/categories/edit/' + cat_id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $('#categoryEditModel').modal('show');
                $('#cat_id').val(data.id);
                $('#name').val(data.name);
                $(`#status option[value='${data.status}']`).prop('selected', true);
                $(`#parent_id option[value='${data.parent_id}']`).prop('selected', true);

            }
        })
    });
    $('#categoryEditModel').on('hidden.bs.modal', function(event) {
        $(`#parent_id option[value='']`).prop('selected', true);
    })
</script>

@endpush