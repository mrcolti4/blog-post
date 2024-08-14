@extends('layouts.home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
@endsection

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
            <x-user.title>Published posts</x-user>
            <x-user.posts-slider>
                @forelse($user->posts as $post)
                    <div class="swiper-slide">
                        <a href="{{ route('users.id.posts.show', ['user' => $user, 'post'=> $post]) }}">
                            {{$post->title}}
                        </a>
                    </div>
                    @empty
                    Not published yet
                @endforelse
            </x-user.posts-slider>
        </x-user>
            @else
            <h2>User not found!</h2>
        @endif
    </div>
</section>
@endsection
@section('scripts')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/profile-slider.js') }}"></script>
@endsection
