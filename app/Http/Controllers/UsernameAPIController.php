<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsernameRequest;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Info(title="UsernameRequest", version="0.1")
 */

class UsernameAPIController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/username",
     *     summary="Validate and save username",
     *     description="This endpoint validates the username and saves it if it is valid.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="username", type="string", example="john_doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Username is valid and saved successfully!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Username is valid and saved successfully!")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="The ID of the user"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={"username": {"The username field is required."}}
     *             )
     *         )
     *     )
     * )
     */
    function username(UsernameRequest $request)
    {
        try {
            dd($request);
            return response()->json(['message' => 'Username is valid and saved successfully!'], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

}
