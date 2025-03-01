<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Todo $todo->title" }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div x-data="{ detailsIsOpen: false }" @if ($todo->completed) class="bg-slate-100" @endif>
                <div class="px-6 py-4 whitespace-nowrap align-top">
                    <form action="{{ route('updateCompleted', $todo->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="completed" value="{{ $todo->completed }}">
                        <input type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                            @if (!$todo->completed) onchange="alertConfirm(this.form, 'is this task completed');this.checked=!this.checked"
                        @else 
                            onchange="alertConfirm(this.form, '');
                            this.checked=!this.checked" @endif
                            @checked($todo->completed)>
                    </form>
                </div>
                <div class="px-6 py-4 whitespace-nowrap w-full">
                    <a href="{{ route('todo-lists.show', $todo->id) }}">
                        <span class="block text-lg font-medium text-gray-900">
                            {{ $todo->title }}
                        </span>
                    </a>


                    <div class="flex gap-2 ">

                        @if ($todo->priority == 1)
                            <span
                                class="inline-block text-xs font-medium bg-green-100 text-green-800 px-3 py-1 rounded-full">
                                Low
                            </span>
                        @elseif($todo->priority == 2)
                            <span
                                class="inline-block text-xs font-medium
                        bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">
                                Medium
                            </span>
                        @elseif($todo->priority == 3)
                            <span
                                class="inline-block text-xs font-medium bg-red-100 text-red-800 px-3 py-1 rounded-full">
                                High
                            </span>
                        @endif

                        <button type="button" x-show="!detailsIsOpen" x-on:click="detailsIsOpen = true">
                            <svg fill="#333" class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd"
                                        d="M21.00025,8.00025 C21.00025,8.25625 20.90225,8.51225 20.70725,8.70725 L12.70725,16.70725 C12.31625,17.09825 11.68425,17.09825 11.29325,16.70725 L3.29325,8.70725 C2.90225,8.31625 2.90225,7.68425 3.29325,7.29325 C3.68425,6.90225 4.31625,6.90225 4.70725,7.29325 L12.00025,14.58625 L19.29325,7.29325 C19.68425,6.90225 20.31625,6.90225 20.70725,7.29325 C20.90225,7.48825 21.00025,7.74425 21.00025,8.00025">
                                    </path>
                                </g>
                            </svg>
                        </button>
                        <button type="button" x-show="detailsIsOpen" x-on:click="detailsIsOpen = false">
                            <svg fill="#333" class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd"
                                        d="M21.00025,8.00025 C21.00025,8.25625 20.90225,8.51225 20.70725,8.70725 L12.70725,16.70725 C12.31625,17.09825 11.68425,17.09825 11.29325,16.70725 L3.29325,8.70725 C2.90225,8.31625 2.90225,7.68425 3.29325,7.29325 C3.68425,6.90225 4.31625,6.90225 4.70725,7.29325 L12.00025,14.58625 L19.29325,7.29325 C19.68425,6.90225 20.31625,6.90225 20.70725,7.29325 C20.90225,7.48825 21.00025,7.74425 21.00025,8.00025"
                                        transform="matrix(1 0 0 -1 0 24)"></path>
                                </g>
                            </svg>
                        </button>

                        <a href="{{ route('todo-lists.index', ['id' => $todo->id, 'edit' => true]) }}">
                            <svg fill="#343434" viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd"
                                        d="M21,20 C21.5522847,20 22,20.4477153 22,21 C22,21.5522847 21.5522847,22 21,22 L3,22 C2.44771525,22 2,21.5522847 2,21 C2,20.4477153 2.44771525,20 3,20 L21,20 Z M6.29289322,13.2928932 L17.2928932,2.29289322 C17.6533772,1.93240926 18.2206082,1.90467972 18.6128994,2.20970461 L18.7071068,2.29289322 L21.7071068,5.29289322 C22.0675907,5.65337718 22.0953203,6.22060824 21.7902954,6.61289944 L21.7071068,6.70710678 L10.7071068,17.7071068 C10.5508265,17.8633871 10.3481451,17.9625983 10.131444,17.9913276 L10,18 L7,18 C6.48716416,18 6.06449284,17.6139598 6.00672773,17.1166211 L6,17 L6,14 C6,13.7789863 6.07316447,13.565516 6.20608063,13.3919705 L6.29289322,13.2928932 L17.2928932,2.29289322 L6.29289322,13.2928932 Z M18,4.41421356 L8,14.4142136 L8,16 L9.58578644,16 L19.5857864,6 L18,4.41421356 Z">
                                    </path>
                                </g>
                            </svg>
                        </a>

                        <form action="{{ route('todo-lists.destroy', $todo->id) }}" method="post"
                            class="flex items-center justify-center" onsubmit="event.preventDefault();deleteNote(this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
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
                </div>

                <div class="block w-full overflow-x-hidden p-2 pb-14" x-show="detailsIsOpen">
                    <div x-data="{ openTab: 1 }">
                        <div class="mb-4 flex space-x-4">
                            <button x-on:click="openTab = 1" :class="{ 'bg-blue-600 text-white': openTab === 1 }"
                                class="inline-flex items-center px-4 py-2  border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Details
                            </button>
                            <button x-on:click="openTab = 2" :class="{ 'bg-blue-600 text-white': openTab === 2 }"
                                class="inline-flex items-center px-4 py-2  border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Teams
                            </button>
                            <button x-on:click="openTab = 3" :class="{ 'bg-blue-600 text-white': openTab === 3 }"
                                class="inline-flex items-center px-4 py-2  border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Comments
                            </button>
                        </div>

                        <div x-show="openTab === 1" class="transition-all duration-300">

                            @if ($todo->description)
                                <div class="mb-2 px-4 py-2 border border-1 border-gray-300 rounded-md ">
                                    <h6 class="text-slate-700 font-semibold text-sm mb-1">
                                        Description
                                    </h6>
                                    <p class="text-sm text-slate-700 ms-2 font-semibold">
                                        {{ $todo->description }}
                                    </p>
                                </div>
                            @endif
                            <div class="mb-2">
                                <div class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div class="flex gap-2 items-center">
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                                                Task in progress
                                            </span>
                                            @if ($todo->completed)
                                                <span
                                                    class="inline-block py-1 px-2 text-xs font-medium text-white bg-green-500 rounded-full">
                                                    finished
                                                </span>
                                            @else
                                                <span
                                                    class="inline-block py-1 px-2 text-xs font-medium text-white bg-red-500 rounded-full">
                                                    unfinished
                                                </span>
                                            @endif
                                            <p class="text-xs text-slate-700">Token: <b
                                                    class="font-semibold">{{ $todo->token }}</b>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-semibold inline-block text-blue-600">
                                                {{ $todo->progress }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                                        <div style="width: {{ $todo->progress }}%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-700">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <table>
                                    <tr>
                                        <th align="left">Tags</th>
                                        <th>:</th>
                                        <th>
                                            @foreach ($todo->tags as $tag)
                                                <a href=""
                                                    class="text-xs py-1 px-2 rounded-sm bg-slate-700 text-white">{{ $tag->tagItem->name }}</a>
                                            @endforeach

                                        </th>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div x-show="openTab === 2" class="transition-all duration-300">
                            <div class="mb-2">
                                <table>
                                    <tr>
                                        <th align="left">Team</th>
                                        <th>:</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($todo->members as $member)
                                        <tr>
                                            <td>
                                                <p class="text-sm text-slate-700 ms-2">Name</p>
                                            </td>
                                            <td>
                                                <p class="text-sm text-slate-700">:</p>
                                            </td>
                                            <td>
                                                <p class="text-sm text-slate-700">
                                                    {{ $member->user->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <form action="{{ route('joinTaskUpdate', $member->id) }}"
                                                    method="post" class="mb-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" id="status"
                                                        onchange="alertConfirm(this.form, 'change status')"
                                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-slate-700 shadow-md text-xs"
                                                        style="field-sizing: content">
                                                        <option value="" disabled> -- Select
                                                            Status
                                                            -- </option>
                                                        <option value="pending" @selected($member->status == 'pending')>Pending
                                                        </option>
                                                        <option value="accepted" @selected($member->status == 'accepted')>
                                                            Accepted
                                                        </option>
                                                        <option value="rejected" @selected($member->status == 'rejected')>
                                                            Rejected
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div x-show="openTab === 3" class="transition-all duration-300">
                            <div class="mb-2">
                                <h6 class="text-slate-700 font-semibold text-md">Comment:</h6>
                                <form action="{{ route('comments.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $todo->id }}">
                                    <x-textarea name="content" label="Comment" placeholder="Comment"
                                        class="block w-full text-gray-800 bg-transparent font-bold text-sm mb-2"
                                        style="field-sizing: content">{{ old('comment') }}</x-textarea>
                                    <x-primary-button type="submit">
                                        Send
                                    </x-primary-button>
                                </form>
                            </div>

                            @forelse ($todo->comments as $comment)
                                <div class="border p-2 rounded-md mb-2">
                                    <h6 class="mb-1 flex justify-between items-center">
                                        <span class="text-slate-700 font-semibold text-sm ">
                                            {{ $comment->user->name }}
                                        </span>
                                        <x-dropdown align="right" width="">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    <div class="ms-1">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <div class="flex  flex-col p-2 gap-2">

                                                    <x-secondary-button type="button" class="">
                                                        <svg fill="#1f2937 " viewBox="0 0 32 32" class="w-3 h-3"
                                                            version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                            </g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <title>reply-all</title>
                                                                <path
                                                                    d="M0 16q0-1.056 0.896-1.664l12-8q0.448-0.288 0.992-0.32t1.056 0.224q0.64 0.352 0.928 1.056l-8.096 5.376q-0.832 0.576-1.312 1.472t-0.448 1.856 0.448 1.888 1.312 1.44l8.096 5.376q-0.288 0.736-0.928 1.088-0.48 0.256-1.056 0.224t-0.992-0.352l-12-8q-0.896-0.544-0.896-1.664zM8 16q0-1.088 0.896-1.664l12-8q0.448-0.288 0.992-0.32t1.056 0.224q0.48 0.256 0.768 0.736t0.288 1.024v4q3.328 0 5.664 2.336t2.336 5.664q0 2.080-1.12 4-1.056-1.824-2.88-2.912t-4-1.088v4q0 0.544-0.288 1.024t-0.768 0.736-1.056 0.224-0.992-0.32l-12-8q-0.896-0.576-0.896-1.664z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </x-secondary-button>
                                                    @if ($comment->user_id == Auth::user()->id)
                                                        <x-primary-button type="button"
                                                            onclick="updateComment('{{ route('comments.update', $comment->id) }}', '{{ $comment->content }}')">
                                                            <svg fill="#ffffff" viewBox="0 0 24 24" class="w-3 h-3"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                </g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path fill-rule="evenodd"
                                                                        d="M21,20 C21.5522847,20 22,20.4477153 22,21 C22,21.5522847 21.5522847,22 21,22 L3,22 C2.44771525,22 2,21.5522847 2,21 C2,20.4477153 2.44771525,20 3,20 L21,20 Z M6.29289322,13.2928932 L17.2928932,2.29289322 C17.6533772,1.93240926 18.2206082,1.90467972 18.6128994,2.20970461 L18.7071068,2.29289322 L21.7071068,5.29289322 C22.0675907,5.65337718 22.0953203,6.22060824 21.7902954,6.61289944 L21.7071068,6.70710678 L10.7071068,17.7071068 C10.5508265,17.8633871 10.3481451,17.9625983 10.131444,17.9913276 L10,18 L7,18 C6.48716416,18 6.06449284,17.6139598 6.00672773,17.1166211 L6,17 L6,14 C6,13.7789863 6.07316447,13.565516 6.20608063,13.3919705 L6.29289322,13.2928932 L17.2928932,2.29289322 L6.29289322,13.2928932 Z M18,4.41421356 L8,14.4142136 L8,16 L9.58578644,16 L19.5857864,6 L18,4.41421356 Z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </x-primary-button>
                                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                                            method="post"
                                                            onsubmit="event.preventDefault();deleteNote(this)">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-danger-button type="submit">
                                                                <svg fill="none" viewBox="0 0 24 24"
                                                                    class="w-3 h-3"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                    </g>
                                                                    <g id="SVGRepo_tracerCarrier"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                    </g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path
                                                                            d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                                            stroke="#ffffff" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </g>
                                                                </svg>
                                                            </x-danger-button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </x-slot>
                                        </x-dropdown>
                                    </h6>
                                    <p class="text-slate-600 text-sm ms-2 text-wrap">
                                        {{ $comment->content }}</p>
                                    <div class="flex justify-end items-center">
                                        <i
                                            class="text-xs text-slate-700 italic">{{ $comment->created_at->diffForHumans() }}</i>
                                    </div>
                                </div>

                            @empty
                                <p>No data</p>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <x-alert-confirm />
    <x-alert-confirm-delete />
    <x-update-comment />


</x-app-layout>
