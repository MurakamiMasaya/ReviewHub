<x-app-layout>

    <!-- Admin Bar -->
    @if(isset($user) && $user->admin_flg === 1)
    <header class="bg-gray-500 shadow">
        <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl">
                <div class="flex justify-around items-center">
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">企業登録</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">スクール登録</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">イベント一覧</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">特集記事一覧</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">ユーザー一覧</a>
                </div>
            </div>
        </div>
    </header>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    TopPage!!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>