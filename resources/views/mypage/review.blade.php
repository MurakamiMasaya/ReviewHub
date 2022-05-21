<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-5 sm:my-10 px-2 md:px-10">
        <div class="text-xl font-bold">Review一覧</div>
        
        {{-- CompanyReview --}}
        <div class="mt-5">
            <div class="text-lg font-bold text-center text-red-500">企業Review</div>
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">対象</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">review内容</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">作成日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs sm:text-md px-1"></th>
                </tr>
                @foreach ($allReviews[0]['c_reviews'] as $review)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-3/12 text-xs p-1">{{ $review->company->name }}</td>
                    <td class="w-5/12 md:w-6/12 text-xs p-1">{{ $review->review }}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <form action="{{ route('company.review.delete', ['id' => $review->id]) }}" method="post">
                        @csrf
                        <button data-id="{{ $review->id }}" onClick="return deletePost(this);" class="px-1 sm:px-2 py-1 bg-red-400 text-white rounded-lg font-semibold">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        {{-- SchoolReview --}}
        <div class="mt-5">
            <div class="text-lg font-bold text-center text-red-500">スクールReview</div>
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">対象</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">review内容</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">作成日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs px-1"></th>
                </tr>
                @foreach ($allReviews[0]['s_reviews'] as $review)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-3/12 text-xs p-1">{{ $review->school->name }}</td>
                    <td class="w-5/12 md:w-6/12 text-xs p-1">{{ $review->review }}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <form action="{{ route('school.review.delete', ['id' => $review->id]) }}" method="post">
                        @csrf
                        <button data-id="{{ $review->id }}" onClick="return deletePost(this);" class="px-1 sm:px-2 py-1 bg-red-400 text-white rounded-lg font-semibold">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        {{-- EventReview --}}
        <div class="mt-5">
            <div class="text-lg font-bold text-center text-red-500">イベントReview</div>
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">対象</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">review内容</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">作成日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs px-1"></th>
                </tr>
                @foreach ($allReviews[0]['e_reviews'] as $review)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-4/12 text-xs p-1">{{ $review->event->title }}</td>
                    <td class="w-4/12 md:w-5/12 text-xs p-1">{{ $review->review }}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <form action="{{ route('event.review.delete', ['id' => $review->id]) }}" method="post">
                        @csrf
                        <button data-id="{{ $review->id }}" onClick="return deletePost(this);" class="px-1 sm:px-2 py-1 bg-red-400 text-white rounded-lg font-semibold">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {{-- ArticleReview --}}
        <div class="mt-5">
            <div class="text-lg font-bold text-center text-red-500">記事Review</div>
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">対象</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">review内容</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">作成日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs px-1"></th>
                </tr>
                @foreach ($allReviews[0]['a_reviews'] as $review)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-4/12 text-xs p-1">{{ $review->article->title }}</td>
                    <td class="w-4/12 md:w-5/12 text-xs p-1">{{ $review->review }}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <form action="{{ route('article.review.delete', ['id' => $review->id]) }}" method="post">
                        @csrf
                        <button data-id="{{ $review->id }}" onClick="return deletePost(this);" class="px-1 sm:px-2 py-1 bg-red-400 text-white rounded-lg font-semibold">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />

    {{-- #FIXME: confilmでキャンセルを押しても、POST送信されてしまう。--}}
    <script>
        function deletePost(e) {
            if(confirm('本当に削除しますか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>