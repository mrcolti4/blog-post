<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UpdatePassword extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            "old_password" => "required|string",
            "password" => "required|confirmed|string|min:6"
        ]);
        $user = Auth::user();
        if (!Hash::check($request->get("old_password"), $user->password)) {
            return back()->with("error", "Wrong password");
        }
        if ($request->old_password === $request->password) {
            return back()->with("error", "Password cannot be the same");
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with("success", "Password changed successfully");
    }
}
