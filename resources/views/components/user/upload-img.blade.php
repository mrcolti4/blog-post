@props(['name', 'size', 'label'])

<label for="{{$name}}" class="w-1/2">
    {{$label}}
    <img src="{{ asset('images/no-poster.webp') }}" class="{{$size === 'poster' ? 'w-1/4' : 'w-1/2'}} mt-4 {{$name}}" />
</label>
<input type="file" name="{{$name}}" id="{{$name}}" class="opacity-0 absolute -z-10 {{$name}}-upload"/>
