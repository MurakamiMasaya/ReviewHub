<div class="mt-10 py-5 px-1 md:px-3 lg:px-5 text-gray-800">
    <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-red-600 bg-clip-text text-transparent">
        特集記事掲示板 GRランキング
    </div>

    <x-period target="article"/>

    <div class="my-5 md:flex relative">
        @if(count($articles)===0)
            <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500">記事が登録されていません。</span>
        @else
            <div class="">
                @foreach($articles as $article)
                    <div class="px-3 md:px-5">
                        <div class="flex items-end mt-5 justify-between">
                            <div class="flex items-center">
                                @if($articles->firstItem()+ $loop->index < 4)
                                <div class="w-10 md:w-11 lg:w-12 flex-none mr-2 md:mr-3">
                                    @if($articles->firstItem()+ $loop->index === 1)
                                        <img src="{{ asset('images/first.png') }}" alt="1位">
                                    @elseif($articles->firstItem()+ $loop->index === 2)
                                        <img src="{{ asset('images/second.png') }}" alt="2位">
                                    @elseif($articles->firstItem()+ $loop->index === 3)
                                        <img src="{{ asset('images/third.png') }}" alt="3位">
                                    @endif
                                </div>
                                @else
                                <div class="w-10 md:w-11 lg:w-12 flex-none mr-2 md:mr-3 relative">
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-bold">{{ $articles->firstItem()+ $loop->index }}</div>
                                </div>
                                @endif
                                <div class="w-5/6 font-bold text-xs md:text-sm lg:text-md line-clamp-2">
                                    <a href="{{ route('article.detail', ['id' => $article->id]) }}">
                                        {{ $article->title }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <switching-gr 
                                    :id='@json($article->id)'
                                    :grs='@json($article->grs->count())' 
                                    :is-gr='@json($article->isGrByAuthUser())'
                                    :path='@json('article')'
                                    :auth='@json(Auth::check())'
                                    :mail='@json(isset(Auth::user()->email_verified_at) ? true : false)'>
                                </switching-gr>
                            </div>
                        </div>
                        <div class="text-xs md:text-sm lg:text-md line-clamp-2 px-5">
                            {{ $article->contents }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- #TODO: 開発ツールからモザイクを削除できてしまうので修正が必要。 --}}
        @if(count($articles) > 5 && !Auth::check())
        <div class="backdrop-filter backdrop-blur-sm absolute top-1/2 w-full h-1/2 text-xs font-bold"></div>
        <span class="absolute text-xs lg:text-md font-bold top-3/4 text-center w-full">閲覧するには会員登録が必要です。</span>
        @endif
    </div>
    @if(Auth::check())
    <div class="my-5">{{ $articles->links() }}</div>
    @endif

    <a href="{{ route('article.create') }}">
        <x-button.review title="記事" />
    </a>
</div>