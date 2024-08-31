@props(['name', 'label', 'tag' => 'input', 'value' => ''])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => "block w-full py-2.5 dark:bg-gray-700 dark:text-text text-sm rounded-5 text-dark-text shadow focus:shadow-accent focus:shadow-lg transition border border-shadow-border focus:border-accent outline-none focus:ring-0",
        'value' => $value ?? old($name)
    ];
@endphp

@if($errors->has($name) || $errors->has("login"))
    @php
        $defaults['class'] .= " text-accent border-accent focus:border-accent focus:text-accent focus:shadow-accent";
    @endphp
@endif

<x-form.field :name="$name" :label="$label">
@if ($tag === 'textarea')
    <textarea {{$attributes->merge($defaults)}}></textarea>
@else
    <input {{$attributes->merge($defaults)}} />
@endif
</x-form>
