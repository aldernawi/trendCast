<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="../assets/img/nn.png" class="navbar-brand-img " alt="main_logo" style="height: 200px;width: 200px">
        </x-slot>

        <!-- عرض الأخطاء إذا كانت موجودة -->
        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">{{ __('هناك خطأ ما، يرجى المحاولة مرة أخرى') }}</div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" dir="rtl" class="text-right">
            @csrf

            <div>
                <x-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('كلمة المرور') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 ms-4" href="{{ route('register') }}">
                        {{ __('ليس لديك حساب؟') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('تسجيل الدخول') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
