@extends('layouts.home')

@section("head")

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')
    <section class="container mx-auto py-24">
        <x-user.title>Create post</x-user>
        <x-flash-message status="success" message="{{session('success')}}" />
        <x-flash-message status="error" message="{{session('error')}}" />
        <x-form.form enctype="multipart/form-data" action="{{ route('posts.store') }}" method="POST" class="mx-auto lg:w-full grid gap-y-5" >
            <x-form.input name="title" label="Enter your post title" />
            <x-user.upload-img label="This image will appear on posts page" name="poster_image" size="poster"/>
            <x-user.upload-img label="This image will appear on top of page of your post" name="hero_image" size="background"/>
            <div class="dark-theme-editor">
                <textarea id="editor" name="content"></textarea>
            </div>
            <x-form.button class="mt-20">Create post</x-form>
        </x-form>
    </section>
@endsection

@vite(['resources/js/ckeditor.js'])
