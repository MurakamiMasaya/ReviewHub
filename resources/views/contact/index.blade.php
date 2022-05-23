<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-lg mx-auto my-10 px-5 md:px-10">
        <div class="flex justify-between items-end">
            <div class="text-xl md:text-2xl font-bold">お問い合わせ</div>
            <div class="">
                <a href="{{ route("top") }}"><div class="text-sm text-blue-500 font-bold">トップページに戻る</div></a>
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
    
            <form method="POST" action="{{ route('contact.confilm') }}" class="mt-10">
                @csrf

                <div class="font-bold">お問い合わせフォーム</div>

                <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                    タイトル(必須) : 
                    <input type="text" name="title" maxlength="40" value="{{ old('title') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="スクールの掲載依頼について"/>
                    <div class="text-xs font-bold text-gray-500">※40文字以内でご記入ください。</div>
                </div>
    
                <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                    本文(必須) : 
                    <textarea name="contents" rows="20" maxlength="1000" value="{{ old('contents') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('contents') }}</textarea>
                    <div class="text-xs font-bold text-gray-500">※1000文字以内でご記入ください。</div>
                </div>
    
    
                <div class="mt-10">
                    <x-button.go-next text="お問い合わせ内容の確認"/>
                </div>
                <div class="mt-10">
                    <x-button.go-refere type="button" route="top" text="トップページに戻る"/>
                </div>
            </form>
        </div>

        
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>