<x-layouts.app isTransparent="false">
    
    <!-- Hero Section with Rotating Background -->
    <x-hero-slider :destinations="$destinations" title="{{ __('Contact Us') }}" />
    
    <div class="bg-white dark:bg-gray-900 py-12 lg:py-24 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-20">
                
                <!-- Left Column: Form -->
                <div class="lg:col-span-2 space-y-8">
                    <div>
                        <p class="font-handwriting text-3xl text-yellow-500 mb-2">{{ __('Get in touch with us') }}</p>
                        <h1 class="text-5xl font-bold text-[#345BA8] dark:text-white">{{ __('Leave a message') }}</h1>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="text" name="name" required placeholder="{{ __('Your Name') }}" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                            
                            <input type="email" name="email" required placeholder="{{ __('Email Address') }}" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                            
                            <div class="relative w-full">
                                <input type="tel" id="phone" name="phone_input" placeholder="{{ __('Phone Number') }}" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                                <input type="hidden" name="phone" id="full_phone">
                            </div>
                            
                            <input type="text" name="subject" placeholder="{{ __('Subject') }}" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition">
                        </div>

                        <textarea name="message" required rows="8" placeholder="{{ __('Write message') }}" class="w-full rounded-xl border-none bg-[#f2f2f2] dark:bg-gray-800 px-6 py-4 text-gray-700 dark:text-gray-200 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-yellow-400 transition"></textarea>

                        <div>
                            <button type="submit" class="px-10 py-4 bg-[#345BA8] text-white font-semibold rounded-lg shadow-lg hover:bg-[#2A4A8A] transition transform hover:-translate-y-1">
                                {{ __('Send a Message') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Contact Info Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 border border-gray-100 dark:border-gray-700 shadow-sm  flex flex-col justify-center">
                        <h2 class="text-4xl font-bold text-yellow-500 mb-10">{{ __('Contact us') }}</h2>
                        
                        <div class="space-y-8 mb-12">
                            <a href="tel:01092378888" class="flex items-center gap-4 text-[#345BA8] dark:text-blue-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors group">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center group-hover:bg-yellow-100 dark:group-hover:bg-yellow-900/30 transition-colors">
                                    <i class="fi fi-rr-phone-call text-xl"></i>
                                </div>
                                <span class="text-lg font-medium">01092378888</span>
                            </a>
                            
                            <a href="mailto:mohamedmooosa11@gmail.com" class="flex items-center gap-4 text-[#345BA8] dark:text-blue-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors group">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center group-hover:bg-yellow-100 dark:group-hover:bg-yellow-900/30 transition-colors">
                                    <i class="fi fi-rr-envelope text-xl"></i>
                                </div>
                                <span class="text-lg font-medium">mohamedmooosa11@gmail.com</span>
                            </a>
                            
                            <a href="https://maps.app.goo.gl/9u3J3Y5P7mD6hEFA9" target="_blank" class="flex items-center gap-4 text-[#345BA8] dark:text-blue-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors group">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center group-hover:bg-yellow-100 dark:group-hover:bg-yellow-900/30 transition-colors">
                                    <i class="fi fi-rr-marker text-xl"></i>
                                </div>
                                <span class="text-lg font-medium">{{ __('72 King Faisal Street') }}</span>
                            </a>
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
    </div>



    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const phoneInput = document.querySelector("#phone");
                const fullPhoneInput = document.querySelector("#full_phone");
                
                const iti = window.intlTelInput(phoneInput, {
                    initialCountry: "auto",
                    rtl: document.documentElement.dir === "rtl",
                    geoIpLookup: function(success, failure) {
                        fetch("https://ipapi.co/json")
                            .then(res => res.json())
                            .then(data => success(data.country_code))
                            .catch(() => success("eg"));
                    },
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
                    separateDialCode: true,
                    preferredCountries: ["eg", "ae", "sa", "us", "gb"]
                });

                // Update hidden input with full number on change
                const handleChange = () => {
                    fullPhoneInput.value = iti.getNumber();
                };

                phoneInput.addEventListener('change', handleChange);
                phoneInput.addEventListener('keyup', handleChange);
            });
        </script>
        <style>
            .iti { width: 100% !important; display: block !important; }
            .iti__country-list { 
                background-color: white !important;
                color: #333 !important;
                border-radius: 12px !important;
                margin-top: 10px !important;
                border: 1px solid #eee !important;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
                z-index: 100 !important;
            }
            .dark .iti__country-list {
                background-color: #1f2937 !important;
                color: #e5e7eb !important;
                border: 1px solid #374151 !important;
            }
            .iti__selected-flag {
                background-color: transparent !important;
                border-radius: 12px 0 0 12px !important;
                padding-left: 15px !important;
            }
            .dark .iti__country-list .iti__country.iti__highlight {
                background-color: #374151 !important;
            }
        </style>
    @endpush
</x-layouts.app>
