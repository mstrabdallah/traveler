<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore Egypt with Expert Local Guides - Mo travels</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="description" content="Book unforgettable Egypt tours with Mo travels. Enjoy private guided tours, Nile cruises, and personalized travel packages led by expert local Egyptologists." />
    <link rel="canonical" href="https://traveleregypt.com/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Explore Egypt with Expert Local Guides - Mo travels" />
    <meta property="og:description" content="Book unforgettable Egypt tours with Mo travels. Enjoy private guided tours, Nile cruises, and personalized travel packages led by expert local Egyptologists." />
    <meta property="og:url" content="https://traveleregypt.com/" />
    <meta property="og:site_name" content="Mo travels" />
    <meta property="article:modified_time" content="2025-11-16T10:48:51+00:00" />
    <meta property="og:image" content="https://traveleregypt.com/wp-content/uploads/2024/07/Untitled-design-2024-07-07T171017.425_11zon.webp" />
    <meta name="twitter:card" content="summary_large_image" />
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

            Alpine.store('language', {
                current: '{{ app()->getLocale() }}',
                languages: {
                    'en': { flag: '🇺🇸', label: 'EN' },
                    'ar': { flag: '🇪🇬', label: 'AR' },
                    'de': { flag: '🇩🇪', label: 'DE' },
                    'fr': { flag: '🇫🇷', label: 'FR' },
                    'es': { flag: '🇪🇸', label: 'ES' },
                    'it': { flag: '🇮🇹', label: 'IT' },
                    'ru': { flag: '🇷🇺', label: 'RU' },
                    'zh-CN': { flag: '🇨🇳', label: 'ZH' },
                    'ja': { flag: '🇯🇵', label: 'JA' },
                    'pt': { flag: '🇵🇹', label: 'PT' }
                },
                init() {
                    const match = document.cookie.match(/googtrans=\/en\/([^;]+)/);
                    if (match && this.languages[match[1]]) {
                        this.current = match[1];
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
          .float-button {
              position: fixed;
              bottom: 30px;
              left: 30px;
              background-color: #25d366;
              color: #fff;
              border-radius: 50px;
              padding: 12px 24px;
              display: flex;
              align-items: center;
              justify-content: center;
              box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3);
              z-index: 9999;
              text-decoration: none !important;
              transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
              font-weight: 700;
          }
          .float-button:hover {
              background-color: #128c7e;
              transform: translateY(-5px) scale(1.05);
              box-shadow: 0 15px 30px rgba(18, 140, 126, 0.4);
              color: #fff;
          }
          .float-button svg {
              filter: drop-shadow(0 2px 2px rgba(0,0,0,0.1));
          }
          @media (max-width: 768px) {
              .float-button {
                  bottom: 20px;
                  left: 20px;
                  padding: 10px 20px;
                  font-size: 14px;
              }
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
<body class="font-sans antialiased text-gray-900 bg-white dark:bg-gray-900 dark:text-white selection:bg-accent selection:text-white {{ app()->getLocale() == 'ar' ? 'ar rtl' : '' }}">
@props([])
    
    <!-- Navbar -->
    <header x-data="{ 
            mobileMenuOpen: false, 
            init() {
                this.$watch('mobileMenuOpen', value => {
                    document.body.classList.toggle('overflow-hidden', value);
                })
            }
        }" 
            class="sticky top-0 z-50 w-full bg-primary-900 shadow-md transition-all duration-300">
        <nav class="flex items-center justify-between p-1 mx-auto max-w-7xl lg:px-8" aria-label="Global">
            <div class="flex ">
                <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ __(config('app.name', 'Mo Travel')) }}" class="h-20 w-auto">
                </a>
            </div>
            <div class="flex lg:hidden items-center gap-3">
                <!-- Mobile Language Dropdown -->
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" 
                            class="notranslate flex items-center gap-2 px-2.5 py-1.5 text-white bg-white/5 hover:bg-white/10 backdrop-blur-md transition-all duration-300 focus:outline-none border border-white/10 shadow-sm active:scale-95 rounded-full">
                         <span x-text="$store.language.languages[$store.language.current].flag" class="text-lg leading-none"></span>
                         <span x-text="$store.language.languages[$store.language.current].label" class="text-[11px] font-bold tracking-tighter opacity-90"></span>
                         <i class="fi fi-rr-angle-small-down transition-transform duration-300 text-[10px] opacity-70" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                         class="notranslate absolute right-0 mt-3 w-52 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl rounded-2xl shadow-2xl py-2 z-[110] ring-1 ring-black/5 dark:ring-white/10 overflow-hidden"
                         style="display: none;">
                        <div class="px-2 space-y-0.5">
                            @foreach([
                                'en' => ['🇺🇸','English'], 
                                'ar' => ['🇪🇬','عربي'], 
                                'de' => ['🇩🇪','German'], 
                                'fr' => ['🇫🇷','French'], 
                                'es' => ['🇪🇸','Spanish'], 
                                'it' => ['🇮🇹','Italian'], 
                                'ru' => ['🇷🇺','Russian'], 
                                'zh-CN' => ['🇨🇳','Chinese'], 
                                'ja' => ['🇯🇵','Japan'], 
                                'pt' => ['🇵🇹','Portuguese']
                            ] as $code => $data)
                                <a href="javascript:void(0)" onclick="changeLanguage('{{ $code }}')" 
                                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group"
                                   :class="$store.language.current === '{{ $code }}' ? 'bg-accent-600/10 text-accent-600 dark:text-accent-400' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100/50 dark:hover:bg-gray-800/50'">
                                     <div class="flex items-center">
                                         <span class="mr-3 text-xl group-hover:scale-110 transition-transform duration-200">{{ $data[0] }}</span> 
                                         <span class="font-semibold">{{ $data[1] }}</span>
                                     </div>
                                     <div x-show="$store.language.current === '{{ $code }}'" class="w-1.5 h-1.5 rounded-full bg-accent-600 shadow-[0_0_8px_rgba(var(--accent-600-rgb),0.5)]"></div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white hover:text-accent-400 transition max-lg:me-3">
                    <span class="sr-only">Open main menu</span>
                    <i class="fi fi-rr-menu-burger text-2xl h-[24px]"></i>
                </button>
            </div>
            <div class="hidden lg:flex gap-6 xl:gap-x-12 items-center">
                <a href="/" class="text-sm font-semibold leading-6 transition {{ request()->is('/') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">{{ __('Home') }}</a>
                <a href="{{ route('about') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('about') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">{{ __('About') }}</a>
                
                <!-- Tours Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('tours.index') }}" class="flex items-center gap-1 text-sm font-semibold leading-6 transition {{ request()->routeIs('tours.*') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">
                        {{ __('Tours') }}
                        <i class="fi fi-rr-angle-small-down transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </a>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         class="absolute left-0 mt-0 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 py-3 z-50 overflow-hidden"
                         style="display: none;">
                        @foreach($headerCategories as $category)
                            <a href="{{ route('tours.index', ['category' => $category->slug]) }}" class="block px-5 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                {{ $category->display_name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Destinations Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('destinations.index') }}" class="flex items-center gap-1 text-sm font-semibold leading-6 transition {{ request()->routeIs('destinations.*') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">
                        {{ __('Destinations') }}
                        <i class="fi fi-rr-angle-small-down transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </a>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         class="absolute left-0 mt-0 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 py-3 z-50 overflow-hidden"
                         style="display: none;">
                        @foreach($headerDestinations as $dest)
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="block px-5 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                {{ $dest->display_name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('articles.index') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('articles.*') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">{{ __('Blogs') }}</a>
                <a href="{{ route('contact') }}" class="text-sm font-semibold leading-6 transition {{ request()->routeIs('contact') ? 'text-accent-400' : 'text-white hover:text-accent-400' }}">{{ __('Contact') }}</a>
            </div>
            <div class="hidden lg:flex lg:justify-end items-center">
                
         
             

                <a href="{{ route('custom-tour.create') }}" class="px-5 py-2.5 text-sm font-semibold text-white transition-all bg-accent-600 rounded-full hover:bg-accent-500 shadow-lg shadow-accent-600/20 ms-4">
                   {{ __('Tailor-Made Your Tour') }} <span aria-hidden="true">{!! app()->getLocale() == 'ar' ? '&larr;' : '&rarr;' !!}</span>
                </a>



                <!-- Combined Language & Settings UI -->
                <div class="relative ms-4 flex items-center bg-white/5 backdrop-blur-md rounded-full border border-white/10 shadow-sm transition-all duration-300 hover:bg-white/10 group">
                    <!-- Language Part -->
                    <div class="relative w-[102px] flex-shrink-0" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" 
                                class="notranslate flex items-center gap-2 px-4 py-2 text-white hover:text-accent-400 transition-all duration-300 focus:outline-none rounded-s-full active:scale-95 " 
                                aria-label="Change Language">
                             <span x-text="$store.language.languages[$store.language.current].flag" class="text-xl leading-none transition-transform group-hover:scale-110 w-[20px] h-[20px]"></span>
                             <span x-text="$store.language.languages[$store.language.current].label" class="text-xs font-bold tracking-widest opacity-90"></span>
                             <i class="fi fi-rr-angle-small-down transition-transform duration-300 opacity-60" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="notranslate absolute end-0 mt-3 w-64 bg-white dark:bg-gray-900 backdrop-blur-2xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.2)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.4)] py-3 z-50 ring-1 ring-black/5 dark:ring-white/10 overflow-hidden"
                             style="display: none;">
                            
                            <div class="px-2.5 space-y-1">
                                @foreach([
                                    'en' => ['🇺🇸','English'], 
                                    'ar' => ['🇪🇬','عربي'], 
                                    'de' => ['🇩🇪','German'], 
                                    'fr' => ['🇫🇷','French'], 
                                    'es' => ['🇪🇸','Spanish'], 
                                    'it' => ['🇮🇹','Italian'], 
                                    'ru' => ['🇷🇺','Russian'], 
                                    'zh-CN' => ['🇨🇳','Chinese'], 
                                    'ja' => ['🇯🇵','Japan'], 
                                    'pt' => ['🇵🇹','Portuguese']
                                ] as $code => $data)
                                    <a href="javascript:void(0)" onclick="changeLanguage('{{ $code }}')" 
                                       class="flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 group"
                                       :class="$store.language.current === '{{ $code }}' ? 'bg-accent-600/10 text-accent-600 dark:text-accent-400' : 'text-gray-700 dark:text-gray-300 hover:bg-accent-600/5 hover:text-accent-600 dark:hover:text-accent-400'">
                                         <div class="flex items-center group">
                                             <span class="me-4 text-2xl group-hover:scale-125 transition-transform duration-300">{{ $data[0] }}</span> 
                                             <span class="tracking-tight">{{ $data[1] }}</span>
                                         </div>
                                         <div x-show="$store.language.current === '{{ $code }}'" 
                                              class="w-2 h-2 rounded-full bg-accent-600 shadow-[0_0_10px_rgba(var(--accent-600-rgb),0.6)]"
                                              x-transition:enter="transition duration-300"
                                              x-transition:enter-start="scale-0"
                                              x-transition:enter-end="scale-100"></div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Separator -->
                    <div class="h-4 w-[1px] bg-white/20"></div>

                    <!-- Settings Part -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center justify-center w-10 h-10 rounded-e-full text-white hover:text-accent-400 transition-all duration-300 focus:outline-none active:scale-95" aria-label="Settings">
                             <i class="fi fi-rr-settings text-xl leading-none"></i>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute end-0 mt-3 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-3 z-50 ring-1 ring-black/5 dark:ring-white/10 focus:outline-none"
                             style="display: none;">
                            
                            <!-- Appearance Section -->
                            <div class="px-4">
                                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                                    {{ __('Appearance') }}
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
                                            <img src="{{ asset('images/logo.png') }}" alt="{{ __(config('app.name', 'Mo Travel')) }}" class="h-10 w-auto">
                                        </div>
                                        <button type="button" @click="mobileMenuOpen = false" class="rounded-md text-gray-400 hover:text-white focus:outline-none">
                                            <span class="sr-only">Close panel</span>
                                            <i class="fi fi-rr-cross text-xl"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                        <div class="flex flex-col gap-1">
                                            <a href="/" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->is('/') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">{{ __('Home') }}</a>
                                            <a href="{{ route('about') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('about') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">{{ __('About') }}</a>
                                            
                                            <!-- Mobile Tours Dropdown -->
                                            <div x-data="{ open: false }">
                                                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-lg font-semibold rounded-xl text-gray-100 hover:bg-white/5 transition">
                                                    <span>{{ __('Tours') }}</span>
                                                    <i class="fi fi-rr-angle-small-down transform transition duration-300" :class="{ 'rotate-180 text-accent-400': open }"></i>
                                                </button>
                                                <div x-show="open" x-collapse class="pl-4 space-y-1">
                                                    @foreach($headerCategories as $category)
                                                        <a href="{{ route('tours.index', ['category' => $category->slug]) }}" class="block px-4 py-2 text-base text-gray-400 hover:text-white transition">
                                                            {{ $category->display_name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Mobile Destinations Dropdown -->
                                            <div x-data="{ open: false }">
                                                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-lg font-semibold rounded-xl text-gray-100 hover:bg-white/5 transition">
                                                    <span>{{ __('Destinations') }}</span>
                                                    <i class="fi fi-rr-angle-small-down transform transition duration-300" :class="{ 'rotate-180 text-accent-400': open }"></i>
                                                </button>
                                                <div x-show="open" x-collapse class="pl-4 space-y-1">
                                                    <a href="{{ route('destinations.index') }}" class="block px-4 py-2 text-base text-gray-400 hover:text-white transition">{{ __('All Destinations') }}</a>
                                                    @foreach($headerDestinations as $dest)
                                                        <a href="{{ route('destinations.show', $dest->slug) }}" class="block px-4 py-2 text-base text-gray-400 hover:text-white transition">
                                                            {{ $dest->display_name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('articles.*') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">{{ __('Blogs') }}</a>
                                            <a href="{{ route('contact') }}" class="block px-4 py-3 text-lg font-semibold rounded-xl hover:bg-white/5 transition {{ request()->routeIs('contact') ? 'text-accent-400 bg-white/5' : 'text-gray-100' }}">{{ __('Contact') }}</a>
                                        </div>

                                        <div class="mt-8 border-t border-gray-800 pt-8 space-y-6">
                                            <!-- Dark Mode -->
                                            <div>
                                                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-1">
                                                    {{ __('Appearance') }}
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
                                                    <span>{{ __('Language') }}</span>
                                                    <i class="fi fi-rr-angle-small-down transform transition duration-300" :class="{ 'rotate-180': langOpen }"></i>
                                                </button>
                                                <div x-show="langOpen" x-collapse class="notranslate mt-2 space-y-1 pl-2">
                                                    @foreach([
                                                        'en' => ['🇺🇸','English'], 
                                                        'ar' => ['🇪🇬','عربي'], 
                                                        'de' => ['🇩🇪','German'], 
                                                        'fr' => ['🇫🇷','French'], 
                                                        'es' => ['🇪🇸','Spanish'], 
                                                        'it' => ['🇮🇹','Italian'], 
                                                        'ru' => ['🇷🇺','Russian'], 
                                                        'zh-CN' => ['🇨🇳','Chinese'], 
                                                        'ja' => ['🇯🇵','Japanese'], 
                                                        'pt' => ['🇵🇹','Portuguese']
                                                    ] as $code => $data)
                                                        <a href="javascript:void(0)" onclick="changeLanguage('{{ $code }}')" 
                                                           class="flex items-center justify-between px-3 py-2 rounded-lg transition"
                                                           :class="$store.language.current === '{{ $code }}' ? 'bg-accent-600/10 text-accent-400' : 'text-gray-300 hover:text-white hover:bg-white/5'">
                                                            <div class="flex items-center gap-3">
                                                                <span class="text-xl">{{ $data[0] }}</span> {{ $data[1] }}
                                                            </div>
                                                            <div x-show="$store.language.current === '{{ $code }}'" class="w-1.5 h-1.5 rounded-full bg-accent-600"></div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <a href="{{ route('custom-tour.create') }}" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-accent-600 hover:bg-accent-500 text-white font-bold rounded-xl transition shadow-lg shadow-accent-600/20">
                                                <span>Tailor-Made Your Tour</span>
                                                <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-xl"></i>
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
                 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 border-b border-gray-200 dark:border-gray-700 pb-12">
                      <!-- Brand -->
                      <div class="space-y-6">
                           <a href="/" class="flex items-center gap-3">
                                <img src="{{ asset('images/logo.png') }}" alt="{{ __(config('app.name', 'Mo Travel')) }}" class="h-20 w-auto bg-white rounded-xl p-1 shadow-sm">
                           </a>
                           <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                               {{ __("Mo travels is the best travel agency specializing in providing a wide range of tour packages throughout Egypt.") }}
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
                      </div>

                       <!-- Quick Links -->
                       <div class="space-y-4">
                            <h4 class="text-base font-bold text-[#272727] dark:text-white">{{ __("Quick Links") }}</h4>
                            <ul class="space-y-3 text-base font-normal text-[#3a3a3a] dark:text-gray-400">
                                <li><a href="/" class="hover:text-blue-500 transition">{{ __('Home') }}</a></li>
                                <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition">{{ __('About Us') }}</a></li>
                                <li><a href="{{ route('tours.index') }}" class="hover:text-blue-500 transition">{{ __('Tours') }}</a></li>
                                <li><a href="{{ route('destinations.index') }}" class="hover:text-blue-500 transition">{{ __('Destinations') }}</a></li>
                                <li><a href="{{ route('articles.index') }}" class="hover:text-blue-500 transition">{{ __('Blogs') }}</a></li>
                            </ul>
                       </div>

                       <!-- Resources -->
                       <div class="space-y-4">
                            <h4 class="text-base font-bold text-[#272727] dark:text-white">{{ __("Resources") }}</h4>
                            <ul class="space-y-3 text-base font-normal text-[#3a3a3a] dark:text-gray-400">
                                <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition">{{ __('Contact Us') }}</a></li>
                                <li><a href="#" class="hover:text-blue-500 transition">{{ __('Privacy Policy') }}</a></li>
                                <li><a href="#" class="hover:text-blue-500 transition">{{ __('Terms of Use') }}</a></li>
                            </ul>
                       </div>

                       <!-- Contact Info -->
                       <div class="space-y-4 lg:col-span-1">
                            <h4 class="text-base font-bold text-[#272727] dark:text-white">{{ __('Contact') }}</h4>
                            <ul class="space-y-3 text-base font-normal text-[#3a3a3a] dark:text-gray-400">
                                <li>
                                    <a href="tel:01092378888" class="flex items-center gap-3 hover:text-[#4875e5] transition-colors group">
                                        <div class="w-8 h-8 relative overflow-hidden flex-shrink-0 bg-[#4875e5]/10 rounded-lg flex items-center justify-center text-[#4875e5] group-hover:bg-[#4875e5] group-hover:text-white transition-all">
                                            <i class="fi fi-rr-phone-call text-sm"></i>
                                        </div>
                                        <span class="truncate">01092378888</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:mohamedmooosa11@gmail.com" class="flex items-center gap-3 hover:text-[#4875e5] transition-colors group">
                                        <div class="w-8 h-8 relative overflow-hidden flex-shrink-0 bg-[#4875e5]/10 rounded-lg flex items-center justify-center text-[#4875e5] group-hover:bg-[#4875e5] group-hover:text-white transition-all">
                                            <i class="fi fi-rr-envelope text-sm"></i>
                                        </div>
                                        <span class="text-xs sm:text-sm">mohamedmooosa11@gmail.com</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://maps.app.goo.gl/9u3J3Y5P7mD6hEFA9" target="_blank" class="flex items-center gap-3 hover:text-[#4875e5] transition-colors group">
                                        <div class="w-8 h-8 relative overflow-hidden flex-shrink-0 bg-[#4875e5]/10 rounded-lg flex items-center justify-center text-[#4875e5] group-hover:bg-[#4875e5] group-hover:text-white transition-all">
                                            <i class="fi fi-rr-marker text-sm"></i>
                                        </div>
                                        <span class="text-sm">{{ __('الفيوم,المسلة') }}</span>
                                    </a>
                                </li>
                            </ul>
                       </div>
                 </div>

                 <!-- Newsletter Section -->
                 <div class="py-12 border-b border-gray-200 dark:border-gray-700">
                      <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                           <div class="max-w-xl text-center lg:text-start">
                               <h3 class="text-2xl font-bold text-[#272727] dark:text-white mb-2">{{ __('Subscribe to our newsletter') }}</h3>
                               <p class="text-gray-600 dark:text-gray-400 text-sm italic">{{ __('Get the latest tour updates and travel tips directly in your inbox.') }}</p>
                           </div>
                           <form class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto min-w-[300px] sm:min-w-[450px]">
                               <div class="relative flex-grow">
                                   <div class="absolute inset-y-0 start-0 ps-4 flex items-center pointer-events-none">
                                       <i class="fi fi-rr-envelope text-gray-400"></i>
                                   </div>
                                   <input type="email" placeholder="{{ __("Email address") }}" class="w-full ps-12 pe-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm" required>
                               </div>
                               <button type="submit" class="px-8 py-3.5 bg-[#355fbf] text-white text-sm font-bold rounded-xl hover:bg-[#2a4a9a] transition-all transform active:scale-95 shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                                   <span>{{ __('Join Now') }}</span>
                                   <i class="fi fi-rr-paper-plane"></i>
                               </button>
                           </form>
                      </div>
                 </div>

                 <!-- Footer Bottom -->
                 <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-sm font-light text-[#3a3a3a] dark:text-gray-400">
                      <p>&copy; {{ date('Y') }} {{ __(config('app.name', 'Mo Travel')) }}. {{ __('All rights reserved.') }}</p>
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
                includedLanguages: 'en,ar,de,fr,es,it,ru,zh-CN,ja,pt', 
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        function changeLanguage(lang) {
            if (lang === 'en' || lang === 'ar') {
                // Clear Google Translate cookie
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + window.location.hostname + "; path=/;";
                
                // Switch native locale
                window.location.href = '/language/' + lang;
                return;
            }

            const cookieValue = "/en/" + lang;
            const domain = window.location.hostname;
            
            // Set cookie for both domain and without domain to ensure it sticks
            document.cookie = "googtrans=" + cookieValue + "; path=/";
            document.cookie = "googtrans=" + cookieValue + "; domain=" + domain + "; path=/";
            
            // Try setting for root domain too (e.g. .example.com)
            const parts = domain.split('.');
            if (parts.length >= 2) {
                const baseDomain = parts.slice(-2).join('.');
                document.cookie = "googtrans=" + cookieValue + "; domain=." + baseDomain + "; path=/";
            }

            // If we're on Arabic native, we must switch to English native for Google Translate
            if ('{{ app()->getLocale() }}' === 'ar') {
                window.location.href = '/language/en';
                return;
            }
            
            location.reload();
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

    <!-- WhatsApp Floating Button -->
    <a class="float-button" href="https://api.whatsapp.com/send/?phone=2001092378888&amp;text=Inquiry%20for:%20{{ urlencode(url()->current()) }}&amp;type=phone_number&amp;app_absent=0" rel="nofollow" target="_blank">
        <svg fill="#fff" height="20" width="20" id="Bold" enable-background="new 0 0 24 24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="m17.507 14.307-.009.075c-2.199-1.096-2.429-1.242-2.713-.816-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.293-.506.32-.578.878-1.634.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.576-.05-.997-.042-1.368.344-1.614 1.774-1.207 3.604.174 5.55 2.714 3.552 4.16 4.206 6.804 5.114.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345z"></path>
            <path d="m20.52 3.449c-7.689-7.433-20.414-2.042-20.419 8.444 0 2.096.549 4.14 1.595 5.945l-1.696 6.162 6.335-1.652c7.905 4.27 17.661-1.4 17.665-10.449 0-3.176-1.24-6.165-3.495-8.411zm1.482 8.417c-.006 7.633-8.385 12.4-15.012 8.504l-.36-.214-3.75.975 1.005-3.645-.239-.375c-4.124-6.565.614-15.145 8.426-15.145 2.654 0 5.145 1.035 7.021 2.91 1.875 1.859 2.909 4.35 2.909 6.99z"></path>
        </svg>
        <span class="ms-2 font-bold">{{ __('Whatsapp Me') }}</span>
    </a>
</body>
</html>
