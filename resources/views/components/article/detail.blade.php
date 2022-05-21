<div class="px-5 md:px-10">
    <div class="flex items-end pt-5 border-b-2 border-gray-400">
        <div class="font-bold text-lg md:text-xl lg:text-2xl line-clamp-2 mr-5 md:mr-10">
            {{ $article->title }}
        </div>
        <div class="flex items-center">
            <div class="w-6 md:w-8 mr-1 md:mr-2">
                <img src="{{ asset('images/GR.png') }}" alt="GR">
            </div>
            <div class="text-center font-bold text-lg md:text-xl lg:text-2xl">{{ $article->gr }}</div>
        </div>
    </div>
    <div class="mt-5 md:mt-10">
        <div class="text-white bg-red-500 rounded-t-lg font-bold text-md md:text-lg text-center pt-2">記事詳細</div>
        <div class="border-4 border-red-500 p-3 md:p-5">

            <x-detail-top :target="$article" fileName="articles"/>

            <div class="mt-10">

                <div class="mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">記事内容 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $article->contents }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">ハッシュタグ : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $article->tag }}</div>
                </div>

                <div class="flex items-center justify-center mt-10">
                    <div class="flex items-center mr-5 md:mr-10">
                        <div class="w-7 md:w-10 mr-2">
                            <img src="{{ asset('images/GR.png') }}" alt="GR">
                        </div>
                        <div class="text-md md:text-xl font-bold">{{ $article->gr }}</div>
                    </div>
                    <div id="review-icon" class="flex items-center">
                        <div class="w-7 md:w-10 mr-2">
                            <img src="{{ asset('images/review.png') }}" alt="GR">
                        </div>
                        <div class="text-md md:text-xl font-bold">{{ count($reviewsAll) }}</div>
                    </div>
                </div>

            </div>
        </div>

        <div id="review-open" class="hidden">
            <div class="bg-red-500 flex items-center justify-center">
                <div class="text-white text-sm md:text-md lg:text-lg font-bold text-center py-2 mr-2">
                    {{ count($reviewsAll) }}件のコメントを見る
                </div>
                <div class="w-5 md:w-6 lg:w-7">
                    <img src="{{ asset('images/white_next.png') }}" alt="コメント確認">
                </div>
            </div>
        </div>
        
        <div id="review-area" class="">
            <div class=" bg-red-500">
                <form action="{{ route('article.review') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div class="flex items-center justify-center">
                        <div class="w-10 md:w-12 mr-1 md:mr-2">
                            @if($user->gender == 0)
                            <img src="{{ asset('images/white-man.png') }}" alt="男性アイコン">
                            @else
                            <img src="{{ asset('images/white-woman.png') }}" alt="女性アイコン">
                            @endif
                        </div>
                        <div class="w-3/4 py-1">
                            <div class="flex justify-between items-end mb-1">
                                <div class="text-white text-xs md:text-sm lg:text-md font-bold">
                                    {{ $user->username }}
                                </div>
                                <div class="w-20 md:w-28 lg:w-32 bg-white rounded-lg px-3 text-center">
                                    <button class="text-red-500 font-bold">review</button>
                                </div>
                            </div>
                            <textarea name="review" id="" rows="2" maxlength="40" class="shadow appearance-none border w-full rounded py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="border-4 border-red-500 p-2">
                <x-review :reviews="$reviews"/>
            </div>
        </div>
    </div>

    <a href="{{ route('article.register') }}">
        <x-button.review title="記事" />
    </a>
    <script src="{{ asset('js/review.js') }}"></script>
</div>