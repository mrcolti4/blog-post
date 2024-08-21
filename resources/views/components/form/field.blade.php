@props(['name', 'label'])

<div class="flex flex-col gap-2.5 w-full">
    @if ($label)
        <x-form.label :$name :$label />
    @endif
        {{$slot}}
        <x-form.error :error="$errors->first($name)"/>
</div>
