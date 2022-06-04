<div class="border-4 border-pink-500 mx-5 md:mx-0">
    <div class="py-2 bg-pink-500">
        <div class="text-center text-white text-lg lg:text-xl font-bold">
            2022年最新
        </div>
        <div class="text-center text-white text-lg lg:text-xl font-bold">
            企業ランキングTOP3
        </div>
    </div>
    <div class="py-5 px-2">
        <a href="{{ route('company.index') }}">
            <div class="w-40 flex items-center justify-center mx-auto py-1 px-4 bg-gradient-to-r from-pink-500 via-orange-500 to-red-500 hover:from-red-500 hover:via-orange-500 hover:to-pink-500
            rounded-full transition duration-300 text-white">
                <div class="text-md font-bold mr-1">
                    GR 受付中
                </div>
                <div class="w-8">
                    <img src="{{ asset('images/flag.png') }}" alt="旗">
                </div>
            </div>
        </a>
        <div>
            @if(count($companies)===0)
                <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500 my-5">企業が登録されていません。</span>
            @else
                @foreach ($companies as $company)
                <div>
                    <div class="flex justify-between items-end mt-3 border-b border-gray-400">
                        <div class="flex items-center">
                            <div class="w-10 mr-1 md:text-md lg:text-xl font-bold text-red-800">{{ $loop->index+1 . '位' }}</div>
                            <div class="text-sm lg:text-lg font-bold text-gray-800">
                                <a href="{{ route('company.detail',['id' => $company->id]) }}">
                                    {{ $company->name }}
                                </a>
                            </div>
                        </div>
                        <div class="flex">
                            <x-gr :target="$company" gr="company.gr" deleteGr="company.gr.delete"/>
                            <div class="text-lg font-bold flex items-end">{{ $company->grs->count() }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>