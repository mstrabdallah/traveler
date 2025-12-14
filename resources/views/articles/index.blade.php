<x-layouts.app>
    <div class="bg-primary-900 py-24 sm:py-32 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=2674&auto=format&fit=crop" alt="Blog Background" class="h-full w-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900 to-transparent"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8 text-center pt-16">
            <h1 class="text-4xl font-bold tracking-tight text-white font-display sm:text-6xl">Traveler's Journal</h1>
            <p class="mt-4 text-xl text-gray-300">Stories, tips, and guides for your Egyptian adventure.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 py-24 sm:py-32 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($articles as $article)
                    <article class="flex flex-col items-start justify-between bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700 h-full">
                        <div class="relative w-full h-48 overflow-hidden">
                            <a href="{{ route('articles.show', $article) }}">
                                <img src="{{ $article->image ? Storage::url($article->image) : 'https://placehold.co/600x400' }}" alt="" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-110">
                            </a>
                        </div>
                        <div class="max-w-xl p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-x-4 text-xs">
                                <time datetime="{{ $article->published_at->format('Y-m-d') }}" class="text-gray-500 dark:text-gray-400">{{ $article->published_at->format('M d, Y') }}</time>
                            </div>
                            <div class="group relative flex-1">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-primary-900 dark:text-white group-hover:text-accent-600 dark:group-hover:text-accent-400 transition-colors">
                                    <a href="{{ route('articles.show', $article) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 dark:text-gray-300">{{ $article->excerpt }}</p>
                            </div>
                            <div class="mt-6 flex items-center gap-x-4 border-t border-gray-100 dark:border-gray-700 pt-4 w-full">
                                <a href="{{ route('articles.show', $article) }}" class="text-sm font-semibold text-accent-600 dark:text-accent-400 hover:text-accent-500">Read more <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            
            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
