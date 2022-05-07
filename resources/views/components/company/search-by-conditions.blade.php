<div class="sm:flex justify-around my-10  text-gray-800">
    <div>
        <div class="mx-10 md:mx-5 border-4 border-orange-500 px-2 md:px-4 py-2 rounded-md font-bold text-sm lg:text-lg text-center">言語・技術から企業を探す</div>
        <div class="py-3 px-5">
            <ul class="flex flex-col flex-wrap h-96 ">
                @foreach($stacks as $stack)
                <div class="w-1/2 mb-2 text-md font-bold text-center">
                    <a href="#">
                        <li>{{ $stack->stack }}</li>
                    </a>
                </div>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="">
        <div class="mx-10 md:mx-5 border-4 border-orange-500 px-2 md:px-4 py-2 rounded-md font-bold text-sm lg:text-lg text-center">採用条件から企業を探す</div>
        <div class="py-3 px-5">
            <ul class="flex flex-col flex-wrap h-48 ">
                @foreach($conditions as $condition)
                <div class="w-1/2 mb-2 text-md font-bold text-center">
                    <a href="#">
                        <li>{{ $condition->condition }}</li>
                    </a>
                </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>