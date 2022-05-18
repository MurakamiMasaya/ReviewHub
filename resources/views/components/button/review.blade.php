<div class="w-64 lg:w-96 mx-auto">
    <div class="mt-5 py-2 px-3 flex justify-center items-center border-4 border-red-400 rounded-lg text-center">
        @if($title === '企業')
        <div class="text-sm md:text-md lg:text-lg font-bold text-red-400">
            <div>企業に関する</div>
            <div>レビューを書きましょう！</div>
        </div>
        @elseif($title === 'スクール')
        <div class="text-sm md:text-md lg:text-lg font-bold text-red-400">
            <div>スクールに関する</div>
            <div>レビューを書きましょう！</div>
        </div>
        @elseif($title === 'イベント')
        <div class="text-sm md:text-md lg:text-lg font-bold text-red-400">
            <div>イベントを投稿しましょう！</div>
        </div>
        @elseif($title === '記事')
        <div class="text-sm md:text-md lg:text-lg font-bold text-red-400">
            <div>記事を投稿しましょう！</div>
        </div>
        @endif
        <div class="w-7 md:w-7">
            <img src="{{ asset('images/megaphone.png') }}" alt="メガホン">
        </div>
    </div>
</div>
