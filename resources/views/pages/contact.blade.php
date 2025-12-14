<x-layouts.app isTransparent="false">
    
    <!-- Hero Section with Rotating Background -->
    <x-hero-slider :destinations="$destinations" title="Contact Us" />
    
    <div class="bg-white dark:bg-gray-900 py-12 lg:py-24 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-20">
                
                <!-- Left Column: Form -->
                <div class="lg:col-span-2 space-y-8">
                    <div>
                        <p class="font-handwriting text-3xl text-yellow-500 mb-2">Get in touch with us</p>
                        <h1 class="text-5xl font-bold text-[#345BA8] dark:text-white">Leave a message</h1>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="text" name="name" required placeholder="Your Name" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                            
                            <input type="email" name="email" required placeholder="Email Address" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                            
                            <input type="tel" name="phone" placeholder="Phone Number" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                            
                            <input type="text" name="subject" placeholder="Subject" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                        </div>

                        <textarea name="message" required rows="8" placeholder="Write message" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition"></textarea>

                        <div>
                            <button type="submit" class="px-10 py-4 bg-[#345BA8] text-white font-semibold rounded-lg shadow-lg hover:bg-[#2A4A8A] transition transform hover:-translate-y-1">
                                Send a Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Contact Info Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 border border-gray-100 dark:border-gray-700 shadow-sm h-full flex flex-col justify-center">
                        <h2 class="text-4xl font-bold text-yellow-500 mb-10">Contact us</h2>
                        
                        <div class="space-y-8 mb-12">
                            <div class="flex items-center gap-4 text-[#345BA8] dark:text-blue-400">
                                <i class="fi fi-rr-phone-call text-xl"></i>
                                <span class="text-lg font-medium">01141812709</span>
                            </div>
                            
                            <div class="flex items-center gap-4 text-[#345BA8] dark:text-blue-400">
                                <i class="fi fi-rr-envelope text-xl"></i>
                                <span class="text-lg font-medium">info@traveleregypt.com</span>
                            </div>
                            
                            <div class="flex items-center gap-4 text-[#345BA8] dark:text-blue-400">
                                <i class="fi fi-rr-marker text-xl"></i>
                                <span class="text-lg font-medium">72 King Faisal Street</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                           <a href="https://www.facebook.com/mohamed.ibrahim.459408" class="w-10 h-10 rounded-full bg-[#3b434d] flex items-center justify-center text-white hover:bg-blue-600 transition">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>                     </a>
                     
                     <a href="https://www.instagram.com/mohammed_fayed_eg" class="w-10 h-10 rounded-full bg-[#3b434d] flex items-center justify-center text-white hover:bg-pink-600 transition">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                     </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Full Width Map -->
        <div class="mt-20 w-full h-[500px] bg-gray-100 dark:bg-gray-800">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.945899881845!2d31.1945617!3d30.0119149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145846f2b739e785%3A0xd7c2ab3cc88ac77b!2s72%20King%20Faisal%20St%2C%20Abu%20Qatadah%2C%20Boulaq%20Al%20Dakrour%2C%20Giza%20Governorate%203714330%2C%20Egypt!5e0!3m2!1sen!2seg!4v1702528765432!5m2!1sen!2seg" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</x-layouts.app>
