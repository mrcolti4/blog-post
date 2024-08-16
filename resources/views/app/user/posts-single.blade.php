@extends('layouts.home')

@section('content')
<section>
    <article class="mt-10">
        <div class="container mx-auto">
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
            <div class="grid gap-y-10 bg-primary-default/30 rounded-3xl p-6">
                <x-form.form method="POST" action="{{ route('posts.comments.store', ['post' => $post]) }}" class="lg:w-full">
                    <x-form.input name="body" label="Leave your comment..." tag="textarea" />
                    <x-form.button>Comment</x-form>
                </x-form>
                @foreach($comments as $comment)
                    <x-user.comment :comment=$comment />
                @endforeach
            </div>
        </div>
    </article>
</section>
@endsection
