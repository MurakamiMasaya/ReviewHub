<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto py-10 px-2 md:px-10">
        <div class="flex justify-center items-end">
            <div class="text-xl font-bold mr-5">登録情報の編集</div>
            <div class="">
                <a href="{{ route("mypage.index") }}"><div class="text-sm text-blue-500 font-bold">マイページに戻る</div></a>
            </div>
        </div>
        
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
        <form method="post" action="{{ route('mypage.profile.register') }}" class="mt-10">
            @csrf

            <div class="mt-5 text-center">
                <label for="email" class="text-gray-500 ml-3">メールアドレスの変更は<a href="{{ route('mypage.reset-email') }}" class="text-blue-500">こちら</a></label>
                <x-input id="email" class="block w-72 text-gray-500 text-center mx-auto" type="email" name="email" value="{{ $user->email }}" required readonly/>
            </div>

            <div class="mt-5 text-center">
                <label for="password" class="text-gray-500 ml-3">パスワード(必須)</label>
                <x-input id="password" class="block w-72 text-center mx-auto"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <div class="mt-2 text-center">
                <label for="password_confirmation" class="text-gray-500 ml-3">パスワード確認用(必須)</label>
                <x-input id="password_confirmation" class="block w-72 text-center mx-auto"
                                type="password"
                                name="password_confirmation" required/>
            </div>

            <div class="mt-5 text-center">
                <label for="name" class="text-gray-500 ml-3">氏名(必須)</label>
                <x-input id="name" class="block w-72 text-center mx-auto" type="text" name="name" value="{{ $user->name }}" required/>
            </div>

            <div class="mt-5 text-center">
                <label for="birthday" class="text-gray-500 ml-3">生年月日(必須)</label>
                <x-input id="birthday" class="block w-72 text-center mx-auto" type="date" name="birthday" value="{{ $user->birthday }}" required />
            </div>
            
            <div class="mt-5 text-center">
                <label for="gender" class="text-gray-500 ml-3">性別(必須)</label>
                <div class="flex justify-center">
                    <div class="mr-3">
                        <input id="gender" type="radio" name="gender" value="0" required class="mr-1" @if( $user->gender == "0" ) checked @endif/>男性
                    </div>
                    <div>
                        <input id="gender" type="radio" name="gender" value="1" required class="mr-1" @if( $user->gender == "1" ) checked @endif/>女性
                    </div>
                </div>
            </div>
            
            <div class="mt-5 text-center">
                <label for="username" class="text-gray-500 ml-3">ユーザーネーム(必須)</label>
                <x-input id="username" class="block w-72 text-center mx-auto" type="text" name="username" value="{{ $user->username }}" required />
            </div>

            <div class="mt-5 text-center">
                <label for="phone" class="text-gray-500 ml-3">電話番号(必須)</label>
                <x-input id="phone" class="block w-72 text-center mx-auto" type="number" name="phone" value="{{ $user->phone }}" required />
            </div>

            <div class="mt-10">
                <x-button.go-next text="登録内容の更新"/>
            </div>
            <div class="mt-10">
                <x-button.go-refere type="button" route="mypage.index" text="マイページに戻る"/>
            </div>
        </form>

        <delete-modal 
            :text='@json('アカウントの削除')'
            :id='@json($user->id)'
            :path='@json('profile')'
            :admin='@json(false)'
            :auth='@json(Auth::check())'
            :delete-acount='@json(true)'>
        </delete-modal>
    </div>

    <!-- Footer Image -->
    <x-footer-image />

</x-app-layout>