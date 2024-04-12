<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminpage</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- component -->
<!-- component -->
<style>
    /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
    /* So here we will write some classes to simulate dark mode and some of tailwind css config in our project */
:root {
  --light: #5f96e4;
  --dark: #ecedef;
  --darker: #12263f;
}

.dark .dark\:text-light {
  color: var(--light);
}

.dark .dark\:bg-dark {
  background-color: var(--dark);
}

.dark .dark\:bg-darker {
  background-color: var(--darker);
}

.dark .dark\:text-gray-300 {
  color: #d1d5db;
}

.dark .dark\:text-indigo-500 {
  color: #6366f1;
}

.dark .dark\:text-indigo-100 {
  color: #e0e7ff;
}

.dark .dark\:hover\:text-light:hover {
    color: var(--light);
}

.dark .dark\:border-indigo-800 {
  border-color: #3730a3;
}

.dark .dark\:border-indigo-700 {
  border-color: #4338ca;
}

.dark .dark\:bg-indigo-600 {
  background-color: #4f46e5;
}

.dark .dark\:hover\:bg-indigo-600:hover {
  background-color: #4f46e5;
}

.dark .dark\:border-indigo-500 {
  border-color: #6366f1;
}

.hover\:overflow-y-auto:hover {
  overflow-y: auto;
}

</style>

<script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/component.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>


<div
    x-data="setup()"
    x-init="$refs.loading.classList.add('hidden');"
    :class="{ 'dark': isDark }"
    @resize.window="watchScreen()"
