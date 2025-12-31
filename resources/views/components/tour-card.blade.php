@props(['tour'])

<article class="bg-white dark:bg-gray-800 shadow-sm hover:shadow-xl transition-all duration-300 group h-full flex flex-col rounded-[12px] overflow-hidden border border-gray-100 dark:border-gray-700">
    <!-- Image Area -->
    <div class="relative h-64 overflow-hidden  mx-4 mt-4">
        <a href="{{ route('tours.show', $tour) }}">
            <img src="{{ $tour->images ? Storage::url($tour->images[0]) : 'https://placehold.co/600x400' }}" alt="{{ $tour->display_name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 rounded-[12px]">
        </a>
        <!-- Badge -->
        <!-- Badge Top Right -->
        <div class="absolute top-4 right-4">
             <div class="h-10 w-10 bg-primary-900/80 backdrop-blur-sm rounded-lg flex items-center justify-center text-white">
                <i class="fi fi-rr-bookmark"></i>
            </div>
        </div>

        <!-- Categories Top Left -->
        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
            @foreach($tour->categories->take(2) as $category)
                <span class="px-3 py-1 bg-accent-600/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wider rounded-full">
                    {{ $category->display_name }}
                </span>
            @endforeach
        </div>
    </div>

    <!-- Content Area -->
    <div class="px-4 pb-4 pt-6 flex flex-col flex-1">
        <!-- Camera Icon Counter Placeholder -->
        <div class="flex justify-end mb-2">
             <div class="flex items-center gap-1 text-gray-500 dark:text-gray-400 text-sm">
                <i class="fi fi-rr-camera"></i>
                <span>{{ count($tour->images ?? []) }}</span>
            </div>
        </div>

        <h3 class="text-xl font-bold text-accent-500 dark:text-blue-400 line-clamp-2 leading-tight mb-6">
            <a href="{{ route('tours.show', $tour) }}">{{ $tour->display_name }}</a>
        </h3>
        
        <div class="mt-auto bg-gray-50 dark:bg-gray-700 rounded-xl p-4 flex items-center justify-between">
            <div class="flex items-center gap-6 text-sm text-primary-900 dark:text-white font-medium">
                 <div class="flex items-center gap-2">
                    <i class="fi fi-rr-clock text-primary-400 dark:text-gray-300"></i>
                    <span>{{ $tour->duration_days }} {{ __('days') }}</span>
                </div>
                 <div class="flex items-center gap-2">
                    <i class="fi fi-rr-users text-primary-400 dark:text-gray-300"></i>
                    <span>{{ $tour->max_people ?? 50 }}</span>
                </div>
            </div>

            <a href="{{ route('tours.show', $tour) }}" class="flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition">
                {{ __('Explore') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</article>
