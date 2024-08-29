@props(['notification'])
<!-- Toast -->
<div class="max-w-xs relative bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700" role="alert" tabindex="-1" aria-labelledby="hs-toast-avatar-label">
  <div class="flex p-4">
    <div class="shrink-0">
      <img class="inline-block size-8 rounded-full" src="{{$user->profile->image ?? asset('images/default-avatar.svg')}}" alt="Avatar">
      <button type="button" class="absolute top-3 end-3 inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-gray-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-white" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 6 6 18"></path>
          <path d="m6 6 12 12"></path>
        </svg>
      </button>
    </div>
    <div class="ms-4 me-5">
      <h3 id="hs-toast-avatar-label" class="text-gray-800 font-medium text-sm dark:text-white">
        <span class="font-semibold">{{ucfirst($notification->author)}}</span> did publish the post
      </h3>
      <div class="mt-1 text-sm text-gray-600 dark:text-neutral-400">

      </div>
      <div class="mt-3">
        <button type="button" class="text-blue-600 decoration-2 hover:underline font-medium text-sm focus:outline-none focus:underline dark:text-blue-500">
          Mark as read
        </button>
      </div>
    </div>
  </div>
</div>
<!-- End Toast -->
