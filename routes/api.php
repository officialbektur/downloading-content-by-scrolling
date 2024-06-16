<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/posts', \App\Http\Controllers\Api\Post\IndexController::class)->name("api.post.index");
Route::get('/posts/{post}', \App\Http\Controllers\Api\Post\ShowController::class)->name("api.post.show");
