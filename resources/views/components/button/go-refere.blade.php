@if(isset($route) && isset($para))
    <a href="{{ route($route,$para) }}">
    @elseif(isset($route))
    <a href="{{ route($route) }}">
@endif
    <button type="{{ $type }}" name="back" value="true" class="flex justify-center items-center bg-white border-2 border-gray-400 rounded-lg px-3 py-2 w-56 lg:w-60 mx-auto">
        <div><img class="w-7" src="{{ asset('images/refere.png') }}" alt=""></div>
        <div class="text-gray-400 text-sm md:text-md font-bold ml-1">{{ $text }}</div>
    </button>
@if(isset($route))
    </a>
@endif