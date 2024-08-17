@props(['comments'])
@forelse($comments as $comment)
    <x-user.comment :comment=$comment />
    @empty
    <x-user.title>No comments yet</x-user>
@endforelse
