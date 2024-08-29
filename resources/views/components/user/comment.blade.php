@props(['comment'])

<div data-id="{{$comment->id}}" class="comment" data-target-type="comment">
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-4">
            <img src="{{$comment->user->profile->image ?? asset('images/default-avatar.svg')}}" alt="avatar" class="w-10 h-10 rounded-xl" />
            <p class="font-bold">{{$comment->user->username}}</p>
            <p>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
        </div>
        <div class="flex gap-3 ml-auto text-lg">
            <x-vote-buttons :target="$comment" name="comment" />
        </div>
    </div>
    <p class="mt-3">
        {{$comment->body}}
    </p>
</div>
