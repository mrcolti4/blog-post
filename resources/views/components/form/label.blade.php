@props(['name', 'label'])
<label {{$attributes(["class" => "leading-6 text-sm font-medium text-text"])}} for="{{$name}}">
    {{$label}}
</label>
