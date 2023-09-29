@extends('layouts.dashborad.app')
@section('title')
<h1><i class="fa fa-th-list"></i> صفحات الموقع </h1>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('dashbord_style/css/summernote/summernote-lite.min.css')}}">
<style>
    .note-editable {
        background: white;
    }
</style>
<!-- row -->
@foreach ($errors->all() as $error)
<div class="alert alert-danger text-center">

    <span class="">{{ $error }}</span> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            @can('صفحات الثابتة-انشاء')
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة صفحة</a>
                </div>
            </div>
            @endcan
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">عنوان</th>
                                <th class="border-bottom-0">الكاتب</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $page->key }}</td>
                                <td>{{ $page->admin->name }}</td>
                                <td>{{ $page->status =='1'? 'مفعل':'غير مفعل'}}</td>
                                @if($page->admin_id==auth()->id() )
                                <td>
                                    @can('صفحات الثابتة-تعديل')
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $page->id }}" data-toggle="modal" id="showEditModelPost" href="javascript:void(0)" title="تعديل"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('صفحات الثابتة-حذف')
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $page->id }}" data-name="{{ $page->key }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                                @else
                                <td>...</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$pages->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- اضافة مقاله -->
    <div class="modal" id="modaldemo8" style="overflow:scroll">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مقالات</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.pages.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان</label>
                            <input type="text" class="form-control @error('key') is-invalid @enderror" id="key_add" name="key" value="{{old('key')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">محتوي مقال
                            </label>
                            <textarea name="value" class="form-control summernote" id="value_add">{{old('value')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">حاله</label>
                            <select name="status" class="form-control">
                                <option value="0">غير مفعل</option>
                                <option value="1">مفعل</option>
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
        <!-- End Basic modal -->
    </div>
    <!-- edit -->
    <div class="modal" id="postEditModel" style="overflow:scroll">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل مقاله</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.pages.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان</label>
                            <input type="text" class="form-control" id="key" name="key">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">محتوي مقاله</label>
                            <textarea name="value" class="form-control summernote " id="value"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">حاله</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0">غير مفعل</option>
                                <option value="1">مفعل</option>
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
    <!-- delete -->
    <x-delete-model route="admin.pages.delete" />
</div>
@endsection
@push('scripts')
<script src="{{ asset('dashbord_style/css/summernote/summernote-lite.min.js') }}"></script>
<script>
    <?php if (!$errors->any()) { ?>
        $("#key_add").val("");
        $("#value_add").val("");
    <?php } ?>
    $(function() {
        $('.summernote').summernote({
            height: 300,
            placeholder: 'Start typing your text...',
            lang: 'es-ES',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['ltr', 'rtl']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });

    $('body').on('click', '#showEditModelPost', function() {
        $('#postEditModel').modal('show');
        var page_id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: '/admin/pages/edit/' + page_id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $('#postEditModel').modal('show');
                $('#id').val(data.id);
                $('#key').val(data.key);
                $('#value').summernote('code', data.value);
                $(`#status option[value='${data.status}']`).prop('selected', true);

            }
        })
    })
</script>
@endpush