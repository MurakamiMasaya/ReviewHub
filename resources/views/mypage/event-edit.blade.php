<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto py-10 px-2 md:px-10">
        <div class="px-5 md:px-10 text-gray-700">
            <div>
                <div class="border-b-2 border-gray-500 text-lg md:text-xl font-bold">イベント編集</div>
            </div>
            <div class="my-5 py-10 px-5 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form action="{{ route('mypage.event.confilm') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <input type="hidden" name="user_id" value="{{ $event->user_id }}">
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        ユーザー名 : 
                        <input type="text" name="username" required readonly class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $event->user->username }}"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        性別 : 
                        <input type="text" name="gender" required readonly class="w-20 shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $event->user->gender }}"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        電話番号(必須) : 
                        <input type="number" name="contact_address" value="{{ $event->contact_address }}" required class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        メールアドレス(必須) : 
                        <input type="text" name="contact_email" value="{{ $event->contact_email }}" required class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight" />
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        イベント種別(必須) : 
                        <input type="checkbox" name="segment" value="1" class="rounded-full mr-1" @if( $event->segment == "1" ) checked @endif/>勉強会
                        <input type="checkbox" name="segment" value="2" class="rounded-full mr-1" @if( $event->segment == "2" ) checked @endif/>その他
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        オンラインタグ : 
                        <input type="checkbox" name="online" value="1" class="rounded-full mr-1" @if( $event->online == "1" ) checked @endif/>オンライン
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        開催地 : 
                        <input type="text" name="area" maxlength="20" value="{{ $event->area }}" class="shadow border-none rounded py-2 px-3 text-gray-700 leading-tight"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        定員(必須) : 
                        <input type="number" name="capacity" min="1" max="100" value="{{ $event->capacity }}" required class="shadow border-none w-20 rounded py-2 px-3 text-gray-700 leading-tight"/>
                        <div class="text-xs font-bold text-gray-500">※最大100名でご記入ください。</div>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        開始日(必須) : 
                        <input type="date" name="start_date" value="{{ $event->start_date->format('Y-m-d') }}" required class="shadow border-none w-40 rounded py-2 px-3 text-gray-700 leading-tight"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        終了日(必須) : 
                        <input type="date" name="end_date" value="{{ $event->end_date->format('Y-m-d') }}" required class="shadow border-none w-40 rounded py-2 px-3 text-gray-700 leading-tight"/>
                    </div>

                    <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                        タイトル(必須) : 
                        <input type="text" name="title" maxlength="40" value="{{ $event->title }}" required class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
                        <div class="text-xs font-bold text-gray-500">※40文字以内でご記入ください。</div>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        イベント本文(必須) : 
                        <textarea name="contents" rows="20" required class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $event->contents }}</textarea>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        ヘッダー画像(推奨) : 
                        <input type="file" name="image" value="{{ $event->image }}"/>
                        <img src="{{ $event->image ? asset('/storage/events/' . $event->image) : 'https://placehold.jp/500x400.png' }}" >
                        <div class="text-xs font-bold text-gray-500">※推奨サイズ: 横幅500px 縦幅400px</div>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        イベントURL(推奨) : 
                        <input type="url" name="url" value="{{ $event->url }}" class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight"/>
                    </div>
        
                    <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                        ハッシュタグ : 
                        <textarea name="tag" rows="5" value="{{ $event->tag }}" class="shadow border-none w-full rounded py-2 px-3 text-gray-700 leading-tight">{{ $event['tag'] }}</textarea>
                    </div>
        
                    <div class="mt-10">
                        <x-button.go-next text="イベント内容の確認"/>
                    </div>
                    <div class="mt-10">
                        <x-button.go-refere type="button" route="mypage.event" text="イベント一覧に戻る"/>
                    </div>
                </form>

                <form id="delete_form" action="{{ route('event.delete', ['event' => $event->id]) }}" method="post">
                    @csrf
                    <div class="my-20 text-center">
                        <button id="delete_button" type="button" class="px-5 py-3 bg-red-600 text-white rounded-lg font-semibold w-40 ">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />

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