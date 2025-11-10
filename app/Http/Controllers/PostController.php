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
    //POST api/posts - Eloquent version, no model binding possible
    // store() does not use model binding, because it doesn’t reference an existing post — it creates a new one.
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully.',
            'data' => $post
        ], 201); // 201 = Created
    }

    // POST api/posts - Query builder version
    // public function store(PostRequest $request)
    // {
    //     // Insert the post using validated data and get the new ID
    //     $id = DB::table('posts')->insertGetId([
    //         'title' => $request->validated()['title'],
    //         'body' => $request->validated()['body'],
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     // Fetch the newly created post
    //     $post = DB::table('posts')->where('id', $id)->first();

    //     // Return success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Post created successfully.',
    //         'data' => $post
    //     ], 201); // 201 = Created
    // }


    //GET api/posts  Get listing of the posts.
    public function index()
    {
        // Fetch posts ordered by latest first and paginate
        // Eloquent version
        $posts = Post::orderBy('created_at','desc')->simplePaginate(5);
        
        // Query builder version
        // $posts = DB::table('posts')->orderByDesc('created_at')->simplePaginate(5);

        // Simple select query
        // $posts = DB::select('select * from posts order by created_at desc'); but no paggination here possible so use Query builder as last resourt
        
        // Return paginated posts as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Posts retrieved successfully.',
            'posts' => $posts
        ], 200);
    }

    
    // PUT or PATCH Update Post  api/posts/{id} - Eloquent with Automatic Model binding
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successfully.',
            'data' => $post
        ], 200);
    }

    // PUT or PATCH Update Post  - Eloquent version only
    // public function update(PostRequest $request, $id)
    // {
    //     // Find the post by ID
    //     $post = Post::find($id);

    //     // If post not found, return error response
    //     if (!$post) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Post not found.'
    //         ], 404);
    //     }

    //     // Update post with validated data
    //     $post->update($request->validated());

    //     // Return success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Post updated successfully.',
    //         'data' => $post
    //     ], 200); // 200 = OK
    // }


    // PUT or PATCH Update Post  - Query builder version
    // public function update(PostRequest $request, $id)
    // {
    //     // Check if the post exists
    //     $post = DB::table('posts')->where('id', $id)->first();

    //     // If post not found, return error response
    //     if (!$post) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Post not found.'
    //         ], 404);
    //     }

    //     // Update the post record
    //     DB::table('posts')->where('id', $id)->update([
    //         'title' => $request->validated()['title'],
    //         'body' => $request->validated()['body'],
    //         'updated_at' => now(),
    //     ]);

    //     // Retrieve the updated post
    //     $updatedPost = DB::table('posts')->where('id', $id)->first();

    //     // Return success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Post updated successfully.',
    //         'data' => $updatedPost
    //     ], 200);
    // }

    
    // DELETE api/posts/{post} Eloquent with  Automatic model binding
    public function destroy(Post $post)
    {
        // Delete the post
        $post->delete();

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Post deleted successfully.'
        ], 200);
    }

    // DELETE api/posts/{id} - as Eloquent version
    // public function destroy($id)
    // {
    //     // Find the post by ID
    //     $post = Post::find($id);

    //     // If post not found, return error response
    //     if (!$post) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Post not found.'
    //         ], 404);
    //     }

    //     // Delete the post
    //     $post->delete();

    //     // Return success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Post deleted successfully.'
    //     ], 200);
    // }

    // DELETE api/posts/{id} - as Query builder version
    // public function destroy($id)
    // {
    //     // Check if the post exists
    //     $post = DB::table('posts')->where('id', $id)->first();

    //     // If post not found, return error response
    //     if (!$post) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Post not found.'
    //         ], 404);
    //     }

    //     // Delete the post
    //     DB::table('posts')->where('id', $id)->delete();

    //     // Return success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Post deleted successfully.'
    //     ], 200);
    // }


    // GET /api/posts/{post} - SHOW single post  with Automatic model binding
    public function show(Post $post)
    {
        return response()->json([
            'post' => $post
        ], 200);
    }

    // GET /api/posts/{id}  SHOW single post Eloquent only
    // public function show($id)
    // {
    //     $post = Post::find($id);

    //     if (!$post) {
    //         return response()->json([
    //             'message' => 'Post not found'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'post' => $post
    //     ], 200);
    // }
}
