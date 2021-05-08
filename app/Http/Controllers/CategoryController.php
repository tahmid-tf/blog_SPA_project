<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){

        $posts = Post::all();

        return response()->json([
            'posts' => $posts
        ]);
    }

    public function categoryPosts($category){
        $post = Post::where('category','=',$category)->paginate(10);
        $user = User::all();
        return response()->json([
            'posts' => $post,
            'users' => $user
        ]);
    }

    public function searchPosts($title){
        $post = Post::where('title', 'like', '%' . $title . '%')->paginate(10);
        $user = User::all();
        return response()->json([
            'posts' => $post,
            'users' => $user
        ]);
    }
}
