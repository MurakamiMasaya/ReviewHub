<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="md:px-10 text-gray-700">
            <div>
                <div class="text-xl md:text-2xl font-bold text-red-500">企業の編集</div>
            </div>
            <div class="my-5 p-5 md:p-10 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form action="{{ route('admin.company.confilm') }}" method="post">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    
                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        企業名 : 
                        <input type="text" name="name" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $company->name }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        所在地 : 
                        <input type="text" name="address" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $company->address }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        電話番号 : 
                        <input type="number" name="phone" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $company->phone }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        採用条件 : 
                        <input type="text" name="condition" class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $company->condition }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        使用技術 : 
                        <input type="text" name="technology" class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $company->technology }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        WebサイトURL : 
                        <input type="text" name="website_url" required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $company->website_url }}"/>
                    </div>

                    <div class="mt-10">
                        <x-button.go-next text="企業情報の確認"/>
                    </div>
                    <div class="mt-10">
                        <x-button.go-refere type="button" route="admin.company" text="企業一覧に戻る"/>
                    </div>
                </form>

                <form id="delete_form" action="{{ route('admin.company.delete')}}" method="post">
                    @csrf
                    <div class="my-20 text-center">
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <button id="delete_button" type="button" class="px-5 py-3 bg-red-600 text-white rounded-lg font-semibold w-40 ">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const deleteForm = document.querySelector('#delete_form');
        const deleteButton = document.querySelector('#delete_button');

        deleteButton.addEventListener('click', function() {
            if(window.confirm('本当に削除しますか？')) {
                deleteForm.submit()
            }
        })
    </script>
</x-app-layout>