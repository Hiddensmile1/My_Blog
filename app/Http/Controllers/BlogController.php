<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blog = Blog::find(1);
        // foreach ($blog->tags as $tag) {
        // echo $tag->pivot->created_at;
        // }
        //$blogs = Blog::all();
        $blogs = Blog::latest()->with(['category', 'admin', 'tag'])->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Blogs fetched successfully!',
            'data' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create([
            'title' => $request->title,
            'admin_id' => $request->user()->id,
            'body' => $request->body,
            'img_url' =>$request->img_url,
            'category_id' =>$request->category_id
        ]);

        $blog->tag()->syncWithoutDetaching($request->tag);

        return response()->json([
            'status' => true,
            'message' => 'Blog created successfully!',
            'data' => $blog
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {

        // return $blog
        return $blog->with(['category', 'admin']);
        try{
            return response()->json([
                'status' => true,
                'message' => 'Blog created successfully!',
                'data' => $blog->with(['category', 'admin'])
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'. $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update([
            'title' => $request->title,
            'body' => $request->body,
            'img_url' =>$request->img_url,
            'category_id' =>$request->category_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Blog has been updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if($blog->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Blog has been deleted successfully!'
            ]);
        }
    }
    
}
