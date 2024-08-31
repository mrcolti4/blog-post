@extends('layouts.home')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<section class="px-[200px] flex py-10 gap-8">
    <!-- Blog Article -->
    <article data-id="{{$post->id}}" data-target-type="post" class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
            <!-- Content -->
            <div class="lg:col-span-2">
                <div class="py-8 lg:pe-8">
                    <div class="space-y-5 lg:space-y-8">
                        <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500" href="{{ route('posts.index') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                            Back to Blog
                        </a>
                        <div class="flex items-center gap-x-3">
                            @can('update', $post)
                                <x-form.button tag="a" class="w-1/2" href="{{ route('posts.edit', ['post' => $post]) }}">
                                    Edit post
                                </x-form>
                            @endcan
                            @can('delete', $post)
                                <x-form.button class="open-modal w-1/2 bg-red-500 hover:bg-red-700">
                                    Delete post
                                </x-form>
                                <x-modal :post="$post"></x-modal>
                           @endcan
                        </div>
                        <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">{{$post->title}}</h2>

                        <div class="flex items-center gap-x-5">
                            <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                {{$post->category->title}}
                            </a>
                            <p class="text-xs sm:text-sm text-gray-800 dark:text-neutral-200">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
                        </div>
                        <!-- Content -->
                        <div>
                            {!! $post->body !!}
                        </div>
                        <!-- Content ends here  -->
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-y-5 lg:gap-y-0">
                            <div class="flex justify-end items-center gap-x-1.5">
                            <!-- Button -->
                            <div class="hs-tooltip inline-block">
                                <x-vote-buttons :target="$post" name="post" />
                            </div>
                            <!-- Button -->

                            <div class="block h-3 border-e border-gray-300 mx-3 dark:border-neutral-600"></div>

                            <!-- Button -->
                            <div class="hs-tooltip inline-block">
                                <button type="button" class="hs-tooltip-toggle flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                                {{count($comments)}}
                                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-black" role="tooltip">
                                    Comment
                                </span>
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid gap-y-10 bg-primary-default/30 rounded-3xl p-6">
                    <select name="sort" class="comments-sort bg-background">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : ''}}>Latest comments</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : ''}}>Most popular comments</option>
                    </select>
                <x-form.form method="POST" action="{{ route('posts.comments.store', ['post' => $post]) }}" class="lg:w-full">
                    <x-form.input name="body" label="Leave your comment..." tag="textarea" />
                    <x-form.button>Comment</x-form>
                </x-form>
                <div class="grid gap-6 comments-list">
                    <x-user.comments :comments="$comments" />
                </div>
            </div>
            </div>
            <!-- End Content -->

            <!-- Sidebar -->
            <aside class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
                <div class="sticky top-0 start-0 py-8 lg:ps-8">
                    <!-- Avatar Media -->
                    <div class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-neutral-700">
                        <a class="block shrink-0 focus:outline-none" href="#">
                            <img class="size-10 rounded-full" src="{{$post->user->profile->image ?? asset('images/default-avatar.svg')}}" alt="Avatar">
                        </a>
                        <a class="group grow block focus:outline-none" href="{{ route('users.id.profile.show', ['user' => $post->user]) }}">
                            <h5 class="group-hover:text-gray-600 group-focus:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:group-focus:text-neutral-400 dark:text-neutral-200">
                                {{$post->user->username}}
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-neutral-500">
                                {{$post->user->profile?->first_name . ' ' . $post->user->profile?->last_name}}
                            </p>
                        </a>

                        <div class="grow">
                            <button data-user-id="{{$post->user->username}}" class="follow-btn py-1.5 px-2.5 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                Follow
                            </button>
                        </div>
                    </div>
                    <!-- End Avatar Media -->

                    <div class="space-y-6">
                        <!-- Media -->
                        @forelse($otherPosts as $otherPost)
                            <x-posts.horizontal-card :post="$otherPost" />
                            @empty
                            <p class="text-gray-500 dark:text-neutral-500">No other posts</p>
                        @endforelse
                        <!-- End media -->
                    </div>
                </div>
            </aside>
            <!-- End Sidebar -->
        </div>
    </article>
    <!-- End Blog Article -->
</section>
@vite('resources/js/posts/modal.js')
@vite('resources/js/posts/show-post.js')
@vite('resources/js/follow.js')
@endsection
