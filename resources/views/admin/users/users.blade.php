@extends('layouts.dashborad.app')
@section('title')
<style>
    .single-calc,
    .calc,
    .calc-data {

        border: 2px solid #2B7A0B;
        padding-top: 7px;
        justify-content: space-around;
        padding-bottom: 8px;
        border-radius: 9px;
        gap: 191px;
        margin-top: 15px;
    }

    .calc-data {
        gap: 30px
    }

    .single-calc {

        gap: 332px;
    }

    .name-data {
        margin-top: 8px;
        margin-right: 7px;
        font-size: 17px;
    }

    .data-calc {
        font-size: 18px;
        margin-top: 12px;
        margin-right: 9px;
    }

    .name-calc .icon-calc {
        margin-top: 11px;
        border: none;
        height: 28px;
        width: 27px;
        border-radius: 50%;
        padding: 8px;
        background: #D5E4CE;
        color: #2B7A0B;
    }

    .name-calc .name {
        margin-top: 8px;
        margin-right: 7px;
        font-size: 17px;
        font-weight: bold;
    }

    .gap-between {
        gap: 11px;
    }

    .calory,
    .gram {
        border: 2px solid #5BB318;

        padding: 6px;
    }

    .calory span,
    .gram span {

        font-weight: bold;
        font-size: 18px;
        color: green;
    }


    .calory sub,
    .gram sub {

        font-weight: bold;
        color: green;
    }

    .modal-content {
        width: 600px;
    }
</style>
<h1><i class="fa fa-th-list"></i> مستخدمين النظام</h1>
@endsection
@section('content')

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">ايميل </th>
                                <th class="border-bottom-0">جوال </th>
                                <th class="border-bottom-0">اونلاين </th>
                                <th class="border-bottom-0">صورة الشخصية</th>
                                <th>الحالة</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>

                                <td>{{$user->online?'نشط':"غير نشط"}}</td>

                                <td><img src="{{asset('assets/users/'.$user->image) }}" width="100px" height="100px"></td>

                                <td>{{ $user->status==1?'مفعل':'غير مفعل' }}</td>
                                <td>
                                    @can('users-edit')
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $user->id }}" data-toggle="modal" id="showEditModeluser" href="showEditModeluser" title="تعديل"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('users-delete')
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- edit -->
    <div class="modal fade" id="userEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل حالة المستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.users.update')}}" method="POST">

                        @csrf
                        <input type="hidden" name="id" id="user_id">

                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select class="form-control" id="status" name="status">
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
    <!-- delete -->
    <div class="modal" id="deleteCoateoryModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.users.delete')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="delete_id" value="">
                        <input class="form-control" name="name" id="delete_name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@push('scripts')
<!-- Internal Data tables -->
<script>
    // show data user like wieght ....
    $('body').on('click', '#showDataModelUser', function() {
        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: "/admin/users/profile/" + id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $('#weight').text(data.weight)
                $('#length').text(data.length)
                $('#age').text(data.age)
                $('#foondseallergy_data').text(data.foondseallergy_data ?? "لا يوجد")
                $('#gender').text(data.gender)
                $('#chronic_diseases_data').text(data.chronic_diseases_data ?? "لا يوجد")
                $('#notes').text(data.notes)
                $('#aims').text(data.aims)
                $('#activity').text(data.activity)
                $('#require_calories').text(data.require_calories)
                $('#waterCalc').text(data.waterCalc)
                $('#bmi').text(data.bmi)
                $('#bmi_value').text(data.bmi_value)
                $('#fat').text(data.fat)
                $('#fat_gram').text(data.fat_gram)
                $('#protein').text(data.protein)
                $('#protein_gram').text(data.protein_gram)
                $('#carbohydrateClac').text(data.carbohydrateClac)
                $('#carbohydrateClac_gram').text(data.carbohydrateClac_gram)

                $("#showDataModal").modal('show');
                console.log(data);

            }

        })
    })

    $('body').on('click', '#showEditModeluser', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "/admin/users/edit/" + id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: (data) => {
                $("#userEditModel").modal('show');
                // console.log(data);
                //    $('#water_calc').text(data);
                $("#user_id").val(data.id);
                $(`#status option[value='${data.status}']`).prop('selected', true);
            }

        })
    });
    $('body').on('click', '#deleteCoateory', function() {
        $('#deleteCoateoryModel').modal('show');
        var id = $(this).data('id')
        var name = $(this).data('name')
        // console.log(name, id)
        $('#delete_id').val(id);
        $('#delete_name').val(name);
    })
</script>
@endpush