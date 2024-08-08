@extends('layouts.base')

@section("content")
    <div class="h-full w-full flex justify-center items-center">
        <x-form.form method="POST" action="/login">
            <x-form.title>Sign up</x-form>
            <x-form.descr>Start your journey now</x-form>
            <x-form.input name="username" label="Username" placeholder="Enter your username"/>
            <x-form.input name="email" label="Email" placeholder="Enter your email" type="email"/>
            <x-form.input name="password" type="password" label="Password" placeholder="Enter your password"/>
            <x-form.input name="password_confirmation" type="password" label="Confirm password" placeholder="Enter your password again"/>
            <x-form.button>Sign in</x-form>
            <x-form.link href="{{ route('login.create') }}">Have an account? Login</x-form>
        </x-form>
    </div>
@endsection
