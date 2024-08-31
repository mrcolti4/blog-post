@extends('layouts.home')

@section("head")
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <section class="container mx-auto py-24">
        <x-user.title>Update post</x-user>
        <x-form.form enctype="multipart/form-data" action="{{ route('posts.update', ['post' => $post]) }}" method="POST" class="mx-auto lg:w-full grid gap-y-5" >
            <x-form.input value="{{ $post->title }}" name="title" label="Enter your post title" />
            <x-form.select value="{{ $post->category_id }}" name="category_id" label="Select category" :options="$categories" />
            <x-user.upload-img src="{{$post->poster_image}}" label="This image will appear on posts page" name="poster_image" size="poster"/>
            <x-user.upload-img src="{{$post->hero_image}}" label="This image will appear on top of page of your post" name="hero_image" size="background"/>
            <div class="dark-theme-editor">
                <textarea id="editor" name="body"></textarea>
            </div>
            <x-form.button class="mt-20">Update post</x-form>
        </x-form>
@foreach($errors->all() as $error)
{{$error}}
@endforeach

    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor.create(document.querySelector("#editor"), {
            simpleUpload: {
                uploadUrl: "/upload-image",
                withCredentials: true,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            },
            initialData: "{!! $post->body !!}"
        });
    });
</script>
@endsection
@vite(['resources/js/ckeditor.js'])
