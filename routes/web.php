<?php

use App\Http\Controllers\AddComment;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\ImageUpload;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\UpdatePassword;
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

Route::get("/forgot-password", function () {
    return view("auth.forgot-password");
})->name("password.request");
Route::post("/forgot-password", ForgotPassword::class)->name("password.email");

Route::name("user.")->prefix("user")->group(function () {
    Route::get("/edit", [UsersController::class, "edit"])->name("edit")->middleware("auth");
    Route::post("/update", [UsersController::class, "update"])->name("update")->middleware("auth");

    Route::name("password.")->prefix("update-password")->group(function () {
        Route::post("/", UpdatePassword::class)->name("update");
    });
});

Route::name("profile.")->prefix("profile")->group(function () {
    Route::get("/", [ProfileController::class, "index"])->name("index");
    Route::get("/edit", [ProfileController::class, "edit"])->name("edit")->middleware("auth");
    Route::post("/update", [ProfileController::class, "update"])->name("update")->middleware("auth");
});

Route::name("posts.")->prefix("posts")->group(function () {
    Route::get("/", [UsersPostsController::class, "index"])->name("index");
    Route::get("/{post}", [UsersPostsController::class, "show"])->name("show");
    Route::get("/create", [PostsController::class, "create"])->name("create")->middleware("auth");
    Route::post("/store", [PostsController::class, "store"])->name("store")->middleware("auth");

    Route::name("comments.")->prefix("{post}")->group(function () {
        Route::post("/store", AddComment::class)->name("store")->middleware("auth");
    });
});


Route::name("users.")->prefix("users")->group(function () {
    Route::get("/", [UsersController::class, "index"])->name("index");

    Route::name("id.")->prefix("{user:username}")->group(function () {
        Route::get("/", [UsersController::class, "show"])->name("show");

        Route::name("profile.")->prefix("profile")->group(function () {
            Route::get("/", [ProfileController::class, "show"])->name("show");
        });
    });
});

Route::get("/upload-image", [ImageUpload::class]);

Route::fallback(function () {
    return "Not found 404";
});
