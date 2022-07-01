<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="md:px-10 text-gray-700">
            <div>
                <div class="text-xl md:text-2xl font-bold text-red-500">イベント情報の確認</div>
            </div>
            <div class="my-5 p-5 md:p-10 shadow-xl">
        
                <x-detail-top :target="$article" fileName="articles"/>

                <div class="">

                    <div class="mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">記事内容 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $article->contents }}</div>
                    </div>

                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">ハッシュタグ : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $article->tag }}</div>
                    </div>

                    <delete-modal 
                        :text='@json('特集記事の削除')'
                        :id='@json($article->id)'
                        :path='@json('article')'
                        :admin='@json(true)'
                        :auth='@json(Auth::check())'>
                    </delete-modal>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>