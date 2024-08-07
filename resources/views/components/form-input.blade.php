<input
    {{$attributes->class([
    "block w-full py-2.5 text-sm rounded-5 text-text shadow shadow-shadow-border focus:shadow-secondary focus:shadow border border-shadow-border focus:border-secondary outline-none focus:ring-0",
    "text-accent border-accent focus:border-accent focus:text-accent focus:shadow-accent" =>
    $errors->has($attributes->get("name")) || $errors->has("login")
    ])->merge()}}
/>
