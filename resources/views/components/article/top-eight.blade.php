<div class="px-5 mt-10">
    <div>
        <div class="flex items-end">
            <div>
                <div class="w-10"><img src="{{ asset('images/pencil.png') }}" alt="pencil"></div>
            </div>
            <div>
                <div class="text-xl font-bold text-gray-800">【月間】特集記事TOP8</div>
                <div class="h-1 bg-gradient-to-r from-pink-500 via-orange-500 to-red-500"></div>
            </div>
        </div>

        <!-- 特集記事TOP8 -->
        @if(count($articles)===0)
            <span class="text-md md:text-lg font-bold flex justify-center mx-auto my-5 text-gray-500">記事が登録されていません。</span>
        @else
            @foreach ($articles as $article)      
            <div class="border-b-2 border-gray-300 mt-4">
                <div class="flex items-end">
                    <div class="mr-2 line-clamp-3">
                        <a href="{{ route('article.detail', ['id' => $article->id]) }}">
                            {{ $article->contents}}
                        </a>
                    </div>
                    <div class="mx-auto align-middle">
                        <switching-gr 
                            :id='@json($article->id)'
                            :grs='@json($article->grs->count())' 
                            :is-gr='@json($article->isGrByAuthUser())'
                            :path='@json('article')'
                            :auth='@json(Auth::check())'>
                        </switching-gr>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

</div>