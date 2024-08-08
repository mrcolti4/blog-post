<div data-event="toggle-menu" class="md:hidden absolute bottom-3 right-3 bg-accent rounded-xl inline-flex items-center justify-center w-10 h-10 z-10">
    <i class="fa-solid fa-bars text-text text-3xl"></i>
</div>
<header data-target="mobile-menu" class="bg-secondary/10 absolute bottom-0 right-0 transition duration-300 translate-x-full md:translate-x-0 md:block md:static">
    <div class="md:flex md:items-center md:max-w-[1000px] md:mx-auto">
        <a href="/" class="hidden md:block">
            <x-logo src="{{asset('/images/logo.png')}}"/>
        </a>
        <nav class="w-full">
            <ul class="p-5 md:p-0 grid grid-rows-2 grid-cols-3 gap-8 md:flex items-center justify-center md:gap-6">
                <x-nav-link href="#">Popular</x-nav-link>
                <x-nav-link href="#">Latest posts</x-nav-link>
                <x-nav-link href="#">About</x-nav-link>
                <x-nav-link href="{{ route('login.create') }}" class="md:ml-20">Login</x-nav-link>
                <x-nav-link href="{{ route('register.create') }}">Register</x-nav-link>
            </ul>
        </nav>
    </div>
</header>
