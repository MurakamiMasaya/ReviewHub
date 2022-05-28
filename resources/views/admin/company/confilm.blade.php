<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="md:px-10 text-gray-700">
            <div>
                <div class="text-xl md:text-2xl font-bold text-red-500">企業情報の確認</div>
            </div>
            <div class="my-5 p-5 md:p-10 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form action="{{ route('admin.company.register') }}" method="post">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $companyInfo['id'] ?? null }}">
                    
                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        企業名 : 
                        <input type="text" name="name" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $companyInfo['name'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        所在地 : 
                        <input type="text" name="address" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $companyInfo['address'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        電話番号 : 
                        <input type="number" name="phone" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $companyInfo['phone'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        採用条件 : 
                        <input type="text" name="condition" readonly class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $companyInfo['condition'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        使用技術 : 
                        <input type="text" name="technology" readonly class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $companyInfo['technology'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        WebサイトURL : 
                        <input type="text" name="website_url" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $companyInfo['website_url'] }}"/>
                    </div>

                    <div class="mt-10">
                        <x-button.go-next text="企業情報の登録"/>
                    </div>
                    <div class="mt-10">
                        <x-button.go-refere type="submit" text="企業の編集に戻る"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>