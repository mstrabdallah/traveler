@props(['title', 'destinations'])

<div class="relative h-64 lg:h-[480px] overflow-hidden" 
     x-data="{ 
         currentIndex: 0,
         images: @js($destinations->pluck('image')->map(fn($img) => Storage::url($img))->toArray()),
         init() {
             if (this.images.length > 0) {
                 setInterval(() => {
                     this.currentIndex = (this.currentIndex + 1) % this.images.length;
                 }, 5000);
             }
         }
     }">
    
    <!-- Background Images -->
    @foreach($destinations as $index => $destination)
        <div x-show="currentIndex === {{ $index }}"
             x-transition:enter="transition ease-in-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in-out duration-1000"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0">
            <img src="{{ Storage::url($destination->image) }}" 
                 alt="{{ $destination->name }}" 
                 class="w-full h-full object-cover">
        </div>
    @endforeach
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>
    
    <!-- Content -->
    <div class="relative z-10 h-full flex items-center justify-center">
        <h1 class="text-4xl lg:text-5xl font-display font-bold text-white">{{ $title }}</h1>
    </div>
</div>
