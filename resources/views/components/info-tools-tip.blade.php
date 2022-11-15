<div class="group absolute top-0 right-0 isolate z-20">
    <span>
        <svg class="color-pink-400 w-4 h-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M13 16H12V12H11M12 8H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>

    <span class="bg-gray-200 rounded-md p-2 m-1 min-w-max text-xs
                    pointer-events-none opacity-0 absolute
                    transition
                    bottom-full
                    left-1/2 -translate-x-1/2
                    group-hover:opacity-100">
                    {{ $slot }}
    </span>

<!--
    <span class="bg-gray-200 rounded-md p-2 m-1 min-w-max text-xs
                    pointer-events-none absolute
                    transition
                    top-full
                    left-1/2 -translate-x-1/2
                    ">
                    bottom
    </span>

    <span class="bg-gray-200 rounded-md p-2 m-1 min-w-max text-xs
                    pointer-events-none absolute
                    transition
                    bottom-full
                    left-1/2 -translate-x-1/2
                    ">
                    top
    </span>


    <span class="bg-gray-200 rounded-md p-2 m-1 min-w-max text-xs
                    pointer-events-none absolute
                    transition
                    top-0  -translate-y-1/2
                    right-full
                    ">
                    left
    </span>

    <span class="bg-gray-200 rounded-md p-2 m-1 min-w-max text-xs
                    pointer-events-none absolute
                    transition
                    top-0  -translate-y-1/2
                    left-full
                    ">
                    right
    </span> -->
</div>
