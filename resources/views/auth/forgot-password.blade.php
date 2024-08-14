@extends('layouts.base')

@section('content')
    <section class="container mx-auto flex items-center justify-center h-full">
        <x-form.form action="{{ route('password.email') }}" method="POST">
            <x-form.title>Reset password form</x-form>
            <x-form.input name="email" type="email" label="Enter your email"/>
            <x-form.button>Reset password</x-form>
            <x-form.link href="{{ route('login') }}" class="mb-5">Login</x-form>
        </x-form>
    </section>
@endsection
