<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-6xl mx-auto mb-5 sm:mb-10">
        <div class="md:flex">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5 ">
                <div>
                    <x-candidates :target="$target" :searchResults="$articles" :targetsAll="$allArticles" flg="article" 
                    title="記事" gr="article.gr" deleteGr="article.gr.delete"/>
                </div>
            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3 mt-10">
                @if(!Auth::check())
                <div>
                    <x-login-register />
                </div>
                @endif

                <x-school.top-three :schools="$schools"/>
                <x-company.top-three :companies="$companies" />
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-footer-image />
</x-app-layout>