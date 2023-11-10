<div class="flex flex-wrap w-full gap-x-4">
    @foreach ($posts as $post)
        @if ($post->status->value === 'published')
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="display: flex; flex-direction: column;">
            <a href="{{ route('blog.view', [$post->published_at->year, $post->slug])}}" wire:navigate>
                <img class="rounded-t-lg" src="{{ is_null($post->thumbnail) ? asset('images/no-thumbnail.jpg') : 'storage/'.$post->thumbnail }}" alt="" />
            </a>
            <div class="flex flex-col justify-start p-5">
                {{-- Title --}}
                <a href="{{ route('blog.view', [$post->published_at->year, $post->slug])}}" class="hover:text-red-600" wire:navigate>
                    <h3 class="text-xl font-bold mb-2 truncate">{{ $post->title }}</h3>
                </a>
                {{-- End Title --}}

                {{-- Content Preview --}}
                <p class="mb-4 text-gray-500 text-sm leading-relaxed tracking-wide">{{ strip_tags(Str::limit($post->content, 80)) }}</p>
                {{-- Content Preview End --}}

                {{-- Author and Published Date --}}
                <div class="flex flex-1 gap-x-1 mb-4 mt-4">
                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            {{ $post->published_at->format('M d') }}
                        </div>
                    </span>
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg>
                            {{ $post->user->name }}
                        </div>
                    </span>
                </div>
                {{-- End of Author and Published Date --}}
                <div class="mt-0 mb-0">
                    <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ route('blog.view', [$post->published_at->year, $post->slug])}}" wire:navigate>Read More</a>
                </div>
            </div>
            
        </div>
        @endif
    @endforeach
</div>  