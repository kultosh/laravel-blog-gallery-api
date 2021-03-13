<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Blog as BlogResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\ShowBlog as ShowBlogResource;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::with('blogCategories.category')->orderBy('id', 'desc')->paginate(5);
        return BlogResource::collection($blog);
    }

    public function create()
    {
        $blog = Category::all();
        return CategoryResource::collection($blog);
    }

    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        $category = new BlogCategory();
        $category->blogs_id = $blog->id;
        $category->categories_id = $request->category_id;
        $category->save();
        if($blog->save())
        {
            return new BlogResource($blog);
        }
        return response()->json('fail');
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        $blog->date = Carbon::parse($blog->updated_at)->format('F d, Y');
        return new ShowBlogResource($blog);
    }

    public function edit($id)
    {
        $blog = Blog::with('blogCategories')->where('id',$id)->first();
        return new BlogResource($blog);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        $category = BlogCategory::where('blogs_id', $id)->first();
        $category->blogs_id = $id;
        $category->categories_id = $request->category_id;
        $category->save();

        return response()->json('success');
        return new BlogResource($blog);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return new BlogResource($blog);
    }
}
