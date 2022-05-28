<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
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

        <form id="delete_form" action="{{ route('admin.user.delete') }}" method="post">
            @csrf
            <div class="my-20 text-center">
                <button id="delete_button" type="button" class="px-5 py-3 bg-red-600 text-white rounded-lg font-semibold w-48">アカウントの削除</button>
            </div>
        </form>
    </div>

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