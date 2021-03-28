<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;
use App\GalleryCategory;
use App\Http\Resources\Category as ResourcesCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Gallery as ResourcesGallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();
        return ResourcesGallery::collection($gallery);
    }

    public function create()
    {
        $categories = Category::all();
        return ResourcesCategory::collection($categories);
    }

    public function store(Request $request)
    {
        $gallery = new Gallery();
        // if($request->has('image'))
        // {
            $file = $request->image;
            // $path = pathinfo($file);
            // @list(, $getExtension) = explode('.', $request->image);
            // return response()->json($ext);
            // return response()->json($getExtension);
            $extension = explode('/', mime_content_type($file))[1];
            $base64_image = $file; // your base64 encoded
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);
            // return response()->json($file_data);
            $imageName = time().'_'.uniqid().'.'.$extension;
            Storage::disk('public')->put($imageName, base64_decode($file_data));
            $gallery->name = $imageName;
            $gallery->save();

            $galleryCategories = new GalleryCategory();
            $galleryCategories->galleries_id = $gallery->id;
            $galleryCategories->categories_id = $request->category_id;
            $galleryCategories->save();
            return response()->json('Upload success');
        // }
        // else
        // {
        //     return response()->json('No Image');
        // }
    }
}
