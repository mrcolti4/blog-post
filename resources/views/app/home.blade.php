@extends('layouts.base')

@push('header')
    <x-header/>
@endpush
@section("content")
<section>
    <div class="container mx-auto">
        <div class="text-center mt-28">
            <h1 class="font-Shantell font-bold text-4xl">The next-generation blog platform</h1>
            <p class="text-xl mt-6">Share, discuss your favourite topics</p>
            <ul class="grid grid-cols-2 grid-rows-2 gap-10 mt-20">
                <x-home.card />
                <x-home.card />
                <x-home.card />
                <x-home.card />
            </ul>
        </div>
    </div>
</section>
@endsection
