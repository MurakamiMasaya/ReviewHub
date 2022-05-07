<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <!-- Header Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-eye-catching-image />

    <div class="max-w-6xl mx-auto my-5 sm:my-10">
        <div class="md:flex">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5 ">
                <div class="block md:hidden">
                    <x-login-register />
                </div>
                <div class="border-4 border-gray-300 my-5 md:my-0">
                    <x-company.banner />
     
                    <x-company.ranking :companies="$companies"/>
     
                    {{-- #TODO: 後ほど条件から企業を検索できるようにするために、企業テーブルを編集する必要あり。
                        また以下を表示するために採用条件テーブルを2つ用意し、foreacheで表示する。 --}}
                    <x-company.search-by-conditions :conditions="$conditions" :stacks="$stacks" />
                </div>

            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3">
                <div class="hidden md:block">
                    <x-login-register />
                </div>

                {{-- #TODO: デザインがかなりもっさりしているの修正必須。
                    データを渡してforeachで表示する --}}
                <x-school.top-three />

                {{-- #TODO: tuncateがついていないので修正が必要かと
                    上記同様にデータを渡して、foreachで表示する。 --}}
                <x-article.top-eight />
                  
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-eye-catching-image />
</x-app-layout>