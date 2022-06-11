<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto py-10 px-5 md:px-10">
        <div class="flex justify-between items-end">
            @if(Request::is('rank/top') || Request::is('rank/top/month'))
                <div class="text-xl md:text-3xl font-bold text-red-500">Reviewランキング(月間)</div>
            @elseif(Request::is('rank/top/year'))
                <div class="text-xl md:text-3xl font-bold text-red-500">Reviewランキング(年間)</div>
            @else
                <div class="text-xl md:text-3xl font-bold text-red-500">Reviewランキング(全て)</div>
            @endif
            <div class="">
                <a href="{{ route("mypage.index") }}"><div class="text-sm text-blue-500 font-bold">マイページに戻る</div></a>
            </div>
        </div>

        <x-period target="rank"/>
        
        {{-- ReviewRanking --}}
        <div class="mt-5">
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-red-100 bg-red-400 text-white md:text-lg p-1">順位</th>
                    <th class="border-r-2 border-red-100 bg-red-400 text-white md:text-lg p-1">ユーザー名</th>
                    <th class="border-r-2 border-red-100 bg-red-400 text-white md:text-lg p-1">GR</th>
                </tr>
                @foreach ($ranks as $rank)
                    @if($rank->user->id === Auth::id())
                        <tr  class="border-b-2 border-red-300">
                            <td class="w-2/12 text-center px-1 py-2 font-bold text-red-500">{{ $loop->index + 1 }}位</td>
                            <td class="w-8/12 px-1 py-2 font-bold text-red-500">{{ $rank->user->username }}</td>
                            <td class="w-2/12 px-1 text-center py-2 font-bold text-red-500">{{ $rank->total_gr }}</td>
                        </tr>
                    @else
                        <tr  class="border-b-2 border-gray-300">
                            <td class="w-2/12 text-center px-1 py-2 font-semibold text-red-500">{{ $loop->index + 1 }}位</td>
                            <td class="w-8/12 px-1 py-2 font-semibold">{{ $rank->user->username }}</td>
                            <td class="w-2/12 px-1 text-center py-2 font-semibold">{{ $rank->total_gr }}</td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <div class="my-5">
                {{ $ranks->links() }}
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    <x-eye-catching-image />
</x-app-layout>