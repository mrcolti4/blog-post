@extends('layouts.home')

@section('content')
<section class="container mx-auto">
    <x-form.form action="{{ route('search.index') }}" method="GET" class="flex w-full items-center justify-center gap-5 mt-4">
        <input type="text" name="q" placeholder="Search posts" class="w-full bg-primary-default/10 rounded-xl" value="{{Request::get('q') ?? ''}}" />
        <x-form.button class="w-1/5">Search</x-form>
    </x-form>
    <div class="mt-8">
        @forelse($posts as $post)
            <x-home.vertical-card :post="$post" />
            @empty
            "{{Request::input('q')}}" has no results
        @endforelse
    </div>
</section>

@endsection
