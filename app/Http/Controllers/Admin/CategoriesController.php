<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\HerkuoUploader;
use App\Helpers\ImageClass;
use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadImage;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Artical;
use App\Models\Category;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:أقسام-عرض', ['only' => ['index']]);
        $this->middleware('permission:أقسام-انشاء', ['only' => ['store']]);
        $this->middleware('permission:أقسام-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:أقسام-حذف', ['only' => ['destroy']]);
    }
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->with(['admin', 'parent'])->paginate(10);
        $parents = Category::where("status", 'active')->get();
        return view('admin.categories', compact('categories', 'parents'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $filename = '';
        $image = UploadImage::create($request->image, 'categories');
        $category = Category::create([
            'name' => $request->post('name'),
            'slug' => $request->post('name'),
            'admin_id' => auth()->id(),
            'status' => $request->post('status'),
            'parent_id' => $request->post('parent_id'),
            'image' => $image,
        ]);
        alert()->success('تصنيفات', 'تم اضافة تصنيف بنجاح');
        return redirect()->route('admin.categories.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::whereId($id)->first();
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
    public function update(CategoryRequest $request)
    {
        $cat = Category::where('id', $request->id)->firstOrFail();
        $data['name'] = $request->post('name');
        $data['status'] = $request->post('status');
        if (isset($request->image)) {
            $data['image'] =  UploadImage::update($request->image, $cat->image, 'categories');
        }
        $cat->update($data);
        alert()->success('تصنيفات', 'تم اضافة تصنيف بنجاح');
        return redirect()->route('admin.categories.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cat = Category::where('id', $request->id)->firstOrFail();
        // if ($cat->posts_count == 0) {
        //     $image = $cat->image;
        //     $cat->delete();
        //     UploadImage::delete($image, 'categories');
        //     alert()->warning('تصنيف', 'تم حذف القسم بنجاح');
        //     return redirect()->route('admin.categories.index');
        // } else {
        //     alert()->error('تصنيفات', 'هناك مقالات مرتبطه بنظام لا يمكن حذفها ');
        //     return redirect()->back();
        // }
        $cat->delete();
        $image = $cat->image;
        UploadImage::delete($image, 'categories');
        alert()->warning('تصنيف', 'تم حذف القسم بنجاح');
        return redirect()->route('admin.categories.index');
    }
}
