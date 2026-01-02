<x-layouts.app isTransparent="false">
    
    <!-- Hero Section -->
    <x-hero-slider :destinations="$destinations" title="{{ __('About Us') }}" />

    <!-- Discover Section -->
    <div class="py-16 lg:py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class=" flex max-lg:flex-col gap-12 lg:gap-20 items-center">
                <!-- Image -->
                <div class="relative flex justify-end ">
                    <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl h-[500px] ">
                         <!-- Using a generic Egypt image or one from destinations if available, fallback to a placeholder -->
                    
                            <img src="{{ asset('images/Untitled-design-2024-07-03T171632.944-1.webp') }}" alt="About Mo travels" class="w-full h-full object-cover">
                    
                    </div>
                    <!-- Decorative element --> 
                 </div>

                <!-- Content -->
                <div class="space-y-8">
                    <div>
                        <span class="font-handwriting text-3xl text-yellow-500">{{ __('Learn about us') }}</span>
                        <h2 class="mt-2 text-4xl lg:text-5xl font-display font-bold text-[#345BA8] dark:text-blue-400 leading-tight">
                            {{ __('Discover with :name', ['name' => __(config('app.name', 'Mo Travel'))]) }}
                        </h2>
                    </div>

                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                        {{ __('We are trusted by our clients and have a reputation for the best services in the field. We provide custom-made tours designed to fit your unique needs and preferences, offering you an authentic experience of Egypt.') }}
                    </p>

                    <!-- Progress Bars -->
                    <div class="space-y-6 pt-4">
                        <!-- Item 1 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-[#2A2C3E] dark:text-white">{{ __('Best Services') }}</span>
                                <span class="text-gray-500 dark:text-gray-400">88%</span>
                            </div>
                            <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-[#345BA8] dark:bg-blue-500 rounded-full" style="width: 88%"></div>
                            </div>
                        </div>
                        
                        <!-- Item 2 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-[#2A2C3E] dark:text-white">{{ __('Tour Agents') }}</span>
                                <span class="text-gray-500 dark:text-gray-400">75%</span>
                            </div>
                            <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-[#345BA8] dark:bg-blue-500 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex gap-4 max-sm:flex-col">
                        <a href="{{ route('tours.index') }}" class="px-8 py-3 bg-[#345BA8] hover:bg-blue-700 text-white rounded-lg transition font-medium text-center shadow-md">
                            {{ __('Explore Our Tours') }}
                        </a>
                        <a href="{{ route('custom-tour.create') }}" class="px-8 py-3 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg transition font-medium text-center border border-gray-100 dark:border-gray-700">
                            {{ __('Tailor-Made Your Tour') }}
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
                <span class="font-handwriting text-3xl text-white block lg:inline">{{ __('Plan your trip with us') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-white">{{ __('Ready for an unforgettable tour?') }}</h2>
            </div>
            
            <a href="{{ route('tours.index') }}" class="px-8 py-4 bg-yellow-400 hover:bg-[#de9d36] text-[#fff] font-bold rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 uppercase tracking-wider">
                {{ __('Book Tour Now') }}
            </a>
        </div>
    </div>

    @php
        $testimonials = [
            [
                'name' => 'أحمد منصور',
                'role' => app()->getLocale() == 'ar' ? 'مسافر منفرد' : 'Solo Traveler',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=400',
                'rate' => '5.0',
                'description' => 'تجربتي مع مو تراڤيل كانت استثنائية بكل المقاييس. التنظيم دقيق جداً والمرشدين على مستوى عالٍ من الثقافة والرقي. شكراً لكم.'
            ],
            [
                'name' => 'Sarah Jenkins',
                'role' => 'Adventure Seeker',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=400',
                'rate' => '5.0',
                'description' => 'Our honeymoon in Egypt was flawless. From the VIP Cairo pick-up to the private Nile cruise, every detail was handled with care.'
            ],
            [
                'name' => 'Mark Thompson',
                'role' => 'History Buff',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=400',
                'rate' => '4.9',
                'description' => 'The 10-day luxury tour surpassed all expectations. The historical knowledge of our guide in Luxor was mind-blowing.'
            ],
            [
                'name' => 'Emily Roberts',
                'role' => 'Solo Traveler',
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=400',
                'rate' => '5.0',
                'description' => 'As a solo female traveler, I felt incredibly safe and supported. The boutique hotels they booked were stunning.'
            ],
            [
                'name' => 'David Wilson',
                'role' => 'Travel Expert',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=400',
                'rate' => '4.9',
                'description' => 'Forget the typical tourist traps. Mo Travels gives you an inside look at the real Egypt. The desert safari was an adrenaline-pumping adventure.'
            ]
        ];
    @endphp

    <!-- Testimonials Section -->
     <div class="py-20 max-lg:py-10 bg-white dark:bg-gray-800 relative transition-colors duration-300 overflow-hidden" 
          x-data='{ 
            active: 2,
            touchStartX: 0,
            touchEndX: 0,
            testimonials: @json($testimonials),
            next() {
                this.active = (this.active + 1) % this.testimonials.length;
            },
            prev() {
                this.active = (this.active - 1 + this.testimonials.length) % this.testimonials.length;
            },
            jump(offset) {
                this.active = (this.active + offset + this.testimonials.length) % this.testimonials.length;
            },
            checkSwipe() {
                if (this.touchEndX < this.touchStartX - 50) this.next();
                if (this.touchEndX > this.touchStartX + 50) this.prev();
            },
            get visibleTestimonials() {
                const len = this.testimonials.length;
                return [
                    this.testimonials[(this.active - 2 + len) % len],
                    this.testimonials[(this.active - 1 + len) % len],
                    this.testimonials[this.active],
                    this.testimonials[(this.active + 1) % len],
                    this.testimonials[(this.active + 2) % len]
                ];
            }
          }'>
        <div class="text-center mb-16">
                <span class="font-handwriting text-3xl text-yellow-500">{{ __('Testimonials & reviews') }}</span>
                <h2 class="mt-2 text-4xl lg:text-5xl font-display font-bold text-[#345BA8] dark:text-blue-400">{{ __('What They\'re Saying') }}</h2>
            </div>
        <div class="max-w-[1600px] mx-auto px-4 lg:px-8 relative">
            
            <!-- 1. Avatars Display (Fixed 5 Slots) -->
            <!-- Added Swipe/Drag Listeners -->
            <div class="relative h-[320px] mb-8 flex items-center justify-center gap-4 lg:gap-12 select-none cursor-grab active:cursor-grabbing"
                 @touchstart="touchStartX = $event.changedTouches[0].screenX"
                 @touchend="touchEndX = $event.changedTouches[0].screenX; checkSwipe()"
                 @mousedown="touchStartX = $event.screenX"
                 @mouseup="touchEndX = $event.screenX; checkSwipe()">
                
                <!-- Helper for Sparkles -->
                <template x-if="true">
                    <svg style="display: none;">
                        <symbol id="sparkle-icon" viewBox="0 0 91 43">
                            <path d="M45.5 0L48 8L56 8.5L49 15L51 23L45.5 18.5L40 23L42 15L35 8.5L43 8L45.5 0Z" fill="#dd9e36"/>
                            <path d="M20 20L22 25L27 25.5L23 29L24 34L20 31L16 34L17 29L13 25.5L18 25L20 20Z" fill="#dd9e36"/>
                            <path d="M71 20L73 25L78 25.5L74 29L75 34L71 31L67 34L68 29L64 25.5L69 25L71 20Z" fill="#dd9e36"/>
                        </symbol>
                    </svg>
                </template>

                <!-- Slot 1 (Far Left) - Clickable -->
                <div class="flex flex-col items-center transition-all duration-500 transform scale-75 opacity-60 blur-[1px] hidden md:flex cursor-pointer hover:opacity-80"
                     @click.stop="jump(-2)">
                    <div class="mb-4">
                        <svg class="w-16 h-8 text-gray-800 dark:text-gray-200"><use href="#sparkle-icon"></use></svg>
                    </div>
                    <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full overflow-hidden border-4 border-white shadow-lg">
                         <img :src="visibleTestimonials[0].image" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Slot 2 (Left) - Clickable -->
                <div class="flex flex-col items-center transition-all duration-500 transform scale-90 opacity-80 z-10 cursor-pointer hover:opacity-100 hover:scale-95"
                     @click.stop="jump(-1)">
                    <div class="mb-4">
                        <svg class="w-16 h-8 text-gray-800 dark:text-gray-200"><use href="#sparkle-icon"></use></svg>
                    </div>
                    <div class="w-32 h-32 lg:w-48 lg:h-48 rounded-full overflow-hidden border-4 border-white shadow-lg bg-gray-200">
                         <img :src="visibleTestimonials[1].image" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Slot 3 (Center - Active) -->
                <div class="flex flex-col items-center transition-all duration-500 z-20 transform scale-110 -translate-y-4">
                    <!-- No Sparkle for Center -->
                    <div class="w-48 h-48 lg:w-72 lg:h-72 rounded-full overflow-hidden border-[6px] border-[#dd9e36] shadow-2xl relative">
                         <img :src="visibleTestimonials[2].image" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Slot 4 (Right) - Clickable -->
                 <div class="flex flex-col items-center transition-all duration-500 transform scale-90 opacity-80 z-10 cursor-pointer hover:opacity-100 hover:scale-95"
                      @click.stop="jump(1)">
                    <div class="mb-4">
                        <svg class="w-16 h-8 text-gray-800 dark:text-gray-200"><use href="#sparkle-icon"></use></svg>
                    </div>
                    <div class="w-32 h-32 lg:w-48 lg:h-48 rounded-full overflow-hidden border-4 border-white shadow-lg bg-gray-200">
                         <img :src="visibleTestimonials[3].image" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Slot 5 (Far Right) - Clickable -->
                <div class="flex flex-col items-center transition-all duration-500 transform scale-75 opacity-60 blur-[1px] hidden md:flex cursor-pointer hover:opacity-80"
                     @click.stop="jump(2)">
                    <div class="mb-4">
                        <svg class="w-16 h-8 text-gray-800 dark:text-gray-200"><use href="#sparkle-icon"></use></svg>
                    </div>
                    <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full overflow-hidden border-4 border-white shadow-lg">
                         <img :src="visibleTestimonials[4].image" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- 2. Content Info -->
            <div class="text-center max-w-4xl mx-auto px-4">
                
                <!-- Badge + Info Row -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-6 mb-8">
                     <!-- Rating Badge -->
                    <div class="bg-[#dd9e36] text-white px-5 py-2 rounded-full flex items-center gap-2 shadow-sm">
                        <i class="fi fi-ss-star text-sm"></i>
                        <span class="font-extrabold text-lg leading-none pt-0.5" x-text="testimonials[active].rate"></span>
                    </div>

                    <!-- Name & Role -->
                    <div class="text-center md:text-left">
                        <h3 class="text-3xl font-extrabold text-[#040404] dark:text-white uppercase font-display leading-none" x-text="testimonials[active].name"></h3>
                        <p class="text-[#9CA3AF] text-lg font-medium font-display tracking-widest uppercase mt-1" x-text="testimonials[active].role"></p>
                    </div>
                </div>

                <!-- Navigation + Text Row -->
                <div class="flex items-center justify-between gap-4 md:gap-12">
                     <!-- Prev Button -->
                    <button @click="prev()" class="flex-shrink-0 w-14 h-14 rounded-full bg-[#F3F4F6] dark:bg-gray-700 hover:bg-[#FAD71B] dark:hover:bg-[#FAD71B] text-black dark:text-white transition-all flex items-center justify-center group shadow-sm z-10">
                        <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-right group-hover:translate-x-1' : 'fi-rr-arrow-small-left group-hover:-translate-x-1' }} text-2xl transition-transform"></i>
                    </button>

                    <!-- Quote Text -->
                    <div class="relative min-h-[100px] flex items-center justify-center"> <!-- Min Height to prevent jumping -->
                        <p class="text-[#0B0B0B] dark:text-gray-300 text-lg md:text-xl font-normal leading-relaxed md:px-8 transition-all duration-300"
                           :key="active"
                           x-transition:enter="transition ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform translate-y-2"
                           x-transition:enter-end="opacity-100 transform translate-y-0"
                           x-text="testimonials[active].description">
                        </p>
                    </div>

                    <!-- Next Button -->
                    <button @click="next()" class="flex-shrink-0 w-14 h-14 rounded-full bg-[#F3F4F6] dark:bg-gray-700 hover:bg-[#FAD71B] dark:hover:bg-[#FAD71B] text-black dark:text-white transition-all flex items-center justify-center group shadow-sm z-10">
                        <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left group-hover:-translate-x-1' : 'fi-rr-arrow-small-right group-hover:translate-x-1' }} text-2xl transition-transform"></i>
                    </button>
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

                <span class="font-handwriting text-3xl lg:text-4xl text-yellow-400 mb-2 block">{{ __('Are you ready to travel?') }}</span>
                <h2 class="text-4xl lg:text-6xl font-display font-bold text-white max-w-4xl mx-auto leading-tight">
                    {{ __(':name is an online tour booking platform', ['name' => __(config('app.name', 'Mo Travel'))]) }}
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
                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Tours') }}</span>
                </div>
                <div class="space-y-2">
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">{{ $destinationsCount }}</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Destinations') }}</span>
                </div>
                <div class="space-y-2">
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">500</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Happy Customers') }}</span>
                </div>
                 <div class="space-y-2 border-l-0 lg:border-l"> <!-- Fix for grid layout border on mobile -->
                    <span class="font-handwriting text-5xl text-[#345BA8] dark:text-blue-400 block">100</span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Reviews') }}</span>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
