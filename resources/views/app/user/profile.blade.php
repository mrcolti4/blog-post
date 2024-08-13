@extends('layouts.home')

@section('content')
<section class="container mx-auto pt-5">
    @if ($user)
    <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-3 md:grid-rows-2 gap-8">
        <x-user.panel class="md:row-start-1 md:row-end-3">
            <x-user.title>User info</x-user>
            <img src={{$user->profile->image}}/>
            <x-user.text>{{$user->username}}</x-user>
            <x-user.text>{{$user->email}}</x-user>
            <x-user.text>{{$user->profile->first_name}} {{$user->profile->last_name}}</x-user>
        </x-user>
        <x-user.panel>
            <x-user.title>User bio</x-user>
            <x-user.text>{{$user->profile->bio}}</x-user>
        </x-user>
        <x-user.panel>
            <x-user.title>Favourite posts</x-user>
        </x-user>
            @else
            <h2>User not found!</h2>
        @endif
    </div>
</section>
@endsection
