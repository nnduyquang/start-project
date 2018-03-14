<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use App\Post;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dd_categorie_posts = CategoryPost::orderBy('order')->get();
        foreach ($dd_categorie_posts as $key => $data) {
            if ($data->level == CATEGORY_POST_CAP_1) {
                $data->name = ' ---- ' . $data->name;
            } else if ($data->level == CATEGORY_POST_CAP_2) {
                $data->name = ' --------- ' . $data->name;
            } else if ($data->level == CATEGORY_POST_CAP_3) {
                $data->name = ' ------------------ ' . $data->name;
            }
        }
        $categoryposts = [];
        self::showCategoryPostDropDown($dd_categorie_posts, 0, $categoryposts);
        return view('backend.admin.categorypost.index', compact('categoryposts'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Post::where('post_type', 1)->get();
        $dd_categorie_posts = CategoryPost::orderBy('order')->get();
        foreach ($dd_categorie_posts as $key => $data) {
            if ($data->level == CATEGORY_POST_CAP_1) {
                $data->name = ' ---- ' . $data->name;
            } else if ($data->level == CATEGORY_POST_CAP_2) {
                $data->name = ' --------- ' . $data->name;
            } else if ($data->level == CATEGORY_POST_CAP_3) {
                $data->name = ' ------------------ ' . $data->name;
            }
        }
        $newArray = [];
        self::showCategoryPostDropDown($dd_categorie_posts, 0, $newArray);
        $dd_categorie_posts = array_prepend(array_pluck($newArray, 'name', 'id'), 'Cấp Cha', '-1');
        return view('backend.admin.categorypost.create', compact('roles','pages' ,'dd_categorie_posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorypost = new CategoryPost();
        $name = $request->input('name');
        $order = $request->input('order');
        $parentID = $request->input('parent');
        $pageId = $request->input('page_id');
        $template=$request->input('template');
        if ($parentID != CATEGORY_POST_CAP_CHA) {
            $categorypost->parent_id = $parentID;
            $level = CategoryPost::where('id', '=', $parentID)->first()->level;
            $categorypost->level = (int)$level + 1;
        } else
            $categorypost->level = 0;
        if ($order) {
            $categorypost->order = $order;
        }
        $categorypost->page_id = $pageId;
        $categorypost->template = $template;
        $categorypost->name = $name;
        $categorypost->path = chuyen_chuoi_thanh_path($name);
        $categorypost->save();
        return redirect()->route('categorypost.index')->with('success', 'Tạo Mới Thành Công Chuyên Mục');
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
        $categorypost = CategoryPost::find($id);
        $pages = Post::where('post_type', 1)->get();
        $dd_categorie_posts = CategoryPost::orderBy('order')->get();
        foreach ($dd_categorie_posts as $key => $data) {
            if ($data->level == CATEGORY_POST_CAP_1) {
                $data->name = ' ---- ' . $data->name;
            } else if ($data->level == CATEGORY_POST_CAP_2) {
                $data->name = ' --------- ' . $data->name;
            } else if ($data->level == CATEGORY_POST_CAP_3) {
                $data->name = ' ------------------ ' . $data->name;
            }
        }
        $newArray=[];
        self::showCategoryPostDropDown($dd_categorie_posts, 0, $newArray);
        $dd_categorie_posts = array_prepend(array_pluck($newArray, 'name', 'id'), 'Cấp Cha', '-1');
        $dd_categorie_posts = array_map(function ($index, $value) {
            return ['index' => $index, 'value' => $value];
        }, array_keys($dd_categorie_posts), $dd_categorie_posts);
        return view('backend.admin.categorypost.edit', compact('categorypost','pages','dd_categorie_posts'));
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
        $categorypost = CategoryPost::find($id);
        $name = $request->input('name');
        $order = $request->input('order');
        if ($order) {
            $categorypost->order = $order;
        }
        $parentID = $request->input('parent');
        $template=$request->input('template');
        $pageId = $request->input('page_id');
        if ($parentID != $categorypost->parent_id) {
            if ($parentID != CATEGORY_POST_CAP_CHA) {
                $categorypost->parent_id = $parentID;
                $level = CategoryPost::where('id', '=', $parentID)->first()->level;
                $categorypost->level = (int)$level + 1;
            } else {
                $categorypost->parent_id = 0;
                $categorypost->level = 0;
            }
        }
        $categorypost->page_id = $pageId;
        $categorypost->template = $template;
        $categorypost->name = $name;
        $categorypost->path = chuyen_chuoi_thanh_path($name);
        $categorypost->save();
        return redirect()->route('categorypost.index')->with('success', 'Cập Nhật Thành Công Chuyên Mục');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorypost = CategoryPost::find($id);
        $categorypost->delete();
        return redirect()->route('categorypost.index')->with('success', 'Đã Xóa Thành Công');
    }

    public function showCategoryPostDropDown($dd_categorie_posts, $parent_id = 0, &$newArray)
    {
        foreach ($dd_categorie_posts as $key => $data) {
            if ($data->parent_id == $parent_id) {
                array_push($newArray, $data);
                $dd_categorie_posts->forget($key);
                self::showCategoryPostDropDown($dd_categorie_posts, $data->id, $newArray);
            }
        }
    }


}
