@extends('layouts.home')

@section('styles')
    <link ref="stylesheet" href="{{ asset('css/ckeditor5-content.css') }}">
    <link ref="stylesheet" href="{{ asset('css/ckeditor5-editor.css') }}">
    <link ref="stylesheet" href="{{ asset('css/ckeditor5.css') }}">
@endsection

@section('content')
    <section>
        <x-flash-message status="success" message="{{session('success')}}" />
        <x-form.form action="{{ route('posts.store') }}" method="POST" class="mx-auto lg:w-full">
            <textarea id="editor" name="content"></textarea>
            <x-form.button>Create post</x-form>
        </x-form>
    </section>
@endsection

@section('scripts')

    <script src="{{ asset('https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace("editor")
    </script>
@endsection
