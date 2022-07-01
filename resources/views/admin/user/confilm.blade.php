<x-app-layout>
    <!-- Admin Header -->
    @if(isset($admin) && $admin->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">

        <div class="mt-5 text-center">
            <label class="text-gray-500">氏名</label>
            <div class="font-bold text-center">{{ $user->name }}</div>
        </div>

        <div class="mt-5 text-center">
            <label class="text-gray-500">ユーザーネーム</label>
            <div class="font-bold text-center">{{ $user->username }}</div>
        </div>

        <div class="mt-5 text-center">
            <label class="text-gray-500">性別</label>
            <div class="font-bold text-center">{{ $user->gender == 0 ? '男性' : '女性' }}</div>
        </div>

        <div class="mt-5 text-center">
            <label class="text-gray-500">生年月日</label>
            <div class="font-bold text-center" >{{ $user->birthday }}</div>
        </div>
        
        <div class="mt-5 text-center">
            <label class="text-gray-500">メールアドレス</label>
            <div class="font-bold text-center" >{{ $user->email }}</div>
        </div>

        <div class="mt-5 text-center">
            <label class="text-gray-500">電話番号</label>
            <div class="font-bold text-center" >{{ $user->phone }}</div>
        </div>

        <delete-modal 
            :text='@json('アカウントの削除')'
            :id='@json($user->id)'
            :path='@json('user')'
            :admin='@json(true)'
            :auth='@json(Auth::check())'>
        </delete-modal>
        
    </div>

</x-app-layout>