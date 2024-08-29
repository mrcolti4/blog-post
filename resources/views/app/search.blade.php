@extends('layouts.home')

@section('content')
<section class="container mx-auto py-8">
    <x-form.form action="{{ route('search.index') }}" method="GET" class="flex w-full items-center justify-center gap-5 mt-4">
        <input type="text" name="q" placeholder="Search posts" class="w-full bg-primary-default/10 rounded-xl" value="{{Request::get('q') ?? ''}}" />
        <x-form.button class="w-1/5">Search</x-form>
@php
    $options = [
        [
            "value" => 'All The Time',
            "label" => 'All The Time',
            "selected" => true
        ],
        [
            "value" => 'Angles',
            "label" => 'Angles',
            "selected" => true
        ]
    ];
@endphp

<x-form.multiselect
    label="Select categories"
    name="category"
    :options="$options"
    multiple
>
    <option value="">Select Categories</option>
</x-form>
    </x-form>
        @if(Request::filled('q'))
            <x-user.title class="mt-5">You did found {{$count}} posts</x-user>
            <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse($posts as $post)
                    <x-home.vertical-card :post="$post" />
                    @empty
                    "{{Request::input('q')}}" has no results
                @endforelse
            </div>
            {{$posts->links()}}
        @endif
</section>

@endsection
@section('head')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"
/>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js" defer></script>
@endsection
