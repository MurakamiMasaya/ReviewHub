{{-- #TODO: デザインがかなりもっさりしているの修正必須。--}}
<div class="border-4 border-pink-500 mt-5">
    <div class="py-2 bg-pink-500">
        <div class="text-center text-white text-xl font-bold">
            2022年最新
        </div>
        <div class="text-center text-white text-xl font-bold">
            企業ランキングTOP3
        </div>
    </div>
    <div class="py-5 px-2">
        <div class="w-52 mx-auto flex items-center border-4 border-red-300 rounded-3xl py-2 px-4">
            <div class="w-8 mr-3">
                <img src="{{ asset('images/GR.png') }}" alt="GR">
            </div>
            <div class="text-xl font-bold">GR 受付中！</div>
        </div>
        <div>
            @if(count($companies)===0)
                <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500 my-5">企業が登録されていません。</span>
            @else
                @foreach ($companies as $company)
                <div>
                    <div class="flex justify-around items-center mt-3">
                        <div class="flex items-end">
                            <div class="mr-3 md:mr-1 lg:mr-3 md:text-md lg:text-xl font-bold text-red-800">{{ $loop->index+1 . '位' }}</div>
                            <div class="text-md lg:text-lg font-bold">
                                <a href="#">
                                    {{ $company->name }}
                                </a>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-7 mr-1">
                                <img src="{{ asset('images/GR.png') }}" alt="GR">
                            </div>
                            <div class="text-lg font-medium flex items-end">{{ $company->gr }}</div>
                        </div>
                    </div>
                    <div class="bg-gray-300 h-1"></div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>