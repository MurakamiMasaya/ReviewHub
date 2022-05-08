<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-6xl mx-auto my-5 sm:my-10">
        <div class="md:flex">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5 ">
                <div class="block md:hidden">
                    <x-login-register />
                </div>
                <div class="border-4 border-gray-300 my-5 md:my-0">
                    <x-school.banner />
                    <x-school.ranking :schools="$schools"/>
                </div>

            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3">
                <div class="hidden md:block">
                    <x-login-register />
                </div>

                {{-- #TODO: デザインがかなりもっさりしているの修正必須かな --}}
                <x-company.top-three :companies="$companies"/>
                <x-article.top-eight :articles="$articles"/>
                  
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>