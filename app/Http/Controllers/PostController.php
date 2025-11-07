<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //POST api/posts
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully.',
            'data' => $post
        ], 201); // 201 = Created
    }

    /**
     * Display a listing of the posts.
     */
    //GET api/posts
    public function index()
    {
        // Fetch posts ordered by latest first and paginate
        //$posts = Post::latest()->simplePaginate(5); // you can change '10' to desired per-page count
        //$posts = Post::orderBy('created_at','desc')->simplePaginate(5);
        //$posts = DB::table('posts')->orderBy('created_at','desc')->simplePaginate(5);
        $posts = DB::table('posts')->orderByDesc('created_at')->simplePaginate(5);
        
        // Return paginated posts as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Posts retrieved successfully.',
            'posts' => $posts
        ]);
    }

}
