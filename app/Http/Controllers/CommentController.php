<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
        $comments = Post::find($id)->comments()->orderBy('id','desc')->get();
        return response()->json([
            "comments" => $comments
        ]);
    }

    public function deleteComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json([
            "message" => "Comment deleted successfully"
        ]);
    }
}
