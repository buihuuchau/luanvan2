<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <input type="image" src="{{ asset('storage/default/restaurant.jpg') }}" width="150px" height="120px">
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mật khẩu')" />

                {{-- <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" /> --}}
                                <x-input type="password" class="block mt-1 w-full" placeholder="Từ 8 ký tự, có ký tự đặc biệt, chữ hoa, chữ thường, số"
                    id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" required autocomplete="current-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Nhập lại mật khẩu')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Tên quán')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Cac thanh phan khac -->
            <div class="mt-4">
                <x-label>Hình ảnh quán:</x-label>
                <x-input required="true" type="file" class="block mt-1 w-full" name="hinhquan" :value="old('hinhquan')"/>
            </div>

            <div class="mt-4">
                <x-label>Địa chỉ quán:</x-label>
                <x-input required="true" type="text" class="block mt-1 w-full" name="diachiquan" :value="old('diachiquan')"/>
            </div>

            <div class="mt-4">
                <x-label>Website:</x-label>
                <x-input required="true" type="url" class="block mt-1 w-full" name="website" pattern="https?://.+" placeholder="http:// or https://" :value="old('website')"/>
            </div>

            <div class="mt-4">
            <x-label>Số điện thoại:</x-label>
            <x-input required="true" type="tel" class="block mt-1 w-full" name="sdtquan" placeholder="0123456789" pattern="[0-9]{10}" :value="old('sdtquan')"/>
            </div>

            <div class="mt-4">
                <x-label>Ngày thành lập:</x-label>
                <x-input required="true" type="date" class="block mt-1 w-full" name="ngaythanhlap" :value="old('ngaythanhlap')"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Đã có tài khoản?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Đăng ký') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
