<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::whereNotIn('post_type', [1, 3])->orderBy('id', 'DESC')->get();
        return view('backend.admin.post.index', compact('posts'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dd_categorie_posts = CategoryPost::whereNotIn('id', [1, 3])->orderBy('order')->get();
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
        $dd_categorie_posts = array_pluck($newArray, 'name', 'id');
        return view('backend.admin.post.create', compact('roles', 'dd_categorie_posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $seoTitle = $request->input('seo_title');
        $seoDescription = $request->input('seo_description');
        $seoKeywords=$request->input('seo_keywords');
        $isActive = $request->input('post_is_active');
        $image = $request->input('image');
        if ($image) {
            $image = substr($image, strpos($image, 'images'), strlen($image) - 1);
            $post->image = $image;
        }
        $post_type = $request->input('parent');
        if ($isActive) {
            $post->isActive = 1;
        } else {
            $post->isActive = 0;
        }
        if ($description) {
            $post->description = $description;
        }
        if ($seoTitle) {
            $post->seo_title = $seoTitle;
        }
        if ($seoDescription) {
            $post->seo_description = $seoDescription;
        }
        if ($seoKeywords) {
            $post->seo_keywords = $seoKeywords;
        }
        $post->title = $title;
        $post->path = chuyen_chuoi_thanh_path($title);

        $post->content = $content;
        $post->post_type = $post_type;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route('post.index')->with('success', 'Tạo Mới Thành Công Bài Viết');
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
        $post = Post::find($id);
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
        $dd_categorie_posts = array_pluck($newArray, 'name', 'id');
        $dd_categorie_posts = array_map(function ($index, $value) {
            return ['index' => $index, 'value' => $value];
        }, array_keys($dd_categorie_posts), $dd_categorie_posts);
        return view('backend.admin.post.edit', compact('post', 'dd_categorie_posts'));
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
        $post = Post::find($id);
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $seoTitle = $request->input('seo_title');
        $seoDescription = $request->input('seo_description');
        $seoKeywords=$request->input('seo_keywords');
        $isActive = $request->input('post_is_active');
        $image = $request->input('image');
        if ($image) {
            $image = substr($image, strpos($image, 'images'), strlen($image) - 1);
            $post->image = $image;
        } else {
            $post->image = NULL;
        }
        $post_type = $request->input('parent');
        if ($isActive) {
            $post->isActive = 1;
        } else {
            $post->isActive = 0;
        }
        if ($description) {
            $post->description = $description;
        }
        if ($seoTitle) {
            $post->seo_title = $seoTitle;
        }
        if ($seoDescription) {
            $post->seo_description = $seoDescription;
        }
        if ($seoKeywords) {
            $post->seo_keywords = $seoKeywords;
        }
        $post->title = $title;
        $post->path = chuyen_chuoi_thanh_path($title);

        $post->content = $content;
        $post->post_type = $post_type;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route('post.index')->with('success', 'Cập Nhật Thành Công Bài Viết');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
