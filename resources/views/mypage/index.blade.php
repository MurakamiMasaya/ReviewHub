<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto py-10 p-5 md:px-10">
        <div class="text-xl md:text-2xl font-bold">マイページ</div>


        <div class="">
            <div class="py-10 md:flex justify-center items-center">
                <div class="w-64 relative mx-auto">
                    <img src="{{ asset('images/sun.png') }}">
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                     text-5xl font-bold text-red-800">{{ $totalGrs }}</div>
                </div>

                <div class="md:w-1/2">
                    <div class="flex justify-center items-center mt-5">
                        <div class="text-xl font-bold text-red-800 mr-5">これまでに集めたGRの数</div>
                        <div class="text-xl font-bold text-red-800">{{ $totalGrs }}</div>
                    </div>
    
                    <div class="flex justify-center items-center mt-5">
                        <div class="text-3xl font-bold text-orange-600 mr-5">総ランキング</div>
                        <div class="text-3xl font-bold text-orange-600">{{ $rankUser }}位</div>
                    </div>
    
                    <div class="flex justify-center items-center mt-3">
                        <div class="text-3xl font-bold text-orange-600 mr-5">月間ランキング</div>
                        <div class="text-3xl font-bold text-orange-600">{{ $rankMonthUser }}位</div>
                    </div>
    
                    <div class="mt-10 text-blue-500 font-bold text-center">
                        <a href="{{ route('rank.index') }}">
                            ランキングの詳細はこちら
                        </a>
                    </div>
                </div>
            </div>

            {{-- 行動履歴について --}}
            <div class="md:flex justify-center">
                <div class="mt-10 md:mr-20">
                    <div class="border-2 border-gray-700 rounded-lg w-48 md:text-lg font-bold text-center px-3 py-2">行動履歴について</div>
                    <div class="text-blue-500 ml-5">
                        <div class="mt-5 md:mt-7 md:text-lg font-bold"><a href="{{ route('mypage.review') }}">Review一覧</a></div>
                        <div class="mt-5 md:mt-7 md:text-lg font-bold"><a href="{{ route('mypage.event') }}">イベント一覧</a></div>
                        <div class="mt-5 md:mt-7 md:text-lg font-bold"><a href="{{ route('mypage.article') }}">特集記事一覧</a></div>
                    </div>
                </div>
                
                {{-- 登録情報について --}}
                <div class="mt-10">
                    <div class="border-2 border-gray-700 rounded-lg w-48 md:text-lg font-bold text-center px-3 py-2">登録情報について</div>
                    <div class="text-blue-500 ml-5">
                        <div class="mt-5 md:mt-7 md:text-lg font-bold"><a href="{{ route('mypage.profile') }}">登録情報の確認・編集</a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>