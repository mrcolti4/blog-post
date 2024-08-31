@extends('layouts.home')

@section('content')
<section class="flex flex-col-reverse md:flex-row items-start gap-8 container mx-auto py-8">
    <div class="w-full md:w-3/4">
        <x-user.title class="mt-5">Result: {{$count}} posts</x-user>
        <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse($posts as $post)
                <x-home.vertical-card :post="$post" />
                @empty
                "{{Request::input('query')}}" has no results
            @endforelse
        </div>
        {{$posts->onEachSide(1)->links()}}
    </div>
    <x-form.form action="{{ route('search.index') }}" method="GET" class="grid w-full md:w-1/4 gap-5 mt-4">
        <input type="text" name="query" placeholder="Search posts" class="w-full bg-primary-default/10 rounded-xl" value="{{Request::get('query') ?? ''}}" />
        <fieldset>
            <legend>Categories</legend>
            <div class="flex flex-col gap-5 md:gap-2 mt-5">
                @foreach($categories as $category)
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="categories[]" value="{{$category->id}}" {{in_array($category->id, Request::get('categories') ?? []) ? 'checked' : ''}} />
                    <p>{{$category->title}}</p>
                </label>
                @endforeach
            </div>
        </fieldset>
        <x-form.button class="w-1/5">Search</x-form>
    </x-form>
</section>
@endsection
