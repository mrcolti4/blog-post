<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersPostsController;
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
    return view('welcome');
});

Route::get("/home", function () {
    return redirect()->route("users.id.", ["id" => "1"]);
    return view("app.home");
})->name("home")->middleware("auth");

Route::get("/register", [RegisteredController::class, "create"]);

Route::post("/register", [RegisteredController::class, "store"]);

Route::get("/login", [SessionController::class, "create"])->name("login");

Route::post("/login", [SessionController::class, "store"]);

Route::prefix("profile")->group(function () {
    Route::get("/", function () {
        return "My profile";
    });
    Route::get("/{id}", function ($id) {
        return "Profile by $id";
    });
});

Route::name("users.")->prefix("users")->group(function () {
    Route::get("/", [UsersController::class, "index"]);

    Route::name("id.")->prefix("{id}")->group(function () {
        Route::get("/", [UsersController::class, "show"]);

        Route::name("posts.")->prefix("posts")->group(function () {
            Route::get("/", [UsersPostsController::class, "index"]);

            Route::get("/{post}", [UsersPostsController::class, "single"]);
        });
    });
});
