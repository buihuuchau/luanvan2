<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
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
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
