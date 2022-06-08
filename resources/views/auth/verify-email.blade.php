<x-guest-layout>
    <x-auth-card class="p-3">
        <div class="py-10 px-5 max-w-md mx-auto">
            <div class="w-40 sm:w-56">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <div class="mb-4 text-sm text-gray-600 px-5 py-10">
                <p class="mb-5 font-semibold">会員登録していただき誠にありがとうございます！</p>
                <p class="mb-3 font-semibold">お客様もメールアドレスはまだ認証されていないようです。メールアドレスを認証する場合は、以下のボタンからメールを再送してください。</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-10 font-semibold text-sm text-green-600">
                    会員登録時に指定したメールアドレスに新しい確認リンクを送信しました
                </div>
            @endif

            <div class="px-5 pb-10 md:flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                    @csrf

                    <div>
                        <x-button.primary-button >
                            確認メールを送信する
                        </x-button.primary-button>
                    </div>
                </form>

                <form method="get" action="{{ route('logout') }}" class="text-center mt-10 md:mt-0">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                        ログアウト
                    </button>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
