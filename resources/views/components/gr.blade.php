@if($target->isGrByAuthUser())
    <div {{ $attributes->merge(['class' => "w-7 mr-1 mb-1"]) }}>
        <a href="{{ route($deleteGr, ['id' => $target->id]) }}">
            <img src="{{ asset('images/gr-red.png') }}" alt="GR">
        </a>
    </div>
@else
    <div {{ $attributes->merge(['class' => "w-7 mr-1 mb-1"]) }}>
        <a href="{{ route($gr,['id' => $target->id]) }}">
            <img src="{{ asset('images/gr-gray.png') }}" alt="GR">
        </a>
    </div>
@endif