@if(!Auth::check())
    @if(count($reviews) > 0)
    <a href="{{ route('login') }}">
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
@endif