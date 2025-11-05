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
    Route::resource('posts', PostController::class);

}
