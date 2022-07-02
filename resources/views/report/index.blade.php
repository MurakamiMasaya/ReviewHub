<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-lg mx-auto my-10 px-5 md:px-10">
        <div class="flex justify-between items-end">
            <div class="text-xl md:text-2xl font-bold text-red-500">通報フォーム</div>
            <div class="">
                <a href="{{ route($route, ['id' => $para]) }}"><div class="text-sm text-blue-500 font-bold">{{ $text }}</div></a>
            </div>
        </div>
        
        <div class="max-w-lg mx-auto">
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />
    
            <form method="post" action="{{ route('report.post') }}" class="mt-10">
                @csrf
                <input type="hidden" name="target_id" value="{{ $targetDetail->id }}">
                <input type="hidden" name="type" value="{{ $type }}">

                <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                    タイトル : 
                    <div  class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{!! nl2br(e($targetDetail->title)) !!}</div>
                </div>

                <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                    ユーザーネーム : 
                    <div class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $targetDetail->user->username }}</div>
                </div>

                <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                    通報の理由 :
                    <div class="mt-2">
                        <x-input class="mr-1" type="checkbox" name="report[]" value="0" />商業目的のコンテンツやスパム
                    </div>
                    <div class="mt-2">
                        <x-input class="mr-1" type="checkbox" name="report[]" value="1"  />ポルノや露骨な静的コンテンツ
                    </div>
                    <div class="mt-2">
                        <x-input class="mr-1" type="checkbox" name="report[]" value="2" />児童虐待
                    </div>
                    <div class="mt-2">
                        <x-input class="mr-1" type="checkbox" name="report[]" value="3" />悪意のある表現や露骨な暴力的描写
                    </div>
                    <div class="mt-2">
                        <x-input class="mr-1" type="checkbox" name="report[]" value="4" />嫌がらせ、いじめ
                    </div>
                    <div class="mt-2">
                        <x-input class="mr-1" type="checkbox" name="report[]" value="5" />その他
                    </div>
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        その他の理由 : 
                        <textarea name="report_other" rows="5" value="{{ old('report_other') }}"  class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="その他の場合は、こちらにご記入ください">{{ old('report_other') }}</textarea>
                    </div>
                </div>
    
    
                <div class="mt-10">
                    <x-button.go-next text="通報する"/>
                </div>
            </form>
        </div>

        
    </div>

    <!-- Footer Image -->
    <x-footer-image />
</x-app-layout>