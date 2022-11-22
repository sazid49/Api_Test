<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
       
        return $posts;
    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $upload = $request->file->store('public/uploads/');
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->file->hashName();
        $result = $post->save();

        if($result)
        {
            return ['message'=>'data save success'];
        }else{
            return ['message'=>'data faild'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $postget= Post::query()->find($post);
         if($postget)
         {
            return response()->json($postget);
         }else{
            return ['message'=>'no data find'];
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$post)
    {
        $findpost = Post::find($post);

        $findpost->title=$request->title;
        $findpost->description=$request->description;
        $findpost->update();
        // if($result)
        // {
        //     return ['message'=>'update success'];
        // }else{
        //     return ['message'=>'update faild'];

        // }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $gePost = Post::query()->find($post);
         $gePost->delete();
        // if($result)
        // {
        //     return "delete Success";
        // }
    }
}
