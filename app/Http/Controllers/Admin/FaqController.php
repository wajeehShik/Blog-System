<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FaqController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:اسئلة شائعة-عرض', ['only' => ['index']]);
        $this->middleware('permission:اسئلة شائعة-انشاء', ['only' => ['store']]);
        $this->middleware('permission:اسئلة شائعة-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:اسئلة شائعة-حذف', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'DESC')->with('admin')->paginate(10);
        return view('admin.faqs', compact('faqs',));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faq =  Faq::create([
            'title' => $request->post('title'),
            'status' => $request->post('status'),
            'body' => Purify::clean($request->post('body')),
            'admin_id' => auth()->id(),
        ]);
        alert()->success('اسئلة شائعة', 'تم اضافة تصنيف بنجاح');
        return redirect()->route('admin.faqs.index')->withInput();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::where('id', $id)->first();
        if ($faq) {
            return Response::json($faq);
        }
        return false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request)
    {
        $faq = Faq::where('id', $request->id)->firstOrFail();
        $data['title'] = $request->post('title');
        $data['status'] = $request->post('status');
        $data['body'] = $request->post('body');
        $faq->update($data);
        alert()->success('اسئلة شائعة', 'تم تعديل اسئلة شائعة بنجاح');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faq = Faq::where('id', $request->post('id'))->firstOrFail();
        $faq->delete();
        alert()->warning('اسئلة شائعة', 'تم حذف سؤال بنجاح');
        return redirect()->route('admin.faqs.index');
    }
}
