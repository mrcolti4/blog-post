<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->user()->unreadNotifications()
            ->when($request->input("id"), function ($query) use ($request) {
                return $query->where("id", $request->input("id"));
            })
            ->get()
            ->markAsRead();

        return response()->noContent();
    }
}
