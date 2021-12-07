<?php

use Illuminate\Http\Response;
use App\Http\Controllers\Home;
use App\Http\Controllers\Books;
use App\Http\Controllers\Login;
use App\Http\Controllers\Comments;
use App\Http\Controllers\Register;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/home");
});

// Login
Route::get("/login", [Login::class, "index"]);
Route::post("/login", [Login::class, 'verifyUser']);
Route::post("/logout", [Login::class, 'logout']);
Route::get("/logout", [Login::class, 'logout']);

// Register
Route::get("/register", [Register::class, 'index']);
Route::post("/register", [Register::class, 'register']);

// Home
Route::get("/home", [Home::class, 'index']);
Route::post("/search/book", [Home::class, 'searchBook']);
Route::get("/search/book", function () {
    return redirect("/home");
});

// Books
Route::get("/book/create", [Books::class, 'index']);
Route::post("/book/create", [Books::class, 'createBook']);
Route::get("/book/{id}", [Books::class, 'bookPage']);
Route::post("/book/delete/{book_id}", [Books::class, 'deleteBook']);
Route::get("/book/delete/{book_id}", function () {
    return redirect("/home");
});

// Route::post("/book/comment", [Books::class, 'createComment']);


// Comments
Route::post("/comment/{book_id}", [Comments::class, 'addComment']);
Route::get("/comment/{book_id}", function () {
    return redirect("/home");
});


Route::get('/{slug?}', function () {
    return view("Error 404");
});

