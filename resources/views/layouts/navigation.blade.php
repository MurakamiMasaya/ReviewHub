<nav class="bg-gray-50 border-b border-gray-50 top-0 z-10 w-full"/>

    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center pl-3 sm:pl-10 lg:pl-20">
                <div class="w-36 sm:w-40 md:w-48">
                    <a href="{{ route('top') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>
            <div class="hidden sm:flex items-center justify-end sm:pr-10 lg:pr-20">
                <div class="pr-5">
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
                <div>
                    <a href="{{ route('event.index') }}">
                        <img src="{{ asset('images/event.png') }}" alt="">
                    </a>
                </div>
            </div>

            <!-- Responsive Group -->
            <div class="flex md:hidden">
                <!-- Responsive Icon -->
                <div class="flex sm:hidden items-center">
                    @auth
                        <div class="mr-3">
                            <a href="{{ route('logout') }}">
                                <div class="w-8 mx-auto" data-tooltip-target="tooltip-logout" data-tooltip-style="light">
                                    <img src="{{ asset('images/logout.png') }}" alt="">
                                </div>
                                <div id="tooltip-logout" role="tooltip" class="inline-block absolute invisible z-20 py-2 px-3 text-sm font-bold text-red-500 bg-white rounded-lg border-2 border-red-300 shadow-sm opacity-0 tooltip">
                                    ログアウト
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="mr-3">
                            <a href="{{ route('register') }}">
                                <div class="w-8 mx-auto" data-tooltip-target="tooltip-register" data-tooltip-style="light">
                                    <img src="{{ asset('images/register.png') }}" alt="">
                                </div>
                                <div id="tooltip-register" role="tooltip" class="inline-block absolute invisible z-20 py-2 px-3 text-sm font-bold text-red-500 bg-white rounded-lg border-2 border-red-300 shadow-sm opacity-0 tooltip">
                                    新規登録
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </a>
                        </div>
                        <div class="mr-3">
                            <a href="{{ route('login') }}">
                                <div class="w-8 mx-auto" data-tooltip-target="tooltip-login" data-tooltip-style="light">
                                    <img src="{{ asset('images/login.png') }}" alt="">
                                </div>
                                <div id="tooltip-login" role="tooltip" class="inline-block absolute invisible z-20 py-2 px-3 text-sm font-bold text-red-500 bg-white rounded-lg border-2 border-red-300 shadow-sm opacity-0 tooltip">
                                    ログイン
                                    <div class="tooltip-arrow" data-popper-arrow></div>
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
