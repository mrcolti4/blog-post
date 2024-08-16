@extends('layouts.home')

@section('content')
<section>
    <article class="mt-10">
        <div class=""></div>
        <div class="container">
        @foreach($images as $image)
            @if($image['alt'] === "Hero image")
                <img src="{{ asset('storage/' . $image['path']) }}" alt="{{ $image['alt'] }}">
            @endif
        @endforeach
            <div class="grid gap-y-4">
                <h1 class="font-Shantell font-bold text-3xl">{{$post->title}}</h1>
                <h2 class="font-semibold text-lg">Author: {{$post->user->username}}</h2>
                <p class="">{!! $post->body !!}</p>
            </div>
        </div>
    </article>
</section>
@endsection
