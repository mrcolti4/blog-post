@props(['name', 'label'])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => "block w-full py-2.5 text-sm rounded-5 text-dark-text shadow shadow-shadow-border focus:shadow-accent focus:shadow-lg transition border border-shadow-border focus:border-accent outline-none focus:ring-0",
        'value' => old($name)
    ];
@endphp

@if($errors->has($name) || $errors->has("login"))
    @php
        $defaults['class'] .= " text-accent border-accent focus:border-accent focus:text-accent focus:shadow-accent";
    @endphp
@endif

<x-form.field :name="$name" :label="$label">
    <input {{$attributes->merge($defaults)}} />
</x-form>
