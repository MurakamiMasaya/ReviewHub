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
                    <x-article.banner />
                    <x-article.ranking :articles="$articles"/>
                </div>
            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3">
                <div class="hidden md:block">
                    <x-login-register />
                </div>

                <x-school.top-three :schools="$schools"/>
                <x-company.top-three :companies="$companies" />
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-eye-catching-image />
</x-app-layout>