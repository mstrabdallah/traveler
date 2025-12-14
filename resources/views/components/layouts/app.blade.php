<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Traveler Egypt') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-900 bg-white selection:bg-accent selection:text-white">
    @props(['isTransparent' => true])
    
    <!-- Navbar -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="{ 
                'bg-primary-900/90 backdrop-blur-md shadow-md': {{ $isTransparent ? 'scrolled' : 'true' }}, 
                'bg-transparent': {{ $isTransparent ? '!scrolled' : 'false' }} 
            }"
            class="fixed top-0 z-50 w-full transition-all duration-300">
        <nav class="flex items-center justify-between p-1 mx-auto max-w-7xl lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Traveler Egypt" class="h-20 w-auto">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="/" class="text-sm font-semibold leading-6 text-white hover:text-accent-400 transition">Home</a>
                <a href="{{ route('destinations.index') }}" class="text-sm font-semibold leading-6 text-white hover:text-accent-400 transition">Destinations</a>
                <a href="{{ route('tours.index') }}" class="text-sm font-semibold leading-6 text-white hover:text-accent-400 transition">Tours</a>
                <a href="{{ route('articles.index') }}" class="text-sm font-semibold leading-6 text-white hover:text-accent-400 transition">Blogs</a>
                <a href="#" class="text-sm font-semibold leading-6 text-white hover:text-accent-400 transition">About</a>
                <a href="#" class="text-sm font-semibold leading-6 text-white hover:text-accent-400 transition">Contact</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="{{ route('custom-tour.create') }}" class="px-5 py-2.5 text-sm font-semibold text-white transition-all bg-accent-600 rounded-full hover:bg-accent-500 shadow-lg shadow-accent-600/20">
                   Tailor-Made Your Tour <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </nav>
        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" class="lg:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 z-50"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full px-6 py-6 overflow-y-auto bg-primary-950 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                     <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Traveler Egypt" class="h-16 w-auto">
                    </a>
                    <button type="button" @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-400">
                        <span class="sr-only">Close menu</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flow-root mt-6">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="py-6 space-y-2">
                            <a href="/" class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-white rounded-lg hover:bg-primary-800">Home</a>
                                <a href="{{ route('destinations.index') }}" class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-white rounded-lg hover:bg-primary-800">Destinations</a>
                                <a href="{{ route('tours.index') }}" class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-white rounded-lg hover:bg-primary-800">Tours</a>
                                <a href="{{ route('articles.index') }}" class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-white rounded-lg hover:bg-primary-800">Blogs</a>
                                <a href="#" class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-white rounded-lg hover:bg-primary-800">About</a>
                            <a href="#" class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-white rounded-lg hover:bg-primary-800">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>
    
    <footer class="bg-[#2A2C3E] text-white pt-16 pb-8" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16">
                
                <!-- Brand & Contact -->
                <div class="lg:col-span-4 space-y-8">
                    <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                         <img src="{{ asset('images/logo.png') }}" alt="Traveler Egypt" class="h-20 w-auto bg-white rounded-xl p-1">
                    </a>
                    
                    <p class="text-sm leading-relaxed text-gray-300 max-w-sm">
                        Traveler Egypt Tours is the best travel agency specializing in Providing a wide range of tour packages throughout egypt
                    </p>
                    
                    <div class="space-y-4 pt-4 border-t border-gray-700/50">
                        <div class="flex items-center gap-3">
                            <i class="fi fi-rr-phone-call text-blue-500"></i>
                            <span class="text-sm font-medium">01141812709</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <i class="fi fi-rr-envelope text-blue-500"></i>
                            <span class="text-sm font-medium">info@traveleregypt.com</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <i class="fi fi-rr-marker text-blue-500"></i>
                            <span class="text-sm font-medium">72 King Faisal Street</span>
                        </div>
                    </div>
                </div>

                <!-- Pages Links -->
                <div class="lg:col-span-3 lg:pl-8">
                    <h3 class="text-lg font-bold text-yellow-500 mb-6">Pages</h3>
                    <ul role="list" class="space-y-4">
                        <li><a href="/" class="text-sm text-gray-300 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-sm text-gray-300 hover:text-white transition">About</a></li>
                        <li><a href="{{ route('tours.index') }}" class="text-sm text-gray-300 hover:text-white transition">Tours</a></li>
                        <li><a href="{{ route('destinations.index') }}" class="text-sm text-gray-300 hover:text-white transition">Destinations</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-sm text-gray-300 hover:text-white transition">Blogs</a></li>
                        <li><a href="#" class="text-sm text-gray-300 hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="lg:col-span-5">
                    <h3 class="text-lg font-bold text-yellow-500 mb-6">Newsletter</h3>
                    <form class="mt-4 sm:flex sm:max-w-md flex-col gap-4">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input type="email" name="email-address" id="email-address" autocomplete="email" required class="w-full min-w-0 appearance-none rounded-lg border-0 bg-[#1F2130] px-4 py-3.5 text-base text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6" placeholder="Email address">
                        <div class="mt-4 sm:mt-0">
                            <button type="submit" class="w-full flex-none rounded-lg bg-blue-600 px-3.5 py-3.5 text-sm font-bold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 uppercase tracking-wider">Subscribe</button>
                        </div>
                        <div class="flex items-center gap-2 mt-4 text-xs text-gray-400">
                             <input type="checkbox" class="rounded border-gray-600 bg-[#1F2130] text-blue-600 focus:ring-blue-500">
                             <span>I agree to all terms and policies</span>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="mt-16 border-t border-gray-700/50 pt-8 sm:mt-20 lg:mt-24 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex gap-4">
                     <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#2A2C3E] hover:bg-blue-500 hover:text-white transition">
                         <i class="fi fi-rr-arrow-small-up text-xl"></i>
                     </a>
                     
                     <a href="https://www.facebook.com/mohamed.ibrahim.459408" class="w-10 h-10 rounded-full bg-[#3b434d] flex items-center justify-center text-white hover:bg-blue-600 transition">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>                     </a>
                     
                     <a href="https://www.instagram.com/mohammed_fayed_eg" class="w-10 h-10 rounded-full bg-[#3b434d] flex items-center justify-center text-white hover:bg-pink-600 transition">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                     </a>
                </div>
                
                <p class="text-xs leading-5 text-gray-400 text-center md:text-right">
                    &copy; {{ date('Y') }} by <span class="font-bold text-white">Traveler Egypt</span>. All Rights Reserved
                </p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
