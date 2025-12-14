<x-layouts.app>
    <div class="bg-primary-900 py-24 sm:py-32 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?q=80&w=2670&auto=format&fit=crop" alt="Desert" class="h-full w-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900 to-transparent"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8 text-center pt-16">
            <h1 class="text-4xl font-bold tracking-tight text-white font-display sm:text-6xl">Our Exclusive Tours</h1>
            <p class="mt-4 text-xl text-gray-300">Discover Egypt like never before with our premium packages.</p>
        </div>
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar Filters -->
                <div class="w-full lg:w-1/4 space-y-8">
                    <form action="{{ route('tours.index') }}" method="GET" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 font-display">Find Your Tour</h2>
                        
                        <!-- Search -->
                         <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Where to?" class="pl-10 w-full rounded-lg border-gray-200 focus:border-accent-500 focus:ring-accent-500 bg-gray-50 text-sm">
                            </div>
                        </div>

                        <!-- Date From -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                            <div class="relative">
                                <input type="text" name="date_from" id="date_from_filter" value="{{ request('date_from') }}" class="w-full rounded-lg border-gray-200 focus:border-accent-500 focus:ring-accent-500 bg-gray-50 text-sm" placeholder="Pick a date">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                   <i class="fi fi-rr-calendar"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Guests Dropdown -->
                        <div class="mb-6 relative" 
                             x-data="{ 
                                open: false,
                                counts: { person: {{ request('guests', 2) > 1 ? request('guests', 2) - 1 : 1 }}, adult: 1, child: 0 },
                                get total() { return this.counts.person + this.counts.adult + this.counts.child; }
                             }"
                             @click.outside="open = false">
                            
                            <label class="block text-sm font-medium text-gray-700 mb-2">Guests</label>
                            
                            <div class="relative cursor-pointer" @click="open = !open">
                                <input type="text" readonly 
                                       :value="total" 
                                       class="w-full rounded-lg border-gray-200 focus:border-accent-500 focus:ring-accent-500 bg-gray-50 text-sm cursor-pointer"
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                   <i class="fi fi-rr-users"></i>
                                </div>
                            </div>

                            <!-- Actual Input for Form Submission -->
                            <input type="hidden" name="guests" :value="total">

                            <!-- Dropdown -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2"
                                 class="absolute top-full left-0 mt-2 w-72 bg-white rounded-xl shadow-2xl p-6 z-50 border border-gray-100"
                                 style="display: none;">
                                
                                <!-- Person Row -->
                                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                    <span class="text-gray-700 font-medium"><span x-text="counts.person"></span> person</span>
                                    <div class="flex items-center gap-3">
                                        <button type="button" @click="if(counts.person > 0) counts.person--" class="w-8 h-8 rounded-lg bg-[#2A2C3E] text-white flex items-center justify-center hover:bg-opacity-90 transition disabled:opacity-50" :disabled="counts.person <= 0">
                                            <i class="fi fi-rr-minus text-xs"></i>
                                        </button>
                                        <button type="button" @click="counts.person++" class="w-8 h-8 rounded-lg bg-[#2A2C3E] text-white flex items-center justify-center hover:bg-opacity-90 transition">
                                            <i class="fi fi-rr-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Adult Row -->
                                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                    <span class="text-gray-700 font-medium"><span x-text="counts.adult"></span> Adult</span>
                                    <div class="flex items-center gap-3">
                                        <button type="button" @click="if(counts.adult > 0) counts.adult--" class="w-8 h-8 rounded-lg bg-[#2A2C3E] text-white flex items-center justify-center hover:bg-opacity-90 transition disabled:opacity-50" :disabled="counts.adult <= 0">
                                            <i class="fi fi-rr-minus text-xs"></i>
                                        </button>
                                        <button type="button" @click="counts.adult++" class="w-8 h-8 rounded-lg bg-[#2A2C3E] text-white flex items-center justify-center hover:bg-opacity-90 transition">
                                            <i class="fi fi-rr-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Child Row -->
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                                    <span class="text-gray-700 font-medium"><span x-text="counts.child"></span> child</span>
                                    <div class="flex items-center gap-3">
                                        <button type="button" @click="if(counts.child > 0) counts.child--" class="w-8 h-8 rounded-lg bg-[#2A2C3E] text-white flex items-center justify-center hover:bg-opacity-90 transition disabled:opacity-50" :disabled="counts.child <= 0">
                                            <i class="fi fi-rr-minus text-xs"></i>
                                        </button>
                                        <button type="button" @click="counts.child++" class="w-8 h-8 rounded-lg bg-[#2A2C3E] text-white flex items-center justify-center hover:bg-opacity-90 transition">
                                            <i class="fi fi-rr-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Apply Button -->
                                <button type="button" @click="open = false" class="w-full py-3 bg-[#345BA8] text-white font-bold rounded-lg hover:bg-[#2A4A8A] transition text-sm tracking-wider uppercase">
                                    Apply
                                </button>
                            </div>
                        </div>

                        <!-- Price Range -->
                         <div class="mb-8" x-data="{ minPrice: {{ request('min_price', 0) }}, maxPrice: {{ request('max_price', 5000) }} }">
                            <label class="block text-sm font-medium text-gray-700 mb-4">Price Range</label>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative w-full">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs">$</span>
                                    <input type="number" name="min_price" x-model="minPrice" class="w-full pl-6 py-1 rounded border-gray-200 text-xs">
                                </div>
                                <span class="text-gray-400">-</span>
                                <div class="relative w-full">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs">$</span>
                                    <input type="number" name="max_price" x-model="maxPrice" class="w-full pl-6 py-1 rounded border-gray-200 text-xs">
                                </div>
                            </div>
                            <input type="range" x-model="maxPrice" min="0" max="10000" step="100" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-accent-600">
                        </div>

                        <button type="submit" class="w-full py-3 bg-accent-600 text-white font-bold rounded-lg shadow-md hover:bg-accent-700 transition flex items-center justify-center gap-2">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                             SEARCH
                        </button>
                    </form>

                    <!-- Last Minute Widget -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hidden lg:block">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 font-display">Last Minute</h3>
                        <div class="space-y-4">
                            @foreach($tours->take(3) as $lmTour)
                                <div class="flex gap-3 items-center group cursor-pointer" onclick="window.location='{{ route('tours.show', $lmTour) }}'">
                                    <img src="{{ $lmTour->images ? Storage::url($lmTour->images[0]) : 'https://placehold.co/100x100' }}" class="w-16 h-16 rounded-lg object-cover group-hover:opacity-80 transition">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900 group-hover:text-accent-600 line-clamp-2 transition">{{ $lmTour->name }}</h4>
                                        <p class="text-xs text-accent-600 font-bold mt-1">From ${{ number_format($lmTour->price) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="w-full lg:w-3/4">
                    <!-- Top Bar -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                        <p class="text-gray-600 text-sm"><span class="font-bold text-gray-900 text-lg">{{ $tours->total() }}</span> Tours found</p>
                        
                        <form id="sortForm" action="{{ route('tours.index') }}" method="GET" class="flex items-center gap-2">
                             @foreach(request()->except(['sort', 'page']) as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <label for="sort" class="text-sm text-gray-600">Sort by:</label>
                            <select name="sort" id="sort" onchange="document.getElementById('sortForm').submit()" class="border-none bg-transparent font-semibold text-gray-900 text-sm focus:ring-0 cursor-pointer">
                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="duration_asc" {{ request('sort') == 'duration_asc' ? 'selected' : '' }}>Duration: Shortest</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            </select>
                        </form>
                    </div>

                    <!-- Tour Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($tours as $tour)
                            <x-tour-card :tour="$tour" />
                        @endforeach
                    </div>
                     <div class="mt-10">
                        {{ $tours->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date_from_filter", {
                dateFormat: "Y-m-d",
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                disableMobile: "true"
            });
        });
    </script>
    @endpush
</x-layouts.app>
