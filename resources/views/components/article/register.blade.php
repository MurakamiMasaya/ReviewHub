<div class="px-5 md:px-10 text-gray-700">
    <div>
        <div class="border-b-2 border-gray-500 text-lg md:text-xl font-bold">イベント作成</div>
    </div>
    <div class="my-5 py-10 px-5 shadow-xl">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mt-4" :errors="$errors" />

        <form action="{{ route('article.confilm') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ユーザー名 : 
                <input type="text" name="username" required readonly class="shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $user->username }}"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                性別 : 
                <input type="text" name="gender" required readonly class="w-20 shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $user->gender === 0 ? '女性' : '男性' }}"/>
            </div>

            <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                タイトル(必須) : 
                <input type="text" name="title" maxlength="40" value="{{ old('title') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="SSRとSSGについて"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                記事本文(必須) : 
                <textarea name="contents" rows="20" value="{{ old('contents') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="今話題のSPA、SSR、SSGについて最近覚えたことを書いていきます！">{{ old('contents') }}</textarea>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ヘッダー画像(推奨) : 
                <input type="file" name="image" accept="image/png,image/jpeg,image/jpg" class="shadow appearance-none border w-full rounded px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                参考文献URL : 
                <input type="url" name="url" value="{{ old('url') }}" class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="https://reviewhub.com"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ハッシュタグ : 
                <textarea name="tag" rows="5" class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="#Vue&#10;#React&#10;#Nuxt&#10;#Next">{{ old('tag') }}</textarea>
            </div>

            <div class="mt-10">
                <x-button.go-next text="記事内容の確認"/>
            </div>
            <div class="mt-10">
                <x-button.go-refere type="button" route="article.index" text="記事一覧に戻る"/>
            </div>
        </form>
    </div>
</div>