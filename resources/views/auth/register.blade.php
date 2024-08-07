<x-layout>
    <div class="h-full w-full flex justify-center items-center">
        <x-form class="lg:w-80 py-10" method="POST" action="/register">
            <x-logo/>
            <x-form-title>Register</x-form-title>
            <x-form-descr>
                Join our community and share your stories!
            </x-form-descr>
            <x-form-field>
                <x-form-label for="username">Username</x-form-label>
                <x-form-input
                    name="username"
                    id="username"
                    placeholder="Enter your username"
                    required
                />
                <x-form-error name="username" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="email">Email</x-form-label>
                <x-form-input
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    required
                />
                <x-form-error name="email" />
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
                <x-form-error name="password" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="password_confirmation">Confirm password</x-form-label>
                <x-form-input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Repeat your password"
                    required
                />
                <x-form-error name="password_confirmation" />
            </x-form-field>
            <x-form-button>Sign up</x-form-button>
            <x-form-link href="/login">Have an acount? Login</x-form-link>
        </x-form>
    </div>
</x-layout>
