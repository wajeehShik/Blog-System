<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:وسوم-عرض', ['only' => ['index']]);
        $this->middleware('permission:وسوم-انشاء', ['only' => ['store']]);
        $this->middleware('permission:وسوم-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:وسوم-حذف', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->with(['admin'])->paginate(30);
        return view('admin.tags', compact('tags',));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tag =  Tag::create([
            'name' => $request->post('name'),
            'slug' => $request->post('name'),
            'admin_id' => auth()->id(),
            'status' => $request->post('status'),
        ]);
        alert()->success('وسوم', 'تم اضافة وسم بنجاح');
        return redirect()->route('admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Tag::where('id', $id)->first();
        if ($cat) {
            return Response::json($cat);
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
    public function update(TagRequest $request)
    {
        $tag = Tag::where('id', $request->id)->firstOrFail();
        $data['name'] = $request->post('name');
        $data['slug'] = $request->post('name');
        $data['status'] = $request->post('status');
        $tag->update($data);
        alert()->success('وسوم', 'تم تعديل وسم بنجاح');
        return redirect()->route('admin.tags.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $tag = Tag::where('id', $request->id)->withCount('posts')->firstOrFail();
        $tag = Tag::where('id', $request->id)->firstOrFail();
        // if ($tag->posts_count == 0) {
        //     Tag::whereId($request->id)->delete();
        //     alert()->warning('وسوم', 'تم حذف وسوم بنجاح');
        //     return redirect()->route('admin.tags.index');
        // } else {
        //     alert()->error('وسوم', 'لا يمكن حذف لانه هناك مقالات ووصفات مرتبطه');
        //     return redirect()->back();
        // }

        Tag::whereId($request->id)->delete();
        alert()->warning('وسوم', 'تم حذف وسوم بنجاح');
        return redirect()->route('admin.tags.index');
    }
}
