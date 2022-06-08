<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-6xl mx-auto mb-5 sm:mb-10">
        <div class="md:flex relative">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5 ">
                <div>
                    <x-school.banner />
                    <x-school.ranking :schools="$schools"/>
                </div>

            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3 mt-10">
                @if(!Auth::check())
                <div>
                    <x-login-register />
                </div>
                @endif

                {{-- #TODO: デザインがかなりもっさりしているの修正必須かな --}}
                <x-company.top-three :companies="$companies"/>
                <x-article.top-eight :articles="$articles"/>
                  
            </div>
            <x-bg-text first="JavaScript" second="TypeScript"/>
        </div>
    </div>


    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>