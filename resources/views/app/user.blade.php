<div>
    @if ($user)
        <h2>{{$user->username}}</h2>
        <p>{{$user->profile->bio}}</p>
    @else
        <h2>User not found!</h2>
    @endif
</div>
