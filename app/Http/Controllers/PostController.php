<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    function index(){
        $posts = Post::all();
        return response()->json([
            'data'  => $posts,
        ]);
        // $posts = Post::all();
        // return response()->json([
        //     'data'  => $posts,
        // ]);
    }

    function addPost(Request $request){
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        // Create new post
        $post = Post::create($validatedData);

        // Optionally, you can return the created post as JSON response
        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
}
