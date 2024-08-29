@props(['user'])
<div class="text-center">
  <img
    src="{{$user->profile->image ?? asset('/images/default-avatar.svg') }}"
    class="mx-auto mb-4 w-32 h-32 rounded-[100%]"
    alt="{{$user->username}}" />
  <h5 class="mb-2 text-xl font-medium leading-tight">{{($user->profile->first_name ?? '') . ' ' . ($user->profile->last_name ?? '')}}</h5>
  <a class="text-neutral-500 dark:text-neutral-400" href="{{ route('users.id.profile.show', ['user' => $user]) }}">
    {{$user->username}}
  </a>
</div>
