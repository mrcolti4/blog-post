@extends('layouts.home')

@section('content')
<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($posts as $post)
            <x-home.post-card :post="$post" />
        @endforeach
    </div>
    {{$posts->links('pagination::tailwind')}}
</div>
@endsection
