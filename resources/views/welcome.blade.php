@extends('layouts.home')

@push('header')
    <x-header/>
@endpush
@section("content")
<section>
    <div class="container px-2.5 mx-auto">
        <div class="text-center mt-28">
            <h1 class="font-Shantell font-bold text-xl md:text-2xl lg:text-4xl">The next-generation blog platform</h1>
            <p class="text-lg lg:text-xl mt-6">Share, discuss your favourite topics</p>
            <ul class="grid grid-cols-1 grid-rows-4 md:grid-cols-2 md:grid-rows-2 gap-10 mt-20">
                <x-home.card />
                <x-home.card />
                <x-home.card />
                <x-home.card />
            </ul>
        </div>
    </div>
</section>
<!-- Popular posts -->
<section class="mt-20 pb-20">
    <div class="container mx-auto">
        <x-home.title>Popular posts</x-home>
        <div class="flex items-center">
            <div class="swiper-button-prev static after:appearance-none">
                <i class="fa-solid fa-arrow-right text-2xl text-accent rotate-180 py"></i>
            </div>
            <div class="swiper-button-next static after:appearance-none">
                <i class="fa-solid fa-arrow-right text-2xl text-accent"></i>
            </div>
        </div>
        <div class="swiper mt-5">
            <ul class="swiper-wrapper">
                @foreach($popular_posts as $post)
                    <x-home.post-card class="swiper-slide" :post="$post"/>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
