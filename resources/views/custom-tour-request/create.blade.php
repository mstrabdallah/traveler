<x-layouts.app>

    <!-- Hero Section -->
    <div class="relative bg-primary-950 py-20 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-5xl font-display font-bold text-white mb-6">{{ __('Tailor-Made Your Experience') }}</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">{{ __('Customize every detail of your Egyptian adventure. Tell us your preferences, and let our experts craft the perfect itinerary for you.') }}</p>
        </div>
    </div>

    <div class="bg-gray-50 py-12 lg:py-20 -mt-16 relative z-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                
                <div class="p-8 lg:p-16">
                    @if(session('success'))
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-8 animate-bounce">
                                <svg class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-display font-bold text-gray-900 mb-4">{{ __('Request Received!') }}</h2>
                            <p class="text-lg text-gray-600 mb-10 max-w-lg mx-auto">{{ session('success') }}</p>
                            <a href="/" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-accent-600 border border-transparent rounded-full shadow-lg hover:bg-accent-700 hover:shadow-accent-600/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500">
                                {{ __('Return to Home') }}
                            </a>
                        </div>
                    @else
                        <form action="{{ route('custom-tour.store') }}" method="POST" class="space-y-12" id="inquiryForm">
                            @csrf
                            
                            <!-- Section: Personal Info -->
                            <div>
                                <h3 class="text-xl font-display font-bold text-primary-900 mb-6 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-accent-100 text-accent-700 text-sm">1</span>
                                    {{ __('Personal Details') }}
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-1">
                                        <label for="name" class="block text-sm font-semibold text-gray-700">{{ __('Full Name') }} <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" id="name" required class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-900 focus:border-accent-500 focus:bg-white focus:ring-accent-500 transition duration-200" placeholder="{{ __('John Doe') }}">
                                    </div>
                                    
                                    <div class="space-y-1">
                                        <label for="email" class="block text-sm font-semibold text-gray-700">{{ __('Email Address') }} <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email" required class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-900 focus:border-accent-500 focus:bg-white focus:ring-accent-500 transition duration-200" placeholder="john@example.com">
                                    </div>
    
                                    <div class="space-y-1">
                                        <label for="nationality" class="block text-sm font-semibold text-gray-700">{{ __('Nationality') }}</label>
                                        <div class="relative">
                                            <select name="nationality" id="nationality" class="appearance-none !bg-none block w-full rounded-xl border-gray-200 bg-gray-50 ps-4 pe-10 py-3.5 text-gray-900 focus:border-accent-500 focus:bg-white focus:ring-accent-500 transition duration-200">
                                                <option value="">{{ __('Select your nationality') }}</option>
                                                <option value="US">American</option>
                                                <option value="UK">British</option>
                                                <option value="CA">Canadian</option>
                                                <option value="AU">Australian</option>
                                                <option value="DE">German</option>
                                                <option value="FR">French</option>
                                                <option value="IT">Italian</option>
                                                <option value="ES">Spanish</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <div class="absolute inset-y-0 end-0 pe-4 flex items-center pointer-events-none text-gray-400">
                                                <i class="fi fi-rr-angle-small-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-1">
                                        <label for="phone" class="block text-sm font-semibold text-gray-700">{{ __('Phone Number') }}</label>
                                        <input type="tel" id="phone" class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-900 focus:border-accent-500 focus:bg-white focus:ring-accent-500 transition duration-200">
                                        <input type="hidden" name="phone" id="phone_full">
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-gray-100">

                            <!-- Section: Trip Data -->
                            <div>
                                <h3 class="text-xl font-display font-bold text-primary-900 mb-6 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-accent-100 text-accent-700 text-sm">2</span>
                                    {{ __('Trip Details') }}
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                                    <div class="col-span-1 md:col-span-2 space-y-1">
                                        <label for="request_title" class="block text-sm font-semibold text-gray-700">{{ __('Trip Name / Idea (Optional)') }}</label>
                                        <input type="text" name="request_title" id="request_title" placeholder="{{ __('e.g. Honeymoon, Family Vacation, Historical Tour') }}" class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-900 focus:border-accent-500 focus:bg-white focus:ring-accent-500 transition duration-200">
                                    </div>

                                    <div class="relative space-y-1">
                                        <label for="arrival_date" class="block text-sm font-semibold text-gray-700">{{ __('Planned Arrival') }}</label>
                                        <div class="relative">
                                            <input type="text" name="arrival_date" id="arrival_date" class="block w-full rounded-xl border-gray-200 bg-white pl-12 pr-4 py-3.5 text-gray-900 focus:border-accent-500 focus:ring-accent-500 shadow-sm transition duration-200 cursor-pointer" placeholder="{{ __('Select Date') }}">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fi fi-rr-calendar text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="relative space-y-1">
                                        <label for="departure_date" class="block text-sm font-semibold text-gray-700">{{ __('Planned Departure') }}</label>
                                        <div class="relative">
                                            <input type="text" name="departure_date" id="departure_date" class="block w-full rounded-xl border-gray-200 bg-white pl-12 pr-4 py-3.5 text-gray-900 focus:border-accent-500 focus:ring-accent-500 shadow-sm transition duration-200 cursor-pointer" placeholder="{{ __('Select Date') }}">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fi fi-rr-calendar text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Travelers Counter -->
                                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100" x-data="{ adults: 2, children: 0 }">
                                    <label class="block text-sm font-semibold text-gray-700 mb-4">{{ __('Who is traveling?') }}</label>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-2">{{ __('Adults (12+)') }}</span>
                                            <div class="flex items-center bg-white rounded-lg border border-gray-200 p-1">
                                                <button type="button" @click="if(adults > 1) adults--" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-accent-600 hover:bg-gray-50 rounded-md transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                                </button>
                                                <input type="number" name="adults" x-model="adults" class="flex-1 text-center border-none p-0 focus:ring-0 text-gray-900 font-semibold" readonly>
                                                <button type="button" @click="adults++" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-accent-600 hover:bg-gray-50 rounded-md transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div>
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-2">{{ __('Children (0-11)') }}</span>
                                            <div class="flex items-center bg-white rounded-lg border border-gray-200 p-1">
                                                <button type="button" @click="if(children > 0) children--" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-accent-600 hover:bg-gray-50 rounded-md transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                                </button>
                                                <input type="number" name="children" x-model="children" class="flex-1 text-center border-none p-0 focus:ring-0 text-gray-900 font-semibold" readonly>
                                                <button type="button" @click="children++" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-accent-600 hover:bg-gray-50 rounded-md transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                        
                                         <div class="space-y-1">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-2">{{ __('Ages (Optional)') }}</span>
                                            <input type="text" name="ages_range" placeholder="{{ __('e.g. 25, 30, 7') }}" class="block w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-gray-900 focus:border-accent-500 focus:ring-accent-500 text-sm h-[50px]">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Section: Preferences -->
                            <div>
                                <h3 class="text-xl font-display font-bold text-primary-900 mb-6 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-accent-100 text-accent-700 text-sm">3</span>
                                    {{ __('Your Preferences') }}
                                </h3>
                                
                                <div class="space-y-8">
                                    <div>
                                         <label class="block text-sm font-semibold text-gray-700 mb-4">{{ __('Destinations of Interest') }}</label>
                                         <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                             @foreach($destinations as $destination)
                                                <label class="cursor-pointer group relative">
                                                    <input type="checkbox" name="destinations[]" value="{{ $destination->name }}" class="peer sr-only">
                                                    <div class="p-4 rounded-xl border-2 border-gray-100 bg-gray-50 peer-checked:border-accent-500 peer-checked:bg-accent-50 transition-all duration-200 hover:border-accent-200 text-center h-full flex items-center justify-center">
                                                        <span class="block text-sm font-medium text-gray-700 peer-checked:text-accent-700 group-hover:text-accent-600">{{ $destination->display_name }}</span>
                                                    </div>
                                                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity text-accent-600">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                    </div>
                                                </label>
                                             @endforeach
                                         </div>
                                    </div>
        
                                    <div>
                                        <label for="accommodation" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Preferred Accommodation Level') }}</label>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                             <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-accent-500">
                                                <input type="radio" name="accommodation" value="5_star_luxury" class="peer sr-only">
                                                <span class="flex flex-1">
                                                  <span class="flex flex-col">
                                                    <span class="block text-sm font-medium text-gray-900 peer-checked:text-accent-600">{{ __('Luxury (5 Star Ultra)') }}</span>
                                                    <span class="mt-1 flex items-center text-sm text-gray-500">{{ __('Top-tier comfort & service') }}</span>
                                                  </span>
                                                </span>
                                                <span class="pointer-events-none absolute -inset-px rounded-xl border-2 border-transparent peer-checked:border-accent-500" aria-hidden="true"></span>
                                              </label>
                                              
                                               <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-accent-500">
                                                <input type="radio" name="accommodation" value="5_star_standard" class="peer sr-only">
                                                <span class="flex flex-1">
                                                  <span class="flex flex-col">
                                                    <span class="block text-sm font-medium text-gray-900 peer-checked:text-accent-600">{{ __('Gold (5 Star Standard)') }}</span>
                                                    <span class="mt-1 flex items-center text-sm text-gray-500">{{ __('Great balance of quality') }}</span>
                                                  </span>
                                                </span>
                                                <span class="pointer-events-none absolute -inset-px rounded-xl border-2 border-transparent peer-checked:border-accent-500" aria-hidden="true"></span>
                                              </label>
                                              
                                               <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-accent-500">
                                                <input type="radio" name="accommodation" value="4_star" class="peer sr-only">
                                                <span class="flex flex-1">
                                                  <span class="flex flex-col">
                                                    <span class="block text-sm font-medium text-gray-900 peer-checked:text-accent-600">{{ __('Silver (4 Star)') }}</span>
                                                    <span class="mt-1 flex items-center text-sm text-gray-500">{{ __('Cost-effective comfort') }}</span>
                                                  </span>
                                                </span>
                                                <span class="pointer-events-none absolute -inset-px rounded-xl border-2 border-transparent peer-checked:border-accent-500" aria-hidden="true"></span>
                                              </label>
                                              
                                               <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-accent-500">
                                                <input type="radio" name="accommodation" value="3_star" class="peer sr-only">
                                                <span class="flex flex-1">
                                                  <span class="flex flex-col">
                                                    <span class="block text-sm font-medium text-gray-900 peer-checked:text-accent-600">{{ __('Bronze (3 Star)') }}</span>
                                                    <span class="mt-1 flex items-center text-sm text-gray-500">{{ __('Just the essentials') }}</span>
                                                  </span>
                                                </span>
                                                <span class="pointer-events-none absolute -inset-px rounded-xl border-2 border-transparent peer-checked:border-accent-500" aria-hidden="true"></span>
                                              </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-gray-100">

                            <!-- Section: Final Details -->
                            <div>
                                <h3 class="text-xl font-display font-bold text-primary-900 mb-6 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-accent-100 text-accent-700 text-sm">4</span>
                                    {{ __('Final Touches') }}
                                </h3>
                                
                                <div class="space-y-6">
                                    <div>
                                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Any specific requirements or notes?') }}</label>
                                        <textarea name="notes" id="notes" rows="4" class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-900 focus:border-accent-500 focus:bg-white focus:ring-accent-500 transition duration-200" placeholder="{{ __('Tell us more about what you\'re looking for...') }}"></textarea>
                                    </div>
        
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('How did you find us? (Optional)') }}</label>
                                        <div class="flex flex-wrap gap-4">
                                             @foreach(['Search Engine', 'Social Media', 'TripAdvisor', 'A Friend'] as $source)
                                             <label class="inline-flex items-center">
                                                 <input type="radio" name="referral_source" value="{{ Str::slug($source, '_') }}" class="form-radio h-4 w-4 text-accent-600 border-gray-300 focus:ring-accent-500">
                                                 <span class="ms-2 text-sm text-gray-700">{{ __($source) }}</span>
                                             </label>
                                             @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Action -->
                            <div class="pt-6">
                                <button type="submit" class="w-full flex items-center justify-center px-8 py-5 text-lg font-bold text-white transition-all duration-200 bg-accent-600 rounded-xl shadow-lg hover:bg-accent-700 hover:shadow-accent-600/30 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500">
                                    {{ __('Submit Your Inquiry') }}
                                </button>
                                <p class="text-center text-sm text-gray-500 mt-4">{{ __('One of our agents will contact you within 24 hours.') }}</p>
                            </div>
    
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Date Picker Initialization
            flatpickr("#arrival_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                position: "auto left", // Better positioning
            });
            
            flatpickr("#departure_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                position: "auto left",
            });

            // Phone Input Initialization
            const phoneInput = document.querySelector("#phone");
            const phoneFullInput = document.querySelector("#phone_full");
            const iti = window.intlTelInput(phoneInput, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    fetch("https://ipapi.co/json")
                    .then(function(res) { return res.json(); })
                    .then(function(data) { callback(data.country_code); })
                    .catch(function() { callback("us"); });
                },
            });

            // Update hidden input on submit
            document.querySelector("#inquiryForm")?.addEventListener('submit', function() {
                if (iti.isValidNumber()) {
                    phoneFullInput.value = iti.getNumber();
                } else {
                    phoneFullInput.value = iti.getNumber();
                }
            });
        </script>
    @endpush
</x-layouts.app>
