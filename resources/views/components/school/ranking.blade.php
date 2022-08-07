<div class="mt-10 px-1 md:px-3 lg:px-5 text-gray-800">
    <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-red-600 bg-clip-text text-transparent">
        スクール掲示板 GRランキング
    </div>

    <x-period target="school"/>

    <div class="my-5 md:flex">
        @if(count($schools)===0)
            <span class="text-md md:text-lg font-bold flex justify-center mx-auto text-gray-500">スクールが登録されていません。</span>
        @else
            <div class="md:w-1/2">
                @foreach($schools as $school)
                    @if($loop->index < 10)
                    <div class="mx-3 md:mx-2 mt-5">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                @if($schools->firstItem()+ $loop->index < 4)
                                <div class="w-10 md:w-11 lg:w-12 flex-none mr-2 md:mr-3">
                                    @if($schools->firstItem()+ $loop->index === 1)
                                        <img src="{{ asset('images/first.png') }}" alt="1位">
                                    @elseif($schools->firstItem()+ $loop->index === 2)
                                        <img src="{{ asset('images/second.png') }}" alt="2位">
                                    @elseif($schools->firstItem()+ $loop->index === 3)
                                        <img src="{{ asset('images/third.png') }}" alt="3位">
                                    @endif
                                </div>
                                @else
                                <div class="w-10 sm:w-11 lg:w-12 flex-none mr-2 md:mr-3 relative">
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-semibold">{{ $schools->firstItem()+ $loop->index }}</div>
                                </div>
                                @endif
                                <div class="w-5/6 font-bold text-md lg:text-lg">
                                    <a href="{{ route('school.detail', ['id' => $school->id]) }}">
                                        {{ $school->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <switching-gr 
                                    :id='@json($school->id)'
                                    :grs='@json($school->gr)' 
                                    :is-gr='@json($school->isGrByAuthUser())'
                                    :path='@json('school')'
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
                @foreach($schools as $school)
                    @if($loop->index >= 10)
                    <div class="mx-3 md:mx-2 mt-5">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <div class="w-10 sm:w-11 lg:w-12 flex-none mr-2 md:mr-3 relative">
                                    <img src="{{ asset('images/ranking/other.png') }}" alt="順位">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-semibold">{{ $schools->firstItem()+ $loop->index }}</div>
                                </div>
                                <div class="w-5/6 font-bold text-md lg:text-lg">
                                    <a href="{{ route('school.detail', ['id' => $school->id]) }}">
                                        {{ $school->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <switching-gr 
                                    :id='@json($school->id)'
                                    :grs='@json($school->grs->count())' 
                                    :is-gr='@json($school->isGrByAuthUser())'
                                    :path='@json('school')'
                                    :auth='@json(Auth::check())'
                                    :mail='@json(isset(Auth::user()->email_verified_at) ? true : false)'>
                                </switching-gr>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                {{-- #TODO: 開発ツールからモザイクを削除できてしまうので修正が必要。 --}}
                @if(count($schools) > 10 && !Auth::check())
                <div class="backdrop-filter backdrop-blur-sm absolute top-0 w-full h-full text-xs font-bold"></div>
                <span class="absolute text-xs lg:text-md font-bold top-1/2 text-center w-full">閲覧するには会員登録が必要です。</span>
                @endif
            </div>
        @endif
    </div>
    @if(Auth::check())
    <div class="my-5">{{ $schools->links() }}</div>
    @endif
</div>