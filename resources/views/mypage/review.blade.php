<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto py-10 px-2 md:px-10">
        <div class="flex justify-between items-end">
            <div class="text-xl font-bold">Review一覧</div>
            <div class="">
                <a href="{{ route("mypage.index") }}"><div class="text-sm text-blue-500 font-bold">マイページに戻る</div></a>
            </div>
        </div>
        
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
                    <td class="w-5/12 md:w-6/12 text-xs p-1">{!! nl2br(e($review->review)) !!}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <delete-modal 
                            :text='@json('削除')'
                            :id='@json($review->id)'
                            :path='@json('company/review')'
                            :admin='@json(false)'
                            :auth='@json(Auth::check())'
                            :review='@json(true)'>
                        </delete-modal>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $allReviews[0]['c_reviews']->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($allReviews[0]['c_reviews'])===0)
                <div class="text-center font-bold mt-5 text-gray-500">Reviewは登録されていません</div>
            @endif
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
                    <td class="w-5/12 md:w-6/12 text-xs p-1">{!! nl2br(e($review->review)) !!}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <delete-modal 
                            :text='@json('削除')'
                            :id='@json($review->id)'
                            :path='@json('school/review')'
                            :admin='@json(false)'
                            :auth='@json(Auth::check())'
                            :review='@json(true)'>
                        </delete-modal>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $allReviews[0]['s_reviews']->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($allReviews[0]['s_reviews'])===0)
                <div class="text-center font-bold mt-5 text-gray-500">Reviewは登録されていません</div>
            @endif
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
                    <td class="w-4/12 md:w-5/12 text-xs p-1">{!! nl2br(e($review->review)) !!}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <delete-modal 
                            :text='@json('削除')'
                            :id='@json($review->id)'
                            :path='@json('event/review')'
                            :admin='@json(false)'
                            :auth='@json(Auth::check())'
                            :review='@json(true)'>
                        </delete-modal>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $allReviews[0]['e_reviews']->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($allReviews[0]['e_reviews'])===0)
                <div class="text-center font-bold mt-5 text-gray-500">Reviewは登録されていません</div>
            @endif
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
                    <td class="w-4/12 md:w-5/12 text-xs p-1">{!! nl2br(e($review->review)) !!}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $review->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $review->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <delete-modal 
                            :text='@json('削除')'
                            :id='@json($review->id)'
                            :path='@json('article/review')'
                            :admin='@json(false)'
                            :auth='@json(Auth::check())'
                            :review='@json(true)'>
                        </delete-modal>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $allReviews[0]['a_reviews']->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($allReviews[0]['a_reviews'])===0)
                <div class="text-center font-bold mt-5 text-gray-500">Reviewは登録されていません</div>
            @endif
        </div>
    </div>

    <!-- Footer Image -->
    <x-footer-image />
</x-app-layout>