@props(['name', 'label'])

<div class="flex my-3.5 flex-col gap-2.5">
    @if ($label)
        <x-form.label :$name :$label />
    @endif
    <div class="mt-1">
        {{$slot}}

        <x-form.error :error="$errors->first($name)"/>
    </div>
</div>
