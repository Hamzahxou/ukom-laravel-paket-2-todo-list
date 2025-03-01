<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Details of Note :" $note->title }}
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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-3 w-full min-h-96 h-96  relative">
            <div class="flex justify-start items-center gap-5">
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
                        <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                    stroke="#343434" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </button>
                </form>
            </div>
            <h1 class="text-gray-800 font-bold text-lg mb-2 truncate">{{ $note->title }}</h1>
            <p class="text-slate-500 text-justify line-clamp-[12] mb-2">{!! $note->content !!}</p>
            <i
                class="text-xs text-slate-400 block text-end mb-2 absolute bottom-2 right-2">{{ $note->created_at->diffForHumans() }}</i>
        </div>

    </div>


    <x-alert-confirm-delete />
</x-app-layout>
