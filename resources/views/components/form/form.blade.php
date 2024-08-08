<form {{$attributes(["class" => "lg:w-80", "method" => "GET"])}}>
    @if($attributes->get("method", 'GET') !== "GET")
        @csrf
        @method($attributes->get("method"))
    @endif
    {{$slot}}
</form>
