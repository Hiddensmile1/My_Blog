<?php

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('admin-login', [AdminController::class, 'login']);
Route::post('admin-register', [AdminController::class, 'register']);





Route::prefix('categories')->middleware('auth:sanctum')->group( function(){

    Route::post('create', [CategoryController::class, 'store']);
    Route::get('fetch', [CategoryController::class, 'index']);

    Route::get('view/{category}', [CategoryController::class, 'show']);
    Route::put('update/{category}', [CategoryController::class, 'update']);
    Route::delete('delete/{category}', [CategoryController::class, 'destroy']);
});


Route::prefix('blogs')->middleware('auth:sanctum')->group( function(){

    Route::post('create', [BlogController::class, 'store']);
    Route::get('fetch', [BlogController::class, 'index']);

    Route::get('view/{blog}', [BlogController::class, 'show']);
    Route::put('update/{blog}', [BlogController::class, 'update']);
    Route::delete('delete/{blog}', [BlogController::class, 'destroy']);
});


Route::prefix('tags')->middleware('auth:sanctum')->group( function(){

    Route::post('create', [TagController::class, 'store']);
    Route::get('fetch', [TagController::class, 'index']);

    Route::get('view/{tag}', [TagController::class, 'show']);
    Route::put('update/{tag}', [TagController::class, 'update']);
    Route::delete('delete/{tag}', [TagController::class, 'destroy']);
});


//User:
//Register
//Login
//Refresh
//Logout
//Search/FilterBlog
//SelectBlog


//Admin:
//Login
//Refresh
//Logout
//createBlog
//ReadBlog
//SelectBlog
//UpdateBlog
//DeleteBlog
//PublishBlog
//createCategory
//ReadCategory
//DeleteCategory
//createTag
//ReadTag
//DeleteTag