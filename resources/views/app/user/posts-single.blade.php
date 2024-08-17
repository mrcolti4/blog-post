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
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.querySelector("select.comments-sort");
    const commentsList = document.querySelector("div.comments-list");

    select.addEventListener("change", async function (e) {
        const sortType = this.value;
        const url = `{{ url('posts/') }}/{{$post->id}}/comments/index?sort=${sortType}`;
        const response = await fetch(url);

        const data = await response.json();
        commentsList.innerHTML = data.body;
    });
})
</script>
@endsection
