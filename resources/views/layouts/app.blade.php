<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Your App Name')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="h-full flex">
    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col lg:mr-72">
        <!-- TOP HEADER BAR -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-4 py-4 lg:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Logo/Brand -->
                    <h1 class="text-xl font-semibold text-gray-900 font-cairo">لوحه التحكم</h1>
                </div>

                <!-- Header Actions (Search, Notifications, etc.) -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="hidden md:block">
                        <input type="search" placeholder="Search..."
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>

                    <!-- Notification Bell -->
                    <button class="p-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5-5-5h5zm0 0V4"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT BODY -->
        <div class="flex-1 overflow-hidden">
            <div class="h-full p-4 lg:p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- SIDEBAR TOGGLE BUTTON (Mobile) -->
    <button id="sidebarToggle" title="Side navigation" type="button"
        class="fixed z-40 self-center order-10 visible block w-10 h-10 bg-white rounded opacity-100 lg:hidden right-6 top-6 shadow-lg"
        aria-haspopup="menu" aria-label="Side navigation" aria-expanded="false" aria-controls="nav-menu-1">
        <div class="absolute w-6 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            <span aria-hidden="true"
                class="absolute block h-0.5 w-9/12 -translate-y-2 transform rounded-full bg-slate-700 transition-all duration-300"></span>
            <span aria-hidden="true"
                class="absolute block h-0.5 w-6 transform rounded-full bg-slate-900 transition duration-300"></span>
            <span aria-hidden="true"
                class="absolute block h-0.5 w-1/2 origin-top-left translate-y-2 transform rounded-full bg-slate-900 transition-all duration-300"></span>
        </div>
    </button>

    <!-- RIGHT SIDE NAVIGATION -->
    <aside id="nav-menu-1" aria-label="Side navigation"
        class="fixed top-0 bottom-0 right-0 z-40 flex flex-col transition-transform translate-x-full bg-white border-l w-72 sm:translate-x-0 border-l-slate-200 shadow-lg lg:shadow-none lg:translate-x-0">
        <!-- User Profile Section -->
        <div class="flex flex-col items-center gap-4 p-6 border-b border-slate-200">
            <div class="shrink-0">
                <a href="#" class="relative flex items-center justify-center w-12 h-12 text-white rounded-full">
                    <img src="https://i.pravatar.cc/40?img=7" alt="user name" title="user name" width="48" height="48"
                        class="max-w-full rounded-full" />
                    <span
                        class="absolute bottom-0 right-0 inline-flex items-center justify-center gap-1 p-1 text-sm text-white border-2 border-white rounded-full bg-emerald-500">
                        <span class="sr-only">online</span>
                    </span>
                </a>
            </div>
            <div class="flex flex-col gap-0 min-h-[2rem] items-end justify-center w-full min-w-0 text-center">
                <h4 class="w-full text-base truncate text-slate-700">{{Auth::user()->FirstName}}
                    {{Auth::user()->SecondName}}</h4>
                <p class="w-full text-sm truncate text-slate-500">

                    {{Auth::user()->ShamandoraCode}} ,
                    {{ Auth::user()->RoleID }}
                </p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav aria-label="side navigation" class="flex-1 overflow-auto ">
            <div>
                <ul class="py-4">
                    <li x-data="{ open: false }" class="px-3">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between gap-3 p-3 transition-colors rounded text-slate-700 hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50">

                            <div class="flex flex-col justify-center items-start flex-1 w-full text-sm truncate">
                                ثوابت النظام
                            </div>

                            <div class="flex items-center self-center transform transition-transform"
                                :class="{ '-rotate-90  ': open }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>

                        </button>

                        <!-- Sub-items (not links) -->
                        <ul x-show="open" x-transition class="mt-2 space-y-1 pr-6 text-sm text-end">
                            <li class="px-3 py-2 rounded hover:bg-emerald-100 cursor-pointer">الإعدادات العامة</li>
                            <li class="px-3 py-2 rounded hover:bg-emerald-100 cursor-pointer">الصلاحيات</li>
                            <li class="px-3 py-2 rounded hover:bg-emerald-100 cursor-pointer">المستخدمين</li>
                        </ul>
                    </li>
                </ul>

                <ul class="py-4">
                    <li x-data="{ open: false }" class="px-3">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between gap-3 p-3 transition-colors rounded text-slate-700 hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50">

                            <div class="flex flex-col justify-center items-start flex-1 w-full text-sm truncate">
                                الاتحقات
                            </div>

                            <div class="flex items-center self-center transform transition-transform"
                                :class="{ '-rotate-90  ': open }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>

                        </button>

                        <!-- Sub-items (not links) -->
                        <ul x-show="open" x-transition class="mt-2 space-y-1 pr-6 text-sm text-end">
                            <li class="px-3 py-2 rounded hover:bg-emerald-100 cursor-pointer">الإعدادات العامة</li>
                            <li class="px-3 py-2 rounded hover:bg-emerald-100 cursor-pointer">الصلاحيات</li>
                            <li class="px-3 py-2 rounded hover:bg-emerald-100 cursor-pointer">المستخدمين</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Footer Section -->
        <div class="p-4 border-t border-slate-200">
            <form method="POST" action="">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 p-3 w-full transition-colors rounded text-slate-700 hover:text-red-500 hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <script>
    // Sidebar toggle logic for mobile screens
    const sidebar = document.getElementById('nav-menu-1');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', () => {
        const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
        toggleBtn.setAttribute('aria-expanded', String(!expanded));
        if (sidebar.classList.contains('translate-x-full')) {
            sidebar.classList.remove('translate-x-full');
        } else {
            sidebar.classList.add('translate-x-full');
        }
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth < 1024) { // Only on mobile/tablet
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                if (!sidebar.classList.contains('translate-x-full')) {
                    sidebar.classList.add('translate-x-full');
                    toggleBtn.setAttribute('aria-expanded', 'false');
                }
            }
        }
    });
    </script>

    @stack('scripts')
</body>

</html>