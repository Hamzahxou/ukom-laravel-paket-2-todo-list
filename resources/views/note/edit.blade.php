<x-app-layout>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Details of Note : $note->title" }}
        </h2>
    </x-slot>

    <div class="py-5 max-w-7xl mx-auto sm:px-6 lg:px-8">


        <x-link-secondary href="{{ route('notes.index') }}" class="mb-3  gap-3">

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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-3 w-full min-h-96  relative">
            <form action="{{ route('notes.update', $note->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <x-text-input name="title" value="{{ $note->title }}" label="Title"
                        class="block w-full border-none outline-none ring-none shadow-none rounded-md  text-gray-800 font-bold text-lg"
                        required autofocus />
                </div>

                <div class="mb-2">
                    <input id="x" type="hidden" value="{{ $note->content }}" name="content">
                    <trix-editor input="x"></trix-editor>
                </div>

                <div class="mb-2">
                    <x-tagify :tags="$tags" :value="$note->tags->pluck('tagItem.name')" name="tags" />
                </div>

                <x-primary-button class="mt-4" type="submit">
                    Update
                </x-primary-button>
            </form>
        </div>

    </div>


    <x-alert-confirm-delete />
</x-app-layout>
