<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="justify-between items-start">
            <div class="flex justify-between items-start">
                <div class="flex">
                    <div class="text-xl font-bold md:mr-5">ユーザー一覧</div>
                    <div class="hidden lg:flex">
                        <form action="{{ route('admin.user.search') }}" method="get">
                            <div class="flex">
                                <div class="flex items-center rounded-md px-2 bg-white mr-2 lg:mr-5 w-32 md:w-48">
                                    <input onchange="this.form.submit()" name="target" class="text-xs md:text-sm bg-white appearance-none border-none w-full py-2 px-2 md:px-4 text-gray-800 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0"
                                    type="text" value="{{ $target }}" placeholder=ユーザーを検索 />
                                    <div class="w-5 md:w-6 md:mx-2">
                                        <img src="{{ asset("images/search.png") }}" alt="search">
                                    </div>
                                </div>
                                <div>
                                    <select onchange="this.form.submit()" name="sort"  class="rounded-md border-none text-gray-600 text-xs md:text-sm py-2 px-2 md:px-4 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0 w-32 md:w-48">
                                        <option value="created_at" @if($sort === "created_at") selected  @endif>登録日</option>
                                        <option value="name" @if($sort  === "name") selected  @endif>氏名</option>
                                        <option value="username" @if($sort  === "username") selected  @endif>ユーザーネーム</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex mt-2 lg:hidden">
                <form action="{{ route('admin.user.search') }}" method="get">
                    <div class="flex">
                        <div class="flex items-center rounded-md px-2 bg-white mr-2 lg:mr-5 w-32 md:w-48">
                            <input onchange="this.form.submit()" name="target" class="text-xs md:text-sm bg-white appearance-none border-none w-full py-2 px-2 md:px-4 text-gray-800 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0"
                            type="text" value="{{ $target }}" placeholder="ユーザーを検索" />
                            <div class="w-5 md:w-6 md:mx-2">
                                <img src="{{ asset("images/search.png") }}" alt="search">
                            </div>
                        </div>
                        <div>
                            <select onchange="this.form.submit()" name="sort"  class="rounded-md border-none text-gray-600 text-xs md:text-sm py-2 px-2 md:px-4 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0 w-32 md:w-48">
                                <option value="created_at" @if($sort === "created_at") selected  @endif>登録日</option>
                                <option value="name" @if($sort  === "name") selected  @endif>氏名</option>
                                <option value="username" @if($sort  === "username") selected  @endif>ユーザーネーム</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- users --}}
        <div class="mt-5">
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">氏名</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">ユーザーネーム</th>
                    <th class="hidden md:block border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">メールアドレス</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">登録日</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs sm:text-md px-1"></th>
                </tr>
                @foreach ($users as $user)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-3/12 text-xs p-1">{{ $user->name }}</td>
                    <td class="w-3/12 text-xs p-1">{{ $user->username }}</td>
                    <td class="hidden md:block text-xs p-1 text-center">{{ $user->email }}</td>
                    <td class="w-2/12 text-xs p-1 text-center">{{ $user->created_at->format('y/m/d') }}</td>
                    <td class="w-2/12 md:w-1/12 text-xs p-1 text-center">
                        <a href="{{ route('admin.user.confilm', ['user' => $user->id]) }}">
                            <button class="px-1 sm:px-2 py-1 bg-green-400 text-white rounded-lg font-semibold">確認</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $users->appends([
                    'target' => $target,
                    'sort' => $sort
                ])->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($users)===0)
                <div class="text-center font-bold mt-5 text-gray-500">ユーザーは登録されていません</div>
            @endif
        </div>
    </div>

</x-app-layout>