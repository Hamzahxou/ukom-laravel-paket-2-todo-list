<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Todo' }}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                @if (isset($edit))
                    @if ($edit->description)
                        <div class="p-6 text-gray-900" x-data="{ descriptionIsOpen: true }">
                        @else
                            <div class="p-6 text-gray-900" x-data="{ descriptionIsOpen: false }">
                    @endif
                    <x-link-secondary href="{{ route('todo-lists.index') }}" class="mb-3  gap-3">
                        <svg fill="#343434" viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd"
                                    d="M10.7902954,4.38710056 L10.7071068,4.29289322 C10.3466228,3.93240926 9.77939176,3.90467972 9.38710056,4.20970461 L9.29289322,4.29289322 L2.29289322,11.2928932 L2.2514958,11.336853 L2.2514958,11.336853 L2.19633458,11.4046934 L2.19633458,11.4046934 L2.12467117,11.5159379 L2.12467117,11.5159379 L2.07122549,11.628664 L2.07122549,11.628664 L2.03584514,11.734007 L2.03584514,11.734007 L2.00690716,11.8819045 L2.00690716,11.8819045 L2,12 L2.00278786,12.0752385 L2.00278786,12.0752385 L2.02024007,12.2007258 L2.02024007,12.2007258 L2.04973809,12.3121425 L2.04973809,12.3121425 L2.09367336,12.4232215 L2.09367336,12.4232215 L2.14599545,12.5207088 L2.14599545,12.5207088 L2.21968877,12.625449 L2.21968877,12.625449 L2.29289322,12.7071068 L9.29289322,19.7071068 C9.68341751,20.0976311 10.3165825,20.0976311 10.7071068,19.7071068 C11.0675907,19.3466228 11.0953203,18.7793918 10.7902954,18.3871006 L10.7071068,18.2928932 L5.416,13 L21,13 C21.5522847,13 22,12.5522847 22,12 C22,11.4477153 21.5522847,11 21,11 L5.414,11 L10.7071068,5.70710678 C11.0675907,5.34662282 11.0953203,4.77939176 10.7902954,4.38710056 L10.7071068,4.29289322 L10.7902954,4.38710056 Z">
                                </path>
                            </g>
                        </svg>
                        Back
                    </x-link-secondary>
                    <form action="{{ route('todo-lists.update', $edit->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="flex gap-2 mb-2">
                            <x-text-input name="title" label="Title" placeholder="Task"
                                class="block w-full text-gray-700 font-bold text-lg  mb-2 md:mb-0" :value="$edit->title" />
                            <div class="flex gap-2 mb-2 md:mb-0">
                                <select name="priority" id="priority"
                                    class="border-gray-300 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm w-full md:w-auto"
                                    style="field-sizing: content">
                                    <option value="" selected> -- Select Priority -- </option>
                                    <option value="1" @selected($edit->priority == '1')>Low</option>
                                    <option value="2" @selected($edit->priority == '2')>Medium</option>
                                    <option value="3" @selected($edit->priority == '3')>High</option>
                                </select>

                                <x-secondary-button type="button" x-on:click="descriptionIsOpen = !descriptionIsOpen">
                                    <svg viewBox="0 0 32 32" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M9 17H15" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                            </path>
                                            <path d="M9 13H15" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                            </path>
                                            <path d="M9 9H10" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                            </path>
                                            <path
                                                d="M5 6C5 4.34315 6.34315 3 8 3H13.1716C13.702 3 14.2107 3.21071 14.5858 3.58579L18.4142 7.41421C18.7893 7.78929 19 8.29799 19 8.82843V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V6Z"
                                                stroke="#1f2937" stroke-width="2"></path>
                                            <path d="M13 3V5C13 7.20914 14.7909 9 17 9H19" stroke="#1f2937"
                                                stroke-width="2">
                                            </path>
                                        </g>
                                    </svg>
                                </x-secondary-button>
                                <x-primary-button type="submit">
                                    Update
                                </x-primary-button>
                            </div>
                        </div>
                        <x-textarea x-show="descriptionIsOpen" name="description" label="Description"
                            placeholder="Description" class="block w-full text-gray-800 font-bold text-sm mb-2"
                            style="field-sizing: content">{{ $edit->description }}</x-textarea>
                        <div class="mb-2">
                            <label for="progress-range" class="block text-gray-700 font-bold">Progress: <span
                                    id="minprogress">{{ $edit->progress }}</span></label>
                            <input type="range" id="progress-range" name="progress"
                                class="w-full accent-indigo-500 cursor-e-resize" min="0" max="100"
                                value="{{ $edit->progress }}" oninput="updateprogress(this.value)">
                        </div>

                        <script>
                            function updateprogress(value) {
                                document.getElementById("minprogress").textContent = value;
                            }
                        </script>
                        <x-tagify :tags="$tags" name="tags" :value="$edit->tags->pluck('name')" />
                    </form>
            </div>
        @else
            @if (old('description'))
                <div class="p-6 text-gray-900" x-data="{ descriptionIsOpen: true }">
                @else
                    <div class="p-6 text-gray-900" x-data="{ descriptionIsOpen: false }">
            @endif
            <form action="{{ route('todo-lists.store') }}" method="post">
                @csrf
                <div class="md:flex gap-2 mb-2">
                    <x-text-input name="title" label="Title" placeholder="Task"
                        class="block w-full text-gray-700 font-bold text-lg mb-2 md:mb-0" :value="old('title')" />
                    <div class="flex gap-2 mb-2 md:mb-0">
                        <select name="priority" id="priority"
                            class="border-gray-300 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm w-full md:w-auto"
                            style="field-sizing: content">
                            <option value="" selected> -- Select Priority -- </option>
                            <option value="1" @selected(old('priority') == '1')>Low</option>
                            <option value="2" @selected(old('priority') == '2')>Medium</option>
                            <option value="3" @selected(old('priority') == '3')>High</option>
                        </select>

                        <x-secondary-button type="button" x-on:click="descriptionIsOpen = !descriptionIsOpen">
                            <svg viewBox="0 0 32 32" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M9 17H15" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                    </path>
                                    <path d="M9 13H15" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                    </path>
                                    <path d="M9 9H10" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                    </path>
                                    <path
                                        d="M5 6C5 4.34315 6.34315 3 8 3H13.1716C13.702 3 14.2107 3.21071 14.5858 3.58579L18.4142 7.41421C18.7893 7.78929 19 8.29799 19 8.82843V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V6Z"
                                        stroke="#1f2937" stroke-width="2"></path>
                                    <path d="M13 3V5C13 7.20914 14.7909 9 17 9H19" stroke="#1f2937" stroke-width="2">
                                    </path>
                                </g>
                            </svg>
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            Create
                        </x-primary-button>
                    </div>
                </div>
                <x-textarea x-show="descriptionIsOpen" name="description" label="Description"
                    placeholder="Description" class="block w-full text-gray-800 font-bold text-sm mb-2"
                    style="field-sizing: content">{{ old('description') }}</x-textarea>
                <x-tagify :tags="$tags" name="tags" :value="old('tags')" />
            </form>
        </div>
        @endif
    </div>

    <form action="" method="get" class="flex gap-2">
        <div class="w-full mb-5 bg-white rounded-lg shadow-md py-2 px-4 flex gap-2">

            <div class="w-full flex gap-2">
                <x-text-input name="search" label="Search" placeholder="Search"
                    class="block w-full text-gray-700 text-sm mb-2 md:mb-0" :value="request()->get('search')" />
                <x-primary-button type="submit">
                    <svg viewBox="0 0 32 32" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                stroke="#ffffff" stroke-width="2"></path>
                            <path d="M14 14L16 16" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M15 11.5C15 13.433 13.433 15 11.5 15C9.567 15 8 13.433 8 11.5C8 9.567 9.567 8 11.5 8C13.433 8 15 9.567 15 11.5Z"
                                stroke="#ffffff" stroke-width="2"></path>
                        </g>
                    </svg>
                </x-primary-button>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-secondary-button type="button">
                        <svg fill="#1f2937 " viewBox="0 0 32 32" class="w-4 h-4 md:w-5 md:h-5" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>Filter</title>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g id="Filter">
                                        <rect id="Rectangle" fill-rule="nonzero" x="0" y="0" width="24"
                                            height="24">
                                        </rect>
                                        <line x1="4" y1="5" x2="16" y2="5"
                                            id="Path" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                        </line>
                                        <line x1="4" y1="12" x2="10" y2="12"
                                            id="Path" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                        </line>
                                        <line x1="14" y1="12" x2="20" y2="12"
                                            id="Path" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                        </line>
                                        <line x1="8" y1="19" x2="20" y2="19"
                                            id="Path" stroke="#1f2937" stroke-width="2" stroke-linecap="round">
                                        </line>
                                        <circle id="Oval" stroke="#0C0310" stroke-width="2"
                                            stroke-linecap="round" cx="18" cy="5" r="2"> </circle>
                                        <circle id="Oval" stroke="#0C0310" stroke-width="2"
                                            stroke-linecap="round" cx="12" cy="12" r="2"> </circle>
                                        <circle id="Oval" stroke="#0C0310" stroke-width="2"
                                            stroke-linecap="round" cx="6" cy="19" r="2"> </circle>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </x-secondary-button>
                </x-slot>

                <x-slot name="content">
                    <div class="p-2">
                        <span class="text-slate-600 text-xs font-medium">Completed</span>
                        <div class="flex items-center gap-2 mb-1 ">
                            <input type="radio" name="completed" value="true" id="finished"
                                class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                                @checked(request()->get('completed') == 'true')>
                            <label for="finished" class="text-gray-700 font-medium text-sm">Finished</label>
                        </div>
                        <div class="flex items-center gap-2 mb-1 ">
                            <input type="radio" name="completed" value="false" id="unfinished"
                                class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                                @checked(request()->input('completed') == 'false')>
                            <label for="unfinished" class="text-gray-700 font-medium text-sm">Unfinished</label>
                        </div>

                        <span class="text-slate-600 text-xs font-medium">Priority</span>
                        <div class="flex items-center gap-2 mb-1 ">
                            <input type="radio" name="priority" value="1" id="low"
                                class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                                @checked(request()->get('priority') == 1)>
                            <label for="low" class="text-gray-700 font-medium text-sm">Low</label>
                        </div>
                        <div class="flex items-center gap-2 mb-1 ">
                            <input type="radio" name="priority" value="2" id="medium"
                                class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                                @checked(request()->get('priority') == 2)>
                            <label for="medium" class="text-gray-700 font-medium text-sm">Medium</label>
                        </div>
                        <div class="flex items-center gap-2 mb-1 ">
                            <input type="radio" name="priority" value="3" id="high"
                                class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                                @checked(request()->get('priority') == 3)>
                            <label for="high" class="text-gray-700 font-medium text-sm">High</label>
                        </div>

                        <div class="flex items-center gap-2 mb-1">
                            <x-secondary-button type="button" onclick="resetFilter()">
                                reset
                            </x-secondary-button>
                            <x-primary-button type="submit">
                                apply
                            </x-primary-button>
                        </div>
                    </div>

                    <script>
                        function resetFilter() {
                            document.querySelectorAll('input[name="priority"]:checked').forEach(function(radio) {
                                radio.checked = false;
                            });
                            // Reset input radio completed
                            document.querySelectorAll('input[name="completed"]:checked').forEach(function(radio) {
                                radio.checked = false;
                            });
                        }
                    </script>
                </x-slot>
            </x-dropdown>
        </div>
    </form>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-20">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Priority
                    </th>
                    <th
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
            </thead>
            <tbody>
                @forelse ($todos as $todo)
                    <tr x-data="{ detailsIsOpen: false }" @if ($todo->completed) class="bg-slate-100" @endif>
                        <td class="px-6 py-4 whitespace-nowrap align-top">
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
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap w-full">
                            {{-- <a href="{{ route('todo-lists.show', $todo->id) }}"> --}}
                            <span class="block text-lg font-medium text-gray-900">
                                {{ $todo->title }}
                            </span>
                            {{-- </a> --}}
                            <div class="block w-full overflow-x-hidden p-2" x-show="detailsIsOpen">
                                <div x-data="{ openTab: 1 }" class="pb-28">
                                    <div class="mb-4 flex space-x-4">
                                        <button x-on:click="openTab = 1"
                                            :class="{ 'bg-gray-800 text-white': openTab === 1 }"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Details
                                        </button>
                                        <button x-on:click="openTab = 2"
                                            :class="{ 'bg-gray-800 text-white': openTab === 2 }"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Teams
                                        </button>
                                        <button x-on:click="openTab = 3"
                                            :class="{ 'bg-gray-800 text-white': openTab === 3 }"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Comments
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
                                                                class="text-xs py-1 px-2 rounded-sm bg-slate-700 text-white">{{ $tag->name }}</a>
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
                                                            <x-dropdown align="right" width="">
                                                                <x-slot name="trigger">
                                                                    <button
                                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                                        <div class="ms-1">
                                                                            <svg viewBox="0 0 20 20"
                                                                                class="fill-current h-4 w-4"
                                                                                enable-background="new 0 0 32 32"
                                                                                id="Editable-line" version="1.1"
                                                                                xml:space="preserve"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                fill="#1f2937">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0"></g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <circle cx="16"
                                                                                        cy="16" fill="none"
                                                                                        id="XMLID_55_" r="2"
                                                                                        stroke="#1f2937"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-miterlimit="10"
                                                                                        stroke-width="2"></circle>
                                                                                    <circle cx="16"
                                                                                        cy="26" fill="none"
                                                                                        id="XMLID_54_" r="2"
                                                                                        stroke="#1f2937"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-miterlimit="10"
                                                                                        stroke-width="2"></circle>
                                                                                    <circle cx="16"
                                                                                        cy="6" fill="none"
                                                                                        id="XMLID_52_" r="2"
                                                                                        stroke="#1f2937"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-miterlimit="10"
                                                                                        stroke-width="2"></circle>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </button>
                                                                </x-slot>

                                                                <x-slot name="content" class="">
                                                                    <div class="flex  flex-col p-2 gap-2">
                                                                        <div clasa="">
                                                                            <span
                                                                                class="text-xs text-gray-700">Permission</span>
                                                                            <form
                                                                                action="{{ route('joinTaskUpdate', $member->id) }}"
                                                                                method="post" class="mb-2">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <select name="status" id="status"
                                                                                    onchange="alertConfirm(this.form, 'change status')"
                                                                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md text-slate-700 shadow-md text-xs"
                                                                                    style="field-sizing: content">
                                                                                    <option value="" disabled
                                                                                        selected>selected</option>
                                                                                    @if ($member->status != 'leave')
                                                                                        <option value="accepted"
                                                                                            @selected($member->status == 'accepted')>
                                                                                            Accepted
                                                                                        </option>
                                                                                        @if ($member->status != 'accepted')
                                                                                            <option value="rejected"
                                                                                                @selected($member->status == 'rejected')>
                                                                                                Rejected
                                                                                            </option>
                                                                                        @endif
                                                                                    @endif
                                                                                    @if ($member->status == 'accepted' || $member->status == 'leave')
                                                                                        <option value="leave"
                                                                                            @selected($member->status == 'leave')>
                                                                                            Kick
                                                                                        </option>
                                                                                    @endif
                                                                                    @if ($member->status == 'leave')
                                                                                        <option value="accepted"
                                                                                            @selected($member->status == 'accepted')>
                                                                                            Invite
                                                                                        </option>
                                                                                    @endif

                                                                                </select>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </x-slot>
                                                            </x-dropdown>

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
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                            </button>
                                                        </x-slot>

                                                        <x-slot name="content">
                                                            <div class="flex  flex-col p-2 gap-2">

                                                                <x-secondary-button type="button"
                                                                    onclick="replyComment('{{ route('reply-comment.store', ['id' => $comment->id]) }}')">
                                                                    <svg fill="#1f2937 " viewBox="0 0 32 32"
                                                                        class="w-3 h-3" version="1.1"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                        </g>
                                                                        <g id="SVGRepo_tracerCarrier"
                                                                            stroke-linecap="round"
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
                                                                        <svg fill="#ffffff" viewBox="0 0 24 24"
                                                                            class="w-3 h-3"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <g id="SVGRepo_bgCarrier"
                                                                                stroke-width="0">
                                                                            </g>
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                            </g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M21,20 C21.5522847,20 22,20.4477153 22,21 C22,21.5522847 21.5522847,22 21,22 L3,22 C2.44771525,22 2,21.5522847 2,21 C2,20.4477153 2.44771525,20 3,20 L21,20 Z M6.29289322,13.2928932 L17.2928932,2.29289322 C17.6533772,1.93240926 18.2206082,1.90467972 18.6128994,2.20970461 L18.7071068,2.29289322 L21.7071068,5.29289322 C22.0675907,5.65337718 22.0953203,6.22060824 21.7902954,6.61289944 L21.7071068,6.70710678 L10.7071068,17.7071068 C10.5508265,17.8633871 10.3481451,17.9625983 10.131444,17.9913276 L10,18 L7,18 C6.48716416,18 6.06449284,17.6139598 6.00672773,17.1166211 L6,17 L6,14 C6,13.7789863 6.07316447,13.565516 6.20608063,13.3919705 L6.29289322,13.2928932 L17.2928932,2.29289322 L6.29289322,13.2928932 Z M18,4.41421356 L8,14.4142136 L8,16 L9.58578644,16 L19.5857864,6 L18,4.41421356 Z">
                                                                                </path>
                                                                            </g>
                                                                        </svg>
                                                                    </x-primary-button>
                                                                    <form
                                                                        action="{{ route('comments.destroy', $comment->id) }}"
                                                                        method="post"
                                                                        onsubmit="event.preventDefault();deleteNote(this)">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <x-danger-button type="submit">
                                                                            <svg fill="none" viewBox="0 0 24 24"
                                                                                class="w-3 h-3"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0">
                                                                                </g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <path
                                                                                        d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                                                        stroke="#ffffff"
                                                                                        stroke-width="2"
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
                                            @if ($comment->replyComments->count() > 0)
                                                @foreach ($comment->replyComments as $replyComment)
                                                    <div class="border p-2 rounded-md mb-2 ms-10">
                                                        <h6 class="mb-1 flex justify-between items-center">
                                                            <span class="text-slate-700 font-semibold text-sm ">
                                                                {{ $replyComment->user->name }}
                                                            </span>
                                                            <x-dropdown align="right" width="">
                                                                <x-slot name="trigger">
                                                                    <button
                                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                                        <div class="ms-1">
                                                                            <svg class="fill-current h-4 w-4"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 20 20">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </div>
                                                                    </button>
                                                                </x-slot>

                                                                <x-slot name="content">
                                                                    <div class="flex  flex-col p-2 gap-2">

                                                                        {{-- <x-secondary-button type="button"
                                                                            onclick="replyComment('{{ route('reply-comment.store', ['id' => $comment->id]) }}')">
                                                                            <svg fill="#1f2937 " viewBox="0 0 32 32"
                                                                                class="w-3 h-3" version="1.1"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0">
                                                                                </g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <title>reply-all</title>
                                                                                    <path
                                                                                        d="M0 16q0-1.056 0.896-1.664l12-8q0.448-0.288 0.992-0.32t1.056 0.224q0.64 0.352 0.928 1.056l-8.096 5.376q-0.832 0.576-1.312 1.472t-0.448 1.856 0.448 1.888 1.312 1.44l8.096 5.376q-0.288 0.736-0.928 1.088-0.48 0.256-1.056 0.224t-0.992-0.352l-12-8q-0.896-0.544-0.896-1.664zM8 16q0-1.088 0.896-1.664l12-8q0.448-0.288 0.992-0.32t1.056 0.224q0.48 0.256 0.768 0.736t0.288 1.024v4q3.328 0 5.664 2.336t2.336 5.664q0 2.080-1.12 4-1.056-1.824-2.88-2.912t-4-1.088v4q0 0.544-0.288 1.024t-0.768 0.736-1.056 0.224-0.992-0.32l-12-8q-0.896-0.576-0.896-1.664z">
                                                                                    </path>
                                                                                </g>
                                                                            </svg>
                                                                        </x-secondary-button> --}}
                                                                        @if ($replyComment->user_id == Auth::user()->id)
                                                                            <x-primary-button type="button"
                                                                                onclick="updateComment('{{ route('reply-comment.update', $replyComment->id) }}', '{{ $replyComment->content }}')">
                                                                                <svg fill="#ffffff"
                                                                                    viewBox="0 0 24 24"
                                                                                    class="w-3 h-3"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <g id="SVGRepo_bgCarrier"
                                                                                        stroke-width="0">
                                                                                    </g>
                                                                                    <g id="SVGRepo_tracerCarrier"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round">
                                                                                    </g>
                                                                                    <g id="SVGRepo_iconCarrier">
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M21,20 C21.5522847,20 22,20.4477153 22,21 C22,21.5522847 21.5522847,22 21,22 L3,22 C2.44771525,22 2,21.5522847 2,21 C2,20.4477153 2.44771525,20 3,20 L21,20 Z M6.29289322,13.2928932 L17.2928932,2.29289322 C17.6533772,1.93240926 18.2206082,1.90467972 18.6128994,2.20970461 L18.7071068,2.29289322 L21.7071068,5.29289322 C22.0675907,5.65337718 22.0953203,6.22060824 21.7902954,6.61289944 L21.7071068,6.70710678 L10.7071068,17.7071068 C10.5508265,17.8633871 10.3481451,17.9625983 10.131444,17.9913276 L10,18 L7,18 C6.48716416,18 6.06449284,17.6139598 6.00672773,17.1166211 L6,17 L6,14 C6,13.7789863 6.07316447,13.565516 6.20608063,13.3919705 L6.29289322,13.2928932 L17.2928932,2.29289322 L6.29289322,13.2928932 Z M18,4.41421356 L8,14.4142136 L8,16 L9.58578644,16 L19.5857864,6 L18,4.41421356 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </svg>
                                                                            </x-primary-button>
                                                                            <form
                                                                                action="{{ route('reply-comment.destroy', $replyComment->id) }}"
                                                                                method="post"
                                                                                onsubmit="event.preventDefault();deleteNote(this)">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <x-danger-button type="submit">
                                                                                    <svg fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        class="w-3 h-3"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g id="SVGRepo_bgCarrier"
                                                                                            stroke-width="0">
                                                                                        </g>
                                                                                        <g id="SVGRepo_tracerCarrier"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round">
                                                                                        </g>
                                                                                        <g id="SVGRepo_iconCarrier">
                                                                                            <path
                                                                                                d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                                                                stroke="#ffffff"
                                                                                                stroke-width="2"
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
                                                            {{ $replyComment->content }}</p>
                                                        <div class="flex justify-end items-center">
                                                            <i
                                                                class="text-xs text-slate-700 italic">{{ $replyComment->created_at->diffForHumans() }}</i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @empty
                                            <p>No data</p>
                                        @endforelse
                                    </div>

                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap align-top">
                            @if ($todo->priority == 1)
                                <span
                                    class="block text-xs font-medium bg-green-100 text-green-800 px-3 py-1 rounded-full">
                                    Low
                                </span>
                            @elseif($todo->priority == 2)
                                <span
                                    class="block text-xs font-medium
                                        bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">
                                    Medium
                                </span>
                            @elseif($todo->priority == 3)
                                <span class="block text-xs font-medium bg-red-100 text-red-800 px-3 py-1 rounded-full">
                                    High
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap align-top">
                            <div class="flex gap-2 ">
                                <button type="button" x-show="!detailsIsOpen" x-on:click="detailsIsOpen = true">
                                    <svg fill="#333" class="w-4 h-4" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                    <svg fill="#333" class="w-4 h-4" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                    <svg fill="#343434" viewBox="0 0 24 24" class="w-4 h-4"
                                        xmlns="http://www.w3.org/2000/svg">
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
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-4" colspan="6">
                            <p class="text-sm text-gray-900  text-center">
                                No data
                            </p>
                        </td>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
    </div>


    <x-alert-confirm />
    <x-alert-confirm-delete />
    <x-update-comment />
    <x-reply-comment />

</x-app-layout>
