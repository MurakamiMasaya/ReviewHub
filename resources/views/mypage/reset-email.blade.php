<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-lg mx-auto py-10 px-5 md:px-10">
        <div class="flex justify-between items-end">
            <div class="text-xl md:text-2xl font-bold">メールアドレス変更</div>
            <div class="">
                <a href="{{ route("mypage.index") }}"><div class="text-sm text-blue-500 font-bold">マイページに戻る</div></a>
            </div>
        </div>

        <!-- Right side -->
        <div class="max-w-lg mx-auto">
            <div class="w-40 sm:w-56 mt-10">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('mypage.reset-email.post') }}" class="mt-10">
                @csrf

                <div class="my-20 text-sm md:text-md lg:text-lg font-bold text-gray-600">
                    新しいメールアドレスを入力してください
                    <input type="email" name="email"  value="{{ old('email') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                    <div class="my-2 text-right">
                        <x-button.primary-button>確認のメールを送信する</x-button.primary-button>
                    </div>
                </div>

            </form>
        </div>

        
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>