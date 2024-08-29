<?php

namespace App\Http\Controllers\actions;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __invoke(User $user)
    {
        if ($user == auth()->user()) {
            return abort(403);
        }
        Activity::updateOrInsert([
            "user_id" => auth()->id(),
            "action_type" => "follow",
            "target_id" => $user->id,
            "target_type" => get_class($user),
        ]);
        dd("asd");
    }
}
