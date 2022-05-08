<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-6xl mx-auto my-5 sm:my-10">
        <div class="md:flex">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5 ">
                @if(!Auth::check())
                <div class="block md:hidden">
                    <x-login-register />
                </div>
                @endif

                <div class="border-4 border-gray-300 my-5 md:my-0">
                    <x-company.banner />
     
                    <x-company.ranking :companies="$companies"/>
                    </div>

            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3">
                @if(!Auth::check())
                <div class="md:block hidden">
                    <x-login-register />
                </div>
                @endif

                {{-- #TODO: デザインがかなりもっさりしているの修正必須。
                    データを渡してforeachで表示する --}}
                <x-school.top-three :schools="$schools"/>

                {{-- #TODO: tuncateがついていないので修正が必要かと
                    上記同様にデータを渡して、foreachで表示する。 --}}
                <x-article.top-eight :articles="$articles"/>
                  
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-eye-catching-image />
</x-app-layout>