<x-layouts.app>
    <!-- Hero Section -->
    <!-- Hero Section with Swiper -->
    <div class="relative h-[calc(100vh-104px)]   bg-primary-900">
        <div class="swiper heroSwiper h-full">
            <div class="swiper-wrapper">
                @foreach($destinations as $destination)
                    <div class="swiper-slide relative">
                        <div class="absolute inset-0">
                            <img src="{{ Storage::url($destination->image) }}" alt="{{ $destination->name }}" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-primary-950/40"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-950/90 via-transparent to-primary-950/30"></div>
                        </div>
                        <div class="relative h-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-center items-center text-center pb-25">
                            <span class="font-handwriting text-5xl md:text-7xl text-yellow-400 mb-4 animate-fade-in-up">Traveling</span>
                            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight text-white font-display mb-6 animate-fade-in-up delay-100">
                                Your Journey <span class="border-b-4 border-white pb-2">Begins Here</span>
                            </h1>
                            <p class="max-w-2xl text-lg md:text-xl text-gray-200 animate-fade-in-up delay-200">
                                Explore the timeless wonders of {{ $destination->name }} with our exclusive tour packages.
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="swiper-button-next !w-12 !h-12 !bg-white/10 max-sm:!hidden !backdrop-blur-sm !rounded-full !text-white hover:!bg-white/20 transition-all after:!text-xl"></div>
            <div class="swiper-button-prev !w-12 !h-12 !bg-white/10 max-sm:!hidden !backdrop-blur-sm !rounded-full !text-white hover:!bg-white/20 transition-all after:!text-xl"></div>
        </div>

        <!-- Search Form -->
        <div class="relative z-20 -mt-24 px-4 w-full">
            <div class="max-w-5xl mx-auto bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl border border-white/40 dark:border-gray-700 rounded-3xl shadow-2xl p-6 md:p-8 animate-fade-in-up delay-300">
                <form action="{{ route('tours.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    
                    <!-- Hidden Filters -->
                    <input type="hidden" name="search" value="">
                    <input type="hidden" name="min_price" value="0">
                    <input type="hidden" name="max_price" value="5000">

                    <!-- Date From -->
                    <div class="col-span-1 md:col-span-4 border-b-2 md:border-b-0 md:border-r-2 border-gray-100 dark:border-gray-700 pb-4 md:pb-0 md:pr-6 relative group">
                        <label for="date_from" class="flex items-center gap-2 text-[#345BA8] dark:text-blue-400 font-bold mb-2 group-focus-within:text-[#2A4A8A] dark:group-focus-within:text-blue-300 transition-colors">
                             <i class="fi fi-rr-calendar-clock text-xl"></i>
                             <span class="text-sm uppercase tracking-wider">When</span>
                        </label>
                        <input type="text" id="date_from" name="date_from" placeholder="Select Date" class="w-full border-0 p-0 text-gray-900 dark:text-white font-bold focus:ring-0 placeholder:text-gray-400 dark:placeholder:text-gray-500 bg-transparent text-lg cursor-pointer">
                    </div>

                    <!-- Guests Dropdown -->
                     <div class="col-span-1 md:col-span-4 border-b-2 md:border-b-0 md:border-r-2 border-gray-100 dark:border-gray-700 pb-4 md:pb-0 md:pr-6 md:pl-6 relative" 
                          x-data="{ 
                             open: false,
                             counts: { person: 0, adult: 0, child: 0 },
                             get total() { return this.counts.person + this.counts.adult + this.counts.child; }
                          }"
                          @click.outside="open = false">
                         
                         <label @click="open = !open" class="flex items-center gap-2 text-[#345BA8] dark:text-blue-400 font-bold mb-2 cursor-pointer hover:text-[#2A4A8A] dark:hover:text-blue-300 transition-colors">
                              <i class="fi fi-rr-users-alt text-xl"></i>
                              <span class="text-sm uppercase tracking-wider">Guests</span>
                         </label>
                        
                        <!-- Main Display Input -->
                        <div @click="open = !open" class="cursor-pointer">
                            <input type="text" readonly 
                                   :value="total ? total + ' Guests' : ''"
                                   placeholder="Add Guests" 
                                   class="w-full border-0 placeholder:text-gray-400 dark:placeholder:text-gray-500 p-0 text-gray-900 dark:text-white font-bold focus:ring-0 cursor-pointer text-lg bg-transparent"
                            >
                        </div>
                        <!-- Actual Input for Form Submission -->
                        <input type="hidden" name="guests" :value="total">

                        <!-- Dropdown -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-4"
                             class="absolute top-full left-0 mt-6 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 z-50 border border-gray-100 dark:border-gray-700 ring-1 ring-black/5"
                             style="display: none;">
                            
                            <!-- Person Row -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-50 dark:border-gray-700">
                                <span class="text-gray-700 dark:text-gray-200 font-medium"><span x-text="counts.person"></span> person</span>
                                <div class="flex items-center gap-3">
                                    <button type="button" @click="if(counts.person > 0) counts.person--" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-[#345BA8] hover:text-white transition disabled:opacity-50" :disabled="counts.person <= 0">
                                        <i class="fi fi-rr-minus text-xs"></i>
                                    </button>
                                    <button type="button" @click="counts.person++" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-[#345BA8] hover:text-white transition">
                                        <i class="fi fi-rr-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Adult Row -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-50">
                                <span class="text-gray-700 font-medium"><span x-text="counts.adult"></span> Adult</span>
                                <div class="flex items-center gap-3">
                                    <button type="button" @click="if(counts.adult > 0) counts.adult--" class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-[#345BA8] hover:text-white transition disabled:opacity-50" :disabled="counts.adult <= 0">
                                        <i class="fi fi-rr-minus text-xs"></i>
                                    </button>
                                    <button type="button" @click="counts.adult++" class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-[#345BA8] hover:text-white transition">
                                        <i class="fi fi-rr-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Child Row -->
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-50">
                                <span class="text-gray-700 font-medium"><span x-text="counts.child"></span> child</span>
                                <div class="flex items-center gap-3">
                                    <button type="button" @click="if(counts.child > 0) counts.child--" class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-[#345BA8] hover:text-white transition disabled:opacity-50" :disabled="counts.child <= 0">
                                        <i class="fi fi-rr-minus text-xs"></i>
                                    </button>
                                    <button type="button" @click="counts.child++" class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-[#345BA8] hover:text-white transition">
                                        <i class="fi fi-rr-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Apply Button -->
                            <button type="button" @click="open = false" class="w-full py-3 bg-[#345BA8] text-white font-bold rounded-lg hover:bg-[#2A4A8A] transition text-sm tracking-wider uppercase shadow-lg shadow-blue-900/10">
                                Apply Selection
                            </button>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-span-1 md:col-span-4 w-full">
                        <button type="submit" class="w-full md:w-auto px-10 py-5 bg-[#345BA8] text-white font-bold rounded-2xl hover:bg-[#2A4A8A] transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 flex items-center justify-center gap-3 uppercase tracking-wide text-sm group">
                            <i class="fi fi-rr-search text-lg group-hover:scale-110 transition-transform"></i>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="h-32 bg-white dark:bg-gray-900 max-md:h-[238px]"></div> <!-- Spacer for the floating search form -->

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hero Swiper
            new Swiper(".heroSwiper", {
                effect: "fade",
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            // Date Picker
            flatpickr("#date_from", {
                minDate: "today",
                dateFormat: "Y-m-d",
            });
        });
    </script>
    @endpush

    <!-- Featured Destinations -->
    <!-- Featured Destinations -->
    <div id="featured-destinations" class="py-20 max-lg:py-10 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <span class="font-handwriting text-3xl text-yellow-500">Destinations lists</span>
                <h2 class="mt-2 text-4xl lg:text-5xl font-display font-bold text-[#2A2C3E] dark:text-white">Discover With Us</h2>
            </div>

            <!-- Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-[300px]">
                @foreach($destinations as $index => $destination)
                    @php
                        // Grid logic matching the screenshot (Row 1: 1-2-1, Row 2: 2-2)
                        // Repeats every 5 items
                        $i = $index % 5;
                        $colSpan = 'md:col-span-1';
                        if ($i === 1 || $i === 3 || $i === 4) {
                            $colSpan = 'md:col-span-2';
                        }
                    @endphp

                    <a href="{{ route('destinations.show', $destination) }}" 
                       class="relative group overflow-hidden rounded-2xl shadow-lg {{ $colSpan }}">
                        <img src="{{ Storage::url($destination->image) }}" 
                             alt="{{ $destination->name }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-80 transition-opacity group-hover:opacity-90"></div>
                        
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-2xl font-bold text-white font-display tracking-wide group-hover:text-yellow-400 transition-colors">
                                {{ $destination->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Footer Button -->
            <div class="mt-12 text-center">
                <a href="{{ route('destinations.index') }}" class="inline-block px-10 py-4 bg-[#2A2C3E] dark:bg-gray-700 text-white font-bold rounded-lg shadow-lg hover:bg-opacity-90 transition transform hover:-translate-y-1">
                    All Destinations
                </a>
            </div>
        </div>
    </div>


    <!-- Plan Your Trip Section -->
    <div class="py-20 max-lg:py-10 bg-white dark:bg-gray-900 overflow-hidden transition-colors duration-300 max-md:py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-24">
                
                <!-- Image Column -->
                <div class="w-full lg:w-1/2 relative lg:pr-12"> <!-- Added padding right to create space for the overlap feel -->
                    <div class="relative z-10">
                        <img src="{{ asset('images/about-image.png') }}" alt="Plan Your Trip" class="w-full h-auto object-contain scale-110"> <!-- Scale up slightly to mimic the brush effect overflowing -->
                    </div>
                     
                    <!-- Floating Contact Card -->
                    <div class="absolute top-1/2 -left-4 lg:-left-12 transform -translate-y-1/2 bg-white dark:bg-gray-800 p-4 pr-8 rounded-xl shadow-xl z-20 flex items-center gap-4 border-l-4 border-[#345BA8] animate-fade-in-up">
                        <div class="w-12 h-12 bg-[#345BA8] rounded-full flex items-center justify-center text-white">
                             <i class="fi fi-ss-phone-call text-xl"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Book Your Trip Now</span>
                            <span class="block text-xl font-bold text-[#2A2C3E] dark:text-white">01141812709</span>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="w-full lg:w-1/2 space-y-8">
                    <div class="relative">
                        <span class="font-handwriting text-4xl text-yellow-500 block mb-2 relative z-10">Get to know us</span>
                         <!-- Decorative line element hint -->
                         <svg class="absolute -top-6 right-0 w-32 h-auto text-gray-200 dark:text-gray-700" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                            <path d="M0 50 Q 25 25, 50 50 T 100 50" stroke-width="2" stroke-dasharray="4" />
                         </svg>
                        <h2 class="text-4xl lg:text-5xl font-display font-bold text-[#345BA8] dark:text-blue-400 leading-tight">
                            Plan Your Trip With <br> Traveler Egypt Tours
                        </h2>
                    </div>

                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                        Traveler Egypt Tours is The Best travel agency that offers a variety of tour packages throughout Egypt. Their services include day tours, multi-day tours, and specialized packages that encompass history and cultural sightseeing, shore excursions, city tours, safari and diving adventures, and holiday special packages. The company emphasizes safety and security for all travelers.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <i class="fi fi-ss-check-circle text-yellow-500 text-xl"></i>
                            <span class="text-[#345BA8] dark:text-blue-400 font-bold text-lg">Safety and Security</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fi fi-ss-check-circle text-yellow-500 text-xl"></i>
                            <span class="text-[#345BA8] dark:text-blue-400 font-bold text-lg">Specialized Tours</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fi fi-ss-check-circle text-yellow-500 text-xl"></i>
                            <span class="text-[#345BA8] dark:text-blue-400 font-bold text-lg">Tour Packages</span>
                        </li>
                    </ul>

                    <div class="pt-4">
                        <a href="{{ route('tours.index') }}" class="inline-block px-10 py-4 bg-[#345BA8] text-white font-bold rounded-lg shadow-lg hover:bg-[#2A4A8A] transition transform hover:-translate-y-1">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Tours (Most Popular) -->
    <div class="py-20 max-lg:py-10 bg-gray-50 dark:bg-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <span class="font-handwriting text-3xl text-yellow-500">Featured tours</span>
                <h2 class="mt-2 text-4xl lg:text-5xl font-display font-bold text-[#2A2C3E] dark:text-white">Most Popular Tours</h2>
            </div>
            
            <!-- Swiper Carousel -->
            <div class="swiper toursSwiper !pb-12 !px-4">
                <!-- Swiper Wrapper -->
                <div class="swiper-wrapper py-8 pb-12"> <!-- Added padding for shadow overflow -->
                    @foreach($featuredTours as $tour)
                        <div class="swiper-slide h-auto">
                            <a href="{{ route('tours.show', $tour) }}" class="flex flex-col h-full bg-white dark:bg-gray-700 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-600 block text-left w-full max-w-sm mx-auto">
                                <!-- Image Section -->
                                <div class="relative w-full aspect-[4/3] overflow-hidden">
                                    <img src="{{ Storage::url(is_array($tour->images) ? ($tour->images[0] ?? '') : '') }}" 
                                         alt="{{ $tour->title }}" 
                                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    
                                    <!-- Photos Count Badge -->
                                    <div class="absolute bottom-3 right-3 bg-[#345BA8] text-white text-xs px-2 py-1 rounded-md flex items-center gap-1 shadow-sm">
                                        <i class="fi fi-rr-camera"></i>
                                        <span>{{ is_array($tour->images) ? count($tour->images) : 0 }}</span>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="p-6 flex flex-col flex-grow justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-yellow-500 leading-tight mb-4 line-clamp-2">
                                            {{ $tour->title }}
                                        </h3>
                                    </div>
                                    
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-600 text-sm text-gray-500 dark:text-gray-300">
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center gap-1">
                                                <i class="fi fi-rr-clock-five"></i>
                                                <span>{{ $tour->duration_days }} Days</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="fi fi-rr-user"></i>
                                                <span>20</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-[#345BA8] dark:text-blue-400 font-bold flex items-center gap-1 group-hover:text-[#2A4A8A] dark:group-hover:text-blue-300 transition">
                                            Explore 
                                            <i class="fi fi-rr-arrow-small-right text-lg translate-y-[1px]"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                     @endforeach
                </div>
                <!-- Navigation Buttons -->
                <div class="swiper-button-next !w-12 !h-12 !bg-white !rounded-full !text-[#2A2C3E] !shadow-lg after:!content-none flex items-center justify-center hover:!bg-[#345BA8] hover:!text-white transition-all opacity-0 group-hover:opacity-100 absolute top-1/2 -right-4 z-10 translate-x-1/2">
                    <i class="fi fi-rr-arrow-small-right text-2xl mt-1"></i>
                </div>
                <div class="swiper-button-prev !w-12 !h-12 !bg-white !rounded-full !text-[#2A2C3E] !shadow-lg after:!content-none flex items-center justify-center hover:!bg-[#345BA8] hover:!text-white transition-all opacity-0 group-hover:opacity-100 absolute top-1/2 -left-4 z-10 -translate-x-1/2">
                    <i class="fi fi-rr-arrow-small-left text-2xl mt-1"></i>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination !bottom-0"></div>
            </div>

            <!-- Footer Button -->
             <div class="mt-12 text-center">
                 <a href="{{ route('tours.index') }}" class="inline-block px-10 py-4 bg-[#2A4A8A] text-white font-bold rounded-lg shadow-lg hover:bg-opacity-90 transition transform hover:-translate-y-1">
                    All Tours
                </a>
            </div>
        </div>
    </div>
    
    <!-- Testimonials Section -->
    <div class="py-20 max-lg:py-10 bg-gray-50 dark:bg-gray-800 relative transition-colors duration-300">
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
    <!-- Why Choose Us Section -->
    <div class="flex flex-col lg:flex-row min-h-[500px]">
        <!-- Image Half -->
        <div class="w-full lg:w-1/2 relative h-[400px] lg:h-auto">
            <img src="{{ asset('images/Untitled-design-2024-07-07T171358.232.webp') }}" 
                 alt="Why Choose Traveler Egypt Tours" 
                 class="absolute inset-0 w-full h-full object-cover">
        </div>

        <!-- Content Half -->
        <div class="w-full lg:w-1/2 bg-[#2A2C3E] dark:bg-gray-800 p-12 lg:p-24 flex flex-col justify-center relative overflow-hidden transition-colors duration-300">
 

             <div class="relative z-10">
                <span class="font-handwriting text-3xl text-yellow-500 mb-2 block">Our benefit lists</span>
                <h2 class="text-4xl lg:text-5xl font-display font-bold text-white mb-12 max-w-lg">
                    Why Choose Traveler Egypt Tours
                </h2>

                <div class="space-y-10">
                    <!-- Benefit 1 -->
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-full bg-yellow-500/10 flex items-center justify-center">
                            <i class="fi fi-rr-badge-check text-4xl text-yellow-500"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Professional and Certified</h3>
                         </div>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-full bg-yellow-500/10 flex items-center justify-center">
                             <i class="fi fi-rr-chart-histogram text-4xl text-yellow-500"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Positive Reviews and Testimonials</h3>
                         </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
    <!-- News & Articles Section -->
    <div class="py-20 max-lg:py-10 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-end max-lg:items-center mb-12 gap-6">
                <div class="text-center md:text-left">
                    <span class="font-handwriting text-3xl text-yellow-500 block mb-2">From the blog post</span>
                    <h2 class="text-4xl lg:text-5xl font-display font-bold text-[#2A2C3E] dark:text-white">News & Articles</h2>
                </div>
                <div>
                     <a href="{{ route('articles.index') }}" class="inline-block px-8 py-3 bg-[#2A4A8A] text-white font-bold rounded-lg shadow-md hover:bg-opacity-90 transition transform hover:-translate-y-1">
                        All Blogs
                    </a>
                </div>
            </div>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                 @foreach($latestArticles as $article)
                    <article class="p-8 border border-gray-100 dark:border-gray-700 rounded-2xl hover:shadow-xl transition-all duration-300 group bg-white dark:bg-gray-800 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center gap-2 mb-4 text-[#345BA8] dark:text-blue-400">
                                <i class="fi fi-rr-user"></i>
                             </div>
                            <h3 class="text-xl font-bold text-[#2A2C3E] dark:text-white mb-6 leading-snug group-hover:text-[#345BA8] dark:group-hover:text-blue-400 transition-colors">
                                <a href="{{ route('articles.show', $article) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('articles.show', $article) }}" class="text-[#345BA8] dark:text-blue-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2 group-hover:gap-3 transition-all">
                                Read More 
                                <i class="fi fi-rr-arrow-small-right text-lg translate-y-[1px]"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ... (existing scripts)

            // Testimonial Swiper
            new Swiper(".testimonialSwiper", {
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

            // Tours Swiper
            new Swiper(".toursSwiper", {
                slidesPerView: 1,
                spaceBetween: 24,
                grabCursor: true,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                },
            });
        });
    </script>
    @endpush
</x-layouts.app>
