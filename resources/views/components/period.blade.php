<div class="flex justify-around items-center my-5 md:my-7 max-w-md mx-auto">
    <a href="{{ route($target .'.index', ['period' => 'month']) }}">
        @if(Request::is($target . '/top') || Request::is($target . '/top/month') || Request::is('/'))
            <div class="py-1 md:py-2 px-4 md:px-7 text-red-500 hover:text-orange-500 border-2 border-red-500 hover:border-orange-500 bg-gray-50 rounded-lg font-bold">月間</div>
        @else
            <div class="py-1 md:py-2 px-4 md:px-7 bg-red-500 hover:bg-orange-500 text-white rounded-lg font-bold">月間</div>
        @endif
    </a>
    <a href="{{ route($target . '.index', ['period' => 'year']) }}">
        @if(Request::is($target . '/top/year'))
            <div class="py-1 md:py-2 px-4 md:px-7 text-red-500 hover:text-orange-500 border-2 border-red-500 hover:border-orange-500 bg-gray-50 rounded-lg font-bold">年間</div>
        @else
            <div class="py-1 md:py-2 px-4 md:px-7 bg-red-500 hover:bg-orange-500 text-white rounded-lg font-bold">年間</div>
        @endif
    </a>
    <a href="{{ route($target . '.index', ['period' => 'all']) }}">
        @if(Request::is($target . '/top/all'))
            <div class="py-1 md:py-2 px-4 md:px-7 text-red-500 hover:text-orange-500 border-2 border-red-500 hover:border-orange-500 bg-gray-50 rounded-lg font-bold">全て</div>
        @else
            <div class="py-1 md:py-2 px-4 md:px-7 bg-red-500 hover:bg-orange-500 text-white rounded-lg font-bold">全て</div>
        @endif
    </a>
</div>