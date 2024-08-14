<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredController extends Controller
{
    public function create(): View
    {
        return view("auth.register");
    }

    public function store(Request $request): RedirectResponse
    {
        // validate
        $attrs = $request->validate([
            "username" => ["bail", "required", "min:3", "unique:users"],
            "email" => ["bail", "required", "email", "unique:users"],
            "password" => ["bail", "required", "min:6", "max:255", "confirmed"],
        ]);
        // try to instance in db
        $user = User::create($attrs);
        // auth
        Auth::login($user);
        // redirect
        return redirect()->to("home");
    }
}
