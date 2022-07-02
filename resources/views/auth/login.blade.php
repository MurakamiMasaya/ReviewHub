<x-guest-layout>
    <x-auth-card>
        <div class="py-10 px-5 max-w-md mx-auto">
            <div class="w-40 sm:w-56">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <!-- Flash Message -->
            @if (session('flash_message'))
                <x-flash-message :message="session('flash_message')"/>
            @endif
    
            <!-- Session Status -->
            <x-auth-session-status class="mt-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('login') }}" class="mt-10">
                @csrf
    
                <div class="font-bold">ログイン</div>
    
                <!-- Email Address -->
                <div class="mt-5">
                    <div class="text-sm font-bold">■メールアドレス<span class="text-red-500">(必須)</span></div>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="メールアドレス" />
                </div>
    
                <!-- Password -->
                <div class="mt-5">
                    <div class="text-sm font-bold">■パスワード<span class="text-red-500">(必須)</span></div>
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password"
                                    placeholder="パスワード" />
                </div>
    
                <!-- privacy policy -->
                <div class="mt-10 text-xs text-center">
                    <a href="/privacy_policy" class="text-blue-500" target="_blank" rel="noopener noreferrer">
                        個人情報保護方針
                    </a>
                    に同意してログイン
                    <div class="text-center mt-2">
                        <input type="checkbox" name="privacy_policy" value=1 class="rounded-full mr-2" required>同意する    
                    </div>
                </div>
    
                <div class="my-10 text-center">
                    <x-button.primary-button class="w-52">
                        ログイン
                    </x-button.primary-button>
                    <div class="mt-5">
                        <a href="{{ route('register') }}">
                            <x-button.secondary-button class="w-52">
                                新規登録はこちら
                            </x-button.secondary-button>
                        </a>
                    </div>
                </div>
                 <div class="text-xs text-center text-blue-500 mb-10">
                     <a href="{{ route('password.request') }}">
                         パスワードを忘れた方はこちら
                     </a>
                 </div>
            </form>

            <x-button.google-login>
                Googleアカウントでログインする
            </x-button.google-login>
        </div>
    </x-auth-card>
</x-guest-layout>
