@props(['post', 'size' => 'default', 'slider' => 'false'])

<li {{$attributes(["class" => "bg-secondary/15 grid p-5 rounded-xl group/item transition duration-300 border-transparent border-4 hover:border-accent" . ($slider === "true" ? " swiper-slide" : "")])}}>
    <img src="{{$post->poster_image}}" />
    <div class="mt-5">
        <h3 class="text-xl font-semibold transition duration-300 group-hover/item:text-accent">{{$post->short_title()}}</h3>
        @if ($size !== 'small')
            <p class="text-sm mt-2">{!! $post->excerpt() !!}</p>
        @endif
    </div>
    <a href="{{ route("posts.show", ["post" => $post->id]) }}" class="mt-4 flex justify-end items-center gap-2">Read more<i class="fa-solid fa-arrow-right"></i></a>
</li>
