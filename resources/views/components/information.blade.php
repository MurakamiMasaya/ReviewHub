<div>
    <div class="mt-3 text-md md:text-md font-bold">{{ $detail->name }}</div>
    @if(isset($detail->address))
    <div class="mt-3 text-md md:text-md font-bold">住所：{{ $detail->address }}</div>
    @endif
    <div class="mt-3 text-md md:text-md font-bold">Webサイト:{{ $detail->website_url }}</div>
    <div class="mt-10 text-md md:text-md font-bold border-b-2 border-gray-300 lg:flex">
        <div class="text-gray-600 ">{{ $detail->name}}の</div>
        <div class="text-red-600 ">「{{ $title }}情報」に関するreviewは{{ count($reviews) }}件</div>
    </div>
</div>