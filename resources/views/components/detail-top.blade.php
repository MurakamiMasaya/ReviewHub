<div>
    <div class="flex justify-center">
        <img src="{{ $target->image !== '' ? asset('storage/' . $fileName . '/' . $target->image) : "https://placehold.jp/FA8072/ffffff/500x400.png?text=Images" }}" alt="">
    </div>
    <div class="mt-5">
        <div class="text-sm md:text-lg lg:text-xl  text-red-700 font-bold ">{{ $target->title }}</div>
        <div class="text-sm md:text-lg lg:text-xl  text-red-700 font-semibold text-right">{{ $target->user->username }}</div>
    </div>
</div>