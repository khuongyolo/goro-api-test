<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    function welcome(){
        $posts = Post::all();
        return view('welcome',compact('posts'));
    }

    function index(){
        Session::put('collapse', 1);
        try {
            $posts = Post::all();
            return view('index', compact('posts'));
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }
    }

    function edit($id){
        try {
            $post = Post::find($id);
            if (empty($post)) return back()->withErrors(['error' => 'This post does not exist or has been deleted.'])->withInput();

            Session::put('post.id', $id);
            return view('edit', compact('post'));
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }
    }

    function update(PostRequest $request) {
        try {
            $id = Session::pull('post.id');
            // dd($request->title);
            $post = Post::find($id);
            if (empty($post)) return redirect(route('index'))->withErrors(['error' => 'This post does not exist']);
            $post->title      = $request->title;
            $post->content    = $request->content;
            $post->author     = $request->author;
            // save DB
            $post->save();
            Session::put('post.info', 'Post updated successfully');
            return redirect(route('edit', ['id' => $id]));
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }
    }

    function delete($id){
        try {
            $post = Post::find($id);
            if ($post) $post->delete();
            Session::put('post.info', 'Post has been successfully deleted.');

            return redirect(route('index'));
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }
    }


    function register(PostRequest $request){
        Session::put('collapse', 1);
        try{
            if ($request->method() ==  'GET') return view('register');
            Post::create($request->all());
            // Optionally, you can return the created post as JSON response
            Session::flash('newPost', 'successfully');
            return redirect(route('register'));
        }
        catch (ValidationException $e) {
            dd(Session::get('collapse'));
            return back()->withErrors('error')->withInput();
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }

    }
}



