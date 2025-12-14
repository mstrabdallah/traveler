<x-layouts.app>
   <div class="bg-primary-900 py-24 sm:py-32 relative overflow-hidden">
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8 text-center pt-16">
            <h1 class="text-4xl font-bold tracking-tight text-white font-display sm:text-6xl">Contact Us</h1>
            <p class="mt-4 text-xl text-gray-300">We'd love to hear from you like never before.</p>
        </div>
    </div>

    <div class="py-24 sm:py-32 bg-white">
        <div class="mx-auto max-w-xl px-6 lg:px-8">
             <form action="#" method="POST" class="space-y-6">
                 @csrf
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-accent-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-accent-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
                    <div class="mt-2">
                        <textarea id="message" name="message" rows="4" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-accent-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-accent-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-accent-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent-600 transition">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
