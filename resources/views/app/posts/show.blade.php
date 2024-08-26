@extends('layouts.home')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<section class="px-[200px] flex py-10 gap-8">
    <article data-id="{{$post->id}}" data-target-type="post">
        <div>
            @foreach($images as $image)
                @if($image['alt'] === "Hero image")
                    <img src="{{ asset('storage/' . $image['path']) }}" alt="{{ $image['alt'] }}" class="w-full">
                @endif
            @endforeach
            <!-- Post section -->
            <div class="grid gap-y-4 mb-10">
                <img src="{{$post->hero_image}}" class="w-full" />
                <h1 class="font-Shantell font-bold text-3xl">{{$post->title}}</h1>
                <p class="">{!! $post->body !!}</p>
                <div>
                    <p class="font-bold text-lg">Did you like this article?</p>
                    <div>
                        <x-vote-buttons :target="$post" />
                    </div>
                </div>
            </div>
            <!-- Comments section -->
            <div class="grid gap-y-10 bg-primary-default/30 rounded-3xl p-6">
                <select name="sort" class="comments-sort bg-background">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : ''}}>Latest comments</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : ''}}>Most popular comments</option>
                </select>
                <x-form.form method="POST" action="{{ route('posts.comments.store', ['post' => $post]) }}" class="lg:w-full">
                    <x-form.input name="body" label="Leave your comment..." tag="textarea" />
                    <x-form.button>Comment</x-form>
                </x-form>
                <div class="grid gap-6 comments-list">
                    <x-user.comments :comments="$comments" />
                </div>
            </div>
        </div>
    </article>
    <aside class="bg-secondary/20 p-5 flex flex-col h-auto gap-6 w-2/3">
        <!-- Profile link -->
        <a href="{{ route('users.id.profile.show', ['user' => $post->user]) }}" class="flex items-center justify-center gap-4">
            <img src="{{$post->user->profile->image ?? ''}}" class="w-12 h-12 rounded-[100%]" />
            <h2 class="font-semibold text-lg">Author: {{$post->user->username}}</h2>
        </a>
        <x-form.button class="max-w-[200px] mx-auto flex items-center justify-center" tag="a" href="{{ route('users.id.profile.show', ['user' => $post->user]) }}">Follow</x-form>
        <div class="grid gap-4">
            <p>{{$post->user->profile->bio ?? ''}}</p>
            <p class="grid">
                <span class="text-xl font-bold text-gray-300">Joined: </span>
                <span>{{\Carbon\Carbon::parse($post->user->created_at)->isoFormat("MMMM D Y")}}</span>
            </p>
        </div>
        <!-- Other posts from this user -->
        @if(count($other_posts) !== 0)
            <div class="grid gap-4">
            <h3 class="text-2xl font-bold font-Shantell">More from {{$post->user->username}}</h3>

                @foreach($other_posts as $other_post)
                    <div>
                        <a class="hover:underline" href="{{ route('posts.show', ['post'=> $other_post]) }}">{{$other_post->short_title()}}</a>
                    </div>
                @endforeach
            </div>
        @endif
    </aside>
</section>
@vite('resources/js/show-post.js')
@endsection
