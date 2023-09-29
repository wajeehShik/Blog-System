<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users-index', ['only' => ['index']]);
        $this->middleware('permission:users-profile', ['only' => ['profile_user']]);
        $this->middleware('permission:users-show-profile', ['only' => ['show_profile']]);
        $this->middleware('permission:users-edit', ['only' => ['edit_user', 'update_user']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.users', compact('users'));
    }

    public function edit($id)
    {
        $user = User::whereId($id)->select('status', 'id')->first();
        if ($user) {
            return Response::json($user);
        } else {
            return false;
        }
    }
    public function update(Request $request)
    {
        $user = User::findOrFail($request->post('id'));
        $user->update(['status' => $request->post('status')]);
        alert()->success('مستخدمين', '   تم نعديل الحالة بنجاح');
        return redirect()->route('admin.users.index');
    }
    public function destroy(Request $request)
    {

        User::find($request->id)->delete();
        alert()->warning('حذف مستخدمين', 'تمت عملية الحذف بنجاح');
        return redirect()->route('admin.users.index');
    }
}
