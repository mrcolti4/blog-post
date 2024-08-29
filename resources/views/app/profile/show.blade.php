@extends('layouts.home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
@endsection

@section('content')
<section class="container mx-auto py-5">
    @if ($user)
    <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-4 md:grid-rows-2 gap-8">
        <x-user.panel>
            <x-user.title>User info</x-user>
            <img src="{{$user->profile->image ?? asset('images/default-avatar.svg') }}" class="w-[80px]"/>
            <x-user.text>{{$user->username}}</x-user>
            <x-user.text>{{$user->email}}</x-user>
            <x-user.text>{{$user->profile->first_name ?? 'Anonymous'}} {{$user->profile->last_name ?? ''}}</x-user>
            <x-user.text>{{$user->profile->bio ?? "We dont know nothing about $user->username, but we are sure $user->username is a good person"}}</x-user>
            @if(auth()->id() !== $user->id)
            <x-form.form action="{{ route('follow.index', ['user' => $user]) }}" method="POST">
                <x-form.button>Follow</x-form>
            </x-form>
            @endif
        </x-user>
        <x-user.panel>
            <x-user.title>{{ucfirst($user->username)}} follows this people</x-user>
            <div class="flex items-center gap-8">
                @foreach($user->followers as $follower)
                    <x-avatar-card :user="$follower" />
                @endforeach
            </div>
        </x-user>
        <x-user.panel>
            <div class="flex items-center justify-between">
                <x-user.title>Favorite posts</x-user>
                <div class="flex gap-3">
                    <div class="swiper-button-prev static after:content-none">
                        <i class="fa-solid fa-arrow-left text-xl"></i>
                    </div>
                    <div class="swiper-button-next static after:content-none">
                        <i class="fa-solid fa-arrow-right text-xl"></i>
                    </div>
                </div>
            </div>
            <x-user.posts-slider>
                @forelse($user->favoritePosts as $post)
                <x-home.post-card size="small" :post="$post" slider="true"/>
                    @empty
                    Not published yet
                @endforelse
            </x-user.posts-slider>
        </x-user>
        <x-user.panel>
            <div class="flex items-center justify-between">
                <x-user.title>Published posts</x-user>
                    <div class="flex gap-3">
                        <div class="swiper-button-prev static after:content-none">
                            <i class="fa-solid fa-arrow-left text-xl"></i>
                        </div>
                        <div class="swiper-button-next static after:content-none">
                            <i class="fa-solid fa-arrow-right text-xl"></i>
                        </div>
                    </div>
                </div>
            <x-user.posts-slider>
                @forelse($user->latestPosts as $post)
                    <x-home.post-card size="small" :post="$post" slider="true"/>
                @empty
                Not published yet
                @endforelse
            </x-user.posts-slider>
        </x-user>

            @else
            <h2>User not found!</h2>
        @endif
    </div>
    @if(auth()->id() === $user->id)
    <div class="w-40 ml-auto mt-10">
        <x-form.button class="w-40 ml-auto mt-5" tag="a" href="{{ route('profile.edit') }}">Edit profile</x-form>
    </div>
    @endif
</section>
@endsection
@vite('resources/js/profile-slider.js')
@vite('resources/js/swiper-bundle.min.js')
@section('scripts')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/profile-slider.js') }}"></script>
@endsection