>
    <div class="flex h-screen antialiased text-gray-900 bg-gray-300 dark:bg-dark dark:text-light">
    <!-- Loading screen -->
    <div
        x-ref="loading"
        class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-indigo-800"
    >
        Loading.....
    </div>

    <!-- Sidebar first column -->
    <!-- Backdrop -->
    <div
        x-show="isSidebarOpen"
        @click="isSidebarOpen = false"
        class="fixed inset-0 z-10 bg-indigo-800 lg:hidden"
        style="opacity: 0.5"
        aria-hidden="true"
    ></div>

    <aside
        x-show="isSidebarOpen"
        x-transition:enter="transition-all transform duration-300 ease-in-out"
        x-transition:enter-start="-translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition-all transform duration-300 ease-in-out"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        x-ref="sidebar"
        @keydown.escape="window.innerWidth <= 1024 ? isSidebarOpen = false : ''"
        tabindex="-1"
        class="fixed inset-y-0 z-10 flex-shrink-0 w-64 bg-white border-r lg:static dark:border-indigo-800 dark:bg-darker focus:outline-none"
    >
        <div class="flex flex-col h-full">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboards links -->
            <div x-data="{ isActive: false, open: false}">
            <!-- active & hover classes 'bg-indigo-100 dark:bg-indigo-600' -->
            <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-indigo-100 dark:hover:bg-indigo-600"
                :class="{'bg-indigo-100 dark:bg-indigo-600': isActive || open}"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
            >
                <span aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">
                        <path d="M47.16,21.221l-5.91-0.966c-0.346-1.186-0.819-2.326-1.411-3.405l3.45-4.917c0.279-0.397,0.231-0.938-0.112-1.282 l-3.889-3.887c-0.347-0.346-0.893-0.391-1.291-0.104l-4.843,3.481c-1.089-0.602-2.239-1.08-3.432-1.427l-1.031-5.886 C28.607,2.35,28.192,2,27.706,2h-5.5c-0.49,0-0.908,0.355-0.987,0.839l-0.956,5.854c-1.2,0.345-2.352,0.818-3.437,1.412l-4.83-3.45 c-0.399-0.285-0.942-0.239-1.289,0.106L6.82,10.648c-0.343,0.343-0.391,0.883-0.112,1.28l3.399,4.863 c-0.605,1.095-1.087,2.254-1.438,3.46l-5.831,0.971c-0.482,0.08-0.836,0.498-0.836,0.986v5.5c0,0.485,0.348,0.9,0.825,0.985 l5.831,1.034c0.349,1.203,0.831,2.362,1.438,3.46l-3.441,4.813c-0.284,0.397-0.239,0.942,0.106,1.289l3.888,3.891 c0.343,0.343,0.884,0.391,1.281,0.112l4.87-3.411c1.093,0.601,2.248,1.078,3.445,1.424l0.976,5.861C21.3,47.647,21.717,48,22.206,48 h5.5c0.485,0,0.9-0.348,0.984-0.825l1.045-5.89c1.199-0.353,2.348-0.833,3.43-1.435l4.905,3.441 c0.398,0.281,0.938,0.232,1.282-0.111l3.888-3.891c0.346-0.347,0.391-0.894,0.104-1.292l-3.498-4.857 c0.593-1.08,1.064-2.222,1.407-3.408l5.918-1.039c0.479-0.084,0.827-0.5,0.827-0.985v-5.5C47.999,21.718,47.644,21.3,47.16,21.221z M25,32c-3.866,0-7-3.134-7-7c0-3.866,3.134-7,7-7s7,3.134,7,7C32,28.866,28.866,32,25,32z"></path>
                    </svg>
                </span>
                <span class="ml-2 text-sm"> Data Master </span>
                <span class="ml-auto" aria-hidden="true">
                <!-- active class 'rotate-180' -->
                <svg
                    class="w-4 h-4 transition-transform transform"
                    :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                </span>
            </a>
            <div id="pesanan"  role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <a
                href="/kategori"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                >
                Data Katagori
                </a>
                <a
                href="/subkategori"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Data Subkategori
                </a>
                <a
                href="/slider"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Data Slider
                </a>
                <a
                href="/barang"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Data Barang
                </a>
                <a
                href="/member"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Data Member
                </a>
                </a>
                <a
                href="/tesmoni"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Data Tesmoni
                </a>
                </a>
                <a
                href="/review"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Data Review
                </a>
                
            </div>
            </div>

            <!-- Components links -->
            <div x-data="{ isActive: false, open: false }">
            <!-- active classes 'bg-indigo-100 dark:bg-indigo-600' -->
            <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-indigo-100 dark:hover:bg-indigo-600"
                :class="{ 'bg-indigo-100 dark:bg-indigo-600': isActive || open }"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
            >
                <span aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="store"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M5 6h14c.55 0 1-.45 1-1s-.45-1-1-1H5c-.55 0-1 .45-1 1s.45 1 1 1zm15.16 1.8c-.09-.46-.5-.8-.98-.8H4.82c-.48 0-.89.34-.98.8l-1 5c-.12.62.35 1.2.98 1.2H4v5c0 .55.45 1 1 1h8c.55 0 1-.45 1-1v-5h4v5c0 .55.45 1 1 1s1-.45 1-1v-5h.18c.63 0 1.1-.58.98-1.2l-1-5zM12 18H6v-4h6v4z"></path></svg>
                </span>
                <span class="ml-2 text-sm"> Data Pesanan </span>
                <span aria-hidden="true" class="ml-auto">
                <!-- active class 'rotate-180' -->
                <svg
                    class="w-4 h-4 transition-transform transform"
                    :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <a
                href="/pesanan/baru"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                >
                Pesanan Baru
                </a>
                <a
                href="pesanan/dikonfirmasi"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                >
                Pesanan Dikonfirmasi
                </a>
                <a
                href="pesanan/dikemas"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Pesanan Dikemas
                </a>
                <a
                href="pesanan/dikirim"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Pesanan Dikirim
                </a>
                <a
                href="pesanan/diterima"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Pesanan Diterima
                </a>
                <a
                href="pesanan/selesai"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                Selesai
                </a>
               
            </div>
            </div>

            <!-- Pages links -->
           

            <!-- Layouts links -->
           
        </nav>

        <!-- Sidebar footer -->
        <div class="relative flex items-center justify-center flex-shrink-0 px-2 py-4 space-x-4">
            <!-- Search button -->
           

            <!-- User avatar button -->
            <div class="" x-data="{ open: false }">
            <button
                @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                type="button"
                aria-haspopup="true"
                :aria-expanded="open ? 'true' : 'false'"
                class="block transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100"
            >
                <span class="sr-only">User menu</span>
                <img
                class="w-12 h-12 rounded-full"
                src="images/logo.png" class="h12.5 me-3 sm:h-12.5 " alt="Flowbite Logo"
                alt="Logo"
                />
            </button>

            <!-- User dropdown menu -->
            <div
                x-show="open"
                x-ref="userMenu"
                x-transition:enter="transition-all transform ease-out"
                x-transition:enter-start="-translate-y-1/2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition-all transform ease-in"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="-translate-y-1/2 opacity-0"
                @click.away="open = false"
                @keydown.escape="open = false"
                class="absolute max-w-xs py-1 bg-white rounded-md shadow-lg min-w-max left-5 right-5 bottom-full ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                tabindex="-1"
                role="menu"
                aria-orientation="vertical"
                aria-label="User menu"
            >
                
                
                <a
                href="#"
                role="menuitem"
                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-indigo-600"
                >
                Logout
                </a>
            </div>
            </div>

            <!-- Settings button -->
            <button
            @click="openSettingsPanel"
            class="p-2 text-indigo-400 transition-colors duration-200 rounded-full bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800"
            >
            <span class="sr-only">Open settings panel</span>
            <svg
                class="w-7 h-7"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                />
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
            </svg>
            </button>
        </div>
        </div>
    </aside>

    <!-- Second column -->
    <!-- Backdrop -->
    <div
        x-show="isSecondSidebarOpen"
        @click="isSecondSidebarOpen = false"
        class="fixed inset-0 z-10 bg-indigo-800 lg:hidden"
        style="opacity: 0.5"
        aria-hidden="true"
    ></div>

   

    <!-- Sidebars buttons -->
    <div class="fixed flex items-center space-x-4 top-5 right-10 lg:hidden">
        <button
        @click="isSidebarOpen = true; $nextTick(() => { $refs.sidebar.focus() })"
        class="p-1 text-indigo-400 transition-colors duration-200 rounded-md bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:ring"
        >
        <span class="sr-only">Toggle main manu</span>
        <span aria-hidden="true">
            <svg
            x-show="!isSidebarOpen"
            class="w-8 h-8"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg
            x-show="isSidebarOpen"
            class="w-8 h-8"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
        </button>
        <button
        @click="isSecondSidebarOpen = true; $nextTick(() => { $refs.secondSidebar.focus() })"
        class="p-1 text-indigo-400 transition-colors duration-200 rounded-md bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:ring"
        >
        <span class="sr-only">Toggle panel</span>
        <span aria-hidden="true">
            <svg
            class="w-8 h-8 transition-transform transform"
            :class="{ 'rotate-180': isSecondSidebarOpen }"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </span>
        </button>
    </div>

   <!-- Main content -->
   

    <!-- Panels -->

    <!-- Settings Panel -->
    <!-- Backdrop -->
    <div
        x-transition:enter="transition duration-300 ease-in-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300 ease-in-out"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-show="isSettingsPanelOpen"
        @click="isSettingsPanelOpen = false"
        class="fixed inset-0 z-10 bg-indigo-800"
        style="opacity: 0.5"
        aria-hidden="true"
    ></div>
    <!-- Panel -->
    <section
        x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        x-ref="settingsPanel"
        tabindex="-1"
        x-show="isSettingsPanelOpen"
        @keydown.escape="isSettingsPanelOpen = false"
        class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
        aria-labelledby="settinsPanelLabel"
    >
        <div class="absolute left-0 p-2 transform -translate-x-full">
        <!-- Close button -->
        <button
            @click="isSettingsPanelOpen = false"
            class="p-2 text-white rounded-md focus:outline-none focus:ring"
        >
            <svg
            class="w-5 h-5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        </div>
        <!-- Panel content -->
        <div class="flex flex-col h-screen">
        <!-- Panel header -->
        <div
            class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-indigo-700"
        >
            <span aria-hidden="true" class="text-gray-500 dark:text-indigo-600">
            <svg
                class="w-8 h-8"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                />
            </svg>
            </span>
            <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">Settings</h2>
        </div>
        <!-- Content -->
        <div class="flex-1 overflow-hidden hover:overflow-y-auto">
            <!-- Theme -->
            <div class="p-4 space-y-4 md:p-8">
            <h6 class="text-lg font-medium text-gray-400 dark:text-light">Mode</h6>
            <div class="flex items-center space-x-8">
                <!-- Light button -->
                <button
                @click="setLightTheme"
                class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-indigo-600 dark:hover:text-indigo-100 dark:hover:border-indigo-500 focus:outline-none focus:ring focus:ring-indigo-400 dark:focus:ring-indigo-700"
                :class="{ 'border-gray-900 text-gray-900 dark:border-indigo-500 dark:text-indigo-100': !isDark, 'text-gray-500 dark:text-indigo-500': isDark }"
                >
                <span>
                    <svg
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                    />
                    </svg>
                </span>
                <span>Light</span>
                </button>

                <!-- Dark button -->
                <button
                @click="setDarkTheme"
                class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-indigo-600 dark:hover:text-indigo-100 dark:hover:border-indigo-500 focus:outline-none focus:ring focus:ring-indigo-400 dark:focus:ring-indigo-700"
                :class="{ 'border-gray-900 text-gray-900 dark:border-indigo-500 dark:text-indigo-100': isDark, 'text-gray-500 dark:text-indigo-500': !isDark }"
                >
                <span>
                    <svg
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                    />
                    </svg>
                </span>
                <span>Dark</span>
                </button>
            </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Search panel -->
    <!-- Backdrop -->
   
    <!-- Panel -->
   
    </div>
