<li class="max-md:w-full px-5 md:p-0 flex items-center">
    <a {{$attributes->merge([
        "class" => "bg-primary-default active:bg-primary-hover text-light-text block w-full py-2 md:py-0 rounded-5 relative
lg:before:content-[''] lg:before:w-full lg:before:h-1 lg:before:block lg:before:bg-secondary lg:before:absolute lg:before:-bottom-1 lg:before:origin-right lg:hover:before:origin-left lg:before:scale-0 lg:hover:before:scale-100 lg:before:transition lg:before:duration-300"
    ])}}
    >
        {{$slot}}
    </a>
</li>
