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

                    <form id="delete_form" action="{{ route('admin.article.delete')}}" method="post">
                        @csrf
                        <div class="my-20 text-center">
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <button id="delete_button" type="button" class="px-5 py-3 bg-red-600 text-white rounded-lg font-semibold w-40 ">削除</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteForm = document.querySelector('#delete_form');
        const deleteButton = document.querySelector('#delete_button');

        deleteButton.addEventListener('click', function() {
            if(window.confirm('本当に削除しますか？')) {
                deleteForm.submit()
            }
        })
    </script>

</x-app-layout>