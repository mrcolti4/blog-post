@props(['tag' => 'button', 'href'])

@php
    $attrs = [
        "type" => "submit",
        "class" => "block px-5 py-2.5 w-full font-semibold text-sm text-center bg-primary-default text-text rounded-5 transition hover:bg-primary-hover"
    ];
    if(!empty($href)) {
        $attrs['href'] = $href;
    }
@endphp

@if($tag === 'a')
    <a {{$attributes($attrs)}}>{{$slot}}</a>
@else()
    <button {{$attributes($attrs)}}>{{$slot}}</button>
@endif
