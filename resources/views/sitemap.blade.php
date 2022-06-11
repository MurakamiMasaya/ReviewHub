<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-lg mx-auto py-10 px-5 md:px-10">
        <div class="flex justify-between items-end">
            <div class="text-xl md:text-2xl font-bold">サイトマップ</div>
            <div class="">
                <a href="{{ route("top") }}"><div class="text-sm text-blue-500 font-bold">トップページに戻る</div></a>
            </div>
        </div>

        <div class="flex mt-10">
            <div class="mr-5 md:mr-10">
                <div class="mt-3">
                    <a href="{{ route('top') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">トップページ</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('company.index') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">企業情報</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('school.index') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">スクール情報</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('event.index') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">イベント情報</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('article.index') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">特集記事情報</a>
                </div>
            </div>
            <div class="">
                <div class="mt-3">
                    <a href="{{ route('mypage.index') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">マイページ</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('contact') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">お問い合わせ</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('rank.index') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">個人のランキング</a>
                </div>
                <div class="mt-3">
                    <a href="{{ route('sitemap') }}" class="text-blue-500 text-sm lg:text-md font-bold ml-3">サイトマップ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>