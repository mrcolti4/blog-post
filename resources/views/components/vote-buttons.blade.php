@props(['target'])

@php
    $action_type = false;
    if(auth()->user()) {
        $liked = $target->activities->where("user_id", auth()->id())->where("target_id", $target->id)->first();
        $action_type = $liked->action_type ?? false;
    }
@endphp

<button data-vote-event="like" data-vote-target="$target" class="like-btn {{$action_type === 'like' ? 'active' : ''}}">
    <i class="{{$action_type === 'like' ? 'fa-solid' : 'fa-regular'}} fa-thumbs-up text-green-500"></i>
</button>
<span class="comment-likes-count">{{$target->likes}}</span>
<button data-vote-event="dislike" data-vote-target="$target" class="dislike-btn {{$action_type === 'dislike' ? 'active' : ''}}">
    <i class="{{$action_type === 'dislike' ? 'fa-solid' : 'fa-regular'}} fa-regular fa-thumbs-down text-red-500 "></i>
</button>

