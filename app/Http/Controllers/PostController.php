<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully.',
            'data' => $post
        ], 201); // 201 = Created
    }
}
