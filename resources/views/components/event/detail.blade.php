<div class="px-5 md:px-10">
    <div class="flex items-end pt-5 border-b-2 border-gray-400">
        <div class="font-bold text-lg md:text-xl lg:text-2xl line-clamp-2 mr-5 md:mr-10">
            {{ $event->title }}
        </div>
        <div class="flex items-center">
            <div class="w-6 md:w-8 mr-1 md:mr-2">
                <img src="{{ asset('images/GR.png') }}" alt="GR">
            </div>
            <div class="text-center font-bold text-lg md:text-xl lg:text-2xl">{{ $event->gr }}</div>
        </div>
    </div>
    <div class="mt-5 md:mt-10">
        <div class="text-white bg-red-500 rounded-t-lg font-bold text-md md:text-lg text-center pt-2">イベント詳細</div>
        <div class="border-4 border-red-500 p-3 md:p-5">

            <x-detail-top :event="$event" fileName="events"/>

            <div class="mt-10">
                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">イベント種別 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->segment ==="1" ? '勉強会' : 'その他' }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">開催地 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">
                        {{ $event->online ==="1" ? 'オンライン' : $event->area }}
                    </div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">定員 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->capacity }}</div>
                </div>

                <div class="mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">イベント内容 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contents }}</div>
                </div>

                <div class="mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">ハッシュタグ : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->tag }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">連絡先 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contact_address }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">ハッシュタグ : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contact_email }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">URL : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->url }}</div>
                </div>

                <div class="flex items-center justify-center mt-10">
                    <div class="flex items-center mr-5 md:mr-10">
                        <div class="w-7 md:w-10 mr-2">
                            <img src="{{ asset('images/GR.png') }}" alt="GR">
                        </div>
                        <div class="text-md md:text-xl font-bold">{{ $event->gr }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-7 md:w-10 mr-2">
                            <img src="{{ asset('images/review.png') }}" alt="GR">
                        </div>
                        <div class="text-md md:text-xl font-bold">{{ count($reviews) }}</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-red-500 flex items-center justify-center">
            <div class="text-white text-sm md:text-md lg:text-lg font-bold text-center py-2 mr-2">
                {{ count($reviews) }}件のコメントを見る
            </div>
            <div class="w-5 md:w-6 lg:w-7">
                <img src="{{ asset('images/white_next.png') }}" alt="コメント確認">
            </div>
        </div>
        {{-- <x-review :reviews="$reviews" :detail="$detail"/> --}}
        
    </div>

    <a href="{{ route('event.register') }}">
        <x-button.review title="イベント" />
    </a>
</div>