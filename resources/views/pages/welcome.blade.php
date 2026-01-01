<x-layouts.app>
    <!-- Hero Section -->
    <!-- Hero Section with Swiper -->
    <div class="relative h-[calc(100vh-104px)]   bg-primary-900">
        <div class="swiper heroSwiper h-full">
            <div class="swiper-wrapper">
                @foreach($destinations as $destination)
                    <div class="swiper-slide relative">
                        <div class="absolute inset-0">
                            <img src="{{ Storage::url($destination->image) }}" alt="{{ $destination->display_name }}" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-primary-950/40"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-950/90 via-transparent to-primary-950/30"></div>
                        </div>
                        <div class="relative h-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-center items-center text-center pb-25">
                            <span class="font-handwriting text-5xl md:text-7xl text-yellow-400 mb-4 animate-fade-in-up">{{ __('Traveling') }}</span>
                            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight text-white font-display mb-6 animate-fade-in-up delay-100">
                                {{ __('Your Journey') }} <span class="border-b-4 border-white pb-2">{{ __('Begins Here') }}</span>
                            </h1>
                            <p class="max-w-2xl text-lg md:text-xl text-gray-200 animate-fade-in-up delay-200">
                                {{ __('Explore the timeless wonders of :name with our exclusive tour packages.', ['name' => $destination->display_name]) }}
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
                             <span class="text-sm uppercase tracking-wider">{{ __('When') }}</span>
                        </label>
                        <input type="text" id="date_from" name="date_from" placeholder="{{ __('Select Date') }}" class="w-full border-0 p-0 text-gray-900 dark:text-white font-bold focus:ring-0 placeholder:text-gray-400 dark:placeholder:text-gray-500 bg-transparent text-lg cursor-pointer">
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
                              <span class="text-sm uppercase tracking-wider">{{ __('Guests') }}</span>
                         </label>
                        
                        <!-- Main Display Input -->
                        <div @click="open = !open" class="cursor-pointer">
                            <input type="text" readonly 
                                   :value="total ? total + ' ' + '{{ __('Guests') }}' : ''"
                                   placeholder="{{ __('Add Guests') }}" 
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
                                <span class="text-gray-700 dark:text-gray-200 font-medium"><span x-text="counts.person"></span> {{ __('person') }}</span>
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
                                <span class="text-gray-700 font-medium"><span x-text="counts.adult"></span> {{ __('Adult') }}</span>
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
                                <span class="text-gray-700 font-medium"><span x-text="counts.child"></span> {{ __('child') }}</span>
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
                                 {{ __('Apply Selection') }}
                            </button>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-span-1 md:col-span-4 w-full">
                        <button type="submit" class="w-full md:w-auto px-10 py-5 bg-[#345BA8] text-white font-bold rounded-2xl hover:bg-[#2A4A8A] transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 flex items-center justify-center gap-3 uppercase tracking-wide text-sm group">
                            <i class="fi fi-rr-search text-lg group-hover:scale-110 transition-transform"></i>
                            {{ __('Search') }}
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

            <!-- Dynamic Grid -->
            @php
                $count = count($destinations);
                // Base grid classes
                $gridClasses = "grid grid-cols-1 gap-6 auto-rows-[300px]";
                
                // Adjust grid columns based on count for smaller sets
                if ($count === 1) {
                    $gridClasses .= " max-w-2xl mx-auto";
                } elseif ($count === 2) {
                    $gridClasses .= " md:grid-cols-2 max-w-5xl mx-auto";
                } elseif ($count === 3) {
                    $gridClasses .= " md:grid-cols-3";
                } else {
                    $gridClasses .= " md:grid-cols-4";
                }
            @endphp

            <div class="{{ $gridClasses }}">
                @foreach($destinations as $index => $destination)
                    @php
                        $colSpan = '';
                        // Only use complex Bento spans if we have enough items
                        if ($count > 3) {
                            $i = $index % 5;
                            $colSpan = 'md:col-span-1';
                            if ($i === 1 || $i === 3 || $i === 4) {
                                $colSpan = 'md:col-span-2';
                            }
                        }
                    @endphp

                    <a href="{{ route('destinations.show', $destination) }}" 
                       class="relative group overflow-hidden rounded-3xl shadow-lg {{ $colSpan }} transition-all duration-500 hover:shadow-2xl">
                        <img src="{{ Storage::url($destination->image) }}" 
                             alt="{{ $destination->display_name }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Premium Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 transition-opacity group-hover:opacity-90"></div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                            <span class="inline-block px-3 py-1 bg-yellow-400 text-black text-[10px] font-bold uppercase tracking-widest rounded-full mb-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ __('Explore') }}</span>
                            <h3 class="text-2xl md:text-3xl font-bold text-white font-display tracking-wide group-hover:text-yellow-400 transition-colors">
                                {{ $destination->display_name }}
                            </h3>
                            <div class="mt-2 w-12 h-1 bg-yellow-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Footer Button -->
            <div class="mt-12 text-center">
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-3 bg-[#355fbf] text-white px-8 py-4 rounded-full font-bold text-base hover:bg-[#2a4a9a] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                    {{ __('All Destinations') }}
                    <div class="w-6 h-6 rounded-full bg-black/10 flex items-center justify-center group-hover:bg-black/20 transition">
                        <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-lg"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <!-- Plan Your Trip Section -->
    <section class="py-24 max-lg:py-16 bg-white dark:bg-gray-900 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
                     <!-- Headings -->
                    <div class="mb-9 relative text-center">
                        <div class="relative inline-block mb-1">
                            <span class="  font-handwriting  text-yellow-500 text-5xl   dark:text-white relative z-10">{{ __('Get to know us') }}</span>
                        </div>
                        <h2 class="text-5xl lg:text-[4rem] font-display font-extrabold text-[#040404] dark:text-white leading-[1.1] uppercase tracking-tight">
                            {{ __('Plan Your Trip With') }} <br> {{ __('Traveler Egypt Tours') }}
                        </h2>
                    </div>
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-24 relative">
                
            
                <!-- Left Column: Title & Main Image -->
                <div class="w-full lg:w-[45%] relative z-10">
           

                    <!-- Main Image -->
                    <div class="rounded-[30px] overflow-hidden shadow-2xl h-[550px] w-full relative group">
                         <img src="{{ asset('images/about-image.png') }}" alt="Plan Your Trip" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    </div>
                </div>

                <!-- Right Column: Content -->
                <div class="w-full lg:w-[55%] relative pt-4 lg:pt-5">
                    
                    <!-- Intro Paragraph -->
                    <p class="text-xl text-[#040404] dark:text-gray-300 font-display font-medium leading-relaxed mb-12 max-w-lg">
                        Traveler Egypt Tours is The Best travel agency that offers a variety of tour packages throughout Egypt. Their services include day tours, multi-day tours, and specialized packages.
                    </p>

                    <!-- Features List -->
                    <div class="space-y-10 mb-12 relative z-10">
                        
                        <!-- Feature 1 -->
                        <div class="flex gap-6 items-start">
                             <div class="w-14 h-14 bg-[#040404] dark:bg-white rounded-xl flex items-center justify-center rotate-3 shrink-0 shadow-lg">
                                <i class="fi fi-ss-shield-check text-white dark:text-black text-2xl"></i>
                             </div>
                             <div>
                                <h3 class="text-2xl font-display font-extrabold text-[#040404] dark:text-white uppercase mb-2">{{ __('Safety and Security') }}</h3>
                                <p class="text-lg font-display text-gray-600 dark:text-gray-400 leading-snug">
                                    The company emphasizes safety and security for all travelers.
                                </p>
                             </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="flex gap-6 items-start">
                             <div class="w-14 h-14 bg-[#040404] dark:bg-white rounded-xl flex items-center justify-center -rotate-2 shrink-0 shadow-lg">
                                <i class="fi fi-ss-star text-white dark:text-black text-2xl"></i>
                             </div>
                             <div>
                                <h3 class="text-2xl font-display font-extrabold text-[#040404] dark:text-white uppercase mb-2">{{ __('Specialized Tours') }}</h3>
                                <p class="text-lg font-display text-gray-600 dark:text-gray-400 leading-snug">
                                    {{ __('History, cultural sightseeing, safari, and holiday packages.') }}
                                </p>
                             </div>
                        </div>

                         <!-- Feature 3 -->
                        <div class="flex gap-6 items-start">
                             <div class="w-14 h-14 bg-[#040404] dark:bg-white rounded-xl flex items-center justify-center rotate-1 shrink-0 shadow-lg">
                                <i class="fi fi-ss-world text-white dark:text-black text-2xl"></i>
                             </div>
                             <div>
                                <h3 class="text-2xl font-display font-extrabold text-[#040404] dark:text-white uppercase mb-2">{{ __('Tour Packages') }}</h3>
                                <p class="text-lg font-display text-gray-600 dark:text-gray-400 leading-snug">
                                    {{ __('Variety of packages including day tours and multi-day adventures.') }}
                                </p>
                             </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-3 bg-[#355fbf] text-white px-8 py-4 rounded-full font-bold text-base hover:bg-[#2a4a9a] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 group relative z-20">
                        {{ __('Book Now') }}
                        <div class="w-6 h-6 rounded-full bg-black/10 flex items-center justify-center group-hover:bg-black/20 transition">
                            <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-lg"></i>
                        </div>
                    </a>

                  
                </div>

            </div>
        </div>
    </section>
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
                                     @php
                                         $firstMedia = (is_array($tour->images) && count($tour->images) > 0) ? $tour->images[0] : null;
                                         $isVideo = false;
                                         if ($firstMedia) {
                                             $ext = strtolower(pathinfo($firstMedia, PATHINFO_EXTENSION));
                                             $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov']);
                                         }
                                     @endphp

                                     @if($firstMedia)
                                         @if($isVideo)
                                             <video src="{{ Storage::url($firstMedia) }}" 
                                                    muted autoplay loop playsinline
                                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                             </video>
                                         @else
                                             <img src="{{ Storage::url($firstMedia) }}" 
                                                  alt="{{ $tour->display_name }}" 
                                                  class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                         @endif
                                     @else
                                         <img src="https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?auto=format&fit=crop&w=800&q=80" 
                                              alt="{{ $tour->display_name }}" 
                                              class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                     @endif
                                     
                                     <!-- Photos Count Badge -->
                                     <div class="absolute bottom-3 right-3 bg-[#345BA8] text-white text-xs px-2 py-1 rounded-md flex items-center gap-1 shadow-sm z-10">
                                         <i class="fi fi-rr-camera"></i>
                                         <span>{{ is_array($tour->images) ? count($tour->images) : 0 }}</span>
                                     </div>
                                 </div>

                                <!-- Content Section -->
                                <div class="p-6 flex flex-col flex-grow justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-yellow-500 leading-tight mb-4 line-clamp-2">
                                            {{ $tour->display_name }}
                                        </h3>
                                    </div>
                                    
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-600 text-sm text-gray-500 dark:text-gray-300">
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center gap-1">
                                                <i class="fi fi-rr-clock-five"></i>
                                                <span>{{ $tour->duration_days }} {{ __('Days') }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="fi fi-rr-user"></i>
                                                <span>20</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-[#345BA8] dark:text-blue-400 font-bold flex items-center gap-1 group-hover:text-[#2A4A8A] dark:group-hover:text-blue-300 transition">
                                            {{ __('Explore') }} 
                                            <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left group-hover:-translate-x-1' : 'fi-rr-arrow-small-right group-hover:translate-x-1' }} text-lg translate-y-[1px]"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                     @endforeach
                </div>
                <!-- Navigation Buttons -->
                <div class="swiper-button-next !w-12 !h-12 !bg-white !rounded-full !text-[#2A2C3E] !shadow-lg after:!content-none flex items-center justify-center hover:!bg-[#345BA8] hover:!text-white transition-all opacity-0 group-hover:opacity-100 absolute top-1/2 -right-4 z-10 translate-x-1/2">
                    <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-2xl mt-1"></i>
                </div>
                <div class="swiper-button-prev !w-12 !h-12 !bg-white !rounded-full !text-[#2A2C3E] !shadow-lg after:!content-none flex items-center justify-center hover:!bg-[#345BA8] hover:!text-white transition-all opacity-0 group-hover:opacity-100 absolute top-1/2 -left-4 z-10 -translate-x-1/2">
                    <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-right' : 'fi-rr-arrow-small-left' }} text-2xl mt-1"></i>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination !bottom-0"></div>
            </div>

            <!-- Footer Button -->
             <div class="mt-12 text-center">
                 <a href="{{ route('tours.index') }}" class="inline-block px-10 py-4 bg-[#2A4A8A] text-white font-bold rounded-lg shadow-lg hover:bg-opacity-90 transition transform hover:-translate-y-1">
                    {{ __('All Tours') }}
                </a>
            </div>
        </div>
    </div>
    
    <!-- Testimonials Section -->
     <div class="py-20 max-lg:py-10 bg-white dark:bg-gray-800 relative transition-colors duration-300 overflow-hidden" 
          x-data='{ 
            active: 2,
            touchStartX: 0,
            touchEndX: 0,
            testimonials: [
                { 
                    name: "Sarah Jenkins", 
                    role: @json(__('Solo Traveler')), 
                    image: "{{ asset('images/testimonials/testimonial-1.jpg') }}", 
                    rate: "5.0", 
                     description: @json(__('Everything was well-organized, and we felt safe and taken care of throughout the entire journey. Highly recommend!')) 
                },
                { 
                    name: "Mark Thompson", 
                    role: @json(__('Adventure Seeker')), 
                    image: "{{ asset('images/testimonials/testimonial-2.jpg') }}", 
                    rate: "5.0", 
                    description: @json(__('Best of the Best Cairo Tour Experience!!! The tour was perfectly arranged, and the guide was fantastic.')) 
                },
                { 
                    name: "Yusuf Mahtow", 
                    role: @json(__('Egypt Tour Guide')), 
                    image: "{{ asset('images/testimonials/testimonial-3.jpg') }}", 
                    rate: "4.8", 
                    description: @json(__('Excellent service and very knowledgeable guides. We had an amazing time exploring the historical sites.')) 
                },
                { 
                    name: "Emily Roberts", 
                    role: @json(__('History Buff')), 
                    image: "{{ asset('images/testimonials/testimonial-4.jpg') }}", 
                    rate: "4.9", 
                    description: @json(__('The guides were incredibly knowledgeable and made the history come alive. Everything was well-organized.')) 
                },
                { 
                    name: "Michael Chen", 
                    role: @json(__('Food Blogger')), 
                    image: "{{ asset('images/testimonials/testimonial-2.jpg') }}", 
                    rate: "4.7", 
                    description: @json(__('An absolute culinary delight! The local food tours were the highlight of our trip. Highly recommended.')) 
                }
            ],
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
                    {{ __('Traveler Egypt Tours is an online tour booking platform') }}
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
    <!-- Why Choose Us / About Section -->
    <div class="py-16 bg-[#fff] dark:bg-gray-900 transition-colors duration-300 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                
                <!-- Left Column: Image Composition -->
                <div class="relative w-full max-w-[500px] mx-auto lg:mx-0 h-[500px] hidden md:block">
                    <!-- Rotated Image 1 -->
                    <div class="absolute top-0 left-8 w-[340px] aspect-[3/4] p-3 bg-white shadow-2xl transform -rotate-[8deg] rounded-2xl z-10 border-4 border-white/50">
                        <img src="{{ asset('images/about-1.png') }}" 
                             alt="About Traveler Egypt" 
                             class="w-full h-full object-cover rounded-xl hover:scale-105 transition duration-700">
                    </div>
                    
                    <!-- Overlapping Image 2 -->
                    <div class="absolute bottom-8 right-0 w-[260px] aspect-[3/4] p-3 bg-white shadow-2xl transform rotate-[6deg] rounded-2xl z-20 border-4 border-white/50">
                        <img src="{{ asset('images/about-2.png') }}" 
                             alt="Happy Traveler" 
                             class="w-full h-full object-cover rounded-xl hover:scale-105 transition duration-700">
                    </div>

                     <!-- Decorative Element -->
                     <div class="absolute -top-12 right-12 z-0 opacity-10 dark:opacity-5">
                        <i class="fi fi-rr-plane-alt text-9xl text-gray-900 dark:text-white"></i>
                     </div>
                </div>

                <!-- Right Column: Content -->
                <div class="space-y-10">
                    <!-- Heading -->
                    <div>
                        <span class="font-handwriting text-3xl text-yellow-400 block mb-3">{{ __('Our benefit lists') }}</span>
                        <h2 class="text-4xl lg:text-5xl font-display font-bold text-neutral-950 dark:text-white leading-tight">
                            {{ __('Why Choose Traveler Egypt Tours') }}
                        </h2>
                        <p class="mt-6 text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ __('Discover breathtaking destinations handpicked for unforgettable experiences. From tropical beaches to cultural landmarks, we make your dream vacation a reality.') }}
                        </p>
                    </div>

                    <!-- Feature Cards -->
                    <div class="space-y-4">
                        <!-- Card 1 -->
                        <div class="bg-gray-50/50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-200 dark:border-gray-700 flex items-start gap-5 hover:bg-white dark:hover:bg-gray-800 transition shadow-sm hover:shadow-md">
                            <div class="w-14 h-14 rounded-full bg-[#fff] flex items-center justify-center flex-shrink-0">
                                <i class="fi fi-rr-badge-check text-2xl text-yellow-400"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ __('Professional and Certified') }}</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ __('Our team consists of certified experts dedicated to providing the best travel experiences.') }}</p>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-gray-50/50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-200 dark:border-gray-700 flex items-start gap-5 hover:bg-white dark:hover:bg-gray-800 transition shadow-sm hover:shadow-md">
                            <div class="w-14 h-14 rounded-full bg-[#fff] flex items-center justify-center flex-shrink-0">
                                <i class="fi fi-rr-chart-histogram text-2xl text-yellow-400 h-[26px]"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ __('Positive Reviews and Testimonials') }}</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ __('Trusted by thousands of travelers worldwide with 5-star reviews and feedback.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pt-2">
                         <a href="{{ route('about') }}" class="inline-flex items-center gap-3 bg-[#355fbf] text-white px-8 py-4 rounded-full font-bold text-base hover:bg-[#355fbf] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                            {{ __('Know About Us') }}
                            <div class="w-6 h-6 rounded-full bg-black/10 flex items-center justify-center group-hover:bg-black/20 transition">
                                <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-lg h-[24px]"></i>
                            </div>
                        </a>
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
                    <span class="font-handwriting text-3xl text-yellow-500 block mb-2">{{ __('From the blog post') }}</span>
                    <h2 class="text-4xl lg:text-5xl font-display font-bold text-[#2A2C3E] dark:text-white">{{ __('News & Articles') }}</h2>
                </div>
                <div class="hidden md:block">
                     <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-3 bg-[#355fbf] text-white px-8 py-4 rounded-full font-bold text-base hover:bg-[#2a4a9a] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                        {{ __('All Blogs') }}
                        <div class="w-6 h-6 rounded-full bg-black/10 flex items-center justify-center group-hover:bg-black/20 transition">
                            <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-lg"></i>
                        </div>
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
                                    {{ $article->display_title }}
                                </a>
                            </h3>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('articles.show', $article) }}" class="text-[#345BA8] dark:text-blue-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2 group-hover:gap-3 transition-all">
                                {{ __('Read More') }} 
                                <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left group-hover:-translate-x-1' : 'fi-rr-arrow-small-right group-hover:translate-x-1' }} text-lg translate-y-[1px]"></i>
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
            // Testimonial Swiper
            new Swiper(".testimonialSwiper", {
                slidesPerView: 3,
                spaceBetween: 0,
                centeredSlides: true,
                loop: true,
                slideToClickedSlide: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next-custom",
                    prevEl: ".swiper-button-prev-custom",
                },
                on: {
                    slideChange: function () {
                        // Dispatch event for AlpineJS to update active index
                        // We use realIndex because of the loop
                        window.dispatchEvent(new CustomEvent('testimonial-change', { detail: this.realIndex }));
                    },
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 5,
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
