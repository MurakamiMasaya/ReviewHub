<div class="p-5 md:p-7">
    <div class="font-bold text-lg md:text-xl lg:text-2xl">
        <span class="text-red-500 mx-2">「{{ $target }}」</span>の<span>{{ $title }}</span>検索結果</div>
    <div class="bg-gray-300 h-1"></div>
    <div class="text-gray-500 text-md lg:text-lg">
        検索の結果, <span>{{ count($targetsAll) }}</span>件が該当しました。
    </div>
    <div class="my-3 relative">
        @foreach ($searchResults as $detail)
            <div class="flex items-center pt-8 border-b-2 border-gray-400">
                @if($flg === 'company')
                    <a href="{{ route('company.detail', ['id' => $detail->id]) }}">
                        <div class="font-bold text-md md:text-lg lg:text-xl line-clamp-2 mr-5 md:mr-10">
                            {{ $detail->name }}
                        </div>
                    </a>
                @elseif($flg === 'school')
                    <a href="{{ route('school.detail', ['id' => $detail->id]) }}">
                        <div class="font-bold text-sm md:text-md lg:text-lg line-clamp-2 mr-2 md:mr-5">
                            {{ $detail->name }}
                        </div>
                    </a>
                @elseif($flg === 'event')
                    <a href="{{ route('event.detail', ['id' => $detail->id]) }}">
                        <div class="font-bold text-sm md:text-md lg:text-lg line-clamp-2 mr-2 md:mr-5">
                            {{ $detail->title }}
                        </div>
                    </a>
                @elseif($flg === 'article')
                    <a href="{{ route('article.detail', ['id' => $detail->id]) }}">
                        <div class="font-bold text-sm md:text-md lg:text-lg line-clamp-2 mr-2 md:mr-5">
                            {{ $detail->title }}
                        </div>
                    </a>
                @endif
                <div class="flex items-end">
                    <switching-gr 
                        :id='@json($detail->id)'
                        :grs='@json($detail->grs->count())' 
                        :is-gr='@json($detail->isGrByAuthUser())'
                        :path='@json($flg)'
                        :width='@json('30px')'
                        :font='@json('20px')'
                        :auth='@json(Auth::check())'
                        :mail='@json(isset(Auth::user()->email_verified_at) ? true : false)'>
                    </switching-gr>
                </div>
            </div>
        @endforeach

        {{-- #TODO: 開発ツールからモザイクを削除できてしまうので修正が必要。 --}}
        @if(count($searchResults) > 5 && !Auth::check())
        <div class="backdrop-filter backdrop-blur-sm absolute top-1/2 w-full h-1/2 text-xs font-bold"></div>
        <span class="absolute text-xs lg:text-md font-bold top-3/4 text-center w-full">閲覧するには会員登録が必要です。</span>
        @endif
        @if(Auth::check())
            <div class="my-5">{{ $searchResults->appends(['target' => $target])->links() }}</div>
        @endif
    </div>
</div>