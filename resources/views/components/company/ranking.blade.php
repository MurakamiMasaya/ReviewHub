<div class="mt-10 px-1 md:px-3 lg:px-5 text-gray-800">
    <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-red-600 bg-clip-text text-transparent ">
        企業掲示板 GRランキング
    </div>

    <x-period target="company"/>

    <div class="my-5 md:flex">
        @if(count($companies)===0)
            <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500">企業が登録されていません。</span>
        @else
            <div class="md:w-1/2">
                @foreach($companies as $company)
                    @if($loop->index < 10)
                    <div class="mx-3 md:mx-2 mt-5">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                @if($companies->firstItem()+ $loop->index < 4)
                                <div class="w-10 md:w-11 lg:w-12 flex-none mr-2 md:mr-3">
                                    @if($companies->firstItem()+ $loop->index === 1)
                                        <img src="{{ asset('images/first.png') }}" alt="1位">
                                    @elseif($companies->firstItem()+ $loop->index === 2)
                                        <img src="{{ asset('images/second.png') }}" alt="2位">
                                    @elseif($companies->firstItem()+ $loop->index === 3)
                                        <img src="{{ asset('images/third.png') }}" alt="3位">
                                    @endif
                                </div>
                                @else
                                <div class="w-10 sm:w-11 lg:w-12 flex-none mr-2 md:mr-3 relative">
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-semibold">{{ $companies->firstItem()+ $loop->index }}</div>
                                </div>
                                @endif
                                <div class="w-5/6 font-bold text-md lg:text-lg">
                                    <a href="{{ route('company.detail',['id' => $company->id]) }}">
                                        {{ $company->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <switching-gr 
                                    :id='@json($company->id)'
                                    :grs='@json($company->grs->count())' 
                                    :is-gr='@json($company->isGrByAuthUser())'
                                    :path='@json('company')'
                                    :auth='@json(Auth::check())'
                                    :mail='@json(isset(Auth::user()->email_verified_at) ? true : false)'>
                                </switching-gr>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="md:w-1/2 relative">
                @foreach($companies as $company)
                    @if($loop->index >= 10)
                    <div class="mx-3 md:mx-2 mt-5">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <div class="w-10 sm:w-11 lg:w-12 flex-none mr-2 md:mr-3 relative">
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-semibold">{{ $companies->firstItem()+$loop->index }}</div>
                                </div>
                                <div class="w-5/6 font-bold text-md lg:text-lg">
                                    <a href="{{ route('company.detail',['id' => $company->id]) }}">
                                        {{ $company->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <switching-gr 
                                    :id='@json($company->id)'
                                    :grs='@json($company->grs->count())' 
                                    :is-gr='@json($company->isGrByAuthUser())'
                                    :path='@json('company')'
                                    :auth='@json(Auth::check())'
                                    :mail='@json(isset(Auth::user()->email_verified_at) ? true : false)'>
                                </switching-gr>
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
    {{-- #FIXME:一旦デフォルトのページネーションにしてます。レスポンシプで枠からはみ出ることがある --}}
        <div class="my-5">{{ $companies->links() }}</div>
    @endif
</div>