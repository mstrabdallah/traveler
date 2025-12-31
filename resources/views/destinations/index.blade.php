<x-layouts.app>
    <div class="bg-primary-900 py-24 sm:py-32 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1568322445389-f64ac2515020?q=80&w=2535&auto=format&fit=crop" alt="Nile River" class="h-full w-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900 to-transparent"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8 text-center pt-16">
            <h1 class="text-4xl font-bold tracking-tight text-white font-display sm:text-6xl">{{ __('Explore Destinations') }}</h1>
            <p class="mt-4 text-xl text-gray-300">{{ __('From the bustling streets of Cairo to the serene beaches of Sharm El Sheikh.') }}</p>
        </div>
    </div>

    <div class="py-24 sm:py-32 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 auto-rows-[300px]">
                @php
                    // Define the layout pattern for the first 7 items to match the reference image
                    // Row 1: 1 col, 2 cols, 1 col
                    // Row 2: 2 cols, 2 cols
                    // Row 3: 2 cols, 1 col, (Contact Card fills the last 1 col)
                    $pattern = [
                        0 => 'lg:col-span-1',
                        1 => 'lg:col-span-2',
                        2 => 'lg:col-span-1',
                        3 => 'lg:col-span-2',
                        4 => 'lg:col-span-2',
                        5 => 'lg:col-span-2',
                        6 => 'lg:col-span-1',
                    ];
                @endphp

                @foreach($destinations as $index => $destination)
                    @php
                        $colSpan = $pattern[$index] ?? 'lg:col-span-1'; 
                    @endphp
                    <a href="{{ route('destinations.show', $destination) }}" class="group relative flex flex-col justify-end overflow-hidden rounded-3xl {{ $colSpan }} hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <img src="{{ Storage::url($destination->image) }}" alt="{{ $destination->display_name }}" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        
                        <div class="relative p-6">
                            <h3 class="text-2xl font-display font-bold text-white tracking-wide">
                                {{ $destination->display_name }}
                            </h3>
                        </div>
                    </a>
                @endforeach

                <!-- Contact / Special Offer Card -->
                <div class="relative flex flex-col justify-center items-center text-center overflow-hidden rounded-3xl bg-[#2e406e] dark:bg-gray-800 p-6 lg:col-span-1">
                     <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white/5 blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 rounded-full bg-white/5 blur-2xl"></div>

                    <div class="relative z-10 space-y-2">
                        <p class="text-xs font-medium tracking-widest text-blue-200 uppercase">Up to 30% Off</p>
                        <h3 class="text-4xl font-handwriting text-white rotating-text">Special <br> Offer</h3>
                        
                        <div class="pt-6">
                            <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-white dark:bg-gray-700 text-[#2e406e] dark:text-white text-xs font-bold uppercase tracking-wider rounded transition-transform hover:scale-105">
                                {{ __('Contact Us') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
