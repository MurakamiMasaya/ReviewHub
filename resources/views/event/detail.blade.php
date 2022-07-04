<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-6xl mx-auto mb-5 sm:mb-10">
        <div class="md:flex">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5">
                <div>
                    <x-event.detail :event="$eventData" :reviews="$reviews" :user="$user" :reviewsAll="$AllReviews" path="event"
                    gr="event.gr" deleteGr="event.gr.delete" grReview="event.review.gr" deleteGrReview="event.review.gr.delete"/>
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

    <x-footer-image />
    <script src="{{ asset('js/review.js') }}"></script>
</x-app-layout>