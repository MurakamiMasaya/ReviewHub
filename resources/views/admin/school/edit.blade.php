<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="md:px-10 text-gray-700">
            <div>
                <div class="text-xl md:text-2xl font-bold text-red-500">スクールの編集</div>
            </div>
            <div class="my-5 p-5 md:p-10 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form action="{{ route('admin.school.confilm') }}" method="post">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ $school->id }}">
                    
                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        スクール名 : 
                        <input type="text" name="name" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $school->name }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        住所 : 
                        <input type="text" name="address" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $school->address }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        電話番号 : 
                        <input type="number" name="phone" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $school->phone }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        WebサイトURL : 
                        <input type="text" name="website_url" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $school->website_url }}"/>
                    </div>

                    <div class="mt-10">
                        <x-button.go-next text="スクール情報の確認"/>
                    </div>
                    <div class="mt-10">
                        <x-button.go-refere type="button" route="admin.school" text="スクール一覧に戻る"/>
                    </div>
                </form>

                <delete-modal 
                    :text='@json('スクールの削除')'
                    :id='@json($school->id)'
                    :path='@json('school')'
                    :admin='@json(true)'
                    :auth='@json(Auth::check())'>
                </delete-modal>
            </div>
        </div>
    </div>

</x-app-layout>