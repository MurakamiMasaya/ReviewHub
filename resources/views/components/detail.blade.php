<div class="px-5 md:px-10">
    <div class="flex items-center pt-5 border-b-2 border-gray-400">
        <div class="font-bold text-lg md:text-xl lg:text-2xl line-clamp-2 mr-5 md:mr-10">
            {{ $detail->name }}
        </div>
        <div class="flex items-center">
            <div class="w-6 md:w-8 mr-1 md:mr-2">
                <img src="{{ asset('images/GR.png') }}" alt="GR">
            </div>
            <div class="text-center font-bold text-lg md:text-xl lg:text-2xl">{{ $detail->gr }}</div>
        </div>
    </div>
    <div class="mt-5 md:mt-10">
        <div class="text-white bg-red-500 rounded-t-lg font-bold text-md md:text-lg text-center pt-2">{{ $title }}<span>Review</span></div>
        <div class="border-4 border-red-500 p-3 md:p-5">

            <x-information :reviews="$reviews" :detail="$detail" :title="$title"/>

            <x-review :reviews="$reviews" :title="$title"/>

            <x-button.see-more :reviews="$reviews" :detail="$detail"/>
            
            <a href="{{ route($route, ['detail' => $detail->id]) }}">
                <x-button.review :title="$title" />
            </a>
        </div>
    </div>
</div>