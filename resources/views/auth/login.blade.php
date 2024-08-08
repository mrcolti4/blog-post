@extends('layouts.base')
@section("content")
    <div class="h-full w-full flex justify-center items-center">
        <x-form.form method="POST" action="/login">
            <x-form.title>Sign in</x-form>
            <x-form.descr>Welcome back! Long time no see</x-form>
            <x-form.input name="username" label="Username" placeholder="Enter your username"/>
            <x-form.input name="password" type="password" label="Password" placeholder="Enter your password"/>
            <x-form.button>Sign in</x-form>
            <x-form.link href="{{ route('register.create') }}">First time here? Sign up</x-form>
        </x-form>
    </div>
@endsection
