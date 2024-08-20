<?php

namespace App\Actions;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreLikedAction
{
    public static function execute(Request $request, Post|Comment $post, string $operation): void
    {
        // if (!empty($likedPost)) {
        //     $likedPost->delete();
        // }
    }
}
