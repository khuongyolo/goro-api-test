<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsernameRequest;
use Illuminate\Validation\ValidationException;


class UsernameController extends Controller
{
    function index() {
        return view('username');
    }


    function username(UsernameRequest $request)
    {
        try {
            return response()->json(['message' => 'Username is valid and saved successfully!'], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

}
