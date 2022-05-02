<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="メールアドレス(必須)"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="パスワード(必須)" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required
                                placeholder="パスワード確認用(必須)" />
            </div>

            <!-- Name -->
            <div>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="氏名(必須)" />
            </div>

            <!-- birthday -->
            <div>
                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus placeholder="生年月日(必須)" />
            </div>
            
            <!-- gender -->
            <div class="flexs">
                <x-input id="gender" class="mt-1" type="radio" name="gender" value="0" required />男性
                <x-input id="gender" class="mt-1" type="radio" name="gender" value="1" required />女性
            </div>
            
            <!-- username -->
            <div>
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus placeholder="ユーザーネーム(必須)" />
            </div>

            <!-- phone -->
            <div>
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus placeholder="電話番号(必須)" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}" >
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
