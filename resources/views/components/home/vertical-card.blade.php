@props(['post'])
<a href="{{ route('posts.show', ['post'=>$post]) }}">
    <img src="{{$post->poster_image}}" alt="{{$post->title}}"/>
    <h3 class="font-bold mt-4">{{$post->title}}</h3>
</a>
