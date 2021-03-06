<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <!-- Header Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-header-image />

    <div class="max-w-6xl mx-auto mb-5 sm:mb-10">
        <div class="md:flex relative">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5 ">
                <div class="my-5 md:my-0">
                    <x-company.banner />
     
                    <x-company.ranking :companies="$companies"/>
                </div>

            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3">
                @if(!Auth::check())
                <div class="">
                    <x-login-register />
                </div>
                @endif

                <x-school.top-three :schools="$schools" />

                <x-article.top-eight :articles="$articles" />
                
                {{-- <div class="hidden md:block">
                    <stripe-banner />
                </div> --}}
            </div>
            <x-bg-text first="ReviewHub" second="ReviewHub"/>
        </div>
    </div>


    <!-- Footer Image -->
    <x-footer-image />
</x-app-layout>