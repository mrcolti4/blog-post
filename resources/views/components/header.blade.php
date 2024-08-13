<div data-event="toggle-menu" class="md:hidden fixed bottom-3 right-3 bg-accent rounded-xl inline-flex items-center justify-center w-10 h-10 z-10">
    <i class="fa-solid fa-bars text-text text-3xl"></i>
</div>
<header data-target="mobile-menu" class="bg-secondary max-md:rounded-l-xl md:bg-secondary/15 fixed bottom-0 right-0 transition duration-300 translate-x-full pr-10 md:translate-x-0 md:block md:static md:px-0">
    <div class="md:flex md:items-center md:max-w-[1000px] md:mx-auto">
        <a href="/" class="hidden md:block w-20">
            <x-logo src="{{asset('/images/logo.svg')}}" class="w-20"/>
        </a>
        <nav class="w-full inline-flex justify-center items-center">
            <ul class="p-5 md:p-0 grid grid-rows-2 grid-cols-3 gap-8 md:flex items-center justify-center md:gap-6">
                <x-nav-link href="#">Popular</x-nav-link>
                <x-nav-link href="#">Latest posts</x-nav-link>
                <x-nav-link href="#" class="order-5">About</x-nav-link>
                @guest
                    <x-nav-link href="{{ route('login') }}" class="md:ml-20">Login</x-nav-link>
                    <x-nav-link href="{{ route('register.create') }}">Register</x-nav-link>
                @endguest
                @auth
                <x-nav-link href="#" class="order-3">My posts</x-nav-link>
                <x-nav-link href="#" class="order-4">Favorite</x-nav-link>
                <li class="md:ml-20">
                    <x-form.form method="POST" action="/login" class="lg:w-auto">
                        @method("DELETE")
                        <x-form.button class="w-[150px]">
                            Logout
                        </x-form>
                    </x-form>
                </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
