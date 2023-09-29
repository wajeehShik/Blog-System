@extends('layouts.dashborad.app')
@section('title')
<h1><i class="fa fa-user"></i> تعديل بيانات الشخصية</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="tile">
            <h3 class="tile-title">بيانات شخصية</h3>
            <div class="tile-body">
                <form style="
    overflow: hidden;" action="{{route('admin.profile.edit')}}" method="POST" class="text-center" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label class="control-label">كلمة السر</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="ادخل كلمة سر">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">تاكيد كلمة السر</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="confirm_password" placeholder="ادخل تاكيد كلمة السر">
                        @error('confirm_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">رقم الجوال</label>
                        <input class="form-control @error('mobile') is-invalid @enderror" type="number" name="mobile" value="{{ old('mobile', $user->mobile)}}" placeholder="Enter full mobile">
                        @error('mobile')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">صورة شخصية </label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>تعديل</button>
                </form>
            </div>
            <div class="tile-footer"> </div>
        </div>
    </div>
    <div class="col-md-5">
        <img src="{{asset('assets/users/'.$user->image)}}" width="250px" height="250px" alt="" />
    </div>
</div>
@endsection