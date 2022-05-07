<div class="mt-10 px-1 md:px-3 lg:px-5 text-gray-800">
    <div class="lg:flex justify-between items-end">
        <div class="text-xl md:text-2xl font-bold">
            企業掲示板 GRランキング
        </div>
        <div class="text-right">
            2022/04/25~2022/05/24
        </div>
    </div>
    <div class="bg-gray-500 h-1"></div>
    <div class="md:flex flex-col flex-wrap h-auto md:h-56 mt-5">
        @foreach($companies as $company)
        <div class="md:w-1/2 md:mr-3">
            <div class="flex items-center mt-5 justify-center">
                <div class="w-10 md:w-11 mr-5">
                    <img src="{{ asset('images/ranking/'. ($loop->index+1) .'.png') }}" alt="1位">
                </div>
                <div class="font-bold text-lg md:text-xl lg:text-2xl">{{ $company->company_name }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>