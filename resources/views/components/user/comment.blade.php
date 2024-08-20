@props(['comment'])

<div data-id="{{$comment->id}}">
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-4">
            <img src="{{$comment->user->profile->image ?? asset('images/default-avatar.svg')}}" alt="avatar" class="w-10 h-10 rounded-xl" />
            <p class="font-bold">{{$comment->user->username}}</p>
            <p>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
        </div>
        <div class="flex gap-3 ml-auto text-lg">
            <button data-vote-event="like" data-vote-target="comment">
                <i class="fa-regular fa-thumbs-up"></i>
            </button>
            <span>{{$comment->getLikesCount() - $comment->getDislikesCount()}}</span>
            <button data-vote-event="dislike" data-vote-target="comment">
                <i class="fa-regular fa-thumbs-down"></i>
            </button>
        </div>
    </div>
    <p class="mt-3">
        {{$comment->body}}
    </p>
</div>
