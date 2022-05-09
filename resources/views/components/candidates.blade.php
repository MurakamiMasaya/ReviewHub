<div class="py-5 px-3 md:px-5 lg:px-7">
    <div class="font-bold text-lg md:text-xl lg:text-2xl"><span class="text-red-500">{{ $target }}</span>の企業検索結果</div>
    <div class="bg-gray-300 h-1"></div>
    <div class="text-gray-500 text-md lg:text-lg">
        検索の結果, <span>{{ count($targetsAll) }}</span>件が該当しました。
    </div>
    <div class="my-3">
        @foreach ($searchResults as $result)
        <div class="flex items-center pt-5 border-b-2 border-gray-400">
            @if($flg === 'company' || $flg === 'school')
                <div class="font-bold text-md md:text-lg lg:text-xl line-clamp-2 mr-5 md:mr-10">{{ $result->name }}</div>
            @else
                <div class="font-bold text-sm md:text-md lg:text-lg line-clamp-2 mr-2 md:mr-5">{{ $result->title }}</div>
            @endif
            <div class="flex items-end">
                <div class="w-6 md:w-8 mr-1 md:mr-2">
                    <img src="{{ asset('images/GR.png') }}" alt="GR">
                </div>
                <div class="text-center font-bold text-sm md:text-lg">{{ $result->gr }}</div>
            </div>
        </div>
        @endforeach
        @if(Auth::check())
            <div class="my-5">{{ $searchResults->appends(['target' => $target])->links() }}</div>
        @endif
    </div>
</div>