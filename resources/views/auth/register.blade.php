<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="../assets/img/nn.png" class="navbar-brand-img mx-auto mb-4" alt="main_logo" style="height: 150px; width: 150px;">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6" dir="rtl">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="flex flex-col">
                    <x-label for="name" value="{{ __('الاسم') }}" class="text-gray-700 mb-2" />
                    <x-input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="flex flex-col">
                    <x-label for="email" value="{{ __('البريد الإلكتروني') }}" class="text-gray-700 mb-2" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autocomplete="email" />
                </div>

                <div class="flex flex-col">
                    <x-label for="password" value="{{ __('كلمة المرور') }}" class="text-gray-700 mb-2" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="flex flex-col">
                    <x-label for="password_confirmation" value="{{ __('تأكيد كلمة المرور') }}" class="text-gray-700 mb-2" />
                    <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex flex-col">
                    <x-label for="user_type" value="{{ __('نوع المستخدم') }}" class="text-gray-700 mb-2" />
                    <select id="user_type" name="user_type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="toggleAdditionalFields()">
                        <option value="">اختر نوع المستخدم</option>
                        <option value="company" {{ old('user_type') == 'company' ? 'selected' : '' }}>شركة</option>
                        <option value="freelancer" {{ old('user_type') == 'freelancer' ? 'selected' : '' }}>مستقل</option>
                        <option value="client" {{ old('user_type') == 'client' ? 'selected' : '' }}>عميل</option>
                    </select>
                </div>
            </div>

            <!-- Additional fields for Company and Freelancer -->
            <div id="additional-fields" class="mt-4 hidden  grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="flex flex-col">
                    <x-label for="phone" value="{{ __('رقم الهاتف') }}" class="text-gray-700 mb-2" />
                    <x-input id="phone" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="phone" :value="old('phone')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="address" value="{{ __('العنوان') }}" class="text-gray-700 mb-2" />
                    <x-input id="address" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="address" :value="old('address')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="description" value="{{ __('الوصف') }}" class="text-gray-700 mb-2" />
                    <x-input id="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="description" :value="old('description')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="image" value="{{ __('صورة الملف الشخصي') }}" class="text-gray-700 mb-2" />
                    <x-input id="image" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="file" name="image" />
                </div>

                <div class="flex flex-col">
                    <x-label for="cover_image" value="{{ __('التراخيص') }}" class="text-gray-700 mb-2" />
                    <x-input id="cover_image" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="file" name="cover_image" />
                </div>

                <div class="flex flex-col">
                    <x-label for="company_url" value="{{ __('رابط الشركة') }}" class="text-gray-700 mb-2" />
                    <x-input id="company_url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="url" name="company_url" :value="old('company_url')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="facebook_url" value="{{ __('رابط فيسبوك') }}" class="text-gray-700 mb-2" />
                    <x-input id="facebook_url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="url" name="facebook_url" :value="old('facebook_url')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="linkedin_url" value="{{ __('رابط لينكدإن') }}" class="text-gray-700 mb-2" />
                    <x-input id="linkedin_url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="url" name="linkedin_url" :value="old('linkedin_url')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="instagram_url" value="{{ __('رابط إنستغرام') }}" class="text-gray-700 mb-2" />
                    <x-input id="instagram_url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="url" name="instagram_url" :value="old('instagram_url')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="twitter_url" value="{{ __('رابط تويتر') }}" class="text-gray-700 mb-2" />
                    <x-input id="twitter_url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="url" name="twitter_url" :value="old('twitter_url')" />
                </div>

                <div class="flex flex-col">
                    <x-label for="location" value="{{ __('الموقع') }}" class="text-gray-700 mb-2" />
                    <x-input id="location" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="location" :value="old('location')" />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms" class="text-gray-700">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                            <div class="ml-2">
                                {!! __('أوافق على :terms_of_service و :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('شروط الخدمة').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('سياسة الخصوصية').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('مسجل بالفعل؟') }}
                </a>

                <x-button class="bg-indigo-500 hover:bg-indigo-600 text-white">
                    {{ __('تسجيل') }}
                </x-button>
            </div>
        </form>

        <script>
            function toggleAdditionalFields() {
                var userType = document.getElementById('user_type').value;
                var additionalFields = document.getElementById('additional-fields');

                if (userType === 'company' || userType === 'freelancer') {
                    additionalFields.classList.remove('hidden');
                } else {
                    additionalFields.classList.add('hidden');
                }
            }
        </script>
    </x-authentication-card>
</x-guest-layout>
