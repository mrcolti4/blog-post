<form {{$attributes->merge(["class" => "lg:w-80"])}}>
    @csrf
    {{$slot}}
</form>
