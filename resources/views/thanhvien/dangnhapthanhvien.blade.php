<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <input type="image" src="{{ asset('storage/default/login.png') }}" width="200px" height="200px">
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('dodangnhapthanhvien') }}">
            @csrf
			@if($errors->any())
			<h3>{{$errors->first()}}</h3>
			@endif
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Tài khoản')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="acc" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mật khẩu')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="pwd"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('login')}}">Bạn chưa có cơ sở ? Đăng ký ngay</a>
                <x-button class="ml-3">
                    {{ __('Đăng nhập') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
