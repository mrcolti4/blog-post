<header class="w-full text-center bg-primary-default py-2 px-4">
    <button class="absolute left-3.5 md:hidden" data-click="open-menu">
        <i class="fa-solid fa-bars block text-xl text-center "></i>
    </button>
    <a href="/" class="font-semibold text-xl text-light-color md:hidden">
        Blog
    </a>
    <div data-target="mobile-menu" class="bg-background md:bg-transparent absolute md:static md:transform-none top-0 left-0 bottom-0 right-0 transform -translate-x-full transition-transform duration-300 overflow-auto md:flex md:justify-between">
         <button data-click="close-menu" class="md:hidden">
            <i class="absolute top-3.5 left-3.5 fa-solid fa-xmark"></i>
         </button>
         <x-logo src="{{URL('/images/logo.png')}}" class="mx-auto md:m-0"/>
         <nav class="flex justify-center items-center w-full md:w-auto bg-background md:bg-transparent z-10 lg:static overflow-auto py-5">
            <ul class="max-md:w-full flex flex-col md:flex-row gap-2.5 md:gap-10">
                <x-nav-link href="/">Home</x-nav-link>
                <x-nav-link href="/categories">Categories</x-nav-link>
                <x-nav-link href="/about">About us</x-nav-link>
                <x-nav-link href="/contact">Contacts</x-nav-link>
            </ul>
        </nav>
    </div>
</header>
