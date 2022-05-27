<header class="bg-gray-500 shadow">
    <h2 class="hidden">Admin Header</h2>
    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-around items-center">
                <a href="{{ route('admin.company') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">企業</a>
                <a href="{{ route('admin.school') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">スクール</a>
                <a href="{{ route('admin.event') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">イベント</a>
                <a href="{{ route('admin.article') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">特集記事</a>
                <a href="{{ route('admin.user') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">ユーザー</a>
            </div>
        </div>
    </div>
</header>