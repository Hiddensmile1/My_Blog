<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Tags fetched successfully!',
            'data' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    { $tags = Tag::create([
        'name' => $request->name,
        'description' => $request->description
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Tag created successfully!',
        'data' => $tags
    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        
        try{
            return response()->json([
                'status' => true,
                'message' => 'Tag created successfully!',
                'data' => $tag
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
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        
        $tag->update([
            'name' => $request->name ?? $tag->name,
            'description' => $request->description ?? $tag->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tag has been updated successfully!'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Tag has been deleted successfully!'
            ]);
        }
    }
    
}
