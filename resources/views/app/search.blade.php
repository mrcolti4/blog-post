@extends('layouts.home')

@section('content')
<section class="container mx-auto py-8">
    <x-form.form action="{{ route('search.index') }}" method="GET" class="flex w-full items-center justify-center gap-5 mt-4">
        <input type="text" name="q" placeholder="Search posts" class="w-full bg-primary-default/10 rounded-xl" value="{{Request::get('q') ?? ''}}" />
        <x-form.button class="w-1/5">Search</x-form>
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
