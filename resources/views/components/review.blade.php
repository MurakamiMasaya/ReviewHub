@if(count($reviews) === 0)
<div class="my-20 text-center font-bold text-gray-500">
    reviewがまだありません
</div>
@else
<div class="mt-4 relative">
    @foreach ($reviews as $review)
    <div class="flex justify-between items-center mb-1">
        <div class="flex items-center">
            <div class="w-5 md:w-7 mr-1 md:mr-2">           
                <x-icon :user="$review->user"/> 
            </div>
            <div class="text-xs md:text-md mr-2 md:mr-3">{{ $review->user->username }}</div>
        </div>
        <div>
            <div class="text-xs md:text-sm text-gray-500">{{ date_format($review->created_at, 'Y年m月n日') }}</div>
        </div>
    </div>
    <div class="text-xs md:text-sm mb-1">{!! nl2br($review->review) !!}</div>
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            <switching-gr 
                :id='@json($review->id)'
                :grs='@json($review->grs->count())' 
                :is-gr='@json($review->isGrByAuthUser())'
                :path='@json($path . '/review')'
                :auth='@json(Auth::check())'
                :mail='@json(isset(Auth::user()->email_verified_at) ? true : false)'>
            </switching-gr>
        </div>
        <div class="w-5 mr-2" data-tooltip-target="tooltip-report" data-tooltip-style="light">
            <button>
                <img src="{{ asset('images/report.png') }}" alt="report">
            </button>
        </div>
        <div id="tooltip-report" role="tooltip" class="inline-block absolute invisible z-20 py-2 px-3 text-sm font-bold text-red-500 bg-white rounded-lg border-2 border-red-300 shadow-sm opacity-0 tooltip">
            通報
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    @endforeach
    {{-- #TODO: 開発ツールからモザイクを削除できてしまうので修正が必要。 --}}
    @if(count($reviews) > 5 && !Auth::check())
    <div class="backdrop-filter backdrop-blur-sm absolute top-1/2 w-full h-1/2 text-xs font-bold"></div>
    <span class="absolute text-xs lg:text-md font-bold top-3/4 text-center w-full">閲覧するには会員登録が必要です。</span>
    @endif
    
    @if(Auth::check())
    <div class="mt-3">{{ $reviews->links() }}</div>
    @endif
</div>
@endif