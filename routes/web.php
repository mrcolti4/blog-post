<?php

use App\Http\Controllers\AddComment;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\ImageUpload;
use App\Http\Controllers\PopularPostsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\UpdatePassword;
use App\Http\Controllers\VoteController;
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


Route::get("/register", [RegisteredController::class, "create"])->name('register.create');

Route::post("/register", [RegisteredController::class, "store"])->name('register.store');

Route::get("/login", [SessionController::class, "create"])->name("login");

Route::post("/login", [SessionController::class, "store"])->name("login.store");

Route::delete("/login", [SessionController::class, "destroy"])->name("login.destroy");

Route::get("/forgot-password", function () {
    return view("auth.forgot-password");
})->name("password.request");
Route::post("/forgot-password", ForgotPassword::class)->name("password.email");

Route::get("/home", function () {
    return view("app.home");
})->name("home")->middleware("auth");

Route::name("search.")->prefix("search")->group(function () {
    Route::get("/", SearchController::class)->name("index");
});

// Edit user information and update password
Route::name("user.")->prefix("user")->group(function () {
    Route::get("/edit", [UsersController::class, "edit"])->name("edit")->middleware("auth");
    Route::post("/update", [UsersController::class, "update"])->name("update")->middleware("auth");

    Route::name("password.")->prefix("update-password")->group(function () {
        Route::post("/", UpdatePassword::class)->name("update");
    });
});

// Edit profile information
Route::name("profile.")->prefix("profile")->group(function () {
    Route::get("/", [ProfileController::class, "index"])->name("index")->middleware("auth");
    Route::get("/edit", [ProfileController::class, "edit"])->name("edit")->middleware("auth");
    Route::post("/update", [ProfileController::class, "update"])->name("update")->middleware("auth");
})->middleware("auth");

// Show, create posts and comments
Route::name("posts.")->prefix("posts")->group(function () {
    Route::get("/", [PostsController::class, "index"])->name("index");
    Route::get("/popular", PopularPostsController::class)->name("popular");

    Route::get("/create", [PostsController::class, "create"])->name("create")->middleware("auth");
    Route::post("/store", [PostsController::class, "store"])->name("store")->middleware("auth");

    Route::prefix("{post}")->group(function () {
        Route::get("/", [UsersPostsController::class, "show"])->name("show");
        Route::name("comments.")->prefix("comments")->group(function () {
            Route::get("/index", [CommentsController::class, "index"])->name("index");
            Route::post("/store", [CommentsController::class, "store"])->name("store")->middleware("auth");
        });
    });
});
// Likes and dislikes
Route::post("/vote/{type}/{id}", VoteController::class)->name("vote.index")->middleware("auth");
// Show all users
Route::name("users.")->prefix("users")->group(function () {
    Route::get("/", [UsersController::class, "index"])->name("index");

    Route::name("id.")->prefix("{user:username}")->group(function () {
        Route::get("/", [UsersController::class, "show"])->name("show");

        // Show profile by username
        Route::name("profile.")->prefix("profile")->group(function () {
            Route::get("/", [ProfileController::class, "show"])->name("show");
        });
        // Show posts by username
        Route::name("posts.")->prefix("posts")->group(function () {
            Route::get("/", [UsersPostsController::class, "index"])->name("index");
        });
    });
});

Route::get("/upload-image", [ImageUpload::class]);

Route::fallback(function () {
    return "Not found 404";
});
