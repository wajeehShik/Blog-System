<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->guard('admin')->user();
        return view('admin.profile', compact('user'));
    }
    public function editprofile(EditProfileRequest $request)
    {

        if ($request->id == auth()->id()) {

            if ($request->post('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $data['mobile'] = $request->post('mobile');
            $file = $request->image;
            if ($request->image) {
                $filename =   ImageClass::update($request->image, auth()->user()->image, 'users');
                $data['image'] = $filename;
            }
            Admin::whereId(auth()->id())
                ->update($data);
            alert()->success('بيانات الشخصية', 'تم تعديل بيانات بنجاح');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
