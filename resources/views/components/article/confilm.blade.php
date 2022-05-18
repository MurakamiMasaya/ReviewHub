<div class="px-5 md:px-10 text-gray-700">
    <div>
        <div class="border-b-2 border-gray-500 text-lg md:text-xl font-bold">イベント作成</div>
    </div>
    <div class="my-5 py-10 px-5 shadow-xl">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mt-4" :errors="$errors" />

        <form action="{{ route('article.register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $articleInfo['user_id'] }}">
            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ユーザー名 : 
                <input type="text" name="username" required readonly class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $articleInfo['username'] }}"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                性別 : 
                <input type="text" name="gender" required readonly class="w-20 shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $articleInfo['gender'] }}"/>
            </div>

            <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                タイトル(必須) : 
                <input type="text" name="title" maxlength="40" value="{{ $articleInfo['title'] }}" required readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                記事本文(必須) : 
                <textarea name="contents" rows="20" required readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $articleInfo['contents'] }}</textarea>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ヘッダー画像(推奨) : 
                <input type="hidden" name="image" value="{{ $articleInfo['image'] }}"/>
                <img src="{{ $articleInfo['image'] ? asset('/storage/articles/tmp/' . $articleInfo['image']) : 'https://placehold.jp/500x300.png' }}" >
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                参考文献URL(推奨) : 
                <input type="url" name="url" value="{{ $articleInfo['url'] }}" readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ハッシュタグ : 
                <textarea name="tag" rows="5" value="{{ $articleInfo['tag'] }}" readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $articleInfo['tag'] }}</textarea>
            </div>

            <div class="mt-10">
                <x-button.go-next text="記事内容の登録"/>
            </div>
            <div class="mt-10">
                <x-button.go-refere type="submit" text="記事作成に戻る"/>
            </div>
        </form>
    </div>
</div>