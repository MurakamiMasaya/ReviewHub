<div class="mt-10 py-5 px-1 md:px-3 lg:px-5 text-gray-800">
    <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-red-600 bg-clip-text text-transparent">
        イベント掲示板 GRランキング
    </div>

    <x-period target="event"/>

    <div class="my-5 md:flex relative">
        @if(count($events)===0)
            <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500">イベントが登録されていません。</span>
        @else
            <div class="">
                @foreach($events as $event)
                    @if($loop->index < 10)
                    <div class="px-3 md:px-5 mt-5">
                        <div class="flex items-end justify-between">
                            <div class="flex items-center">
                                <div class="w-10 sm:w-11 lg:w-12 mr-2 md:mr-3">
                                    {{-- うまく順位を取得できていないので暫定的処理 --}}
                                    {{-- <img src="{{ asset('images/ranking/'. ($loop->index+1) .'.png') }}" alt="順位"> --}}
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                </div>
                                <div class="w-5/6 font-bold text-md lg:text-lg line-clamp-1">
                                    <a href="{{ route('event.detail', ['id' => $event->id]) }}">
                                        {{ $event->title }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <x-gr :target="$event" gr="event.gr" deleteGr="event.gr.delete"/>
                                <div class="text-lg font-bold flex items-end">{{ $event->grs->count() }}</div>
                            </div>
                        </div>
                        <div class="line-clamp-2 px-5">
                            {{ $event->contents }}
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- #TODO: 開発ツールからモザイクを削除できてしまうので修正が必要。 --}}
        @if(count($events) > 5 && !Auth::check())
        <div class="backdrop-filter backdrop-blur-sm absolute top-1/2 w-full h-1/2 text-xs font-bold"></div>
        <span class="absolute text-xs lg:text-md font-bold top-3/4 text-center w-full">閲覧するには会員登録が必要です。</span>
        @endif
    </div>
    @if(Auth::check())
    <div class="my-5">{{ $events->links() }}</div>
    @endif

    <a href="{{ route('event.create') }}">
        <x-button.review title="イベント" />
    </a>
</div>