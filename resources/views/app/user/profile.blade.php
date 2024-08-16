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
            <img src="{{$user->profile->image ?? asset('images/default-avatar.svg') }}" class="w-[80px]"/>
            <x-user.text>{{$user->username}}</x-user>
            <x-user.text>{{$user->email}}</x-user>
            <x-user.text>{{$user->profile->first_name ?? 'Anonymous'}} {{$user->profile->last_name ?? ''}}</x-user>
        </x-user>
        <x-user.panel>
            <x-user.title>User bio</x-user>
            <x-user.text>{{$user->profile->bio ?? "We dont know nothing about $user->username, but we are sure $user->username is a good person"}}</x-user>
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
                    <div class="swiper-slide">
                        <a href="{{ route('users.id.posts.show', ["user" => $user, "post" => $post]) }}">
                        @if(count($post->posterImage))
                            <img src="{{ asset('storage/'. $post->posterImage[0]->path ) }}"/>
                        @endif
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
    @if(Auth::user() === $user->id)
        <x-form.button class="w-40 ml-auto mt-5" tag="a" href="{{ route('profile.edit') }}">Edit profile</x-form>
    @endif
</section>
@endsection
@section('scripts')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/profile-slider.js') }}"></script>
@endsection
