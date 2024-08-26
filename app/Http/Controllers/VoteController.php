<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $type, $id)
    {
        $model = $type === 'post' ? Post::findOrFail($id) : Comment::findOrFail($id);
        $event = $request->input("event", "like");

        if (!in_array($event, ["like", "dislike"])) {
            return response()->json(["error" => "Invalid event", 400]);
        }
        $post = $model->$event($request->user()->id);
        $result = $post->getLikesCount() - $post->getDislikesCount();

        return response()->json(["event" => $event, "result" => $result, "target" => [
            "id" => $post->id,
            "type" => get_class($post)
        ]]);
    }
}
