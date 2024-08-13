<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdatePassword extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return "Updated password";
    }
}
