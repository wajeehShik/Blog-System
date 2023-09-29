<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:صلاحيات-عرض', ['only' => ['index']]);
        $this->middleware('permission:صلاحيات-رؤيا', ['only' => ['show']]);
        $this->middleware('permission:صلاحيات-انشاء', ['only' => ['store']]);
        $this->middleware('permission:صلاحيات-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:صلاحيات-حذف', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        $roles = Role::orderBy('id', 'DESC')->paginate(10);

        $permissions = Permission::get();
        return view('admin.roles.index', compact('roles', 'permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        alert()->success('صلاحيات', 'تم اضافة صلاحيات بنجاح');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();


        return Response::json($rolePermissions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrfail($id);
        $rolePermissions = $role->permissions;
        return Response::json($rolePermissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request)
    {

        $role = Role::findOrfail($request->post('id'));
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        alert()->success('صلاحيات المستخدمي', 'تم  تعديل الصلاحيات بنجاح');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table("roles")->where('id', $request->id)->delete();
        alert()->warning(' صلاحيات', 'تم حذف صلاحيات بنجاح');
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
