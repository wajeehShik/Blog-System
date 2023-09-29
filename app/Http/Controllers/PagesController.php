<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Response;
use App\Http\Helpers\EditorArabic;
use App\Http\Requests\Admin\PagesRequest;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:صفحات الثابتة-عرض', ['only' => ['index']]);
        $this->middleware('permission:صفحات الثابتة-انشاء', ['only' => ['store']]);
        $this->middleware('permission:صفحات الثابتة-رؤيا', ['only' => ['show']]);
        $this->middleware('permission:صفحات الثابتة-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:صفحات الثابتة-حذف', ['only' => ['destroy']]);
    }
    public function index()
    {
        $pages = Page::orderBy('id', "DESC")->paginate(10);
        return view("admin.pages", compact('pages'));
    }
    public function store(PagesRequest $request)
    {
        $page = Page::create([
            'key' => $request->post('key'),
            'value' => $request->post('value'),
            'value' => Purify::clean(EditorArabic::editorContent($request->post('value'))),
            'status' => $request->post('status'),
            'admin_id' => auth()->id(),
        ]);
        alert()->success('صفحات', 'تم اضافة صفحة بنجاح');
        return redirect()->route('admin.pages.index');
    }
    public function edit($id)
    {
        $page = Page::where('id', $id)->first();
        if ($page) {
            return Response::json($page);
        }
        return false;
    }
    public function update(PagesRequest $request)
    {
        $page = Page::where('id', $request->id)->firstOrFail();
        $data['key'] = $request->post('key');
        $data['value'] =  Purify::clean(EditorArabic::editorContent($request->post('value')));
        $page->update($data);
        alert()->success('صفحة', 'تم تعديل صفحة بنجاح');
        return redirect()->route('admin.pages.index');
    }
    public function destroy(Request $request)
    {
        $page = Page::where('id', $request->id)->firstOrFail();
        $page->delete();
        alert()->warning('صفحة', 'تم حذف صفحة بنجاح');
        return redirect()->route('admin.pages.index');
    }
}
