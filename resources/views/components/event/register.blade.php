<div class="px-5 md:px-10 text-gray-700">
    <div>
        <div class="border-b-2 border-gray-500 text-lg md:text-xl font-bold">イベント作成</div>
    </div>
    <div class="my-5 py-10 px-5 shadow-xl">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mt-4" :errors="$errors" />

        <form action="{{ route('event.confilm') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ユーザー名 : <span class="text-gray-500">{{ $user->username }}</span>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                性別 : <span class="text-gray-500">{{ $user->gender === 0 ? '女性' : '男性' }}</span>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                電話番号 : 
                <input type="number" name="contact_address" value="{{ old('contact_address') }}" required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="{{ $user->phone }}"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                メールアドレス : 
                <input type="text" name="contact_email" value="{{ old('contact_email') }}" required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="{{ $user->email }}"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                イベント種別 : 
                <input type="checkbox" name="segment" value="1" class="rounded-full mr-1" @if(old('segment') === "1" ) checked @endif/>勉強会
                <input type="checkbox" name="segment" value="2" class="rounded-full mr-1" @if(old('segment') === "2" ) checked @endif/>その他
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                オンラインタグ : 
                <input type="checkbox" name="online" value="1" class="rounded-full mr-1" @if(old('online') === "1" ) checked @endif/>オンライン
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                開催地 : 
                <input type="text" name="area" maxlength="20" value="{{ old('area') }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="東京都渋谷"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                定員 : 
                <input type="number" name="capacity" min="1" max="100" value="{{ old('capacity') }}" required class="shadow appearance-none border w-20 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="20"/>
                <div class="text-xs font-bold text-gray-500">※最大100名でご記入ください。</div>
            </div>

            <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                タイトル(必須) : 
                <input type="text" name="title" maxlength="40" value="{{ old('title') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="渋谷で行うlaravelもくもく会"/>
                <div class="text-xs font-bold text-gray-500">※40文字以内でご記入ください。</div>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                イベント本文(必須) : 
                <textarea name="contents" rows="20" value="{{ old('contents') }}" required class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="開催日は2022年5月1日 15:00-17:00&#10;&#10;現役エンジニアを講師としてお招きし、みなさんでバックエンドの知見を深めます。&#10;&#10;ご興味のある方は記載の電話番号、もしくはメールアドレスからご連絡ください！">{{ old('contents') }}</textarea>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ヘッダー画像 : 
                <input type="file" name="image" accept="image/png,image/jpeg,image/jpg" class="shadow appearance-none border w-full rounded px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                イベントURL : 
                <input type="url" name="url" value="{{ old('url') }}" class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="https://reviewhub.com"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ハッシュタグ : 
                <textarea name="tag" rows="5" value="{{ old('tag') }}" class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="#laravel&#10;#もくもく会&#10;#バックエンド&#10;#渋谷"></textarea>
            </div>

            <div class="mt-10">
                <x-button.go-next text="イベント内容の確認"/>
            </div>
            <div class="mt-10">
                <x-button.go-refere text="イベント一覧に戻る"/>
            </div>
        </form>
    </div>
</div>