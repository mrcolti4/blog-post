<div data-event="toggle-menu" class="md:hidden fixed bottom-3 right-3 bg-accent rounded-xl inline-flex items-center justify-center w-10 h-10 z-30">
    <i class="fa-solid fa-bars text-text text-3xl"></i>
</div>
<header data-target="mobile-menu" class="bg-secondary max-md:rounded-l-xl md:bg-secondary/15 fixed bottom-0 right-0 transition duration-300 translate-x-full pr-10 md:translate-x-0 md:block md:static md:px-0 z-20">
    <div class="md:flex md:items-center md:max-w-[1000px] md:mx-auto">
        <a href="/" class="hidden md:block w-20">
            <x-logo src="{{asset('/images/logo.svg')}}" class="w-20"/>
        </a>
        <nav class="w-full inline-flex justify-center items-center">
            <ul class="p-5 md:p-0 grid grid-rows-2 grid-cols-3 gap-8 md:flex items-center justify-center md:gap-6">
                <x-nav-link href="{{ route('posts.popular') }}">Popular</x-nav-link>
                <x-nav-link href="{{ route('posts.index') }}">Latest posts</x-nav-link>
                <x-nav-link href="{{ route('search.index') }}">Search</x-nav-link>
                @guest
                    <x-nav-link href="{{ route('login') }}" class="md:ml-20">Login</x-nav-link>
                    <x-nav-link href="{{ route('register.create') }}">Register</x-nav-link>
                @endguest
                @auth
                <div class="md:ml-20 relative">
                    <button data-event="toggle-profile-menu" aria-expanded="false" aria-haspopup="menu">
                        <i class="fa-regular fa-user text-xl"></i>
                    </button>
                    <ul data-target="profile-menu" role="menu" class="hidden opacity-0 absolute top-8 left-1/2 -translate-x-2/4 transition-all bg-secondary rounded-xl p-5 w-32 grid gap-4 z-50">
                        <x-nav-link href="{{ route('profile.index') }}">Profile</x-nav-link>
                        <x-nav-link href="{{ route('posts.create') }}">Create post</x-nav-link>
                        <x-nav-link>Favorite</x-nav-link>
                        <x-nav-link>
                            <x-form.form method="POST" action="/login" class="lg:w-auto">
                                @method("DELETE")
                                <x-form.button class="w-[150px]" tag="button">
                                    Logout
                                </x-form>
                            </x-form>
                        </x-nav-link>
                    </ul>
                </div>
                <div>
                    <button>
                        <i class="fa-regular fa-bell text-xl"></i>
                    </button>
                </div>
                @endauth
            </ul>
        </nav>
    </div>
</header>
@auth
    <div>
        {{auth()->user()->newPostNotifications}}
    </div>
@endauth
