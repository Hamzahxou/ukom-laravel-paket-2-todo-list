<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Tags" }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-500 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </h3>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-3 w-full min-h-96 ">
                <div x-data="{ modalAddTagIsOpen: false }" class="flex justify-end items-center">
                    <x-primary-button class="mb-2" x-on:click="modalAddTagIsOpen = true">
                        Create
                    </x-primary-button>


                    <div x-cloak x-show="modalAddTagIsOpen" x-transition.opacity.duration.200ms
                        x-trap.inert.noscroll="modalAddTagIsOpen" x-on:keydown.esc.window="modalAddTagIsOpen = false"
                        x-on:click.self="modalAddTagIsOpen = false"
                        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                        <!-- Modal Dialog -->
                        <div x-show="modalAddTagIsOpen"
                            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                            class="flex w-full max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-outline bg-white text-dark">
                            <!-- Dialog Header -->
                            <div
                                class="flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 ">
                                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-on-surface-strong">
                                    Add Tag</h3>
                                <button x-on:click="modalAddTagIsOpen = false" aria-label="close modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                        stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('tags.store') }}" method="post">
                                @csrf
                                <!-- Dialog Body -->
                                <div class="px-4 mb-2">
                                    <div class="mb-2">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                                            name="name" :value="old('name')" required autofocus />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Dialog Footer -->
                                <div
                                    class="flex flex-col-reverse justify-between gap-2 border-t border-outline bg-surface-alt/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                    <x-primary-button>Save</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tags as $tag)
                            <tr x-data="{ modalEditTagIsOpen: false }">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="" class="block text-sm font-medium text-gray-900">
                                        {{ $tag->name }}
                                        <span
                                            class="px-1 bg-zinc-600 text-white text-xs rounded-sm inline-block align-top">
                                            {{ $tag->tags->count() }}
                                        </span>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-start items-center gap-5">
                                        <button x-on:click="modalEditTagIsOpen = true" type="button">
                                            <svg fill="#343434" viewBox="0 0 24 24" class="w-4 h-4"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd"
                                                        d="M21,20 C21.5522847,20 22,20.4477153 22,21 C22,21.5522847 21.5522847,22 21,22 L3,22 C2.44771525,22 2,21.5522847 2,21 C2,20.4477153 2.44771525,20 3,20 L21,20 Z M6.29289322,13.2928932 L17.2928932,2.29289322 C17.6533772,1.93240926 18.2206082,1.90467972 18.6128994,2.20970461 L18.7071068,2.29289322 L21.7071068,5.29289322 C22.0675907,5.65337718 22.0953203,6.22060824 21.7902954,6.61289944 L21.7071068,6.70710678 L10.7071068,17.7071068 C10.5508265,17.8633871 10.3481451,17.9625983 10.131444,17.9913276 L10,18 L7,18 C6.48716416,18 6.06449284,17.6139598 6.00672773,17.1166211 L6,17 L6,14 C6,13.7789863 6.07316447,13.565516 6.20608063,13.3919705 L6.29289322,13.2928932 L17.2928932,2.29289322 L6.29289322,13.2928932 Z M18,4.41421356 L8,14.4142136 L8,16 L9.58578644,16 L19.5857864,6 L18,4.41421356 Z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </button>
                                        <form action="{{ route('tags.destroy', $tag->id) }}" method="post"
                                            class="flex items-center justify-center"
                                            onsubmit="event.preventDefault();deleteNote(this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                            stroke="#343434" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>


                                        <div x-cloak x-show="modalEditTagIsOpen" x-transition.opacity.duration.200ms
                                            x-trap.inert.noscroll="modalEditTagIsOpen"
                                            x-on:keydown.esc.window="modalEditTagIsOpen = false"
                                            x-on:click.self="modalEditTagIsOpen = false"
                                            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                                            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                                            <!-- Modal Dialog -->
                                            <div x-show="modalEditTagIsOpen"
                                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="flex w-full max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-outline bg-white text-dark">
                                                <!-- Dialog Header -->
                                                <div
                                                    class="flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 ">
                                                    <h3 id="defaultModalTitle"
                                                        class="font-semibold tracking-wide text-on-surface-strong">
                                                        Edit Tag</h3>
                                                    <button x-on:click="modalEditTagIsOpen = false"
                                                        aria-label="close modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            aria-hidden="true" stroke="currentColor" fill="none"
                                                            stroke-width="1.4" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <form action="{{ route('tags.update', $tag->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Dialog Body -->
                                                    <div class="px-4 mb-2">
                                                        <div class="mb-2">
                                                            <x-input-label for="name_{{ $tag->id }}"
                                                                :value="__('Name')" />
                                                            <x-text-input id="name_{{ $tag->id }}"
                                                                class="block mt-1 w-full" type="text"
                                                                name="name" :value="$tag->name" required autofocus />
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>
                                                    </div>
                                                    <!-- Dialog Footer -->
                                                    <div
                                                        class="flex flex-col-reverse justify-between gap-2 border-t border-outline bg-surface-alt/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                                        <x-primary-button>Save</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4" colspan="2">
                                    <p class="text-sm text-gray-900  text-center">
                                        No data
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-alert-confirm-delete />
</x-app-layout>
