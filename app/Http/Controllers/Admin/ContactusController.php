<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class ContactusController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:طلبات التواصل', ['only' => ['index']]);
        $this->middleware('permission:طلبات التواصل-عرض', ['only' => ['show']]);
        $this->middleware('permission:طلبات التواصل-حذف', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactuss = Contactus::orderBy('id', 'DESC')->paginate(30);
        return view('admin.contactus',  compact('contactuss',));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactus = Contactus::where('id', $id)->first();
        if ($contactus) {
            return Response::json($contactus);
        }
        return false;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contactus = Contactus::whereId($request->id)->firstOrFail();
        $contactus->delete();
        alert()->warning('تعليق مستخدم', 'تم حذف تعليق مستخدم بنجاح');
        return redirect()->route('admin.contactus.index');
    }
}
