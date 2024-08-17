@extends('layouts.home')

@section('content')
<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="grid rounded-md shadow shadow-primary-default">
                <img src="{{$post->poster_image}}" class="block" />
                <div class="p-6 bg-accent/10 grid gap-4">
                    <h2 class="font-bold text-lg">{{$post->title}}</h2>
                    <p>{!! $post->excerpt() !!}</p>
                    <a class="flex gap-2 items-center justify-end" href="{{ route('posts.show', ['post' => $post->id]) }}">
                        Read more <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
