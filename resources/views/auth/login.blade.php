<x-layout>
    <div class="h-full w-full flex justify-center items-center">
        <x-form method="POST" action="/login">
            <x-logo/>
            <x-form-title>Sign in</x-form-title>
            <x-form-descr>Welcome back! We were waiting for you</x-form-descr>
            <x-form-field>
                <x-form-label for="username">Username</x-form-label>
                <x-form-input
                    name="username"
                    id="username"
                    placeholder="Enter your username"
                    required
                />
            </x-form-field>
            <x-form-field>
                <x-form-label for="password">Password</x-form-label>
                <x-form-input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter your password"
                    required
                />
            </x-form-field>
            @if ($errors->any())
                <x-form-error name="login">{{$errors}}</x-form-error>
            @endif
            <x-form-button>Sign in</x-form-button>
            <x-form-link href="/register">First time here? Sign up</x-form-link>
        </x-form>
    </div>
</x-layout>
