<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // Get all categories
        $categories = Category::all();
        // Get search query and selected categories
        $query = $request->query("query", "");
        $selectedCategories = $request->query("categories", "");
        // Search posts by query or categories
        $query = strtolower($query);
        $search_posts = $query ? Post::search($query) : Post::latest()->get();
        if ($selectedCategories) {
            $search_posts = $search_posts->whereIn("category_id", $selectedCategories);
        }

        $posts = $search_posts->paginate(10);
        $count = $search_posts->count();

        return view("app.search", compact("posts", "count", "categories"));
    }
}
