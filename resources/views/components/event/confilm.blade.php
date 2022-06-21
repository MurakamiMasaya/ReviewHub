<div class="p-5 md:p-10 text-gray-700">
    <div>
        <div class="border-b-2 border-gray-500 text-lg md:text-xl font-bold">イベント作成</div>
    </div>
    <div class="my-5 py-10 px-5 shadow-xl">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mt-4" :errors="$errors" />

        <form action="{{ route('event.register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $eventInfo['user_id'] }}">
            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ユーザー名 : 
                <input type="text" name="username" required readonly class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $eventInfo['username'] }}"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                性別 : 
                <input type="text" name="gender" required readonly class="w-20 shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $eventInfo['gender'] }}"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                電話番号(必須) : 
                <input type="number" name="contact_address" value="{{ $eventInfo['contact_address'] }}" required readonly class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                メールアドレス(必須) : 
                <input type="text" name="contact_email" value="{{ $eventInfo['contact_email'] }}" required readonly class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" />
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                イベント種別(必須) : 
                <input type="checkbox" name="segment" value="1" onclick='return false;' class="rounded-full mr-1" @if( $eventInfo['segment'] === "1" ) checked @endif/>勉強会
                <input type="checkbox" name="segment" value="2" onclick='return false;' class="rounded-full mr-1" @if( $eventInfo['segment'] === "2" ) checked @endif/>その他
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                オンラインタグ : 
                <input type="checkbox" name="online" value="1" onclick='return false;' class="rounded-full mr-1" @if( $eventInfo['online'] === "1" ) checked @endif/>オンライン
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                開催地 : 
                <input type="text" name="area" maxlength="20" readonly value="{{ $eventInfo['area'] }}" class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                定員(必須) : 
                <input type="number" name="capacity" min="1" max="100" value="{{ $eventInfo['capacity'] }}" required readonly class="shadow border-none w-20 rounded py-2 px-3 text-gray-700 leading-tight"/>
                <div class="text-xs font-bold text-gray-500">※最大100名でご記入ください。</div>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                開始日(必須) : 
                <input type="date" name="start_date" value="{{ $eventInfo['start_date'] }}" required readonly class="shadow border-none w-40 rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                終了日(必須) : 
                <input type="date" name="end_date" value="{{ $eventInfo['end_date'] }}" required readonly class="shadow border-none w-40 rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                タイトル(必須) : 
                <input type="text" name="title" maxlength="40" value="{{ $eventInfo['title'] }}" required readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
                <div class="text-xs font-bold text-gray-500">※40文字以内でご記入ください。</div>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                イベント本文(必須) : 
                <textarea name="contents" rows="20" required readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $eventInfo['contents'] }}</textarea>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ヘッダー画像(推奨) : 
                <input type="hidden" name="image" value="{{ $eventInfo['image'] }}"/>
                <img src="{{ $eventInfo['image'] ? asset('/storage/events/tmp/' . $eventInfo['image']) : 'https://placehold.jp/500x400.png' }}" >
                <div class="text-xs font-bold text-gray-500">※推奨サイズ: 横幅500px 縦幅400px</div>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                イベントURL(推奨) : 
                <input type="url" name="url" value="{{ $eventInfo['url'] }}" readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
            </div>

            <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                ハッシュタグ : 
                <textarea name="tag" rows="5" value="{{ $eventInfo['tag'] }}" readonly class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $eventInfo['tag'] }}</textarea>
            </div>

            <div class="mt-10">
                <x-button.go-next text="イベント内容の登録"/>
            </div>
            <div class="mt-10">
                <x-button.go-refere type="submit" text="イベント作成に戻る"/>
            </div>
        </form>
    </div>
</div>