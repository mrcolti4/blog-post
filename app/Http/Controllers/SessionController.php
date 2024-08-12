<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function create(): View
    {
        return view("auth.login");
    }
    public function store(Request $request): RedirectResponse
    {
        $attrs = $request->validate([
            "username" => ["required"],
            "password" => ["required"]
        ]);

        if (!Auth::attempt($attrs)) {
            throw ValidationException::withMessages([
                "login" => "Invalid username or password",
            ]);
        }
        $request->session()->regenerate();

        return to_route("home");
    }

    public function destroy()
    {
        Auth::logout();

        return redirect("/login");
    }
}
