<nav class="bg-gray-50 border-b border-gray-50 top-0 z-10 w-full"/>

    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="shrink-0 flex items-center ml-2 sm:ml-5 md:ml-10 lg:ml-20">
                <div class="w-36 sm:w-40 md:w-48">
                    <a href="{{ route('top') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>
            <div class="hidden sm:flex justify-end">
                <div class="pr-5 my-auto">
                    <div>
                        <a href="{{ route('sitemap') }}" class="mr-2 lg:mr-4 text-xs font-bold text-gray-700 dark:text-gray-500">サイトマップ</a>
                        <a href="{{ route('contact') }}" class="mr-2 lg:mr-4 text-xs font-bold text-gray-700 dark:text-gray-500">お問い合わせ</a>
                        <a href="{{ route('mypage.index') }}" class="text-xs font-bold text-gray-700 dark:text-gray-500">マイページ</a>
                    </div>
                    <div class="text-right">
                        @auth
                            <a href="{{ url('/logout') }}" class="text-sm font-bold text-red-600 dark:text-red-500">ログアウト</a>
                        @else
                            <a href="{{ route('login') }}" class="mr-2 lg:mr-4 text-sm font-bold text-red-600 dark:text-red-500">ログイン</a>
                            <a href="{{ route('register') }}" class="text-sm font-bold text-red-600 dark:text-red-500">新規登録</a>
                        @endauth
                    </div>
                </div>
                <top-image></top-image>
            </div>

            <!-- Responsive Group -->
            <div class="flex md:hidden">
                <!-- Responsive Icon -->
                <div class="flex sm:hidden items-center">
                    @auth
                        <div class="mr-1 sm:mr-2">
                            <a href="{{ route('logout') }}">
                                <div class="w-5 sm:w-8 mx-auto">
                                    <img src="{{ asset('images/logout.png') }}" alt="">
                                </div>
                                <div class="text-gray-800 text-xs font-semibold md:font-bold mt-1">
                                    ログアウト
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="mr-1 sm:mr-2">
                            <a href="{{ route('register') }}">
                                <div class="w-5 sm:w-8 mx-auto">
                                    <img src="{{ asset('images/register.png') }}" alt="">
                                </div>
                                <div class="text-gray-800 text-xs font-semibold md:font-bold mt-1">
                                    新規登録
                                </div>
                            </a>
                        </div>
                        <div class="mr-1 sm:mr-3">
                            <a href="{{ route('login') }}">
                                <div class="w-5 sm:w-8 mx-auto">
                                    <img src="{{ asset('images/login.png') }}" alt="">
                                </div>
                                <div class="text-gray-800 text-xs font-semibold md:font-bold mt-1">
                                    ログイン
                                </div>
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Hamburger -->
                <switching-humburger></switching-humburger>
            </div>
        </div>
    </div>

    <!-- Top Bar -->
    <header class="bg-gradient-to-r from-pink-500 via-orange-500 to-red-500 hover:from-red-500 hover:via-orange-500 hover:to-pink-500 shadow">
        <div class="mx-auto py-3 md:py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto flex justify-center sm:justify-between items-center">
                <div class="flex">
                    <x-company.search route="company.search"/>
                    <x-school.search route="school.search"/>
                </div>
                <div class="hidden sm:block">
                    <a href="{{ route('company.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">企業情報</a>
                    <a href="{{ route('school.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">スクール情報</a>
                    <a href="{{ route('event.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">イベント情報</a>
                    <a href="{{ route('article.index') }}" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">記事情報</a>
                </div>
            </div>
        </div>
    </header>
</nav>
