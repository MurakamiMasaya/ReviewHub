<div class="border-4 border-orange-500 m-5 md:m-3 rounded-lg">
    <div class="relative">
        <div class="bg-orange-500 pt-3 pb-10">
            <div class="text-center text-white lg:text-xl font-bold">
                2022年最新Top3
            </div>
            <div class="text-center text-white lg:text-xl font-bold">
                月間スクールランキング
            </div>
        </div>
        <a class="absolute top-20 inset-x-0" href="{{ route('school.index') }}">
            <div class="w-40 flex items-center justify-center mx-auto py-1 px-4 bg-gradient-to-r from-red-500 to-orange-500 hover:from-orange-500 hover:to-red-500
            rounded-full transition duration-300 text-white border-4 border-gray-50">
                <div class="text-md font-bold mr-1">
                    GR 受付中
                </div>
                <div class="w-8">
                    <img src="{{ asset('images/flag.png') }}" alt="旗">
                </div>
            </div>
        </a>
    </div>
    <div class="pt-8 pb-5 px-2">
        <div>
            @if(count($schools)===0)
                <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500 my-5">スクールが登録されていません。</span>
            @else
                @foreach ($schools as $school)
                <div>
                    <div class="flex justify-between items-end mt-3 border-b border-gray-400">
                        <div class="flex items-center">
                            <div class="w-7 lg:w-10 mr-1 md:text-md lg:text-xl font-bold text-red-800">{{ $loop->index+1 . '位' }}</div>
                            <div class="text-sm lg:text-lg font-bold text-gray-800">
                                <a href="{{ route('school.detail', ['id' => $school->id]) }}">
                                    {{ $school->name }}
                                </a>
                            </div>
                        </div>
                        <div class="flex">
                            <switching-gr 
                                :id='@json($school->id)'
                                :grs='@json($school->grs->count())' 
                                :is-gr='@json($school->isGrByAuthUser())'
                                :path='@json('school')'
                                :auth='@json(Auth::check())'>
                            </switching-gr>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>