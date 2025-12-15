<x-layouts.app>


    @php
        $heroImages = $tour->images ?? [];
        if (empty($heroImages)) {
             for($i=0; $i<8; $i++) $heroImages[] = 'placeholder';
        } else {
             while(count($heroImages) < 8) {
                 $heroImages = array_merge($heroImages, $heroImages);
             }
        }
    @endphp

    <!-- Hero Slider -->
    <div class="relative h-[450px] bg-gray-900 group">
        <!-- Swiper -->
        <div class="swiper mySwiper h-full">
            <div class="swiper-wrapper">
                 @foreach($heroImages as $image)
                    <div class="swiper-slide relative border-r-4 border-white h-full">
                         @if($image === 'placeholder')
                            <img src="https://placehold.co/1200x600" class="h-full w-full object-cover">
                         @else
                            <img src="{{ Storage::url($image) }}" class="h-full w-full object-cover">
                         @endif
                    </div>
                @endforeach
            </div>
            
            <!-- Navigation Buttons -->
            <div class="swiper-button-next !text-gray-900 !w-12 !h-12 !bg-white !shadow-lg !rounded-full after:!text-lg hover:!scale-105 transition-transform !z-50"></div>
            <div class="swiper-button-prev !text-gray-900 !w-12 !h-12 !bg-white !shadow-lg !rounded-full after:!text-lg hover:!scale-105 transition-transform !z-50"></div>
        </div>

        <!-- Camera Badge -->
        <div class="absolute bottom-6 right-6 z-20 pointer-events-none">
             <span class="bg-gray-900/80 backdrop-blur text-white px-3 py-1.5 rounded-lg text-sm font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                  <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                  <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                </svg>
                {{ count($tour->images ?? []) }}
             </span>
        </div>
    </div>

    <!-- Summary Bar -->
    <div class="bg-[#FFF8D6] dark:bg-gray-800 p-8 transition-colors">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <!-- Title Section -->
            <div class="w-full md:w-auto text-center md:text-left">
                <h1 class="text-3xl font-bold text-accent-600 font-display leading-tight">{{ $tour->name }}</h1>
            </div>
            
            <!-- Details Section -->
            <div class="w-full md:w-auto flex flex-wrap items-center justify-center md:justify-end gap-6 sm:gap-8 lg:gap-12 text-gray-800">
                <div class="flex items-start gap-3">
                    <i class="fi fi-rr-calendar-check text-3xl text-accent-500"></i>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white leading-none mb-1">From</p>
                        <p class="font-bold text-lg leading-none dark:text-gray-200">${{ number_format($tour->price, 2) }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-accent-600 flex-shrink-0">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white leading-none mb-1">Duration</p>
                        <p class="font-bold text-lg leading-none dark:text-gray-200">{{ $tour->duration_days }} days</p>
                    </div>
                </div>

                 <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-accent-600 flex-shrink-0">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white leading-none mb-1">Tour Type</p>
                        <p class="font-bold text-lg text-yellow-600 dark:text-yellow-500 leading-none">Private Tour</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                    },
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                on: {
                    init: function () {
                        console.log('Swiper initialized');
                    },
                },
                observer: true,
                observeParents: true,
            });
        });
    </script>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 lg:py-24">
        <div class="lg:grid lg:grid-cols-3 lg:gap-12">
            <!-- Left Column: Content -->
            <div class="lg:col-span-2">
                <div class="prose prose-lg prose-indigo text-gray-600 dark:text-gray-300 max-w-none">
                    <h2 class="font-display text-[24px] text-primary-900 dark:text-white">Overview</h2>
                    <div class="mt-4 text-[14px] text-gray-700 dark:text-gray-300">
                        {!! $tour->description !!}
                    </div>
                
                    @if($tour->included || $tour->excluded)
                        <div class="grid md:grid-cols-2 gap-8 mt-12">
                            @if($tour->included)
                                <div>
                                    <h3 class="font-display text-[18px] text-primary-900 dark:text-white mb-4 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Included
                                    </h3>
                                    <ul class="space-y-3">
                                        @foreach($tour->included as $item)
                                            <li class="flex items-start gap-3 text-[14px]">
                                                <span class="mt-1.5 h-1.5 w-1.5 flex-shrink-0 rounded-full bg-green-500"></span>
                                                <span>{{ is_array($item) ? $item['item'] : $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($tour->excluded)
                                <div>
                                    <h3 class="font-display text-[18px] text-primary-900 dark:text-white mb-4 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Excluded
                                    </h3>
                                    <ul class="space-y-3">
                                         @foreach($tour->excluded as $item)
                                            <li class="flex items-start gap-3 text-[14px]">
                                                <span class="mt-1.5 h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500"></span>
                                                <span>{{ is_array($item) ? $item['item'] : $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif



                    @if($tour->has_price_tiers && $tour->price_tiers)
                        <h2 class="font-display text-[24px] text-primary-900 dark:text-white mt-12 mb-6">Price Tiers</h2>
                        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-12">
                            <table class="w-full text-left text-[14px] text-gray-500 dark:text-gray-400 m-auto">
                                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-bold">Number of People</th>
                                        <th scope="col" class="px-6 py-4 font-bold text-right">Price per Person</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                                    @foreach($tour->price_tiers as $tier)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $tier['min_people'] }}  
                                                @if(isset($tier['max_people']) && $tier['max_people'] > $tier['min_people'])
                                                    - {{ $tier['max_people'] }}
                                                @elseif(isset($tier['max_people']) && $tier['max_people'] == $tier['min_people'])
                                                @else
                                                    +
                                                @endif
                                                People
                                            </td>
                                            <td class="px-6 py-4 text-right font-bold text-blue-600">
                                                ${{ number_format($tier['price_per_person'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif


                    @if($tour->itinerary)
                        <h2 class="font-display text-[24px] text-primary-900 dark:text-white mt-12 mb-6">Itinerary</h2>
                        
                        <div class="space-y-6" x-data="{ activeItems: [0] }">
                            @foreach($tour->itinerary as $index => $day)
                                <div class="bg-white dark:bg-gray-800 rounded-[10px] shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] dark:shadow-none border border-[#e7ebee] dark:border-gray-700 overflow-hidden transition-all duration-300">
                                    <button 
                                        @click="activeItems.includes({{ $index }}) ? activeItems = activeItems.filter(i => i !== {{ $index }}) : activeItems.push({{ $index }})"
                                        class="w-full flex items-center justify-start p-4 md:p-6 text-left focus:outline-none bg-neutral-50 dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                                    >
                                        <!-- Icon container -->
                                        <div class="relative w-[30px] h-[30px] flex items-center justify-center mr-3 md:mr-8 shrink-0 ml-0 md:ml-4 transform scale-75 md:scale-100">
                                            <!-- Horizontal Bar -->
                                            <div class="absolute w-[30px] h-[3px] rounded-[20px] transition-colors duration-300"
                                                 :class="activeItems.includes({{ $index }}) ? 'bg-[#fc5757]' : 'bg-[#1a1039] dark:bg-white'">
                                            </div>
                                            <!-- Vertical Bar -->
                                            <div class="absolute w-[30px] h-[3px] rounded-[20px] bg-[#1a1039] dark:bg-white rotate-90 transition-all duration-300 origin-center"
                                                 :class="activeItems.includes({{ $index }}) ? 'rotate-0 opacity-0' : 'rotate-90 opacity-100'">
                                            </div>
                                        </div>
                                        
                                        <h3 class="text-base md:text-lg font-medium text-[#313131] dark:text-gray-100 flex-1 leading-6">
                                            {{ $day['day_title'] }}
                                        </h3>
                                    </button>
                                    
                                    <div x-show="activeItems.includes({{ $index }})" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 -translate-y-2"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         class="bg-white dark:bg-gray-800"
                                         style="display: none;"
                                    >
                                        <div class="p-4 md:p-8 pt-2 md:pt-2 pl-4 md:pl-[86px] text-[#575757] dark:text-gray-400 text-sm md:text-lg font-normal leading-relaxed prose prose-sm max-w-none">
                                            {!! str_replace('<p><br></p>', '', $day['description']) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif


                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1 mt-12 lg:mt-0 space-y-8">
                    <!-- Tour Information Card -->
                <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-8 shadow-sm">
                    <h3 class="text-2xl font-bold text-blue-600 font-display mb-6 border-l-4 border-blue-600 pl-4">Tour Information</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-2 text-blue-600">
                                <svg style="width: 24px; height: 24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Max Guests</p>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">20</p>
                            </div>
                        </div>

                         <div class="flex items-start gap-4">
                            <div class="p-2 text-blue-600">
                                <svg style="width: 24px; height: 24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Min Age</p>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">+10</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-2 text-blue-600">
                                <svg style="width: 24px; height: 24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Tour Location</p>
                                <p class="text-blue-600 font-medium mt-1">{{ $tour->destination->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-2 text-blue-600">
                                <svg style="width: 24px; height: 24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Languages Support</p>
                                <p class="text-blue-600 font-medium mt-1">English</p>
                            </div>
                        </div>
                    </div>
                </div>
                       <div x-data="{
                    date: '',
                    time: '11:45 am',
                    adults: 1,
                    children: 0,
                    servicePerBooking: false,
                    servicePerPerson: false,
                    name: '',
                    email: '',
                    phone: '',
                    isLoading: false,
                    showSuccess: false,
                    basePrice: {{ $tour->price }},
                    childPrice: {{ $tour->price * 0.5 }}, 
                    serviceBookingPrice: 30,
                    servicePersonPrice: 15,
                    get total() {
                        let t = 0;
                        t += this.adults * this.basePrice;
                        t += this.children * this.childPrice;
                        if (this.servicePerBooking) t += this.serviceBookingPrice;
                        if (this.servicePerPerson) t += this.servicePersonPrice * (this.adults + this.children);
                        return t;
                    },
                    submitBooking() {
                        this.isLoading = true;
                        fetch('{{ route('tours.book', $tour) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                date: this.date,
                                time: this.time,
                                adults: this.adults,
                                children: this.children,
                                service_booking: this.servicePerBooking,
                                service_person: this.servicePerPerson,
                                name: this.name,
                                email: this.email,
                                phone: this.phone
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.showSuccess = true;
                                this.isLoading = false;
                                this.$nextTick(() => {
                                    this.$el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                });
                            } else {
                                alert('Something went wrong. Please try again.');
                                this.isLoading = false;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Something went wrong. Please try again.');
                            this.isLoading = false;
                        });
                    }
                }" class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 sm:p-8 shadow-sm font-sans relative overflow-hidden lg:sticky lg:top-[160px]">
                    
                    <!-- Success Message Overlay -->
                    <div x-show="showSuccess" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-90"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-white/80 backdrop-blur-sm p-6 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                            <i class="fi fi-rr-check text-2xl text-green-600"></i>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Booking Received!</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-xs mx-auto">Thank you for booking with us. We will contact you shortly to confirm your details.</p>
                        <button @click="showSuccess = false; name=''; email=''; phone=''; date=''" class="bg-white border-2 border-green-600 text-green-700 font-bold py-2 px-6 rounded-full hover:bg-green-50 transition transform hover:-translate-y-0.5">
                            Book Another Tour
                        </button>
                    </div>

                    <!-- Main Form Content -->
                    <div :class="{ 'blur-sm grayscale opacity-50 pointer-events-none transition duration-500': showSuccess }">
                        <!-- Header -->
                        <div class="flex items-center gap-3 mb-6 sm:mb-8">
                             <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
                             <h3 class="text-2xl font-bold text-blue-600 font-display">Booking Tour</h3>
                        </div>
                        
                        <!-- Form Content -->
                        <form @submit.prevent="submitBooking">
                            <!-- Date -->
                            <div class="mb-6">
                                <label class="block text-base font-bold text-gray-900 dark:text-white mb-2">From:</label>
                                <div class="relative">
                                     <input type="text" x-model="date" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 pl-10 focus:border-blue-500 focus:ring-blue-500 py-3 font-medium text-gray-700 dark:text-white dark:bg-gray-900 dark:placeholder-gray-400" placeholder="Select Date" id="booking-date">
                                     <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                         <i class="fi fi-rr-calendar text-blue-600 text-lg"></i>
                                     </div>
                                </div>
                            </div>
                            
                            <div x-show="date" x-transition.opacity.duration.500ms>
                                <!-- Time -->
                                <div class="mb-6">
                                     <label class="block text-base font-bold text-gray-900 dark:text-white mb-3">Time:</label>
                                     <div class="flex flex-wrap gap-4">
                                         <label class="flex items-center gap-2 cursor-pointer group">
                                             <div class="relative flex items-center">
                                                <input type="radio" name="time" value="11:45 am" x-model="time" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-gray-300 dark:border-gray-600 text-blue-600 transition-all checked:border-blue-600 checked:bg-blue-600 hover:border-blue-400">
                                                <div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100">
                                                    <svg class="h-3 w-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                </div>
                                             </div>
                                             <span class="text-gray-700 dark:text-gray-300 font-bold group-hover:text-blue-600 transition">11:45 am</span>
                                         </label>
                                         <label class="flex items-center gap-2 cursor-pointer group">
                                             <div class="relative flex items-center">
                                                <input type="radio" name="time" value="12:05 pm" x-model="time" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-gray-300 dark:border-gray-600 text-blue-600 transition-all checked:border-blue-600 checked:bg-blue-600 hover:border-blue-400">
                                                <div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100">
                                                    <svg class="h-3 w-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                </div>
                                             </div>
                                             <span class="text-gray-700 dark:text-gray-300 font-bold group-hover:text-blue-600 transition">12:05 pm</span>
                                         </label>
                                     </div>
                                </div>
                                
                                <div class="h-px bg-gray-100 my-6"></div>

                                <!-- Tickets -->
                                <div class="mb-6">
                                    <label class="block text-base font-bold text-gray-900 dark:text-white mb-4">Tickets:</label>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                         <span class="text-gray-500 dark:text-gray-400 font-medium">Adult <span class="text-blue-600 font-bold ml-1">${{ number_format($tour->price, 2) }}</span></span>
                                         <div class="relative">
                                             <select x-model="adults" class="block w-20 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-2 pl-3 pr-8 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm font-bold text-gray-700">
                                                 @for($i=1; $i<=10; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                             </select>
                                         </div>
                                    </div>
                                    
                                     <div class="flex items-center justify-between">
                                         <span class="text-gray-500 dark:text-gray-400 font-medium">Child <span class="text-blue-600 font-bold ml-1">${{ number_format($tour->price * 0.5, 2) }}</span></span>
                                         <div class="relative">
                                             <select x-model="children" class="block w-20 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-2 pl-3 pr-8 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm font-bold text-gray-700">
                                                  @for($i=0; $i<=10; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                             </select>
                                         </div>
                                    </div>
                                </div>
                                
                                <div class="h-px bg-gray-100 my-6"></div>
                                
                                <!-- Add Extra -->
                                <div class="mb-6">
                                    <label class="block text-base font-bold text-gray-900 dark:text-white mb-4">Add Extra</label>
                                    
                                    <label class="flex items-center justify-between cursor-pointer mb-3 group">
                                         <div class="flex items-center gap-3">
                                            <div class="relative flex items-center">
                                             <input type="checkbox" x-model="servicePerBooking" class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-blue-600 transition-all checked:border-blue-600 checked:bg-blue-600 hover:border-blue-400">
                                             <div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100">
                                                <svg class="h-3.5 w-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            </div>
                                             <span class="text-blue-600 font-medium group-hover:text-blue-700 transition">Service per booking</span>
                                         </div>
                                         <span class="font-bold text-gray-900 dark:text-white">$30.00</span>
                                    </label>
                                    
                                    <label class="flex items-center justify-between cursor-pointer group">
                                         <div class="flex items-center gap-3">
                                            <div class="relative flex items-center">
                                             <input type="checkbox" x-model="servicePerPerson" class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-blue-600 transition-all checked:border-blue-600 checked:bg-blue-600 hover:border-blue-400">
                                             <div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100">
                                                <svg class="h-3.5 w-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            </div>
                                             <span class="text-blue-600 font-medium group-hover:text-blue-700 transition">Service per person</span>
                                         </div>
                                         <span class="font-bold text-gray-900 dark:text-white">$15.00</span>
                                    </label>
                                </div>
                                
                                <div class="h-px bg-gray-100 my-6"></div>

                                <!-- Client Details -->
                                <div class="mb-6 space-y-4">
                                     <label class="block text-base font-bold text-gray-900 dark:text-white">Your Details</label>
                                     <input type="text" x-model="name" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-3 px-4 focus:border-blue-500 focus:ring-blue-500 text-sm placeholder-gray-400 dark:placeholder-gray-500" placeholder="Full Name">
                                     <input type="email" x-model="email" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-3 px-4 focus:border-blue-500 focus:ring-blue-500 text-sm placeholder-gray-400 dark:placeholder-gray-500" placeholder="Email Address">
                                     <input type="tel" x-model="phone" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-3 px-4 focus:border-blue-500 focus:ring-blue-500 text-sm placeholder-gray-400 dark:placeholder-gray-500" placeholder="Phone Number">
                                </div>
                                
                                <div class="h-px bg-gray-100 my-6"></div>
                                
                                <!-- Total -->
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">Total:</span>
                                    <span class="text-3xl font-bold text-blue-600" x-text="'$' + total.toFixed(2)"></span>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" :disabled="isLoading || !date" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg shadow-xl shadow-blue-600/20 transition flex items-center justify-center gap-2 text-lg transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                                 <span x-show="!isLoading" class="flex items-center gap-2">
                                    <i class="fi fi-rr-shopping-cart"></i>
                                    BOOK NOW
                                 </span>
                                 <span x-show="isLoading" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                 </span>
                            </button>
                        </form>
                    </div>
                </div>

                @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        
                        flatpickr("#booking-date", {
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "d/m/Y",
                            minDate: tomorrow, // Booking typically starts tomorrow
                            disableMobile: "true",
                            onChange: function(selectedDates, dateStr, instance) {
                                document.getElementById('booking-date').dispatchEvent(new Event('input'));
                            }
                        });
                    });
                </script>
                @endpush
            

         
            </div>
        </div>
    </div>
</x-layouts.app>
