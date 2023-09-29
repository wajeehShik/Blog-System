@extends('layouts.dashborad.app')
@section('title')
<h1><i class="fa fa-th-list"></i> اسئلة الشائعة</h1>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    @can("اسئلة شائعة-انشاء")
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة سؤال</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">العنوان</th>
                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">مستخدم</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $faq->title }}</td>
                                <td>{{ substr($faq->body,0,70) }}</td>
                                <td>{{ $faq->status=="1"?'مفعل':'غير مفعل' }}</td>
                                <td>{{ $faq->admin->name }}</td>
                                <td>
                                    @can("اسئلة شائعة-تعديل")
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $faq->id }}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can("اسئلة شائعة-حذف")
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $faq->id }}" data-name="{{ $faq->title }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$faqs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة سؤال</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.faqs.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">سؤال </label>
                            <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title_add" name="title" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاجابة</label>
                            <textarea class="form-control  @error('body') is-invalid @enderror" id="body_add" name="body">{{old('body')}} </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select class="form-control" id="status_add" name="status">
                                <option value="0" {{old('status')==0?"selected":""}}>غير مفعل</option>
                                <option value="1" {{old('status')==1?"selected":""}}>مفعل</option>
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
    <div class="modal fade" id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل سؤال</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.faqs.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="cat_id">
                            <label for="recipient-name" class="col-form-label">سؤال:</label>
                            <input class="form-control" name="title" id="name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اجابة</label>
                            <textarea class="form-control" id="body" name="body"> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select class="form-control" id="" name="status">
                                <option value="0">غير مفعل</option>
                                <option value="1">مفعل</option>

                            </select>
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
    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<x-delete-model route="admin.faqs.delete" />
<!-- main-content closed -->
@endsection
@push('scripts')<script>
    <?php if (!$errors->any()) { ?>
        $("#title_add").val("");
        $("#body_add").val("");
        $("#status_add").val("");
    <?php } ?>
    $('body').on('click', '#showEditModelCategory', function() {
        var faq_id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: '/admin/faqs/edit/' + faq_id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $('#categoryEditModel').modal('show');
                $('#cat_id').val(data.id);
                $('#name').val(data.title);
                $('#body').val(data.body);
                $(`#status option[value='${data.status}']`).prop('selected', true);
            }
        })
    });
</script>
@endpush