<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todo Team</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        button[data-toggle-navbar][data-is-open="true"] #line-1 {
            transform: translateY(0.375rem) rotate(40deg);
        }

        button[data-toggle-navbar][data-is-open="true"] #line-2 {
            transform: scaleX(0);
            opacity: 0;
        }

        button[data-toggle-navbar][data-is-open="true"] #line-3 {
            transform: translateY(-0.375rem) rotate(-40deg);
        }
    </style>


</head>

<body class="font-sans antialiased">

    <!-- component -->
    <header class="inset-x-0 top-0 z-50 py-3">
        <div class="mx-auto lg:max-w-7xl w-full px-5 sm:px-10 md:px-12 lg:px-5">
            <nav class="w-full flex justify-between gap-6 relative">
                <!-- logo -->
                <div class="min-w-max inline-flex relative">
                    <a href="/" class="relative flex items-center gap-3">
                        {{-- <img src="{{ asset('storage/assets/logo/icon.png') }}" class="w-10" alt=""> --}}
                        <div class="inline-flex text-xl font-semibold text-gray-900">
                            <span class="text-gray-500 fw-bold">Todo</span>Team
                        </div>
                    </a>
                </div>

                <div data-nav-overlay aria-hidden="true"
                    class="fixed hidden inset-0 lg:!hidden bg-gray-800/60 bg-opacity-50 backdrop-filter backdrop-blur-xl">
                </div>
                <div data-navbar
                    class="flex invisible opacity-0  translate-y-10 overflow-hidden lg:visible lg:opacity-100  lg:-translate-y-0 lg:scale-y-100 duration-300 ease-linear flex-col gap-y-6 gap-x-4 lg:flex-row w-full lg:justify-between lg:items-center p-5 md:p-0 absolute lg:relative top-full lg:top-0 bg-white lg:!bg-transparent border-x border-x-gray-100 lg:border-x-0">

                    <div></div>

                    <div class="flex gap-1 justify-center items-center">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="text-white bg-gray-500 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground h-10 px-4 py-2 w-full sm:w-auto">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-white bg-gray-500 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground h-10 px-4 py-2 w-full sm:w-auto">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}"
                                class="hover:ring-gray-400 hover:bg-gray-100 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 mt-3 w-full sm:mt-0 sm:ml-3 sm:w-auto">
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>


                <div class="min-w-max flex items-center gap-x-3">

                    <button data-toggle-navbar data-is-open="false"
                        class="lg:hidden lg:invisible outline-none w-7 h-auto flex flex-col relative">
                        <span id="line-1"
                            class="w-6 h-0.5 rounded-full bg-gray-700 transition-all duration-300 ease-linear"></span>
                        <span id="line-2"
                            class="w-6 origin-center  mt-1 h-0.5 rounded-ful bg-gray-700 transition-all duration-300 ease-linear"></span>
                        <span id="line-3"
                            class="w-6 mt-1 h-0.5 rounded-ful bg-gray-700 transition-all duration-300 ease-linear"></span>
                        <span class="sr-only">togglenav</span>
                    </button>
                </div>
            </nav>
        </div>
    </header>
    <div class="bg-white h-96 font-sans mx-auto max-w-screen-xl lg:px-8 mb-20">
        <div class="grid md:grid-cols-2 gap-2 h-full">
            <div class="flex flex-col  justify-center gap-4 p-10">
                <div>
                    <a class="inline-flex px-1 py-1 gap-x-2 rounded-xl  border-gray-400 border-2 hover:border-gray-500 items-center text-sm font-semibold text-gray-600 space-x-1"
                        href="#">
                        <span
                            class="bg-gray-100 flex items-center justify-center gap-2 text-gray-800 text-sm font-semibold px-2.5 py-0.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-6 w-6 text-natural-400">
                                <path d="m3 11 18-5v12L3 14v-3z"></path>
                                <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"></path>
                            </svg>

                        </span>
                        Explore
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg></a>
                </div>
                <h1
                    class="mt-4 text-3xl tracking-tight font-extrabold text-gray-900 sm:mt-5 sm:leading-none lg:mt-6 lg:text-4xl xl:text-5xl">
                    <p class="sm:block">Create a task and invite your team</p>
                </h1>
                <div class="mt-10 sm:flex sm:justify-center lg:justify-start">
                    <a href="{{ route('todo-lists.index') }}"
                        class="inline-flex items-center text-white bg-gray-500 justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full sm:w-auto">
                        Create</a>
                </div>
            </div>
            <di class="flex justify-center items-center">
                <img src="{{ asset('assets/image/task-ilustration.svg') }}" alt="" width="400px">
            </di>
        </div>
    </div>

    <footer class="bg-white">
        <div class="mx-auto max-w-screen-xl space-y-8 px-4 py-16 sm:px-6 lg:space-y-16 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div>
                    <div class="text-teal-600">
                        {{-- <img src="{{ asset('storage/assets/logo/icon.png') }}" class="w-10" alt=""> --}}
                    </div>

                    <p class="mt-4 max-w-xs text-gray-500">
                        task maker app collaborate with your team
                    </p>

                    <ul class="mt-8 flex gap-6">
                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75">
                                <span class="sr-only">GitHub</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75">
                                <span class="sr-only">Dribbble</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-4">
                    <div>
                        <p class="font-medium text-gray-900">Halaman</p>

                        <ul class="mt-6 space-y-4 text-sm">
                            <li>
                                <a href="#" class="text-gray-700 transition hover:opacity-75">
                                    Beranda
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-500">&copy; 2025. xoustudio. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const btnHumb = document.querySelector("[data-toggle-navbar]")
        const navbar = document.querySelector("[data-navbar]")
        const overlay = document.querySelector("[data-nav-overlay]")
        if (btnHumb && navbar) {
            const toggleBtnAttr = () => {
                const isOpen = btnHumb.getAttribute("data-is-open")
                btnHumb.setAttribute("data-is-open", isOpen === "true" ? "false" : "true")
                if (isOpen === "false") {
                    overlay.classList.toggle("hidden")
                    document.body.classList.add('max-h-screen', 'overflow-hidden')
                } else {
                    overlay.classList.add("hidden")
                    document.body.classList.remove('max-h-screen', 'overflow-hidden')
                }
            }
            btnHumb.addEventListener("click", () => {
                navbar.classList.toggle("invisible")
                navbar.classList.toggle("opacity-0")
                navbar.classList.toggle("translate-y-10")
                toggleBtnAttr()
            })

            overlay.addEventListener("click", () => {
                navbar.classList.add("invisible")
                navbar.classList.add("opacity-0")
                navbar.classList.add("translate-y-10")
                toggleBtnAttr()
            })
        }
    </script>
</body>

</html>
