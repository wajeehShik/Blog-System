<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadImage;
use App\Http\Requests\Admin\PostsRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\EditorArabic;
use Stevebauman\Purify\Facades\Purify;
class PostsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:أقسام-عرض', ['only' => ['index']]);
        $this->middleware('permission:أقسام-انشاء', ['only' => ['store']]);
        $this->middleware('permission:أقسام-تعديل', ['only' => ['edit', 'update']]);
        $this->middleware('permission:أقسام-حذف', ['only' => ['destroy']]);
    }   public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->with(['admin', 'category', 'tags'])->paginate(10);
        $categories = Category::whereStatus("1")->get();
        $tags = Tag::whereStatus("1")->get();
        if (count($categories) == 0) {
            alert()->error('التصنيفات', 'لا يوجد تصنيفات');
            return redirect()->route('admin.categories.index');
        }
        if (count($tags) == 0) {
            alert()->error('وسوم', 'لا يوجد وسوم');
            return redirect()->route('admin.tags.index');
        }
        return view('admin.posts', compact('posts', 'categories', 'tags',));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->image) {
                $filename = UploadImage::create($request->image, 'assets/posts');
                $post =   Post::create([
                    'title' => $request->post('title'),
                    'description' => $request->post('description'),
                    'content' => Purify::clean(EditorArabic::editorContent($request->post('content'),"/upload/posts/")),
                    'status' => $request->post('status'),
                    'comment_able' => $request->post('comment_able'),
                    'admin_id' => auth()->id(),
                    'category_id' => $request->post('category_id'),
                    'image' => $filename,
                ]);
                if (!is_null($request->tags)) {
                    $post->tags()->sync($request->tags);
                } else {
                    alert()->warning('مقالات', 'يجيب اختاير وسوم');
                    return redirect()->route('admin.posts.index');
                }
            }
            DB::commit();
            alert()->success('مقالات', 'تم اضافة مقال بنجاح');
            return redirect()->route('admin.posts.index');
        } catch (Throwable $e) {
            DB::rollBack();
            return $e;
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::whereId($id)->with(['tags'])->first();
        if ($post) {
            return Response::json($post);
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
    public function update(PostsRequest $request)
    {
        $post = Post::whereId($request->id)->firstOrFail();
        if ($post) {
            if ($request->image) {
                if ($post->image) {
                    $data['image'] =  UploadImage::update($request->image, $post->image, 'assets/posts/');
                }
            }
            $data['title'] = $request->post('title');
            $data['content'] =  Purify::clean(EditorArabic::editorContent($request->post('content'),"/upload/posts/"));
            $data['description'] = $request->post('description');
            $data['category_id'] = $request->post('category_id');
            $data['status'] = $request->post('status');
            $data['comment_able'] = $request->post('comment_able');
            $post->update($data);
            if (count($request->tags) > 0) {
                $post->tags()->detach();
                $post->tags()->sync($request->tags);
            }
            alert()->success('مقالات', 'تم تعديل مقال بنجاح');
            return redirect()->route('admin.posts.index');
        } else {
            alert()->error('مقالات', 'هناك خطا ما');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $artical = Post::where('id', $request->id)
            ->whereTitle($request->title)->firstOrFail();
        if ($artical->image) {
            UploadImage::delete($artical->image, 'assets/posts');
        }
        $title = $artical->title;
        $artical->delete();
        alert()->warning('مقالات', 'تم حذف مقال بنجاح');
        return redirect()->route('admin.posts.index');
    }
    
}
