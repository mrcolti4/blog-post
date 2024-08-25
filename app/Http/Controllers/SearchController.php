<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->query("q", "");
        $posts = [];
        if ($query) {
            $search_posts = Post::search($query);

            $posts = $search_posts->paginate(10);
            $count = $search_posts->count();
        }

        return view("app.search", compact("posts", "count"));
    }
}
