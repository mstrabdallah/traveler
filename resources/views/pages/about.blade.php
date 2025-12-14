<x-layouts.app isTransparent="false">
    
    <!-- Hero Section -->
    <x-hero-slider :destinations="$destinations" title="About Us" />

    <!-- Discover Section -->
    <div class="py-16 lg:py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class=" flex max-lg:flex-col gap-12 lg:gap-20 items-center">
                <!-- Image -->
                <div class="relative flex justify-end ">
                    <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl h-[500px] ">
                         <!-- Using a generic Egypt image or one from destinations if available, fallback to a placeholder -->
                    
                            <img src="{{ asset('images/Untitled-design-2024-07-03T171632.944-1.webp') }}" alt="About Traveler Egypt" class="w-full h-full object-cover">
                    
                    </div>
                    <!-- Decorative element --> 
                 </div>

                <!-- Content -->
                <div class="space-y-8">
                    <div>
                        <span class="font-handwriting text-3xl text-yellow-500">Learn about us</span>
                        <h2 class="mt-2 text-4xl lg:text-5xl font-display font-bold text-[#345BA8] dark:text-blue-400 leading-tight">
                            Discover with Traveler Egypt Tours
                        </h2>
                    </div>

                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                        We are trusted by our clients and have a reputation for the best services in the field. We provide custom-made tours designed to fit your unique needs and preferences, offering you an authentic experience of Egypt.
                    </p>

                    <!-- Progress Bars -->
                    <div class="space-y-6 pt-4">
                        <!-- Item 1 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-[#2A2C3E] dark:text-white">Best Services</span>
                                <span class="text-gray-500 dark:text-gray-400">88%</span>
                            </div>
                            <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-[#345BA8] dark:bg-blue-500 rounded-full" style="width: 88%"></div>
                            </div>
                        </div>
                        
                        <!-- Item 2 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-[#2A2C3E] dark:text-white">Tour Agents</span>
                                <span class="text-gray-500 dark:text-gray-400">75%</span>
                            </div>
                            <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-[#345BA8] dark:bg-blue-500 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex gap-4 max-sm:flex-col">
                        <a href="https://gaviaspreview.com/wp/tevily/about/" class="px-8 py-3 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg transition font-medium">
                            / Get Right Solutions
                        </a>
                        <a href="https://gaviaspreview.com/wp/tevily/about/" class="px-8 py-3 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg transition font-medium">
                            / Expert Architecture
                        </a>
        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Banner -->
    <div class="relative py-20 bg-[#345BA8] overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center lg:text-left flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-2">
                <span class="font-handwriting text-3xl text-white block lg:inline">Plan your trip with us</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-white">Ready for an unforgettable tour?</h2>
            </div>
            
            <a href="{{ route('tours.index') }}" class="px-8 py-4 bg-yellow-400 hover:bg-[#de9d36] text-[#fff] font-bold rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 uppercase tracking-wider">
                Book Tour Now
            </a>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-20 bg-gray-50 dark:bg-gray-800 transition-colors duration-300 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="font-handwriting text-3xl text-yellow-500">Testimonials & reviews</span>
                <h2 class="mt-2 text-4xl lg:text-5xl font-display font-bold text-[#345BA8] dark:text-blue-400">What They're Saying</h2>
            </div>

            <!-- Swiper -->
            <div class="swiper testimonialSwiper px-4 pb-12 group">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide h-auto">
                        <div class="p-8 pt-0 rounded-2xl shadow-sm transition h-full flex flex-col items-center mt-12 relative">
                            <div class="-mt-12 mb-6 relative z-10">
                                <img src="{{ asset('images/testimonials/testimonial-3.jpg') }}" alt="Jessica Brown" class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
                            </div>
                            <div class="flex justify-center text-yellow-400 mb-6 gap-1">
                                <i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-center mb-8 leading-relaxed italic flex-grow px-4">"I will definitely book with Traveler Egypt Tours again. The entire team was professional and friendly, and they went out of their way to ensure we had a great time."</p>
                            <h4 class="text-center font-bold text-[#2A2C3E] dark:text-white text-xl">John P</h4>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide h-auto">
                        <div class="p-8 pt-0 rounded-2xl shadow-sm transition h-full flex flex-col items-center mt-12 relative">
                            <div class="-mt-12 mb-6 relative z-10">
                                <img src="{{ asset('images/testimonials/testimonial-2.jpg') }}" alt="Mark T" class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
                            </div>
                            <div class="flex justify-center text-yellow-400 mb-6 gap-1">
                                <i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-center mb-8 leading-relaxed italic flex-grow px-4">"Best of the Best Cairo Tour Experience!!! The tour was perfectly arranged, and the guide was fantastic. We visited all the major sites and learned so much about Egyptian culture and history."</p>
                            <h4 class="text-center font-bold text-[#2A2C3E] dark:text-white text-xl">Mark T</h4>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide h-auto">
                        <div class="p-8 pt-0 rounded-2xl shadow-sm transition h-full flex flex-col items-center mt-12 relative">
                            <div class="-mt-12 mb-6 relative z-10">
                                <img src="{{ asset('images/testimonials/testimonial-4.jpg') }}" alt="Emily R" class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
                            </div>
                            <div class="flex justify-center text-yellow-400 mb-6 gap-1">
                                <i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-center mb-8 leading-relaxed italic flex-grow px-4">"Our trip with Traveler Egypt Tours was nothing short of amazing. The guides were incredibly knowledgeable and made the history come alive. Everything was well-organized."</p>
                            <h4 class="text-center font-bold text-[#2A2C3E] dark:text-white text-xl">Emily R</h4>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="swiper-slide h-auto">
                        <div class="p-8 pt-0 rounded-2xl shadow-sm transition h-full flex flex-col items-center mt-12 relative">
                            <div class="-mt-12 mb-6 relative z-10">
                                <img src="{{ asset('images/testimonials/testimonial-1.jpg') }}" alt="Sarah J" class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
                            </div>
                            <div class="flex justify-center text-yellow-400 mb-6 gap-1">
                                <i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i><i class="fi fi-ss-star text-lg"></i>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-center mb-8 leading-relaxed italic flex-grow px-4">"Everything was well-organized, and we felt safe and taken care of throughout the entire journey. Highly recommend! The guides were incredibly knowledgeable."</p>
                            <h4 class="text-center font-bold text-[#2A2C3E] dark:text-white text-xl">Sarah J</h4>
                        </div>
                    </div>
                </div>
                
                <div class="swiper-button-next  opacity-0 group-hover:opacity-100 !w-12 !h-12 !bg-white !rounded-full !text-[#1c1c1c] !shadow-lg after:!content-none flex items-center justify-center hover:!bg-yellow-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="!w-4 !h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <div class="swiper-button-prev  opacity-0 group-hover:opacity-100 !w-12 !h-12 !bg-white !rounded-full !text-[#1c1c1c] !shadow-lg after:!content-none flex items-center justify-center hover:!bg-yellow-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="!w-4 !h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper(".testimonialSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    });
</script>
@endpush

    <!-- Video & Stats Section -->
    <div class="relative" x-data="{ videoOpen: false }">
        <!-- Video Background -->
        {{-- Ideally this background should be fixed/parallax --}}
        <div class="relative h-[500px] lg:h-[600px] bg-fixed bg-cover bg-center flex items-center justify-center" 
             style="background-image: url('https://images.unsplash.com/photo-1572252009286-268acec5ca0a?auto=format&fit=crop&q=80&w=2000');">
            <div class="absolute inset-0 bg-black/60"></div>
            
            <div class="relative z-10 text-center px-4">
                <!-- Play Button -->
                <button @click="videoOpen = true" class="w-20 h-20 lg:w-24 lg:h-24 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition transform hover:scale-110 shadow-[0_0_0_8px_rgba(37,99,235,0.3)] mb-8 mx-auto">
                    <i class="fi fi-ss-play text-2xl lg:text-3xl ml-1"></i>
                </button>

                <span class="font-handwriting text-3xl lg:text-4xl text-yellow-400 mb-2 block">Are you ready to travel?</span>
                <h2 class="text-4xl lg:text-6xl font-display font-bold text-white max-w-4xl mx-auto leading-tight">
                    Traveler Egypt Tours is an online tour booking platform
                </h2>
            </div>
        </div>

        <!-- Video Modal -->
        <div x-show="videoOpen" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="videoOpen = false"
             style="display: none;">
             
             <div class="relative w-full max-w-5xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl" @click.outside="videoOpen = false">
                <button @click="videoOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                    <i class="fi fi-rr-cross text-2xl"></i>
                </button>
                <iframe class="w-full h-full" src="https://www.youtube.com/embed/JkH_qCq5_lA?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
             </div>
        </div>

        <!-- Stats Counter (Overlapping) -->
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 -mt-20 z-20 pb-20">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 lg:p-12 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-gray-100 dark:divide-gray-700 transition-colors duration-300">
                <div class="space-y-2">
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">{{ $toursCount }}</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Tours</span>
                </div>
                <div class="space-y-2">
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">{{ $destinationsCount }}</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Destinations</span>
                </div>
                <div class="space-y-2">
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">500</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Happy Customers</span>
                </div>
                 <div class="space-y-2 border-l-0 lg:border-l"> <!-- Fix for grid layout border on mobile -->
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">100</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Reviews</span>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
