<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="justify-between items-start">
            <div class="flex justify-between items-start">
                <div class="flex">
                    <div class="text-xl font-bold md:mr-5">イベント一覧</div>
                    <div class="hidden lg:flex">
                        <form action="{{ route('admin.event.search') }}" method="get">
                            <div class="flex">
                                <div class="flex items-center rounded-md px-2 bg-white mr-2 lg:mr-5 w-32 md:w-48">
                                    <input onchange="this.form.submit()" name="target" class="text-xs md:text-sm bg-white appearance-none border-none w-full py-2 px-2 md:px-4 text-gray-800 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0"
                                    type="text" value="{{ $target }}" placeholder=イベントを検索 />
                                    <div class="w-5 md:w-6 md:mx-2">
                                        <img src="{{ asset("images/search.png") }}" alt="search">
                                    </div>
                                </div>
                                <div>
                                    <select onchange="this.form.submit()" name="sort"  class="rounded-md border-none text-gray-600 text-xs md:text-sm py-2 px-2 md:px-4 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0 w-32 md:w-48">
                                        <option value="updated_at" @if($sort === "updated_at") selected  @endif>最終更新日</option>
                                        <option value="gr" @if($sort  === "gr") selected  @endif>GR</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex mt-2 lg:hidden">
                <form action="{{ route('admin.event.search') }}" method="get">
                    <div class="flex">
                        <div class="flex items-center rounded-md px-2 bg-white mr-2 lg:mr-5 w-32 md:w-48">
                            <input onchange="this.form.submit()" name="target" class="text-xs md:text-sm bg-white appearance-none border-none w-full py-2 px-2 md:px-4 text-gray-800 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0"
                            type="text" value="{{ $target }}" placeholder="イベントを検索" />
                            <div class="w-5 md:w-6 md:mx-2">
                                <img src="{{ asset("images/search.png") }}" alt="search">
                            </div>
                        </div>
                        <div>
                            <select onchange="this.form.submit()" name="sort"  class="rounded-md border-none text-gray-600 text-xs md:text-sm py-2 px-2 md:px-4 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0 w-32 md:w-48">
                                <option value="updated_at" @if($sort === "updated_at") selected  @endif>最終更新日</option>
                                <option value="gr" @if($sort  === "gr") selected  @endif>GR</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- Events --}}
        <div class="mt-5">
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">イベント名</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">内容</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">最終更新日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs sm:text-md px-1"></th>
                </tr>
                @foreach ($events as $event)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-3/12 text-xs">{{ $event->title }}</td>
                    <td class="text-xs pt-2 line-clamp-5">{!! nl2br(e($event->contents)) !!}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $event->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $event->updated_at->format('y/m/d') }}</td>
                    <td class="w-2/12 md:w-1/12 text-xs p-1 text-center">
                        <a href="{{ route('admin.event.confilm', ['event' => $event->id]) }}">
                            <button class="px-1 sm:px-2 py-1 bg-green-400 text-white rounded-lg font-semibold">確認</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $events->appends([
                    'target' => $target,
                    'sort' => $sort
                ])->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($events)===0)
                <div class="text-center font-bold mt-5 text-gray-500">イベントは登録されていません</div>
            @endif
        </div>
    </div>

</x-app-layout>