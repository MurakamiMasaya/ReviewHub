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

            <x-detail-top :target="$event" fileName="events"/>

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

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">開催期間 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">
                        {{ $event->start_date->format('y/m/d') }}~{{ $event->end_date->format('y/m/d') }}
                    </div>
                </div>

                <div class="mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">イベント内容 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contents }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">ハッシュタグ : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->tag }}</div>
                </div>

                <div class="flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">連絡先 : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contact_address }}</div>
                </div>

                <div class="md:flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">メールアドレス : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contact_email }}</div>
                </div>

                <div class="md:flex items-center mt-3">
                    <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">URL : </div>
                    <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->url }}</div>
                </div>

                <div class="flex justify-around items-center mt-10">
                    <div class="flex items-center justify-center">
                        <div class="flex items-center mr-5 md:mr-10">
                            <div class="w-7 md:w-10 mr-2">
                                <img src="{{ asset('images/GR.png') }}" alt="GR">
                            </div>
                            <div class="text-md md:text-xl font-bold">{{ $event->gr }}</div>
                        </div>
                        <div id="review-icon" class="flex items-center">
                            <div class="w-7 md:w-10 mr-2">
                                <img src="{{ asset('images/review.png') }}" alt="GR">
                            </div>
                            <div class="text-md md:text-xl font-bold">{{ count($reviewsAll) }}</div>
                        </div>
                    </div>

                    <div class="">
                        <form action="{{ route('report') }}" method="get">
                            <input type="hidden" name="target_id" value="{{ $event->id }}">
                            <input type="hidden" name="type" value="イベント">
                            <div class="w-7 md:w-10" data-tooltip-target="tooltip-report" data-tooltip-style="light">
                                <button>
                                    <img src="{{ asset('images/report.png') }}" alt="report">
                                </button>
                            </div>
                            <div id="tooltip-report" role="tooltip" class="inline-block absolute invisible z-20 py-2 px-3 text-sm font-bold text-red-500 bg-white rounded-lg border-2 border-red-300 shadow-sm opacity-0 tooltip">
                                通報
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <div id="review-open" class="hidden">
            <div class="bg-red-500 flex items-center justify-center">
                <div class="text-white text-sm md:text-md lg:text-lg font-bold text-center py-2 mr-2">
                    {{ count($reviewsAll) }}件のreviewを見る
                </div>
                <div class="w-5 md:w-6 lg:w-7">
                    <img src="{{ asset('images/white_next.png') }}" alt="コメント確認">
                </div>
            </div>
        </div>

        <div id="review-area" class="">
            <div class=" bg-red-500">
                <form action="{{ route('event.review') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <div class="flex items-center justify-center">
                        <div class="w-10 md:w-12 mr-1 md:mr-2">
                            <x-icon :user="$user" white="true"/> 
                        </div>
                        <div class="w-3/4 py-1">
                            <div class="flex justify-between items-end mb-1">
                                <div class="text-white text-xs md:text-sm lg:text-md font-bold">
                                    {{ $user->username }}
                                </div>
                                <button class="w-20 md:w-28 lg:w-32 px-3 bg-white rounded-lg">
                                    <div class="text-center font-bold text-red-500">
                                        review
                                    </div>
                                </button>
                            </div>
                            <textarea name="review" id="" rows="2" maxlength="40" required class="shadow appearance-none border w-full rounded py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="border-4 border-red-500 p-2">
                <x-review :reviews="$reviews" title="イベント"/>
            </div>
        </div>
    </div>

    <a href="{{ route('event.register') }}">
        <x-button.review title="イベント" />
    </a>
    <script src="{{ asset('js/review.js') }}"></script>
</div>