<x-layouts.app>


    @php
        $heroImages = $tour->images ?? [];
        
        if (empty($heroImages)) {
             for($i=0; $i<5; $i++) $heroImages[] = 'placeholder';
        }
        $heroImages = array_slice($heroImages, 0, 5);
        
        $galleryData = array_map(function($img) {
            $url = $img === 'placeholder' 
                ? 'https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?auto=format&fit=crop&w=2000&q=80' 
                : Storage::url($img);
            
            $isVideo = false;
            if ($img !== 'placeholder') {
                $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov']);
            }
            
            return [
                'url' => $url,
                'isVideo' => $isVideo
            ];
        }, $heroImages);
    @endphp

    <div x-data="{ 
        lightboxOpen: false, 
        activeImageIndex: 0, 
        galleryData: {{ json_encode($galleryData) }},
        openLightbox(index) {
            this.activeImageIndex = index;
            this.lightboxOpen = true;
            document.body.style.overflow = 'hidden';
            if (this.galleryData[index].isVideo) {
                this.$nextTick(() => {
                    const video = this.$refs.lightboxVideo;
                    if (video) video.play();
                });
            }
        },
        closeLightbox() {
            if (this.galleryData[this.activeImageIndex].isVideo) {
                const video = this.$refs.lightboxVideo;
                if (video) video.pause();
            }
            this.lightboxOpen = false;
            document.body.style.overflow = 'auto';
        },
        nextImage() {
            if (this.galleryData[this.activeImageIndex].isVideo) {
                const video = this.$refs.lightboxVideo;
                if (video) video.pause();
            }
            this.activeImageIndex = (this.activeImageIndex + 1) % this.galleryData.length;
            if (this.galleryData[this.activeImageIndex].isVideo) {
                this.$nextTick(() => {
                    const video = this.$refs.lightboxVideo;
                    if (video) video.play();
                });
            }
        },
        prevImage() {
            if (this.galleryData[this.activeImageIndex].isVideo) {
                const video = this.$refs.lightboxVideo;
                if (video) video.pause();
            }
            this.activeImageIndex = (this.activeImageIndex - 1 + this.galleryData.length) % this.galleryData.length;
            if (this.galleryData[this.activeImageIndex].isVideo) {
                this.$nextTick(() => {
                    const video = this.$refs.lightboxVideo;
                    if (video) video.play();
                });
            }
        }
    }" @keydown.escape.window="closeLightbox()" @keydown.left.window="prevImage()" @keydown.right.window="nextImage()">

    <!-- Hero Grid Gallery Section -->
    <div class="relative w-full bg-gray-50 dark:bg-gray-900 pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 h-[250px] lg:h-[400px]">
                <!-- Main Large Image (Left) -->
                <div @click="openLightbox(0)" class="lg:col-span-2 relative rounded-2xl overflow-hidden group cursor-pointer h-full">
                    @if($galleryData[0]['url'] === 'placeholder' || !$galleryData[0]['isVideo'])
                        <img src="{{ $galleryData[0]['url'] }}" 
                             class="h-full w-full object-cover transform transition-transform duration-700 group-hover:scale-110" 
                             alt="Tour main image">
                    @else
                        <video src="{{ $galleryData[0]['url'] }}" 
                               muted autoplay loop playsinline
                               class="h-full w-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                        </video>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        @if($galleryData[0]['isVideo'])
                            <div class="w-16 h-16 bg-white/30 backdrop-blur-md rounded-full flex items-center justify-center text-white border border-white/50">
                                <i class="fi fi-ss-play text-2xl ml-1"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Gallery & Video Buttons (Bottom Left) -->
                    <div class="absolute bottom-4 left-4 flex gap-2 z-10">
                        <button @click.stop="openLightbox(0)" class="flex items-center gap-2 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-4 py-2.5 rounded-xl text-sm font-bold text-gray-900 dark:text-white hover:bg-white dark:hover:bg-gray-800 transition-all shadow-lg border border-gray-200/50 dark:border-gray-700/50">
                            <i class="fi fi-rr-picture text-blue-600"></i>
                            <span>{{ __('Gallery') }}</span>
                        </button>
                        @php
                            $firstVideoIndex = array_search(true, array_column($galleryData, 'isVideo'));
                        @endphp
                        @if($firstVideoIndex !== false)
                            <button @click.stop="openLightbox({{ $firstVideoIndex }})" class="flex items-center gap-2 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-4 py-2.5 rounded-xl text-sm font-bold text-gray-900 dark:text-white hover:bg-white dark:hover:bg-gray-800 transition-all shadow-lg border border-gray-200/50 dark:border-gray-700/50">
                                <i class="fi fi-rr-video-camera text-red-600"></i>
                                <span>{{ __('Video') }}</span>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Right Grid (4 smaller images in 2x2) - Hidden on Mobile -->
                <div class="hidden lg:grid grid-cols-2 grid-rows-2 gap-3">
                    @for($i = 1; $i <= 4; $i++)
                        <div @click="openLightbox({{ $i }})" class="relative rounded-2xl overflow-hidden group cursor-pointer">
                            @if(isset($galleryData[$i]))
                                @if($galleryData[$i]['isVideo'])
                                    <video src="{{ $galleryData[$i]['url'] }}" 
                                           muted autoplay loop playsinline
                                           class="h-full w-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                    </video>
                                @else
                                    <img src="{{ $galleryData[$i]['url'] }}" 
                                         class="h-full w-full object-cover transform transition-transform duration-700 group-hover:scale-110" 
                                         alt="Tour image {{ $i }}">
                                @endif
                            @else
                                <img src="https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?auto=format&fit=crop&w=800&q=80" 
                                     class="h-full w-full object-cover transform transition-transform duration-700 group-hover:scale-110" 
                                     alt="Tour image {{ $i }}">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                @if(isset($galleryData[$i]) && $galleryData[$i]['isVideo'])
                                    <div class="w-10 h-10 bg-white/30 backdrop-blur-md rounded-full flex items-center justify-center text-white border border-white/50">
                                        <i class="fi fi-ss-play text-sm ml-0.5"></i>
                                    </div>
                                @endif
                            </div>
                            
                            @if($i === 4 && count($tour->images ?? []) > 5)
                                <!-- Show More Overlay on last image -->
                                <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <p class="text-3xl font-black mb-1">+{{ count($tour->images ?? []) - 5 }}</p>
                                        <p class="text-sm font-bold uppercase tracking-wider">{{ __('Photos') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Mobile Slider - Visible only on Mobile -->
            <div class="mt-3 lg:hidden">
                <div class="swiper mobileGallerySwiper h-[100px]">
                    <div class="swiper-wrapper">
                        @foreach($galleryData as $index => $item)
                            @if($index > 0)
                                <div class="swiper-slide !w-[100px] h-full" @click="openLightbox({{ $index }})">
                                    <div class="relative w-full h-full rounded-xl overflow-hidden">
                                        @if($item['isVideo'])
                                            <video src="{{ $item['url'] }}" muted class="w-full h-full object-cover"></video>
                                            <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                                <i class="fi fi-ss-play text-white text-xs"></i>
                                            </div>
                                        @else
                                            <img src="{{ $item['url'] }}" class="w-full h-full object-cover" alt="Gallery thumbnail">
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Lightbox Overlay -->
    <div x-show="lightboxOpen" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex flex-col bg-gray-950/98 backdrop-blur-xl"
         style="display: none;"
         @click.self="closeLightbox()">
        
        <!-- Top Bar: Title & Close -->
        <div class="absolute top-0 left-0 right-0 p-6 flex items-center justify-between z-[110] bg-gradient-to-b from-black/60 to-transparent">
            <div class="flex items-center gap-4">
                <div class="h-10 w-1px bg-accent-500 hidden sm:block"></div>
                <div>
                    <h3 class="text-white font-display font-bold text-lg sm:text-xl tracking-tight leading-none">{{ $tour->display_name }}</h3>
                    <p class="text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black mt-1">{{ __('Exclusive Gallery') }}</p>
                </div>
            </div>
            <button @click="closeLightbox()" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all border border-white/10 group backdrop-blur-md">
                <i class="fi fi-rr-cross-small text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
            </button>
        </div>

         <!-- Main Content Holder -->
        <div class="relative flex-1 flex items-center justify-center p-4 sm:p-12" @click.self="closeLightbox()">
            <!-- Media Content -->
            <div class="relative max-w-7xl max-h-full flex items-center justify-center" @click.stop>
                <template x-if="!galleryData[activeImageIndex].isVideo">
                    <img :src="galleryData[activeImageIndex].url" 
                         class="max-w-full max-h-[70vh] object-contain rounded-2xl shadow-[0_0_80px_rgba(0,0,0,0.5)] border border-white/5"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="scale-90 opacity-0"
                         x-transition:enter-end="scale-100 opacity-100">
                </template>
                <template x-if="galleryData[activeImageIndex].isVideo">
                    <video x-ref="lightboxVideo" 
                           :src="galleryData[activeImageIndex].url" 
                           controls 
                           class="max-w-full max-h-[70vh] rounded-2xl shadow-[0_0_80px_rgba(0,0,0,0.5)] border border-white/5"
                           x-transition:enter="transition ease-out duration-500"
                           x-transition:enter-start="scale-90 opacity-0"
                           x-transition:enter-end="scale-100 opacity-100"></video>
                </template>
            </div>
            
            <!-- Navigation Arrows - Always visible and RTL-aware -->
            <button @click="prevImage()" class="fixed start-4 sm:start-10 top-1/2 -translate-y-1/2 w-14 h-14 flex items-center justify-center rounded-full bg-accent-500 text-white transition-all z-[150] backdrop-blur-md border border-white/30 group shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ app()->getLocale() == 'ar' ? 'M9 5l7 7-7 7' : 'M15 19l-7-7 7-7' }}" />
                </svg>
            </button>
            <button @click="nextImage()" class="fixed end-4 sm:end-10 top-1/2 -translate-y-1/2 w-14 h-14 flex items-center justify-center rounded-full bg-accent-500 text-white transition-all z-[150] backdrop-blur-md border border-white/30 group shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ app()->getLocale() == 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}" />
                </svg>
            </button>
        </div>

         <!-- Bottom Thumbnails Strip -->
        <div class="w-full bg-gradient-to-t from-black/60 to-transparent p-6 pb-10 z-[110]" @click.self="closeLightbox()">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-center gap-3 overflow-x-auto pb-4 scrollbar-hide no-scrollbar">
                    <template x-for="(item, index) in galleryData" :key="index">
                        <button @click="activeImageIndex = index" 
                                class="relative flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden border-2 transition-all duration-300"
                                :class="activeImageIndex === index ? 'border-accent-500 scale-110 shadow-[0_0_20px_rgba(var(--accent-500-rgb),0.4)]' : 'border-transparent opacity-40 hover:opacity-100'">
                            <img :src="item.url" class="w-full h-full object-cover">
                            <div x-show="item.isVideo" class="absolute inset-0 flex items-center justify-center bg-black/40">
                                <i class="fi fi-ss-play text-white text-[10px]"></i>
                            </div>
                        </button>
                    </template>
                </div>
                
                <!-- Index Counter with Progress bar -->
                <div class="flex flex-col items-center gap-3 mt-4">
                    <div class="w-48 h-1 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-accent-500 transition-all duration-500" 
                             :style="`width: ${((activeImageIndex + 1) / galleryData.length) * 100}%`"></div
                    </div>
                    <div class="text-white/60 text-[10px] font-black uppercase tracking-[0.2em]">
                        <span x-text="activeImageIndex + 1" class="text-white"></span> / <span x-text="galleryData.length"></span> {{ __('Items') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Redesigned Summary Bar -->
    <section class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 relative z-30 overflow-hidden">
        <!-- Decorative background subtle gradients -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-50 dark:bg-blue-900/10 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-accent-50 dark:bg-accent-900/10 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10 lg:py-14 relative">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-16">
                
                <!-- Title Section -->
                <div class="flex-1 max-lg:text-center lg:text-start space-y-4">
           
                    <h1 class="text-4xl lg:text-4xl font-black text-gray-900 dark:text-white font-display leading-[1.05] tracking-tight">
                        {{ $tour->display_name }}
                    </h1>
                </div>
                
                <!-- Premium Metrics Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6 w-full lg:w-auto">
                    
                    <!-- Price Stats -->
                    <div class="group bg-gray-50/50 dark:bg-gray-800/40 hover:bg-white dark:hover:bg-gray-800 p-6 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 transition-all duration-500 shadow-sm hover:shadow-2xl hover:-translate-y-1 border-b-4 border-b-transparent hover:border-b-blue-600">
                        <div class="flex items-center gap-5">
                             <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-500">
                                <i class="fi fi-rr-usd-circle text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">{{ __('Price From') }}</p>
                                @if($tour->sale_price)
                                    <div class="flex flex-col">
                                        <p class="text-2xl font-black text-gray-900 dark:text-white leading-none">${{ number_format($tour->sale_price) }}</p>
                                        <p class="text-xs font-bold text-gray-400 line-through mt-1">${{ number_format($tour->price) }}</p>
                                    </div>
                                @else
                                    <p class="text-2xl font-black text-gray-900 dark:text-white leading-none">${{ number_format($tour->price) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Duration Stats -->
                    <div class="group bg-gray-50/50 dark:bg-gray-800/40 hover:bg-white dark:hover:bg-gray-800 p-6 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 transition-all duration-500 shadow-sm hover:shadow-2xl hover:-translate-y-1 border-b-4 border-b-transparent hover:border-b-amber-500">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform duration-500">
                                <i class="fi fi-rr-clock text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">{{ __('Duration') }}</p>
                                <p class="text-2xl font-black text-gray-900 dark:text-white leading-none">
                                    {{ $tour->duration_days }} <span class="text-xs font-bold text-gray-400 lowercase">{{ __('Days') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Location Stats -->
                    <div class="group bg-gray-50/50 dark:bg-gray-800/40 hover:bg-white dark:hover:bg-gray-800 p-6 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 transition-all duration-500 shadow-sm hover:shadow-2xl hover:-translate-y-1 border-b-4 border-b-transparent hover:border-b-emerald-500">
                        <div class="flex items-center gap-5">
                             <div class="w-14 h-14 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-500">
                                <i class="fi fi-rr-marker text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">{{ __('Tour Location') }}</p>
                                <div class="flex items-center gap-1 text-xl font-black text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $tour->destination ? $tour->destination->display_name : __('Egypt') }}
                                    <i class="fi {{ app()->getLocale() == 'ar' ? 'fi-rr-arrow-small-left' : 'fi-rr-arrow-small-right' }} text-gray-300 text-sm group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

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
                <div class="mb-12">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-[#F0FAFF] dark:bg-blue-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center gap-3">
                            <span class="p-2 bg-blue-500 rounded-lg shadow-lg shadow-blue-500/20 h-[39px]">
                                <i class="fi fi-rr-paper-plane text-white text-lg"></i>
                            </span>
                            <h2 class="font-display text-xl font-bold text-[#1a1039] dark:text-white m-0">{{ __('Tour Details') }}</h2>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            <!-- Duration -->
                            <div class="flex items-center justify-between px-6 py-4 group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center">
                                        <i class="fi fi-rr-hourglass-end text-orange-500"></i>
                                    </div>
                                    <span class="text-[#313131] dark:text-gray-200 font-medium">{{ __('Duration') }}</span>
                                </div>
                                <span class="text-[#575757] dark:text-gray-400 font-bold">
                                    {{ $tour->duration_days }} {{ __('Days') }} / {{ $tour->duration_nights ?? ($tour->duration_days - 1) }} {{ __('Nights') }}
                                </span>
                            </div>

                            <!-- Tour Location -->
                            <div class="flex items-center justify-between px-6 py-4 bg-[#F0FAFF]/30 dark:bg-blue-900/5 group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-center gap-4">
                                     <div class="w-10 h-10 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                                        <i class="fi fi-rr-map-marker text-green-500"></i>
                                    </div>
                                    <span class="text-[#313131] dark:text-gray-200 font-medium">{{ __('Tour Location') }}</span>
                                </div>
                                <span class="text-[#575757] dark:text-gray-400 font-bold">{{ $tour->destination->display_name }}</span>
                            </div>

                            <!-- Tour Availability -->
                            <div class="flex items-center justify-between px-6 py-4 group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-center gap-4">
                                     <div class="w-10 h-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center">
                                        <i class="fi fi-rr-calendar text-red-500"></i>
                                    </div>
                                    <span class="text-[#313131] dark:text-gray-200 font-medium">{{ __('Tour Availability') }}</span>
                                </div>
                                <span class="text-[#575757] dark:text-gray-400 font-bold">{{ $tour->display_availability ?: __('Everyday') }}</span>
                            </div>

                            <!-- Pickup & Drop Off -->
                            <div class="flex items-center justify-between px-6 py-4 bg-[#F0FAFF]/30 dark:bg-blue-900/5 group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-center gap-4">
                                     <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                                        <i class="fi fi-rr-marker text-blue-500"></i>
                                    </div>
                                    <span class="text-[#313131] dark:text-gray-200 font-medium">{{ __('Pickup & Drop Off') }}</span>
                                </div>
                                <span class="text-[#575757] dark:text-gray-400 font-bold">{{ $tour->display_pickup_location ?: __('Cairo Airport') }}</span>
                            </div>

                             <!-- Tour Type -->
                             <div class="flex items-center justify-between px-6 py-4 group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                 <div class="flex items-center gap-4">
                                      <div class="w-10 h-10 rounded-full bg-sky-50 dark:bg-sky-900/20 flex items-center justify-center">
                                         <i class="fi fi-rr-plane-alt text-sky-500"></i>
                                     </div>
                                     <span class="text-[#313131] dark:text-gray-200 font-medium">{{ __('Tour Categories') }}</span>
                                 </div>
                                 <div class="flex flex-wrap justify-end gap-2">
                                     @forelse($tour->categories as $category)
                                         <span class="px-3 py-1 bg-sky-100 dark:bg-sky-900/40 text-sky-700 dark:text-sky-300 text-xs font-bold rounded-full">
                                             {{ $category->display_name }}
                                         </span>
                                     @empty
                                         <span class="text-[#575757] dark:text-gray-400 font-bold">{{ $tour->tour_type ?? 'General Tour' }}</span>
                                     @endforelse
                                 </div>
                             </div>
                        </div>

                        <!-- Tour Overview (Merged) -->
                        @if($tour->description)
                            <div class="px-6 py-8 border-t border-gray-100 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-800/50">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                    <i class="fi fi-rr-info text-blue-500 text-sm"></i> {{ __('Tour Overview') }}
                                </h3>
                                <div class="text-gray-600 dark:text-gray-300 leading-relaxed text-[15px] prose prose-sm dark:prose-invert max-w-none">
                                    {!! $tour->display_description !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-10">
                    <!-- Included / Excluded Section -->
                    @if($tour->included || $tour->excluded)
                        <section>
                            <h2 class="font-display text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                                {{ __('What\'s Included') }}
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                @if($tour->included)
                                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col">
                                        <div class="px-6 py-4 border-b border-gray-50 dark:border-gray-700">
                                            <h3 class="text-sm font-bold text-gray-800 dark:text-white m-0 flex items-center gap-2">
                                                <i class="fi fi-rr-check-circle text-green-500"></i> {{ __('Included') }}
                                            </h3>
                                        </div>
                                        <div class="p-6 flex-1">
                                            <ul class="space-y-3">
                                                @foreach($tour->included as $item)
                                                    @php
                                                        $includedItem = (app()->getLocale() === 'ar' && isset($item['item_ar']) && $item['item_ar']) ? $item['item_ar'] : (is_array($item) ? $item['item'] : $item);
                                                    @endphp
                                                    <li class="flex items-start gap-3 group">
                                                        <i class="fi fi-rr-check text-green-500/70 mt-1 text-[10px]"></i>
                                                        <span class="text-gray-600 dark:text-gray-400 text-[14px] leading-relaxed">{{ $includedItem }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if($tour->excluded)
                                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col">
                                        <div class="px-6 py-4 border-b border-gray-50 dark:border-gray-700">
                                            <h3 class="text-sm font-bold text-gray-800 dark:text-white m-0 flex items-center gap-2">
                                                <i class="fi fi-rr-cross-circle text-red-500"></i> {{ __('Excluded') }}
                                            </h3>
                                        </div>
                                        <div class="p-6 flex-1">
                                            <ul class="space-y-3">
                                                @foreach($tour->excluded as $item)
                                                    @php
                                                        $excludedItem = (app()->getLocale() === 'ar' && isset($item['item_ar']) && $item['item_ar']) ? $item['item_ar'] : (is_array($item) ? $item['item'] : $item);
                                                    @endphp
                                                    <li class="flex items-start gap-3 group">
                                                        <i class="fi fi-rr-cross text-red-500/70 mt-1 text-[10px]"></i>
                                                        <span class="text-gray-600 dark:text-gray-400 text-[14px] leading-relaxed">{{ $excludedItem }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endif



                    <!-- Pricing Section -->
                    @if($tour->has_price_tiers || $tour->has_seasonal_prices)
                        <section class="mt-12">
                            <h2 class="font-display text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                                {{ $tour->has_price_tiers ? __('Group Discount Rates') : __('Seasonal Price Variations') }}
                            </h2>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                                {{-- Group Discount Tiers (Table View) --}}
                                @if($tour->has_price_tiers && $tour->price_tiers)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead>
                                                <tr class="bg-[#F0FAFF] dark:bg-blue-900/10">
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider border-r border-gray-100 dark:border-gray-700 last:border-0">{{ __('Number of Guests') }}</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider border-r border-gray-100 dark:border-gray-700 last:border-0">{{ __('Adult Price') }}</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider">{{ __('Child Price') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                                {{-- Solo Row --}}
                                                @if($tour->solo_price)
                                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-50 dark:border-gray-700 last:border-0">
                                                            <div class="flex items-center gap-3 text-gray-900 dark:text-white font-bold">
                                                                <i class="fi fi-rr-user text-blue-500/50"></i>
                                                                <span>{{ __('Solo Traveler') }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-50 dark:border-gray-700 last:border-0">
                                                            <span class="text-lg font-black text-gray-900 dark:text-white">${{ number_format($tour->solo_price) }}</span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400">${{ $tour->child_solo_price ? number_format($tour->child_solo_price) : '-' }}</span>
                                                        </td>
                                                    </tr>
                                                @endif

                                                {{-- Tier Rows --}}
                                                @foreach($tour->price_tiers as $tier)
                                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-50 dark:border-gray-700 last:border-0">
                                                            <div class="flex items-center gap-3 text-gray-600 dark:text-gray-300 font-medium">
                                                                <i class="fi fi-rr-users text-gray-400"></i>
                                                                <span>{{ $tier['min_people'] }}{{ (isset($tier['max_people']) && $tier['max_people'] > $tier['min_people']) ? '-' . $tier['max_people'] : '+' }} {{ __('Persons') }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-50 dark:border-gray-700 last:border-0">
                                                            <span class="text-lg font-black text-gray-900 dark:text-white">${{ number_format($tier['price_per_person']) }}</span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                                                ${{ isset($tier['child_price_per_person']) ? number_format($tier['child_price_per_person']) : number_format($tier['price_per_person'] * 0.5) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                {{-- Seasonal Variations (Card Grid View) --}}
                                @if($tour->has_seasonal_prices && $tour->seasonal_prices)
                                    <div class="p-6 sm:p-8">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                            @foreach($tour->seasonal_prices as $season)
                                                <div class="bg-gray-50/50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-700 p-5 group hover:border-orange-500 hover:bg-white dark:hover:bg-gray-900 transition-all duration-300 shadow-sm hover:shadow-md">
                                                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100 dark:border-gray-800">
                                                        <div class="flex items-center gap-2">
                                                            <div class="w-8 h-8 rounded-lg bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center">
                                                                <i class="fi fi-rr-calendar-star text-orange-600 text-sm"></i>
                                                            </div>
                                                            <span class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $season['name'] }}</span>
                                                        </div>
                                                        <span class="text-[10px] font-black text-orange-600/60 uppercase tracking-widest">{{ __('Season') }}</span>
                                                    </div>
                                                    
                                                    <div class="space-y-4">
                                                        <div class="flex justify-between items-end bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-50 dark:border-gray-700 shadow-sm">
                                                            <div class="text-left">
                                                                <p class="text-[9px] font-bold text-gray-400 dark:text-gray-500 uppercase flex items-center gap-1"><i class="fi fi-rr-user"></i> {{ __('Solo Adult') }}</p>
                                                                <h4 class="text-xl font-black text-gray-900 dark:text-white">${{ number_format($season['solo_price'] ?? $tour->solo_price) }}</h4>
                                                            </div>
                                                            <div class="text-right">
                                                                <p class="text-[9px] font-bold text-gray-400 dark:text-gray-500 uppercase flex items-center justify-end gap-1"><i class="fi fi-rr-child-head"></i> {{ __('Solo Child') }}</p>
                                                                <h4 class="text-lg font-black text-orange-600 dark:text-orange-400">${{ number_format($season['child_solo_price'] ?? $tour->child_solo_price) }}</h4>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="bg-blue-600/5 dark:bg-blue-400/5 px-4 py-2 rounded-lg flex items-center justify-center gap-3 text-gray-500 dark:text-gray-400">
                                                            <i class="fi fi-rr-calendar-check text-xs"></i>
                                                            <span class="text-[11px] font-bold uppercase tracking-widest">
                                                                {{ \Carbon\Carbon::parse($season['start_date'])->format('d M') }} - {{ \Carbon\Carbon::parse($season['end_date'])->format('d M') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endif


                    <!-- Itinerary Section -->
                    @if($tour->itinerary)
                        <section>
                            <h2 class="font-display text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                                {{ __('Daily Itinerary') }}
                            </h2>
                            <div class="space-y-4" x-data="{ activeItems: [0] }">
                                @foreach($tour->itinerary as $index => $day)
                                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition-all duration-300">
                                        <button 
                                            @click="activeItems.includes({{ $index }}) ? activeItems = activeItems.filter(i => i !== {{ $index }}) : activeItems.push({{ $index }})"
                                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors"
                                        >
                                            <div class="flex items-center gap-4">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs transition-colors"
                                                     :class="activeItems.includes({{ $index }}) ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600 dark:bg-blue-900/20'">
                                                    {{ $index + 1 }}
                                                </div>
                                                <h3 class="text-base font-bold text-gray-800 dark:text-gray-100 leading-tight">
                                                    {{ (app()->getLocale() === 'ar' && isset($day['day_title_ar']) && $day['day_title_ar']) ? $day['day_title_ar'] : $day['day_title'] }}
                                                </h3>
                                            </div>
                                            <i class="fi fi-rr-angle-small-down transform transition-transform duration-300 text-lg text-gray-400"
                                               :class="activeItems.includes({{ $index }}) ? 'rotate-180 text-blue-600' : ''"></i>
                                        </button>
                                        
                                        <div x-show="activeItems.includes({{ $index }})" 
                                             x-collapse
                                             class="bg-white dark:bg-gray-800"
                                        >
                                            <div class="px-5 pb-6 pt-0 ml-[52px] text-gray-600 dark:text-gray-400 text-sm leading-relaxed border-l border-gray-100 dark:border-gray-700">
                                                <div class="prose prose-sm dark:prose-invert max-w-none">
                                                    {!! str_replace('<p><br></p>', '', (app()->getLocale() === 'ar' && isset($day['description_ar']) && $day['description_ar']) ? $day['description_ar'] : $day['description']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                    
                    <!-- Map Section -->
                    @if($tour->map_url)
                        <section>
                            <h2 class="font-display text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                                {{ __('Location Map') }}
                            </h2>
                            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden p-3 group">
                                @if(str_contains($tour->map_url, 'google.com/maps') || str_contains($tour->map_url, 'maps.google.com'))
                                    <div class="rounded-xl overflow-hidden relative">
                                        <iframe 
                                            src="{{ $tour->map_url }}" 
                                            width="100%" 
                                            height="400" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy" 
                                            referrerpolicy="no-referrer-when-downgrade"
                                            class="grayscale-[30%] group-hover:grayscale-0 transition-all duration-700"
                                        ></iframe>
                                    </div>
                                @else
                                    <div class="h-[300px] flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 rounded-xl space-y-3">
                                        <i class="fi fi-rr-map-marker text-2xl text-gray-300"></i>
                                        <p class="text-gray-400 text-xs font-medium">{{ __('Map location not available') }}</p>
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endif
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1 mt-12 lg:mt-0 space-y-8">

                <div x-data='{
                    date: "",
                    currentLocale: "{{ app()->getLocale() }}",
                    time: "11:45 am",
                    adults: 1,
                    children: 0,
                    servicePerBooking: false,
                    servicePerPerson: false,
                    extras: {{ json_encode($tour->extras ?? []) }},
                    selectedExtras: [], // Stores indexes of selected extras
                    name: "",
                    email: "",
                    phone: "",
                    isLoading: false,
                    showSuccess: false,
                    hasTiers: {{ $tour->has_price_tiers ? "true" : "false" }},
                    tiers: {{ json_encode($tour->price_tiers ?? []) }},
                    hasSeasonalPrices: {{ $tour->has_seasonal_prices ? "true" : "false" }},
                    seasonalPrices: {{ json_encode($tour->seasonal_prices ?? []) }},
                    defaultPrice: {{ $tour->price }},
                    defaultChildPrice: {{ $tour->child_price ?? "null" }},
                    defaultSoloPrice: {{ $tour->solo_price ?? "null" }},
                    defaultChildSoloPrice: {{ $tour->child_solo_price ?? "null" }},
                    
                    get activeSeason() {
                        if (!this.date || !this.hasSeasonalPrices || this.seasonalPrices.length === 0) {
                            return null;
                        }
                        const selectedDate = new Date(this.date);
                        selectedDate.setHours(0, 0, 0, 0);
                        return this.seasonalPrices.find(s => {
                            const start = new Date(s.start_date);
                            const end = new Date(s.end_date);
                            start.setHours(0, 0, 0, 0);
                            end.setHours(0, 0, 0, 0);
                            return selectedDate >= start && selectedDate <= end;
                        });
                    },

                    get currentPrices() {
                        const adultsCount = parseInt(this.adults) || 0;
                        const childrenCount = parseInt(this.children) || 0;
                        const season = this.activeSeason;
                        const currentTiers = (season && season.tiers && season.tiers.length > 0) ? season.tiers : this.tiers;
                        const sortedTiers = currentTiers.length > 0 ? [...currentTiers].sort((a, b) => parseInt(a.min_people) - parseInt(b.min_people)) : [];

                        let adultPrice = this.defaultPrice;
                        let childPrice = (this.defaultChildPrice ? this.defaultChildPrice : this.defaultPrice * 0.5);

                        // 1. Calculate Adult Price independently
                        if (adultsCount === 1) {
                            adultPrice = (season && season.solo_price) ? parseFloat(season.solo_price) : (this.defaultSoloPrice || this.defaultPrice);
                        } else if (adultsCount > 1 && sortedTiers.length > 0) {
                            let tier = sortedTiers.find(t => adultsCount >= parseInt(t.min_people) && adultsCount <= parseInt(t.max_people));
                            if (!tier) {
                                const highestTier = sortedTiers[sortedTiers.length - 1];
                                tier = (adultsCount > parseInt(highestTier.max_people)) ? highestTier : sortedTiers[0];
                            }
                            adultPrice = parseFloat(tier.price_per_person);
                        }

                        // 2. Calculate Child Price independently
                        if (childrenCount === 1) {
                            childPrice = (season && season.child_solo_price) ? parseFloat(season.child_solo_price) : (this.defaultChildSoloPrice || childPrice);
                        } else if (childrenCount > 1 && sortedTiers.length > 0) {
                            let tier = sortedTiers.find(t => childrenCount >= parseInt(t.min_people) && childrenCount <= parseInt(t.max_people));
                            if (!tier) {
                                const highestTier = sortedTiers[sortedTiers.length - 1];
                                tier = (childrenCount > parseInt(highestTier.max_people)) ? highestTier : sortedTiers[0];
                            }
                            childPrice = tier.child_price_per_person ? parseFloat(tier.child_price_per_person) : parseFloat(tier.price_per_person) * 0.5;
                        }

                        return { adult: adultPrice, child: childPrice };
                    },
                    
                    get total() {
                        const prices = this.currentPrices;
                        let t = 0;
                        t += this.adults * prices.adult;
                        t += this.children * prices.child;
                        
                        // Calculate dynamic extras
                        this.selectedExtras.forEach(idx => {
                            const extra = this.extras[idx];
                            if (extra.type === "per_booking") {
                                t += parseFloat(extra.price);
                            } else {
                                t += parseFloat(extra.price) * (parseInt(this.adults) + parseInt(this.children));
                            }
                        });
                        return t;
                    },
                    submitBooking() {
                        this.isLoading = true;
                        fetch("{{ route('tours.book', $tour) }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                                    this.$el.scrollIntoView({ behavior: "smooth", block: "center" });
                                });
                            } else {
                                alert("Something went wrong. Please try again.");
                                this.isLoading = false;
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("Something went wrong. Please try again.");
                            this.isLoading = false;
                        });
                    }
                }' class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 sm:p-8 shadow-sm font-sans relative lg:sticky lg:top-[160px] max-h-[calc(100vh-180px)] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-200 dark:scrollbar-thumb-gray-700">
                    
                    <!-- Success Message Overlay -->
                    <div x-show="showSuccess" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-90"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-white/80 backdrop-blur-sm p-6 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                            <i class="fi fi-rr-check text-2xl text-green-600"></i>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Booking Received!') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-xs mx-auto">{{ __('Thank you for booking with us. We will contact you shortly to confirm your details.') }}</p>
                        <button @click="showSuccess = false; name=''; email=''; phone=''; date=''" class="bg-white border-2 border-green-600 text-green-700 font-bold py-2 px-6 rounded-full hover:bg-green-50 transition transform hover:-translate-y-0.5">
                            {{ __('Book Another Tour') }}
                        </button>
                    </div>

                    <!-- Main Form Content -->
                    <div :class="{ 'blur-sm grayscale opacity-50 pointer-events-none transition duration-500': showSuccess }">
                        <!-- Header -->
                        <div class="flex items-center gap-3 mb-6 sm:mb-8">
                             <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
                             <h3 class="text-2xl font-bold text-blue-600 font-display">{{ __('Booking Tour') }}</h3>
                        </div>
                        
                        <!-- Form Content -->
                        <form @submit.prevent="submitBooking">
                            <!-- Date -->
                            <div class="mb-6">
                                <label class="block text-base font-bold text-gray-900 dark:text-white mb-2">{{ __('From:') }}</label>
                                <div class="relative">
                                     <input type="text" x-model="date" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 pl-10 focus:border-blue-500 focus:ring-blue-500 py-3 font-medium text-gray-700 dark:text-white dark:bg-gray-900 dark:placeholder-gray-400 rtl:placeholder:text-right" placeholder="{{ __('Select Date') }}" id="booking-date">
                                     <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                         <i class="fi fi-rr-calendar text-blue-600 text-lg"></i>
                                     </div>
                                </div>
                            </div>
                            
                            <div x-show="date" x-transition.opacity.duration.500ms>
                                <!-- Tickets -->
                                <div class="mb-6">
                                    <label class="block text-base font-bold text-gray-900 dark:text-white mb-4">{{ __('Tickets:') }}</label>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                         <span class="text-gray-500 dark:text-gray-400 font-medium">{{ __('Adult') }} 
                                             <span class="text-blue-600 font-bold ml-1" x-text="'$' + currentPrices.adult.toFixed(2)"></span>
                                         </span>
                                         <div class="relative">
                                             <select x-model="adults" class="block w-20 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-2 pl-3 pr-8 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm font-bold text-gray-700">
                                                 @for($i=1; $i<=20; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                             </select>
                                         </div>
                                    </div>
                                    
                                     <div class="flex items-center justify-between">
                                         <span class="text-gray-500 dark:text-gray-400 font-medium">{{ __('Child') }} 
                                             <span class="text-blue-600 font-bold ml-1" x-text="'$' + currentPrices.child.toFixed(2)"></span>
                                         </span>
                                         <div class="relative">
                                             <select x-model="children" class="block w-20 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-2 pl-3 pr-8 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm font-bold text-gray-700">
                                                  @for($i=0; $i<=15; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                             </select>
                                         </div>
                                    </div>
                                </div>
                                
                                <div class="h-px bg-gray-100 my-6"></div>
                                
                                <!-- Add Extra -->
                                <template x-if="extras.length > 0">
                                    <div class="mb-6">
                                        <label class="block text-base font-bold text-gray-900 dark:text-white mb-4 uppercase tracking-tighter flex items-center gap-2">
                                            <i class="fi fi-rr-plus-small text-blue-600"></i>
                                            {{ __('Enhance Your Trip') }}
                                        </label>
                                        
                                        <div class="space-y-3">
                                            <template x-for="(extra, index) in extras" :key="index">
                                                <label class="flex items-center justify-between cursor-pointer group bg-gray-50 dark:bg-gray-900/50 p-3 rounded-xl border border-transparent hover:border-blue-500/30 transition-all">
                                                     <div class="flex items-center gap-3">
                                                        <div class="relative flex items-center">
                                                            <input type="checkbox" :value="index" x-model="selectedExtras" class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-blue-600 transition-all checked:border-blue-600 checked:bg-blue-600 hover:border-blue-400">
                                                            <div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100">
                                                                <svg class="h-3.5 w-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span class="text-blue-600 font-bold group-hover:text-blue-700 transition block text-sm" x-text="currentLocale === 'ar' && extra.name_ar ? extra.name_ar : extra.name"></span>
                                                            <span class="text-[10px] text-gray-400 dark:text-gray-500 uppercase font-bold" x-text="extra.type === 'per_person' ? '{{ __('Per Person') }}' : '{{ __('Per Booking') }}'"></span>
                                                        </div>
                                                     </div>
                                                     <span class="font-black text-gray-900 dark:text-white" x-text="'$' + parseFloat(extra.price).toFixed(2)"></span>
                                                </label>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                                
                                <div class="h-px bg-gray-100 my-6"></div>

                                <!-- Client Details -->
                                <div class="mb-6 space-y-4">
                                     <label class="block text-base font-bold text-gray-900 dark:text-white">{{ __('Your Details') }}</label>
                                     <input type="text" x-model="name" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-3 px-4 focus:border-blue-500 focus:ring-blue-500 text-sm placeholder-gray-400 dark:placeholder-gray-500 rtl:placeholder:text-right" placeholder="{{ __('Full Name') }}">
                                     <input type="email" x-model="email" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-3 px-4 focus:border-blue-500 focus:ring-blue-500 text-sm placeholder-gray-400 dark:placeholder-gray-500 rtl:placeholder:text-right" placeholder="{{ __('Email Address') }}">
                                     <input type="tel" x-model="phone" required class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white py-3 px-4 focus:border-blue-500 focus:ring-blue-500 text-sm placeholder-gray-400 dark:placeholder-gray-500 rtl:placeholder:text-right" placeholder="{{ __('Phone Number') }}">
                                </div>
                                
                                <div class="h-px bg-gray-100 my-6"></div>
                                
                                <!-- Total -->
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Total:') }}</span>
                                    <span class="text-3xl font-bold text-blue-600" x-text="'$' + total.toFixed(2)"></span>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" :disabled="isLoading || !date" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg shadow-xl shadow-blue-600/20 transition flex items-center justify-center gap-2 text-lg transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                                 <span x-show="!isLoading" class="flex items-center gap-2">
                                    <i class="fi fi-rr-shopping-cart"></i>
                                    {{ __('BOOK NOW') }}
                                 </span>
                                 <span x-show="isLoading" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Processing...') }}
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

                        // Mobile Gallery Slider
                        new Swiper(".mobileGallerySwiper", {
                            slidesPerView: "auto",
                            spaceBetween: 12,
                            grabCursor: true,
                            freeMode: true,
                        });
                    });
                </script>
                @endpush
            

         
            </div>
        </div>
    </div>
</x-layouts.app>
