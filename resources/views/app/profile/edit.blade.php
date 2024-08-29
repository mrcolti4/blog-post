@extends('layouts.home')

@section('content')
<section class="container mx-auto pt-5 grid gap-10 grid-cols-1 md:grid-cols-2 grid-rows-3 md:grid-rows-2">
    <x-user.panel>
        <x-user.title>User info</x-user>
        @if (session('success'))
            <x-flash-message status="success" message="{{session('success')}}"/>
        @endif
        @if(session('error'))
             <x-flash-message status="error" message="{{session('error')}}"/>
        @endif
        <x-form.form action="{{ route('user.update', ['user' => $user]) }}" method="POST">
            <x-form.input name="username" label="" placeholder="{{$user->username}}" />
            <x-form.input name="email" label="" placeholder="{{$user->email}}" type="email" />
            <x-form.button>Update info</x-form>
        </x-form>
    </x-user>
    <x-user.panel>
        <x-user.title>User profile</x-user>
        <x-form.form action="{{ route('profile.update', ['user' => $user]) }}" method="POST" class="text-left">
            <x-form.input name="first_name" label="First name" value="{{$user->profile->first_name ?? ''}}" />
            <x-form.input name="last_name" label="Last name" value="{{$user->profile->last_name ?? ''}}" />
            <x-form.input name="bio" label="Enter your bio" value="{{$user->profile->bio ?? ''}}"/>
            <x-form.button>Update profile</x-form>
        </x-form>
    </x-user>
    <x-user.panel>
        <x-user.title>User password</x-user>

        <x-form.form action="{{ route('user.password.update') }}" method="POST" class="text-left">
            <x-form.input name="old_password" label="Enter your current password" type="password" />
            <x-form.input name="password" label="Enter your new password" type="password"/>
            <x-form.input name="password_confirmation" label="Repeat new password" type="password"/>
            <x-form.button>Update password</x-form>
        </x-form>
    </x-user>
</section>

@endsection
