<div class="mt-10 px-1 md:px-3 lg:px-5 text-gray-800">
    <div class="lg:flex justify-between items-end">
        <div class="text-xl md:text-2xl font-bold">
            企業掲示板 GRランキング
        </div>
        <div class="text-right">
            2022/04/25~2022/05/24
        </div>
    </div>
    <div class="bg-gray-500 h-1"></div>

    <div class="my-5 md:flex">
        @if(count($companies)===0)
            <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500">企業が登録されていません。</span>
        @else
            <div class="md:w-1/2">
                @foreach($companies as $company)
                    @if($loop->index < 10)
                    <div class="mr-1 lg:mr-3 mt-5">
                        <div class="flex justify-around md:justify-between">
                            <div class="flex items-center">
                                <div class="w-1/5 lg:w-1/6 mr-2 md:mr-3">
                                    {{-- うまく順位を取得できていないので暫定的処理 --}}
                                    {{-- <img src="{{ asset('images/ranking/'. ($loop->index+1) .'.png') }}" alt="順位"> --}}
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                </div>
                                <div class="w-4/5 lg:w-5/6 font-bold text-md lg:text-lg">
                                    <a href="#">
                                        {{ $company->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <div class="w-7 mr-1">
                                    <img src="{{ asset('images/GR.png') }}" alt="GR">
                                </div>
                                <div class="text-lg font-bold flex items-end">{{ $company->gr }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="md:w-1/2 relative">
                @foreach($companies as $company)
                    @if($loop->index >= 10)
                    <div class="mr-1 lg:mr-3 mt-5">
                        <div class="flex justify-around md:justify-between">
                            <div class="flex items-center">
                                <div class="w-1/5 lg:w-1/6 mr-2 md:mr-3">
                                    {{-- うまく順位を取得できていないので暫定的処理 --}}
                                    {{-- <img src="{{ asset('images/ranking/'. ($loop->index+1) .'.png') }}" alt="順位"> --}}
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                </div>
                                <div class="w-4/5 lg:w-5/6 font-bold text-md lg:text-lg">
                                    <a href="#">
                                        {{ $company->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <div class="w-7 mr-1">
                                    <img src="{{ asset('images/GR.png') }}" alt="GR">
                                </div>
                                <div class="text-lg font-bold flex items-end">{{ $company->gr }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                {{-- #TODO: 開発ツールからモザイクを削除できてしまうので修正が必要。 --}}
                @if(count($companies) > 10 && !Auth::check())
                <div class="backdrop-filter backdrop-blur-sm absolute top-0 w-full h-full text-xs font-bold"></div>
                <span class="absolute text-xs lg:text-md font-bold top-1/2 text-center w-full">閲覧するには会員登録が必要です。</span>
                @endif
            </div>
        @endif
    </div>
    @if(Auth::check())
        <div class="my-5">{{ $companies->links() }}</div>
    @endif
</div>