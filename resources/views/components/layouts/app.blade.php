<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore Egypt with Expert Local Guides - Traveler egypt tours</title>
    <meta name="description" content="Book unforgettable Egypt tours with Traveler Egypt Tours. Enjoy private guided tours, Nile cruises, and personalized travel packages led by expert local Egyptologists." />
    <link rel="canonical" href="https://traveleregypt.com/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Explore Egypt with Expert Local Guides - Traveler egypt tours" />
    <meta property="og:description" content="Book unforgettable Egypt tours with Traveler Egypt Tours. Enjoy private guided tours, Nile cruises, and personalized travel packages led by expert local Egyptologists." />
    <meta property="og:url" content="https://traveleregypt.com/" />
    <meta property="og:site_name" content="Traveler egypt tours" />
    <meta property="article:modified_time" content="2025-11-16T10:48:51+00:00" />
    <meta property="og:image" content="https://traveleregypt.com/wp-content/uploads/2024/07/Untitled-design-2024-07-07T171017.425_11zon.webp" />
    <meta name="twitter:card" content="summary_large_image" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', {
                mode: localStorage.theme || 'system',
                init() {
                    this.applyData();
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                        if (this.mode === 'system') {
                            this.applyData();
                        }
                    });
                },
                set(value) {
                    this.mode = value;
                    if (value === 'system') {
                        localStorage.removeItem('theme');
                    } else {
                        localStorage.theme = value;
                    }
                    this.applyData();
                },
                applyData() {
                    if (this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            });
        });
    </script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
         .iti { width: 100%; }
         .iti__flag { background-image: url("https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/img/flags.png"); }
         @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
           .iti__flag { background-image: url("https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/img/flags@2x.png"); }
         }
    </style>
    <script>
        // Apply theme immediately to prevent FOUC
        try {
            const theme = localStorage.theme || 'system';
            if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        } catch (_) {}
    </script>
    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-900 bg-white dark:bg-gray-900 dark:text-white selection:bg-accent selection:text-white">
    @props(['isTransparent' => true])
    
    <!-- Navbar -->
    <header x-data="{ 
            mobileMenuOpen: false, 
            scrolled: false,
            init() {
                this.$watch('mobileMenuOpen', value => {
                    document.body.classList.toggle('overflow-hidden', value);
                })
            }
        }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="{ 
                'bg-primary-900/90 backdrop-blur-md shadow-md': {{ $isTransparent ? 'scrolled' : 'true' }}, 
                'bg-transparent': {{ $isTransparent ? '!scrolled' : 'false' }} 
            }"
            class="fixed top-0 z-50 w-full transition-all duration-300">
        <nav class="flex items-center justify-between p-1 mx-auto max-w-7xl lg:px-8" aria-label="Global">
            <div class="flex ">
                <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Traveler Egypt" class="h-20 w-auto">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white hover:text-accent-400 transition max-lg:me-3">
                    <span class="sr-only">Open main menu</span>
                    <i class="fi fi-rr-menu-burger text-2xl"></i>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="/" class="text-sm font-semibold leading-6 transition {{ request()->is('/') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">Home</a>
                <a href="{{ route('about') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('about') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">About</a>
                <a href="{{ route('tours.index') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('tours.*') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">Tours</a>
                <a href="{{ route('destinations.index') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('destinations.*') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">Destinations</a>
                <a href="{{ route('articles.index') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('articles.*') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">Blogs</a>
                <a href="{{ route('contact') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('contact') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">Contact</a>
            </div>
            <div class="hidden lg:flex lg:justify-end items-center">
                
         
                <a href="{{ route('custom-tour.create') }}" class="px-5 py-2.5 text-sm font-semibold text-white transition-all bg-accent-600 rounded-full hover:bg-accent-500 shadow-lg shadow-accent-600/20 ml-4">
                   Tailor-Made Your Tour <span aria-hidden="true">&rarr;</span>
                </a>

                       <!-- Settings Dropdown -->
                <div class="relative ml-4" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="flex items-center justify-center w-10 h-10 rounded-full text-white hover:bg-white/10 hover:text-accent-400 transition focus:outline-none" aria-label="Settings">
                         <i class="fi fi-rr-settings text-xl h-[24px]"></i>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute right-0 mt-3 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-3 z-50 ring-1 ring-black/5 dark:ring-white/10 focus:outline-none"
                         style="display: none;">
                        
                        <!-- Language Section -->
                        <div class="px-4 pb-3 border-b border-gray-100 dark:border-gray-700">
                            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Language
                            </div>
                            <div class="space-y-1">
                                <a href="javascript:void(0)" onclick="changeLanguage('en')" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 transition-colors">
                                     <span class="mr-3 text-lg">🇺🇸</span> English
                                </a>
                                <a href="javascript:void(0)" onclick="changeLanguage('zh-CN')" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 transition-colors">
                                     <span class="mr-3 text-lg">🇨🇳</span> Chinese
                                </a>
                                <a href="javascript:void(0)" onclick="changeLanguage('it')" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 transition-colors">
                                    <span class="mr-3 text-lg">🇮🇹</span> Italian
                                </a>
                                <a href="javascript:void(0)" onclick="changeLanguage('ja')" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 transition-colors">
                                    <span class="mr-3 text-lg">🇯🇵</span> Japan
                                </a>
                                <a href="javascript:void(0)" onclick="changeLanguage('ru')" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 transition-colors">
                                    <span class="mr-3 text-lg">🇷🇺</span> Russia
                                </a>
                                <a href="javascript:void(0)" onclick="changeLanguage('es')" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-blue-600 transition-colors">
                                    <span class="mr-3 text-lg">🇪🇸</span> Spain
                                </a>
                            </div>
                        </div>

                        <!-- Dark Mode Toggle Section -->
                        <div class="px-4 pt-3">
                            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Mode
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700/50 p-1 rounded-lg flex items-center justify-between">
                                <button @click="$store.darkMode.set('light')" 
                                        :class="$store.darkMode.mode === 'light' ? 'bg-white dark:bg-gray-600 text-blue-600 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                                        class="flex-1 py-1.5 rounded-md transition-all flex items-center justify-center">
                                    <i class="fi fi-rr-sun text-lg"></i>
                                </button>
                                <button @click="$store.darkMode.set('dark')" 
                                        :class="$store.darkMode.mode === 'dark' ? 'bg-white dark:bg-gray-600 text-blue-600 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                                        class="flex-1 py-1.5 rounded-md transition-all flex items-center justify-center">
                                    <i class="fi fi-rr-moon text-lg"></i>
                                </button>
                                <button @click="$store.darkMode.set('system')" 
                                        :class="$store.darkMode.mode === 'system' ? 'bg-white dark:bg-gray-600 text-blue-600 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                                        class="flex-1 py-1.5 rounded-md transition-all flex items-center justify-center">
                                    <i class="fi fi-rr-computer text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </nav>
        
        <!-- Mobile Menu (Teleported to body) -->
        <template x-teleport="body">
            <div class="relative z-[100]" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" x-show="mobileMenuOpen" style="display: none;">
                <!-- Backdrop -->
                <div x-show="mobileMenuOpen"
                     x-transition:enter="ease-in-out duration-500"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in-out duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" 
                     @click="mobileMenuOpen = false"></div>
        
                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                            <!-- Menu Panel -->
                            <div x-show="mobileMenuOpen"
                                 x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                                 x-transition:enter-start="translate-x-full"
                                 x-transition:enter-end="translate-x-0"
                                 x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                                 x-transition:leave-start="translate-x-0"
                                 x-transition:leave-end="translate-x-full"
                                 class="pointer-events-auto w-screen max-w-md">
                                
                                <div class="flex h-full flex-col overflow-y-scroll bg-primary-950 shadow-2xl" @click.outside="mobileMenuOpen = false">
                                    <div class="flex items-center justify-between px-6 py-6 border-b border-gray-800">
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('images/logo.png') }}" alt="Traveler Egypt" class="h-10 w-auto">
                                        </div>
                                        <button type="button" @click="mobileMenuOpen = false" class="rounded-md text-gray-400 hover:text-white focus:outline-none">
                                            <span class="sr-only">Close panel</span>
                                            <i class="fi fi-rr-cross text-xl"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                        <div class="flex flex-col gap-2">
                                            <a href="/" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->is('/') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">Home</a>
                                            <a href="{{ route('about') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('about') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">About</a>
                                            <a href="{{ route('tours.index') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('tours.*') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">Tours</a>
                                            <a href="{{ route('destinations.index') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('destinations.*') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">Destinations</a>
                                            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('articles.*') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">Blogs</a>
                                            <a href="{{ route('contact') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('contact') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">Contact</a>
                                        </div>

                                        <div class="mt-8 border-t border-gray-800 pt-8 space-y-6">
                                            <!-- Dark Mode -->
                                            <div>
                                                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-1">
                                                    Appearance
                                                </div>
                                                <div class="bg-gray-800 p-1 rounded-xl flex items-center justify-between">
                                                    <button @click="$store.darkMode.set('light')" 
                                                            :class="$store.darkMode.mode === 'light' ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-400 hover:text-white'"
                                                            class="flex-1 py-2 rounded-lg transition-all flex items-center justify-center">
                                                        <i class="fi fi-rr-sun text-lg"></i>
                                                    </button>
                                                    <button @click="$store.darkMode.set('dark')" 
                                                            :class="$store.darkMode.mode === 'dark' ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-400 hover:text-white'"
                                                            class="flex-1 py-2 rounded-lg transition-all flex items-center justify-center">
                                                        <i class="fi fi-rr-moon text-lg"></i>
                                                    </button>
                                                    <button @click="$store.darkMode.set('system')" 
                                                            :class="$store.darkMode.mode === 'system' ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-400 hover:text-white'"
                                                            class="flex-1 py-2 rounded-lg transition-all flex items-center justify-center">
                                                        <i class="fi fi-rr-computer text-lg"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Language Accordion -->
                                            <div x-data="{ langOpen: false }">
                                                <button @click="langOpen = !langOpen" class="w-full flex items-center justify-between text-lg font-semibold text-gray-100 hover:text-white transition px-1">
                                                    <span>Language</span>
                                                    <i class="fi fi-rr-angle-small-down transform transition duration-300" :class="{ 'rotate-180': langOpen }"></i>
                                                </button>
                                                <div x-show="langOpen" x-collapse class="mt-2 space-y-1 pl-2">
                                                    <a href="javascript:void(0)" onclick="changeLanguage('en')" class="flex items-center gap-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                                                        <span class="text-xl">🇺🇸</span> English
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="changeLanguage('zh-CN')" class="flex items-center gap-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                                                        <span class="text-xl">🇨🇳</span> Chinese
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="changeLanguage('it')" class="flex items-center gap-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                                                        <span class="text-xl">🇮🇹</span> Italian
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="changeLanguage('ja')" class="flex items-center gap-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                                                        <span class="text-xl">🇯🇵</span> Japanese
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="changeLanguage('ru')" class="flex items-center gap-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                                                        <span class="text-xl">🇷🇺</span> Russian
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="changeLanguage('es')" class="flex items-center gap-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                                                        <span class="text-xl">🇪🇸</span> Spanish
                                                    </a>
                                                </div>
                                            </div>

                                            <a href="{{ route('custom-tour.create') }}" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-accent-600 hover:bg-accent-500 text-white font-bold rounded-xl transition shadow-lg shadow-accent-600/20">
                                                <span>Tailor-Made Your Tour</span>
                                                <i class="fi fi-rr-arrow-small-right text-xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </header>

    <main>
        {{ $slot }}
    </main>
    
    <footer class="relative mt-4   lg:pb-12" aria-labelledby="footer-heading">
  

        <!-- Main Footer Card -->
        <div class="bg-white dark:bg-gray-800 rounded-[40px] pt-4 pb-8 px-6 lg:px-8 shadow-[0px_20px_84px_0px_rgba(73,118,231,0.20)] dark:shadow-none relative z-10 max-w-7xl mx-auto max-md:mt-5 max-md:bg-white max-md:dark:bg-gray-800 border dark:border-gray-700">
             <div class="max-w-7xl mx-auto mt-7">
                 <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 border-b border-gray-200 dark:border-gray-700 pb-12">
                      <!-- Brand -->
                      <div class="lg:col-span-4 space-y-6">
                           <a href="/" class="flex items-center gap-3">
                                <img src="{{ asset('images/logo.png') }}" alt="Traveler Egypt" class="h-20 w-auto bg-white rounded-xl p-1 shadow-sm">
                           </a>
                           <p class="text-[#3a3a3a] dark:text-gray-400 text-sm font-light leading-6">
                               Traveler Egypt Tours is the best travel agency specializing in providing a wide range of tour packages throughout Egypt.
                           </p>
                           <!-- Social Icons -->
                           <div class="flex gap-4">
                                <a href="https://www.facebook.com/mohamed.ibrahim.459408" class="w-10 h-10 rounded-full bg-[#29385f] flex items-center justify-center text-white hover:bg-[#1e2a4a] transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                </a>
                                <a href="https://www.instagram.com/mohammed_fayed_eg" class="w-10 h-10 rounded-full bg-[#29385f] flex items-center justify-center text-white hover:bg-[#1e2a4a] transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                                </a>
                           </div>

                           <!-- Subscription Form -->
                           <div class="pt-4">
                               <h5 class="text-sm font-bold text-[#272727] dark:text-white mb-3">Subscribe to our newsletter</h5>
                               <form class="flex flex-col sm:flex-row gap-2">
                                   <div class="relative flex-grow">
                                       <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                           <i class="fi fi-rr-envelope text-gray-400"></i>
                                       </div>
                                       <input type="email" placeholder="Email address" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                                   </div>
                                   <button type="submit" class="px-5 py-2.5 bg-[#355fbf] text-white text-sm font-semibold rounded-lg hover:bg-[#2a4a9a] transition shadow-md flex items-center justify-center gap-2">
                                       <span>Join</span>
                                       <i class="fi fi-rr-paper-plane"></i>
                                   </button>
                               </form>
                           </div>
                      </div>

                      <!-- Links -->
                      <div class="lg:col-span-8 grid grid-cols-2 md:grid-cols-3 gap-8">
                           <!-- Quick Links -->
                           <div class="space-y-4">
                                <h4 class="text-base font-bold text-[#272727] dark:text-white">Quick Links</h4>
                                <ul class="space-y-3 text-base font-normal text-[#3a3a3a] dark:text-gray-400">
                                    <li><a href="/" class="hover:text-blue-500 transition">Home</a></li>
                                    <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition">About Us</a></li>
                                    <li><a href="{{ route('tours.index') }}" class="hover:text-blue-500 transition">Tours</a></li>
                                    <li><a href="{{ route('destinations.index') }}" class="hover:text-blue-500 transition">Destinations</a></li>
                                    <li><a href="{{ route('articles.index') }}" class="hover:text-blue-500 transition">Blogs</a></li>
                                </ul>
                           </div>

                           <!-- More Links -->
                           <div class="space-y-4">
                                <h4 class="text-base font-bold text-[#272727] dark:text-white">Resources</h4>
                                <ul class="space-y-3 text-base font-normal text-[#3a3a3a] dark:text-gray-400">
                                    <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition">Contact Us</a></li>
                                    <li><a href="#" class="hover:text-blue-500 transition">Privacy Policy</a></li>
                                    <li><a href="#" class="hover:text-blue-500 transition">Terms of Use</a></li>
                                </ul>
                           </div>


                   
                           <!-- Contact Info -->
                           <div class="space-y-4">
                                <h4 class="text-base font-bold text-[#272727] dark:text-white">Contact</h4>
                                <ul class="space-y-3 text-base font-normal text-[#3a3a3a] dark:text-gray-400">
                                    <li class="flex items-center gap-3">
                                        <div class="w-8 h-8 relative overflow-hidden flex-shrink-0 bg-[#4875e5]/10 rounded-lg flex items-center justify-center text-[#4875e5]">
                                            <i class="fi fi-rr-phone-call text-sm"></i>
                                        </div>
                                        <span>01141812709</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <div class="w-8 h-8 relative overflow-hidden flex-shrink-0 bg-[#4875e5]/10 rounded-lg flex items-center justify-center text-[#4875e5]">
                                            <i class="fi fi-rr-envelope text-sm"></i>
                                        </div>
                                        <span>info@traveleregypt.com</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <div class="w-8 h-8 relative overflow-hidden flex-shrink-0 bg-[#4875e5]/10 rounded-lg flex items-center justify-center text-[#4875e5]">
                                            <i class="fi fi-rr-marker text-sm"></i>
                                        </div>
                                        <span>72 King Faisal Street</span>
                                    </li>
                                </ul>
                           </div>
                      </div>
                 </div>

                 <!-- Footer Bottom -->
                 <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-sm font-light text-[#3a3a3a] dark:text-gray-400">
                      <p>&copy; {{ date('Y') }} Traveler Egypt. All rights reserved.</p>
                      <div class="flex gap-4 font-medium">
                          <a href="#" class="w-10 h-10 rounded-full bg-[#f3f4f6] dark:bg-gray-700 flex items-center justify-center text-[#3a3a3a] dark:text-white hover:bg-[#4976e7] hover:text-white transition">
                              <i class="fi fi-rr-arrow-small-up text-xl"></i>
                          </a>
                      </div>
                 </div>
             </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
    @livewireScriptConfig
    <!-- Google Translate Script -->
    <div id="google_translate_element" style="display:none;"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', 
                includedLanguages: 'en,zh-CN,it,ja,ru,es', 
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        function changeLanguage(lang) {
            var select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
            } else {
                 // Fallback if the widget isn't fully loaded or is hidden/custom style
                 // Set the google cookie manually
                 document.cookie = "googtrans=/en/" + lang + "; domain=" + window.location.hostname + "; path=/";
                 document.cookie = "googtrans=/en/" + lang + "; domain=" + window.location.hostname + "; path=/";
                 location.reload();
            }
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Hiding Google Translate Toolbar -->
    <style>
        .goog-te-banner-frame.skiptranslate { display: none !important; } 
        body { top: 0px !important; }
        .goog-tooltip { display: none !important; }
        .goog-te-gadget-icon { display: none !important; }
        /* Hide text "Powered by Google" if visible */
        .goog-te-gadget-simple { background-color: transparent !important; border: none !important; }
    </style>
    <!-- Tawk.to Script -->
    <script id="tawk-script" type="text/javascript">
    var Tawk_API = Tawk_API || {};
    var Tawk_LoadStart=new Date();
    (function(){
        var s1 = document.createElement( 'script' ),s0=document.getElementsByTagName( 'script' )[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/6831ee37fa3c1f19045d9eec/1is1gl2st';
        s1.charset = 'UTF-8';
        s1.setAttribute( 'crossorigin','*' );
        s0.parentNode.insertBefore( s1, s0 );
    })();
    </script>
</body>
</html>
