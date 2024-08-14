@props(['status', "message"])
<div id="flash-message" class="transition font-Mandali font-medium text-xl fixed bottom-5 right-5 p-5 {{$status === 'error' ? 'bg-red-900/50' : 'bg-green-900/50'}}">
    {{$message}}
</div>
