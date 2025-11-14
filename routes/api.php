<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Laravel’s Route Registrar now automatically recognizes routes/api.php as an “API route file” 
// and applies the prefix internally, so you don’t need to define /api manually in your routes.
// http://localhost:8000/api/user
// bootstrap/app.php withRouting() has got config for prefix api

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// sanctum protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Generate all of the routes
    //Route::resource('posts', PostController::class);

    // Store a new post (store)
    Route::post('/posts', [PostController::class, 'store']);

    // Get all posts (index)
    Route::get('/posts', [PostController::class, 'index'])->withoutMiddleware('auth:sanctum');    
    
    // Put for updating post
    Route::put('/posts/{post}', [PostController::class, 'update']);

    // Show post
    Route::get('/posts/{post}', [PostController::class, 'show'])->withoutMiddleware('auth:sanctum');

    // Delete post 
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

});
