<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="flex justify-between items-end">
            <div class="text-xl font-bold">記事一覧</div>
            <div class="">
                <a href="{{ route("mypage.index") }}"><div class="text-sm text-blue-500 font-bold">マイページに戻る</div></a>
            </div>
        </div>
        
        {{-- ArticleShow --}}
        <div class="">
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">タイトル</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">内容</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">最終更新日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs sm:text-md px-1"></th>
                </tr>
                @foreach ($allArticles as $article)
                <tr class="border-b-2 border-gray-300">
                    <td class="w-2/12 text-xs p-1">{{ $article->title }}</td>
                    <td class="w-6/12 md:w-7/12 text-xs p-1">{{ $article->contents }}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $article->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $article->updated_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <a href="{{ route('mypage.article.edit', ['article' => $article->id]) }}">
                            <button class="px-1 sm:px-2 py-1 bg-green-400 text-white rounded-lg font-semibold">編集</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $allArticles->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($allArticles)===0)
                <div class="text-center font-bold mt-5 text-gray-500">記事は登録されていません</div>
            @endif
        </div>
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>