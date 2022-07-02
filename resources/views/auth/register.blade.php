{{-- #TODO: フロント側でバリデーションを実装する必要がある --}}
<x-guest-layout>
    <x-auth-card>
        <div class="flex justify-center">
            <!-- Left side -->
            {{-- <div class="hidden md:w-1/3 bg-gray-200 md:flex flex-col justify-center px-2">
                <div class="text-sm text-gray-500 mb-28">
                    ReviewHubに登録することで、たくさんの情報が自由に閲覧できるようになります。さああなたも貴重な情報を掴み、ライバルと差をつけましょう！
                </div>
                <div class="text-sm text-gray-500 mb-28">
                    ReviewHubに登録することで、たくさんの情報が自由に閲覧できるようになります。さああなたも貴重な情報を掴み、ライバルと差をつけましょう！
                </div>
                <div class="text-sm text-gray-500 mb-28">
                    ReviewHubに登録することで、たくさんの情報が自由に閲覧できるようになります。さああなたも貴重な情報を掴み、ライバルと差をつけましょう！
                </div>
            </div> --}}

            <!-- Right side -->
            <div class="md:w-2/3 py-5 px-5 max-w-md mx-auto">
                <div class="w-40 sm:w-56 mt-10">
                    <a href="/">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Flash Message -->
                @if (session('flash_message'))
                    <x-flash-message :message="session('flash_message')"/>
                @endif

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('register') }}" class="mt-10">
                    @csrf

                    <div class="font-bold">新規会員登録</div>
        
                    <!-- Email Address -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■メールアドレス<span class="text-red-500">(必須)</span></div>
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="メールアドレス"/>
                    </div>
        
                    <!-- Password -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■パスワード<span class="text-red-500">(必須)</span></div>
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password"
                                        placeholder="パスワード" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-2">
                        <div class="text-sm font-bold">■メールアドレス確認用<span class="text-red-500">(必須)</span></div>
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required
                                        placeholder="パスワード確認用" />
                    </div>
        
                    <!-- Name -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■名前<span class="text-red-500">(必須)</span></div>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="氏名" />
                    </div>
        
                    <!-- birthday -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■生年月日<span class="text-red-500">(必須)</span></div>
                        <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus min="1900-04-01" max="<?php echo date('Y-m-d'); ?>" />
                    </div>
                    
                    <!-- gender -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■性別<span class="text-red-500">(必須)</span></div>
                        <div class="flex">
                            <div class="mr-2 flex justify-center">
                                <x-input id="gender" class="mt-1 mr-1" type="radio" name="gender" value="0" required />男性
                            </div>
                            <div class="flex justify-center">
                                <x-input id="gender" class="mt-1 mr-1" type="radio" name="gender" value="1" required />女性
                            </div>
                        </div>
                    </div>
                    
                    <!-- username -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■ユーザーネーム<span class="text-red-500">(必須)</span></div>
                        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus placeholder="ユーザーネーム" />
                    </div>
        
                    <!-- phone -->
                    <div class="mt-5">
                        <div class="text-sm font-bold">■電話番号<span class="text-red-500">(必須)</span></div>
                        <x-input id="phone" class="block mt-1 w-full no-spin" type="number" name="phone" :value="old('phone')" required autofocus placeholder="電話番号" />
                    </div>

                    <!-- privacy policy -->
                    <div class="mt-10 text-xs text-center">
                        <a href="/privacy_policy" class="text-blue-400" target="_blank" rel="noopener noreferrer">
                            個人情報保護方針
                        </a>
                        <span>
                            に同意いただいた上で、会員登録をお願いいたします
                        </span>
                        <div class="text-center mt-2">
                            <input type="checkbox" name="privacy_policy" value="1" class="rounded-full mr-2" required>同意する    
                        </div>
                    </div>
        
                    <div class="my-10 text-center">
                        <x-button.primary-button class="w-52">
                            新規登録
                        </x-button.primary-button>
                        <div class="mt-5">
                            <a href="{{ route('login') }}">
                                <x-button.secondary-button class="w-52">
                                    ログインはこちら
                                </x-button.secondary-button>
                            </a>
                        </div>
                    </div>
                </form>

                <x-button.google-login >
                    Googleアカウントで登録する
                </x-button.google-login>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
