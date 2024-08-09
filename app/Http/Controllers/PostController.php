<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    function index(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        return response()->json([
            'data'  => $posts,
        ]);
    }

    function addPost(Request $request){
        try{
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        // Create new post
        Post::create($validatedData);


        // return response()->json(['message' => 'Post created successfully', 'post' => $post], 200);
    } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }


    function addPostsIndex(){
        return view('addpost');
    }

    // function addPosts(Request $request){
    //     try{
    //     // Validate incoming request data
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'author' => 'required|string|max:255',
    //     ]);

    //     // Create new post
    //     $post = Post::create($validatedData);

    //     // Optionally, you can return the created post as JSON response
    //     return response()->json(['message' => 'Post created successfully', 'post' => $post], 200);
    // } catch (ValidationException $e) {
    //         return response()->json([
    //             'errors' => $e->errors()
    //         ], 422);
    //     }
    // }
    function addPosts(PostRequest $request){
        try{

        $post = Post::create($request->all());

        // Optionally, you can return the created post as JSON response
        Session::flash('newPost', 'successfully');
        return redirect(route('user.register'));
    } catch (Exception $e) {
            return back()->withErrors('error')->withInput();
        }
    }
}
