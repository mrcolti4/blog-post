<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->query("q", "");
        $search_posts = null;
        if ($query) {
            $search_posts = Post::search($query)->get();
        }

        return view("app.search", [
            "posts" => $search_posts
        ]);
    }
}
