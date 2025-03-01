<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Notes" }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 2xl:grid-cols-6 gap-4 mb-6">
            @foreach ($notes as $note)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-3 h-96 relative">
                    <div class="flex justify-start items-center gap-5">
                        <a href="{{ route('notes.show', $note->id) }}">
                            <svg fill="#343434" viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd"
                                        d="M5,2 L7,2 C7.55228475,2 8,2.44771525 8,3 C8,3.51283584 7.61395981,3.93550716 7.11662113,3.99327227 L7,4 L5,4 C4.48716416,4 4.06449284,4.38604019 4.00672773,4.88337887 L4,5 L4,19 C4,19.5128358 4.38604019,19.9355072 4.88337887,19.9932723 L5,20 L19,20 C19.5128358,20 19.9355072,19.6139598 19.9932723,19.1166211 L20,19 L20,17 C20,16.4477153 20.4477153,16 21,16 C21.5128358,16 21.9355072,16.3860402 21.9932723,16.8833789 L22,17 L22,19 C22,20.5976809 20.75108,21.9036609 19.1762728,21.9949073 L19,22 L5,22 C3.40231912,22 2.09633912,20.75108 2.00509269,19.1762728 L2,19 L2,5 C2,3.40231912 3.24891996,2.09633912 4.82372721,2.00509269 L5,2 L7,2 L5,2 Z M21,2 L21.081,2.003 L21.2007258,2.02024007 L21.2007258,2.02024007 L21.3121425,2.04973809 L21.3121425,2.04973809 L21.4232215,2.09367336 L21.5207088,2.14599545 L21.5207088,2.14599545 L21.6167501,2.21278596 L21.7071068,2.29289322 L21.7071068,2.29289322 L21.8036654,2.40469339 L21.8036654,2.40469339 L21.8753288,2.5159379 L21.9063462,2.57690085 L21.9063462,2.57690085 L21.9401141,2.65834962 L21.9401141,2.65834962 L21.9641549,2.73400703 L21.9641549,2.73400703 L21.9930928,2.8819045 L21.9930928,2.8819045 L22,3 L22,3 L22,9 C22,9.55228475 21.5522847,10 21,10 C20.4477153,10 20,9.55228475 20,9 L20,5.414 L13.7071068,11.7071068 C13.3466228,12.0675907 12.7793918,12.0953203 12.3871006,11.7902954 L12.2928932,11.7071068 C11.9324093,11.3466228 11.9046797,10.7793918 12.2097046,10.3871006 L12.2928932,10.2928932 L18.584,4 L15,4 C14.4477153,4 14,3.55228475 14,3 C14,2.44771525 14.4477153,2 15,2 L21,2 Z">
                                    </path>
                                </g>
                            </svg>
                        </a>
                        <a href="{{ route('notes.edit', $note->id) }}">
                            <svg fill="#343434" viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd"
                                        d="M21,20 C21.5522847,20 22,20.4477153 22,21 C22,21.5522847 21.5522847,22 21,22 L3,22 C2.44771525,22 2,21.5522847 2,21 C2,20.4477153 2.44771525,20 3,20 L21,20 Z M6.29289322,13.2928932 L17.2928932,2.29289322 C17.6533772,1.93240926 18.2206082,1.90467972 18.6128994,2.20970461 L18.7071068,2.29289322 L21.7071068,5.29289322 C22.0675907,5.65337718 22.0953203,6.22060824 21.7902954,6.61289944 L21.7071068,6.70710678 L10.7071068,17.7071068 C10.5508265,17.8633871 10.3481451,17.9625983 10.131444,17.9913276 L10,18 L7,18 C6.48716416,18 6.06449284,17.6139598 6.00672773,17.1166211 L6,17 L6,14 C6,13.7789863 6.07316447,13.565516 6.20608063,13.3919705 L6.29289322,13.2928932 L17.2928932,2.29289322 L6.29289322,13.2928932 Z M18,4.41421356 L8,14.4142136 L8,16 L9.58578644,16 L19.5857864,6 L18,4.41421356 Z">
                                    </path>
                                </g>
                            </svg>
                        </a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="post"
                            class="flex items-center justify-center" onsubmit="event.preventDefault();deleteNote(this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                            stroke="#343434" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <h1 class="text-gray-800 font-bold text-lg mb-2 truncate">{{ $note->title }}</h1>
                    <p class="text-slate-500 text-justify line-clamp-[11] mb-2">{{ strip_tags($note->content) }}</p>

                    <div class="absolute left-0 px-2 bottom-2 w-full">
                        <i
                            class="text-xs text-slate-400 block text-end mb-1">{{ $note->created_at->diffForHumans() }}</i>

                        <div class="flex gap-1">
                            @foreach ($note->tags as $tag)
                                <a href=""
                                    class="text-xs py-1 px-2 rounded-sm bg-slate-700 text-white">{{ $tag->tagItem->name }}</a>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
            <div x-data="{ modalAddIsOpen: false }"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-3 h-96 flex justify-center items-center">
                <button type="button" x-on:click="modalAddIsOpen = true">
                    <svg fill="#343434" viewBox="0 0 24 24" class="w-10 h-10" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd"
                                d="M12,4 C12.5522847,4 13,4.44771525 13,5 L13,11 L19,11 C19.5522847,11 20,11.4477153 20,12 C20,12.5522847 19.5522847,13 19,13 L13,13 L13,19 C13,19.5522847 12.5522847,20 12,20 C11.4477153,20 11,19.5522847 11,19 L11,13 L5,13 C4.44771525,13 4,12.5522847 4,12 C4,11.4477153 4.44771525,11 5,11 L11,11 L11,5 C11,4.44771525 11.4477153,4 12,4 Z">
                            </path>
                        </g>
                    </svg>
                </button>

                <div x-cloak x-show="modalAddIsOpen" x-transition.opacity.duration.200ms
                    x-trap.inert.noscroll="modalAddIsOpen" x-on:keydown.esc.window="modalAddIsOpen = false"
                    x-on:click.self="modalAddIsOpen = false"
                    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                    role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                    <!-- Modal Dialog -->
                    <div x-show="modalAddIsOpen"
                        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                        class="flex w-full max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-outline bg-white text-dark">
                        <!-- Dialog Header -->
                        <div class="flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 ">
                            <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-on-surface-strong">
                                Add Note</h3>
                            <button x-on:click="modalAddIsOpen = false" aria-label="close modal">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                    stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <form action="{{ route('notes.store') }}" method="post">
                            @csrf
                            <!-- Dialog Body -->
                            <div class="px-4 mb-2">
                                <div class="mb-2">
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text"
                                        name="title" :value="old('title')" required autofocus />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="mb-2">
                                    <x-input-label for="content" :value="__('Content')" />
                                    <x-textarea id="content" class="block mt-1 w-full min-h-60" type="text"
                                        name="content" required>{{ old('content') }}</x-textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                                <div class="mb-2">
                                    <x-tagify :tags="$tags" name="tags" />
                                </div>
                            </div>
                            <!-- Dialog Footer -->
                            <div
                                class="flex flex-col-reverse justify-between gap-2 border-t border-outline bg-surface-alt/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                <x-primary-button x-on:click="modalAddIsOpen = false">Save</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{ $notes->links() }}
    </div>

    <x-alert-confirm-delete />
</x-app-layout>
