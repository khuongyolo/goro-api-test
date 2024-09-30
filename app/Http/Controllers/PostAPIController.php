<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PostAPIRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PostAPIController extends Controller
{
    function index(Request $request)
    {
        try {
            $perPage = $request->input('size', 10); 
            $page = intval($request->input('page', 1));

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
            if (!empty($searchString)) {
                $posts = $posts->where(function ($query) use ($searchString) {
                    $query->where(DB::raw('LOWER(title)'), 'like', '%' . mb_strtolower($searchString['title']) . '%')
                    ->where(DB::raw('LOWER(content)'), 'like', '%' . mb_strtolower($searchString['content']) . '%')
                    ->where(DB::raw('LOWER(author)'), 'like', '%' . mb_strtolower($searchString['author']) . '%');
                });
            }
            $posts = $posts->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);

            $response = [
                'desc' => true,
                'data' => $posts->items(),
                'page' => $page,
                'size' => $perPage,
                'sortBy' => 'created_at',
                'totals' => $posts->total(),
                'view'  => '/api/index?' . 'page=' . $page,
            ];

            return response()->json($response, Response::HTTP_OK); //200
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return response()->json([
                'redirect'  => '/api/index',
                'error' => 'An unexpected error occurred',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR); //500
        }
    }

    function edit($id)
    {
        try {
            $post = Post::find($id);
            if (empty($post)) {
                return response()->json([
                    'redirect' => '/api/index',
                    'error' => 'This post does not exist'
                ], Response::HTTP_NOT_FOUND); // 404 Not Found
            }

            Cache::put('post.id', $post->id, 60);
            return response()->json([
                'view'  => '/api/edit/' . $id,
                'data'  => $post,
            ]);
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return response()->json([
                'redirect'  => '/api/index',
                'error' => 'An unexpected error occurred',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR); //500
        }
    }

    function update(PostAPIRequest $request)
    {
        try {
            $id = (Cache::get('post.id'));
            $post = Post::find($id);
            if (empty($post)) {
                return response()->json([
                    'redirect' => '/api/index',
                    'error' => 'This post does not exist',
                    'id'    => $id
                ], Response::HTTP_NOT_FOUND); // 404 Not Found
            }

            $post->title      = $request->title;
            $post->content    = $request->content;
            $post->author     = $request->author;
            // save DB
            $post->save();
            return response()->json([
                'redirect'  => '/api/edit/' . $id,
                'message'   => 'Post updated successfully',
            ], Response::HTTP_OK);  //200
        }
        catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY); //422
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return response()->json([
                'redirect'  => '/api/index',
                'error' => 'An unexpected error occurred',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR); //500
        }
    }

    function delete($id)
    {
        try {
            $post = Post::find($id);
            if ($post) $post->delete();

            return response()->json([
                'redirect'  => '/api/index',
                'message' => 'Post has been successfully deleted.',
            ], Response::HTTP_OK); // 200 OK
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return response()->json([
                'redirect'  => '/api/index',
                'error' => 'An unexpected error occurred',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR); //500 Internal Server Error
        }
    }


    function register(PostAPIRequest $request)
    {
        try {
            Post::create($request->all());

            return response()->json([
                'status' => 'successfully',
            ], Response::HTTP_CREATED); // 201 Created
        }
        catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY); //422
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return response()->json([
                'redirect'  => '/api/index',
                'error' => 'An unexpected error occurred',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR); //500
        }
    }
}



