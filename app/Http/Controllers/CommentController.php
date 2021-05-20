<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function addComment(Request $request){

        $inputs = request()->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $post = Post::find(request()->id);
        $description = request()->description;
        $name = request()->name;

        $post->comments()->create(['name'=>$name,'description'=>$description]);
        return response()->json([
            "message" => "Successfull"
        ]);
    }

    public function viewComment($id){
        $comments = Post::find($id)->comments;
        return response()->json([
            "comments" => $comments
        ]);
    }
}
