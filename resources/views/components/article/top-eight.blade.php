<div class="px-5 mt-5">
    <div>
        <div class="flex items-end">
            <div>
                <div class="w-10"><img src="{{ asset('images/pencil.png') }}" alt="pencil"></div>
            </div>
            <div>
                <div class="text-xl font-bold">人気のある特集記事一覧</div>
                <div class="bg-gray-300 h-1"></div>
            </div>
        </div>

        <!-- 特集記事TOP8 -->
        @for ($i=0; $i<8; $i++)
        <div class="border-b-2 border-gray-300 mt-3">
            <div class="flex items-end">
                <div class="mr-2 w-56 h-12 text-ellipsis overflow-hidden ...">
                    React vs Vue フロントエンドの流行りと廃り、いま学ぶならどちらか？
                </div>
                <div class="mx-auto align-middle">
                    <div class="w-8">
                        <img src="{{ asset('images/GR.png') }}" alt="GR">
                    </div>
                    <div class="text-center text-sm">983</div>
                </div>
            </div>
        </div>
        @endfor
    </div>

</div>