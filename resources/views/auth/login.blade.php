<x-guest-layout>
    <x-jet-authentication-card>
        

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <h1 style="text-align:center;font-weight:bold;color:#f19999;">ĐĂNG NHẬP</h1>
            </div>

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Mật khẩu') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Quên mật khẩu?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Đăng nhập') }}
                </x-jet-button>
            </div>

            <div style="text-align:right;margin:7px 0 7px 0">
                <a href="{{route('register')}}"> Đăng kí tài khoản tại đây</a>
            </div>
            <div style=" text-align:center;margin:10px 0 10px 0;">
                <h5>hoặc đăng nhập qua</h5>
            </div>
            <div style=" text-align:center;display:flex;">
                <a href="{{url('auth/google')}}">
                    <img src="{{asset('front/image/google.png')}}" height="50px" style="margin-right:35px;">
                </a>
                <a href="{{url('auth/facebook')}}">
                    <img src="{{asset('front/image/facebook.png')}}" height="50px" style="text-align:right;">
                </a>
            </div>
            <div style="text-align:center;">
                
                
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
