<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('id','desc')->paginate(25);
        $user = User::all();
        return response()->json([
            'posts' => $post,
            'users' => $user
        ]);
    }

    public function allPosts(){
        $post = Post::paginate(10);
        $user = User::all();
        return response()->json([
            'posts' => $post,
            'users' => $user
        ]);
    }

    public function singlePosts($id){
        $post = Post::find($id);
        $user = User::all();
        return response()->json([
            'post' => $post,
            'users' => $user
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        $inputs = \request()->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'file'
        ]);


        if(request('image')){
            $inputs['image'] = \request('image')->store('images','public');
        }


        $user->posts()->create($inputs);
        return response()->json([
            "message" => "Succesfull"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
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
    public function update(Request $request, Post $post)
    {

        $inputs = \request()->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        if(request('image')){
            $inputs['image'] = \request('image')->store('images','public');
        }else{
            $inputs['image'] = $post->image;
        }

        $post->update($inputs);
        return response()->json([
            "message" => "Succesfull"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Storage::disk('public')->exists($post->product_image)) {
            $image = 'storage/' . $post->product_image;
            unlink($image);
        }
        $post->delete();
        return response()->json([
            "message" => "Successfully Deleted"
        ]);
    }



}
