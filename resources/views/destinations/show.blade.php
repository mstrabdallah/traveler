<x-layouts.app>
   <!-- Hero -->
    <div class="relative h-[50vh] bg-gray-900">
         <img src="{{ $destination->image ? Storage::url($destination->image) : 'https://placehold.co/1200x600' }}" alt="{{ $destination->display_name }}" class="h-full w-full object-cover">
         <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
         <div class="absolute bottom-0 left-0 right-0 p-8 pb-12 lg:p-24">
             <div class="max-w-7xl mx-auto text-center">
                 <h1 class="text-4xl lg:text-7xl font-bold text-white font-display">{{ $destination->display_name }}</h1>
             </div>
         </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 lg:py-24 transition-colors duration-300">
        <!-- Description -->
        <div class="prose prose-lg prose-indigo text-gray-600 dark:text-gray-300 max-w-3xl mx-auto text-center mb-24">
            {!! $destination->display_description !!}
        </div>

        <!-- Available Tours -->
        <div class="border-t border-gray-200 dark:border-gray-700 pt-16">
            <h2 class="text-3xl font-bold tracking-tight text-primary-900 dark:text-white font-display sm:text-4xl text-center mb-16">{{ __('Available Tours in') }} {{ $destination->display_name }}</h2>
             <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                 @forelse($destination->tours as $tour)
                    <article class="flex flex-col items-start justify-between bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700">
                        <div class="relative w-full overflow-hidden">
                            @php
                                $firstMedia = $tour->images ? $tour->images[0] : null;
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
                                           class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition duration-500 group-hover:scale-105">
                                    </video>
                                @else
                                    <img src="{{ Storage::url($firstMedia) }}" 
                                         alt="{{ $tour->display_name }}" 
                                         class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition duration-500 group-hover:scale-105">
                                @endif
                            @else
                                <img src="https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?auto=format&fit=crop&w=800&q=80" 
                                     alt="{{ $tour->display_name }}" 
                                     class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition duration-500 group-hover:scale-105">
                            @endif

                             <div class="absolute top-4 right-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary-900 dark:text-white shadow-sm z-10">
                                {{ $tour->duration_days }} Days
                            </div>
                        </div>
                        <div class="max-w-xl p-6 flex flex-col flex-1">
                            <div class="group relative flex-1">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-primary-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-blue-400 transition-colors">
                                    <a href="{{ route('tours.show', $tour) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $tour->name }}
                                    </a>
                                </h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600 dark:text-gray-300">{{ Str::limit(strip_tags($tour->description), 100) }}</p>
                            </div>
                             <div class="relative mt-8 flex items-center gap-x-4 w-full justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{!! __('Starting from') !!}</span>
                                    <span class="text-lg font-bold text-accent-600">
                                        @if($tour->price_tiers)
                                            ${{ number_format(collect($tour->price_tiers)->min('price_per_person')) }}
                                        @else
                                            ${{ number_format($tour->price) }}
                                        @endif
                                    </span>
                                </div>
                                 <div class="text-sm font-semibold text-primary-900 dark:text-white flex items-center gap-1 group-hover:text-accent-500 dark:group-hover:text-blue-400 transition">
                                    {{ __('View Details') }} <span aria-hidden="true">{!! app()->getLocale() == 'ar' ? '&larr;' : '&rarr;' !!}</span>
                                 </div>
                            </div>
                        </div>
                    </article>
                 @empty
                    <p class="text-gray-500 text-center col-span-3">{{ __('No tours available for this destination yet.') }}</p>
                 @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
