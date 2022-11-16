<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index($id=null)
    {
           $posts = $id?Post::find($id):Post::all();
        //    dd($posts->toArray());
        //    return $posts;

        return $posts;
    }

  

    public function addpost(Request $request)
    {
         
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return ['message'=>'input plz'];
        }
       
        $post = new Post;
        $post->title=$request->title;
        $post->description=$request->description;
        $result =$post->save();

        if($result)
        {
            return ['message'=>'data save success'];
        }else{
            return ['message'=>'data faild'];
        }
    }

    public function updatePost(Request $request,$id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description=$request->description;
        $result=$post->update();
        if($result)
        {
            return ['message'=>'update success'];
        }else{
            return ['message'=>'update faild'];

        }
    }

    public function deletepost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return ['message'=>'data delete success'];
    }

    public function searchpost($name)
    {
        $search = Post::query()
                        ->where('title','LIKE',"%$name%")
                        ->orWhere('description','LIKE',"%$name%")
                        ->get();
                        if(count($search)){
                            return $search;
                        } else {
                            return [['Result', 'No records found']];
                        }

    }

    public function fileUpload(Request $request)
    {
        return ['message'=>'hello'];
    }
}
