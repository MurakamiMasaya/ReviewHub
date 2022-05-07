<footer class="">
    <div class="bg-red-400 shadow">
        <div class="mx-auto py-6 px-2 md:px-5">
            <div class="max-w-6xl">
                <div class="flex justify-around items-center">
                    <a href="{{ route('company.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-1 lg:mr-5">企業情報</a>
                    <a href="{{ route('school.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-1 lg:mr-5">スクール情報</a>
                    <a href="{{ route('event.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-1 lg:mr-5">イベント情報</a>
                    <a href="{{ route('article.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">特集記事</a>
                </div>
            </div>
        </div>
    </div>
    <div class="lg:flex justify-between items-center py-5 px-5">
        <div class="flex justify-end">
            <a href="#">
                <div class="mr-3 md:mr-5 text-gray-800 text-sm font-bold">サイトマップ</div>
            </a>
            <a href="">
                <div class="mr-3 md:mr-5 text-gray-800 text-sm font-bold">お問い合わせ</div>
            </a>
            <a href="">
                <div class="mr-3 md:mr-5 text-gray-800 text-sm font-bold">マイページ</div>
            </a>
        </div>
        <div class="md:flex items-center justify-end mt-5 lg:mt-0">
            <div class="w-36 sm:w-40 md:w-48 mr-0 md:mr-3">
                <a href="{{ route('top') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
            </div>
            <div class="flex mt-1 md:mt-0">
                <x-company.search />
                <x-school.search />
            </div>
        </div>
    </div>
    <div class="text-center text-sm py-5">
        &copy; ReviewHub All Right Reserved.
    </div>

</footer>