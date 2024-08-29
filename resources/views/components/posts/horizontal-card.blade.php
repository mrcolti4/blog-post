@props(['post'])

<a class="group flex items-center gap-x-6 focus:outline-none" href="{{route('posts.show', ['post' => $post])}}">
    <div class="grow">
    <span class="text-sm font-bold text-gray-800 group-hover:text-blue-600 group-focus:text-blue-600 dark:text-neutral-200 dark:group-hover:text-blue-500 dark:group-focus:text-blue-500">
        {{$post->title}}
    </span>
    </div>

    <div class="shrink-0 relative rounded-lg overflow-hidden size-20">
        <img class="size-full absolute top-0 start-0 object-cover rounded-lg" src="{{$post->poster_image}}" alt="Blog Image">
    </div>
</a>
