<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    function welcome(){
        $posts = Post::all();
        Cache::put('post.id', $posts->first()->id, 60);
        return view('welcome',compact('posts'));
    }

    function index(Request $request){
        try {
            // dd($request);
            $searchString = [
                'title' => null,
                'content' => null,
                'author' => null,
            ];

            $searchString = $request->has('searchString')
            ? $request->searchString
            : $searchString;

            Session::put('post.searchString', $searchString);

            $posts = Post::query();
            // 検索する文字列で検索
            if (!empty($searchString)) {
                $posts = $posts->where(function ($query) use ($searchString) {
                    $query->where(DB::raw('LOWER(title)'), 'like', '%' . mb_strtolower($searchString['title']) . '%')
                    ->where(DB::raw('LOWER(content)'), 'like', '%' . mb_strtolower($searchString['content']) . '%')
                    ->where(DB::raw('LOWER(author)'), 'like', '%' . mb_strtolower($searchString['author']) . '%');
                });
            }
            $posts = $posts->get();

            return view('index', compact('posts'));
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-POST, ' . $e->getMessage());
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
            $id = Session::pull('post.id') ?? Cache::get('post.id');
            $post = Post::find($id);
            if (empty($post)) return redirect(route('index'))->withErrors(['error' => 'This post does not exist']);
            $post->title      = $request->title;
            $post->content    = $request->content;
            $post->author     = $request->author;
            // save DB
            $post->save();
            Session::put('post.info', 'Post updated successfully');
            return back()->withInput();
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