</div>

<script>
    const setup = () => {
        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'))
            }
            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }

        return {
            loading: true,
            isDark: getTheme(),
            toggleTheme() {
            this.isDark = !this.isDark
            setTheme(this.isDark)
            },
            setLightTheme() {
            this.isDark = false
            setTheme(this.isDark)
            },
            setDarkTheme() {
            this.isDark = true
            setTheme(this.isDark)
            },
            watchScreen() {
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false
                this.isSecondSidebarOpen = false
            } else if (window.innerWidth >= 1024) {
                this.isSidebarOpen = true
                this.isSecondSidebarOpen = true
            }
            },
            isSidebarOpen: window.innerWidth >= 1024 ? true : false,
            toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen
            },
            isSecondSidebarOpen: window.innerWidth >= 1024 ? true : false,
            toggleSecondSidbarColumn() {
            this.isSecondSidebarOpen = !this.isSecondSidebarOpen
            },
            isSettingsPanelOpen: false,
            openSettingsPanel() {
            this.isSettingsPanelOpen = true
            this.$nextTick(() => {
                this.$refs.settingsPanel.focus()
            })
            },
            isSearchPanelOpen: false,
            openSearchPanel() {
            this.isSearchPanelOpen = true
            this.$nextTick(() => {
                this.$refs.searchInput.focus()
            })
            },
        }
    }
</script>
</html>
