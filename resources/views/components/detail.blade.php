<div class="px-5 md:px-10">
    <div class="flex items-center pt-5 border-b-2 border-gray-400">
        <div class="font-bold text-lg md:text-xl lg:text-2xl line-clamp-2 mr-5 md:mr-10">
            {{ $detail->name }}
        </div>
        <div class="flex items-center">
            <div class="w-6 md:w-8 mr-1 md:mr-2">
                <img src="{{ asset('images/GR.png') }}" alt="GR">
            </div>
            <div class="text-center font-bold text-lg md:text-xl lg:text-2xl">{{ $detail->gr }}</div>
        </div>
    </div>
    <div class="mt-5 md:mt-10">
        <div class="text-white bg-red-500 rounded-t-lg font-bold text-md md:text-lg text-center pt-2">{{ $title }}<span>Review</span></div>
        <div class="border-4 border-red-500 p-3 md:p-5">

            <x-information :reviews="$reviews" :detail="$detail" :title="$title"/>

            <x-review :reviews="$reviews" :detail="$detail"/>

            @if(count($reviews) > 0)
            <a href="#">
                <div class="md:mx-5 lg:mx-10 mt-5 px-2 py-2 bg-red-500 flex items-center justify-center">
                    <div class="text-center text-white text-sm md:text-md font-bold mr-2 lg:flex ">
                        <div>{{$detail->name}}の</div>
                        <div>レビューをもっと見る</div>
                    </div>
                    <div class="w-5 md:w-7">
                        <img src="{{ asset('images/right_arrow.png') }}" alt="右矢印">
                    </div>
                </div>
            </a>
            @endif
            <a href="#">
                <div class="text-center">
                    <div class="mt-5 py-2 px-3 inline-flex justify-center items-center border-4 border-red-400 rounded-lg text-center">
                        @if($title === '企業')
                        <div class="text-sm md:text-md font-bold text-red-400">
                            <div>企業に関する</div>
                            <div>レビューを書きましょう！</div>
                        </div>
                        @else
                        <div class="text-sm md:text-md font-bold text-red-400">
                            <div>スクールに関する</div>
                            <div>レビューを書きましょう！</div>
                        </div>
                        @endif
                        <div class="w-7 md:w-7">
                            <img src="{{ asset('images/megaphone.png') }}" alt="メガホン">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>