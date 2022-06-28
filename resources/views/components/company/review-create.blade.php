<div class="p-5 md:p-10">
    <div class="flex items-center pt-5 border-b-2 border-gray-400">
        <div class="font-bold text-lg md:text-xl lg:text-2xl line-clamp-2 mr-5 md:mr-10">
            {{ $company->name }}
        </div>
        <div class="flex items-center">
            <switching-gr 
                :id='@json($company->id)'
                :grs='@json($company->grs->count())' 
                :is-gr='@json($company->isGrByAuthUser())'
                :path='@json('company')'
                :width='@json('40px')'
                :font='@json('30px')'
                :auth='@json(Auth::check())'>
            </switching-gr>
        </div>
    </div>
    <div class="mt-5 md:mt-10">
        <div class="my-5 py-10 px-5 shadow-xl">
                <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />

            <form action="{{ route('company.review.confilm', ['company'=>$company->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                
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
                    <textarea name="review" rows="10" value="{{ old('review') }}" required maxlength="40" class="shadow appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="従業員を大切にしてくれる良い企業だったと思います！">{{ old('review') }}</textarea>
                    <div class="text-xs font-bold text-gray-500">※40文字以内でご記入ください。</div>
                </div>

                <div class="mt-10">
                    <x-button.go-next text="企業reviewの確認"/>
                </div>
                <div class="mt-10">
                    <x-button.go-refere type="button" route="company.detail" :para="$company->id" text="企業詳細に戻る"/>
                </div>
            </form>
        </div>
    </div>
</div>