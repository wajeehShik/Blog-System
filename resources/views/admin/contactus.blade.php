@extends('layouts.dashborad.app')
@section('title')
<h1><i class="fa fa-message"></i> طلبات التواصل مع ادارة</h1>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">

        <div class="card mg-b-20">
            <div class="card-body">
                @can('طلبات التواصل-بحث')
                <div class="search-input col-12 m-3">
                    <input type="hidden" id="token_search" value="{{csrf_token()}}" />
                    <input type="hidden" id="ajax_search_url" value="{{route('admin.contactus.ajaxSearch')}}" />
                    <div class="row">
                        <div class="col-4">
                            <input type="text" id="search_by_name" class="form-control" placeholder="ادخل اسم تبحث عنه" />
                        </div>
                        <div class="col-4">
                            <input type="text" id="search_by_email" class="form-control" placeholder="ايميل تبحث عنه" />
                        </div>
                        <div class="col-4">
                            <input type="text" id="search_by_mobile" class="form-control" placeholder="رقم جوال" />
                        </div>
                    </div>
                </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">ايميل </th>
                                <th class="border-bottom-0">عنوان </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactuss as $contact)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>
                                    @can("طلبات التواصل-عرض")
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $contact->id }}" data-toggle="modal" id="showModelContactus" href="javascript:void(0)" title="عرض"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can("طلبات التواصل-حذف")
                                    <a class="modal-effect btn btn-sm btn-danger" data-id="{{ $contact->id }}" data-name="{{$contact->name}}" data-toggle="modal" id="deleteCoateory" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$contactuss->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editmodelContactus">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> عرض رسالة المستخدم </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <span id="message"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <x-delete-model route="admin.contactus.delete" />
</div>
</div>
@endsection
@push('scripts')
<script>
    $('body').on('click', '#showModelContactus', function() {
        var caontact_us_id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: '/admin/contactus/show/' + caontact_us_id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $('#editmodelContactus').modal('show');
                $('#message').text(data.message);
            }
        })
    });
</script>
<script src="{{asset('dashbord_style/js/datatable.js')}}"></script>
@endpush