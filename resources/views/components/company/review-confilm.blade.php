<div class="px-5 md:px-10">
    <div class="flex items-center pt-5 border-b-2 border-gray-400">
        <div class="font-bold text-lg md:text-xl lg:text-2xl line-clamp-2 mr-5 md:mr-10">
            {{ $company->name }}
        </div>
        {{-- <div class="flex items-center">
            <x-gr :target="$company" gr="company.gr" deleteGr="company.gr.delete"/>
            <div class="text-lg font-bold flex items-end">{{ $company->grs->count() }}</div>
        </div> --}}
    </div>
    <div class="mt-5 md:mt-10">
        <div class="my-5 py-10 px-5 shadow-xl">
                <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />

            <form action="{{ route('company.review.register', ['company'=>$company->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="company_id" value="{{ $company->id }}">
                
                <div class="mt-3 text-red-500 text-2xl lg:text-4xl font-bold">{{$title}}review</div>

                <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                    ユーザー名 : 
                    <input type="text" name="username" required readonly class="shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $user->username }}"/>
                </div>

                <div class="mt-3 text-sm md:text-md lg:text-lg font-bold">
                    性別 : 
                    <input type="text" name="gender" required readonly class="w-20 shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $user->gender === 0 ? '女性' : '男性' }}"/>
                </div>

                <div class="mt-10 text-sm md:text-md lg:text-lg font-bold">
                    本文(必須) : 
                    <textarea name="review" rows="10" required maxlength="40"readonly class="shadow appearance-none border-none w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $review }}</textarea>
                </div>

                <div class="mt-10">
                    <x-button.go-next text="企業reviewの登録"/>
                </div>
                <div class="mt-10">
                    <x-button.go-refere type="submit" text="企業review作成に戻る"/>
                </div>
            </form>
        </div>
    </div>
</div>