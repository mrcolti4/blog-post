<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersPostsController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $popular_posts = Post::with("user")->orderBy("likes", "DESC")->paginate(3)->items();

    return view('welcome', [
        "popular_posts" => $popular_posts
    ]);
});

Route::get("/home", function () {
    return view("app.home");
})->name("home")->middleware("auth");

Route::get("/register", [RegisteredController::class, "create"])->name('register.create');

Route::post("/register", [RegisteredController::class, "store"])->name('register.store');

Route::get("/login", [SessionController::class, "create"])->name("login");

Route::post("/login", [SessionController::class, "store"])->name("login.store");

Route::delete("/login", [SessionController::class, "destroy"])->name("login.destroy");


Route::prefix("profile")->group(function () {
    Route::get("/", function () {
        return "My profile";
    });
    Route::get("/{id}", function ($id) {
        return "Profile by $id";
    });
});

Route::name("users.")->prefix("users")->group(function () {
    Route::get("/", [UsersController::class, "index"])->name("index");

    Route::name("id.")->prefix("{user:username}")->group(function () {
        Route::get("/", [UsersController::class, "show"])->name("show");

        Route::name("posts.")->prefix("posts")->group(function () {
            Route::get("/", [UsersPostsController::class, "index"])->name("index");

            Route::get("/{post}", [UsersPostsController::class, "show"])->name("show");
        });
    });
});

Route::fallback(function () {
    return "Not found 404";
});
