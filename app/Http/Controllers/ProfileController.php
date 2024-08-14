<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Redirect;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view("app.user.profile", [
            "user" => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user): View
    {
        return view("app.user.profile-edit", [
            "user" => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attrs = $request->validate([
            "first_name" => "string|min:2",
            "last_name" => "string|min:2",
            "bio" => "string|min:10|max:300"
        ]);
        $user = Auth::user();
        if (empty($user->profile)) {
            $user->profile()->create($attrs);
        } else {
            $user->profile()->update($attrs);
        }


        return back()->with("success", "Your profile successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
