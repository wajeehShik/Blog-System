<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SupervisorsRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Notifications\UserRegisterNotification;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupervisorsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:مشرفين-عرض', ['only' => ['index']]);
        $this->middleware('permission:مشرفين-انشاء', ['only' => ['store']]);
        $this->middleware('permission:مشرفين-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:مشرفين-حذف', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Admin::orderBy('id', 'DESC')->where("role", '<>', 'docotor')->paginate(10);
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.supervisors', compact('data', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function store(SupervisorsRequest $request)
    {
        $user = Admin::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'role' => $request->post('role'),
            'online' => '0',
            'status' => $request->post('status'),
            'mobile' => $request->post('mobile'),
            'image' => 'default.png',
            'timezone' => $request->post('timezone'),
        ]);
        $user->assignRole($request->input('role'));
        alert()->success('مشرفين ', 'تم اضافة مشرف بنجاح');
        return redirect()->route('admin.supervisors.index')
            ->with('success', 'تم اضافة المشرف بنجاح');
    }
    public function edit($id)
    {
        $user = Admin::whereId($id)->select('status', 'role')->get();
        return Response::json($user);
    }
    public function update(Request $request)
    {
        $user = Admin::findOrfail($request->id);
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            alert()->error('مشرفين', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator);
        }

        $user->update([
            'status' => $request->post('status'),
            'role' => $request->post('role'),
        ]);

        $user->syncRoles($request->post('role'));
        alert()->success('مشرفين', 'تم التعديل بنجاح');
        return redirect()->route('admin.supervisors.index');
    }
    public function destroy(Request $request)
    {
        Admin::findOrfail($request->id)->delete();
        alert()->success('مشرفين', 'تم التعديل بنجاح');
        return redirect()->route('admin.supervisors.index');
    }
}
