<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative">

    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center pl-3 sm:pl-10 lg:pl-20">
                <div class="w-28 sm:w-40 md:w-48">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>
            <div class="hidden sm:block my-auto pr-5 sm:pr-10 lg:pr-20">
                <div>
                    <a href="#" class="text-sm font-bold text-gray-700 dark:text-gray-500">お問い合わせ</a>
                    <a href="#" class="ml-5 text-sm font-bold text-gray-700 dark:text-gray-500">マイページ</a>
                </div>
                <div class="">
                    @auth
                        <a href="{{ url('/logout') }}" class="text-sm font-bold text-red-600 dark:text-red-500">ログアウト</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-red-600 dark:text-red-500">ログイン</a>
                        <a href="{{ route('register') }}" class="ml-5 lg:ml-10 text-sm font-bold text-red-600 dark:text-red-500">新規登録</a>
                    @endauth
                </div>
            </div>

            <!-- Responsive Group -->
            <div class="flex md:hidden">
                <!-- Responsive Icon -->
                <div class="flex sm:hidden items-center">
                    @auth
                        <div class="mr-2">
                            <a href="{{ route('logout') }}">
                                <div class="w-8 mx-auto"><img src="{{ asset('images/logout.png') }}" alt=""></div>
                                <div class="text-xs text-gray-500">ログアウト</div>
                            </a>
                        </div>
                    @else
                        <div class="mr-2">
                            <a href="{{ route('register') }}">
                                <div class="w-8 mx-auto"><img src="{{ asset('images/register.png') }}" alt=""></div>
                                <div class="text-xs text-gray-500">新規登録</div>
                            </a>
                        </div>
                        <div class="mr-2">
                            <a href="{{ route('login') }}">
                                <div class="w-8 mx-auto"><img src="{{ asset('images/login.png') }}" alt=""></div>
                                <div class="text-xs text-gray-500">ログイン</div>
                            </a>
                        </div>
                    @endauth
                </div>
    
                <!-- Hamburger -->
                <div class="flex items-center sm:hidden bg-red-500 px-3 z-10">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white focus:outline-nonetransition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden absolute top-0 left-0 bg-gray-300 h-full w-full opacity-50"></div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden absolute top-0 left-0 bg-white w-40 h-96">
        <div>
            <div class="flex justify-center items-center h-16">
                <div class="w-28">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>
            <div class="text-center">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    企業情報
                </x-responsive-nav-link>
            </div>
            <div class="text-center">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    スクール情報
                </x-responsive-nav-link>
            </div>
            <div class="text-center">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    イベント情報
                </x-responsive-nav-link>
            </div>
            <div class="text-center">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    特集記事
                </x-responsive-nav-link>
            </div>
            <div class="text-center">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    マイページ
                </x-responsive-nav-link>
            </div>
        </div>
    </div>

    <!-- Top Bar -->
    <header class="bg-red-500 shadow">
        <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto flex justify-center sm:justify-between items-center">
                <div class="flex">
                    {{-- todo: inputにフォーカスした時、青い枠線が出現する --}}
                    <form action="#" method="post" class="mr-2 lg:mr-5 w-32 md:w-48">
                        <input class="text-sm bg-white appearance-none border-2 border-white rounded w-full py-2 px-2 md:px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-300"
                        type="text" name="" value="会社を検索">
                    </form>
                    <form action="#" method="post" class="mr-2 w-32 md:w-48">
                        <input class="text-sm bg-white appearance-none border-2 border-white rounded w-full py-2 px-2 md:px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-300"
                        type="text" name="" value="スクールを検索">
                    </form>
                </div>
                <div class="hidden sm:block">
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">企業情報</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">スクール情報</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">イベント情報</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">特集記事</a>
                </div>
            </div>
        </div>
    </header>
</nav>
