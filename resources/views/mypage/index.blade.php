<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-3xl mx-auto py-10 p-5 md:px-10">
        <div class="text-xl md:text-2xl font-bold">マイページ</div>


        <div class="md:flex justify-around items-center">
            <div class="py-10">
                <div class="w-64 sm:w-40 md:w-48 mx-auto">
                    <img src="{{ asset('images/sun.png') }}" >
                </div>
            </div>

            {{-- 行動履歴について --}}
            <div class="md:flex justify-around">
                <div class="mt-10 md:mt-0 md:mr-5">
                    <div class="border-2 border-gray-700 rounded-lg w-48 md:text-lg font-bold text-center px-3 py-2">行動履歴について</div>
                    <div class="text-blue-500 ml-5">
                        <div class="mt-3 md:mt-5 md:text-lg font-bold"><a href="{{ route('mypage.review') }}">Review一覧</a></div>
                        <div class="mt-3 md:mt-5 md:text-lg font-bold"><a href="{{ route('mypage.event') }}">イベント一覧</a></div>
                        <div class="mt-3 md:mt-5 md:text-lg font-bold"><a href="{{ route('mypage.article') }}">特集記事一覧</a></div>
                    </div>
                </div>
                
                {{-- 登録情報について --}}
                <div class="mt-10 md:mt-0">
                    <div class="border-2 border-gray-700 rounded-lg w-48 md:text-lg font-bold text-center px-3 py-2">登録情報について</div>
                    <div class="text-blue-500 ml-5">
                        <div class="mt-3 md:mt-5 md:text-lg font-bold"><a href="{{ route('mypage.profile') }}">登録情報の確認・編集</a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>