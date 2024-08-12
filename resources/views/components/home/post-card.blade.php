@props(['post'])
<li {{$attributes(["class" => "bg-secondary/15 grid p-5 rounded-xl group/item transition duration-300 border-transparent border-4 hover:border-accent"])}}>
    <img src={{$post->image}}/>
    <div class="mt-5">
        <h3 class="text-xl font-semibold transition duration-300 group-hover/item:text-accent">{{$post->title}}</h3>
        <p class="text-sm mt-2">{{$post->body}}</p>
    </div>
    <a href="{{ route("users.id.posts.show", ["user"=> $post->user, "post" => $post->id]) }}" class="mt-4 flex justify-end items-center gap-2">Read more<i class="fa-solid fa-arrow-right"></i></a>
</li>
