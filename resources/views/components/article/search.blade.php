{{-- TODO: inputにフォーカスした時、青い枠線が出現する --}}
<form action="{{ route('article.search') }}" method="get" class="mr-2 lg:mr-5 w-48" autocomplete="off">
    <div class="flex items-center rounded-md px-2 bg-white">
        <input class="text-xs md:text-sm bg-white appearance-none border-none w-full py-2 px-2 md:px-4 text-gray-800 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0"
        type="text" name="target" required placeholder="特集記事を検索">
        <button>
            <div class="w-5 md:w-6 md:mx-2">
                <img src="{{ asset("images/search.png") }}" alt="search">
            </div>
        </button>
    </div>
</form>