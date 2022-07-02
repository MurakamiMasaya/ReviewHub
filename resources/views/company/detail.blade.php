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
                    <x-detail :detail="$companyData" :reviews="$reviews" title="企業" route="company.review" path="company"
                    gr="company.gr" deleteGr="company.gr.delete" grReview="company.review.gr" deleteGrReview="company.review.gr.delete"/>
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
                <x-article.top-eight :articles="$articles"/>
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-footer-image />
</x-app-layout>