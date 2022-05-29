@if(count($reviews) === 0)
<div class="my-20 text-center font-bold text-gray-500">
    reviewがまだありません
</div>
@else
<div class="mb-4 relative">
    @foreach ($reviews as $review)
    <div class="flex items-center mt-3">
        <div class="w-12 md:w-15 mr-1 md:mr-2">           
            <x-icon :user="$review->user"/> 
        </div>
        <div class="w-full">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="text-sm md:text-md mr-2 md:mr-3">{{ $review->user->username }}</div>
                    <div class="w-5 md:w-6 mr-1 md:mr-2"><img src="{{ asset('images/GR.png') }}" alt="GR"></div>
                    <div class="text-sm md:text-md">{{ $review->gr }}</div>
                </div>
                <div>
                    <div class="text-xs md:text-md text-gray-500">{{ date_format($review->created_at, 'Y年m月n日') }}</div>
                </div>
            </div>
            <div class="text-xs md:text-sm mt-1">{{ $review->review }}</div>

            <div class="flex justify-end">
                <form action="{{ route('review.report') }}" method="get">
                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                    <input type="hidden" name="user_id" value="{{ $review->user->id }}">
                    <input type="hidden" name="type" value="{{ $title }}">
                    <div class="w-5 mr-2" data-tooltip-target="tooltip-report" data-tooltip-style="light">
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