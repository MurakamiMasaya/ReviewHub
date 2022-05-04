<x-guest-layout>
    <x-auth-card>
        <div class="w-40 sm:w-56 mt-10">
            <a href="/">
                <x-application-logo />
            </a>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="mt-10">
            @csrf

            <div class="font-bold">ログイン</div>

            <!-- Email Address -->
            <div class="mt-5">
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="メールアドレス(必須)" />
            </div>

            <!-- Password -->
            <div class="mt-5">
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="パスワード(必須)" />
            </div>

            <!-- privacy policy -->
            <div class="mt-10 text-xs text-center">
                <a href="#" class="text-blue-400">
                    個人情報保護方針
                </a>
                に同意してログイン
                <div class="text-center mt-2">
                    <input type="checkbox" name="agree_privacy" value="1" class="rounded-full mr-2">同意する    
                </div>
            </div>

            <div class="my-10 text-center">
                <x-button.primary-button class="w-52">
                    ログイン
                </x-button.primary-button>
                <x-button.secondary-button class="w-52 mt-5">
                    新規登録はこちら
                </x-button.secondary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
