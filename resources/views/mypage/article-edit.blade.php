<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto py-10 px-2 md:px-10">
        <div class="px-5 md:px-10 text-gray-700">
            <div>
                <div class="border-b-2 border-gray-500 text-lg md:text-xl font-bold">記事編集</div>
            </div>
            <div class="my-5 py-10 px-5 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form action="{{ route('mypage.article.confilm') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $article->id }}">
                    <input type="hidden" name="user_id" value="{{ $article->user_id }}">
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        ユーザー名 : 
                        <input type="text" name="username" required readonly class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $article->user->username }}"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        性別 : 
                        <input type="text" name="gender" required readonly class="w-20 shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $article->user->gender }}"/>
                    </div>
        
                    <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                        タイトル(必須) : 
                        <input type="text" name="title" maxlength="40" value="{{ $article->title }}" required class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
                        <div class="text-xs font-bold text-gray-500">※40文字以内でご記入ください。</div>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        記事本文(必須) : 
                        <textarea name="contents" rows="20" required class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $article->contents }}</textarea>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        ヘッダー画像(推奨) : 
                        <input type="file" name="image" value="{{ $article->image }}"/>
                        <img src="{{ $article->image ? asset('/storage/articles/' . $article->image) : 'https://placehold.jp/500x400.png' }}" >
                        <div class="text-xs font-bold text-gray-500">※推奨サイズ: 横幅500px 縦幅400px</div>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        参考文献URL(推奨) : 
                        <input type="url" name="url" value="{{ $article->url }}" class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        ハッシュタグ : 
                        <textarea name="tag" rows="5" value="{{ $article->tag }}" class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $article['tag'] }}</textarea>
                    </div>
        
                    <div class="mt-10">
                        <x-button.go-next text="記事内容の確認"/>
                    </div>
                    <div class="mt-10">
                        <x-button.go-refere type="button" route="mypage.article" text="記事一覧に戻る"/>
                    </div>
                </form>

                <delete-modal 
                    :text='@json('記事の削除')'
                    :id='@json($article->id)'
                    :path='@json('article')'
                    :admin='@json(false)'
                    :auth='@json(Auth::check())'>
                </delete-modal>
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    <x-footer-image />
</x-app-layout>