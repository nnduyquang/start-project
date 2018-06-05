<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Post::where('post_type','=',IS_POST)->orderBy('id', 'DESC')->get();
        return view('backend.admin.page.index', compact('pages'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.page.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Post();
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $seoTitle = $request->input('seo_title');
        $seoDescription = $request->input('seo_description');
        $seoKeywords=$request->input('seo_keywords');
        $isActive = $request->input('page_is_active');
        $image = $request->input('image');
        $image = substr($image, strpos($image, 'images'), strlen($image) - 1);
        if ($isActive) {
            $page->isActive = 1;
        } else {
            $page->isActive = 0;
        }
        if ($description) {
            $page->description = $description;
        }
        if ($seoTitle) {
            $page->seo_title = $seoTitle;
        }
        if ($seoDescription) {
            $page->seo_description = $seoDescription;
        }
        if ($seoKeywords) {
            $page->seo_keywords = $seoKeywords;
        }
        $page->title = $title;
        $page->path = chuyen_chuoi_thanh_path($title);
        $page->image = $image;
        $page->content = $content;
        $page->post_type = IS_PAGE;
        $page->user_id = Auth::user()->id;
        $page->save();
        return redirect()->route('page.index')
            ->with('success', 'Tạo Mới Thành Công Trang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Post::find($id);
        return view('backend.admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Post::find($id);;
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $seoTitle = $request->input('seo_title');
        $seoDescription = $request->input('seo_description');
        $seoKeywords=$request->input('seo_keywords');
        $isActive = $request->input('page_is_active');
        $image = $request->input('image');
        $image = substr($image, strpos($image, 'images'), strlen($image) - 1);
        if ($isActive) {
            $page->isActive = 1;
        } else {
            $page->isActive = 0;
        }
        if ($description) {
            $page->description = $description;
        }
        if ($seoTitle) {
            $page->seo_title = $seoTitle;
        }
        if ($seoDescription) {
            $page->seo_description = $seoDescription;
        }
        if ($seoKeywords) {
            $page->seo_keywords = $seoKeywords;
        }
        $page->title = $title;
        $page->path = chuyen_chuoi_thanh_path($title);
        $page->image = $image;
        $page->content = $content;
        $page->post_type = IS_PAGE;
        $page->user_id = Auth::user()->id;
        $page->save();
        return redirect()->route('page.index')
            ->with('success', 'Cập Nhật Thành Công Trang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Post::find($id);
        $page->delete();
        return redirect()->route('page.index')
            ->with('success', 'Đã Xóa Thành Công');
    }
    public function search(Request $request)
    {
        $keywords = preg_replace('/\s+/', ' ', $request->input('txtSearch'));
        $pages = Post::where('title', 'like', '%' . $keywords . '%')->orderBy('id', 'DESC')->paginate(5);
        return view('backend.admin.page.index', compact('pages', 'keywords'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
