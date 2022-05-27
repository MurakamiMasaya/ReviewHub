<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="justify-between items-start">
            <div class="flex justify-between items-start">
                <div class="flex">
                    <div class="text-xl font-bold md:mr-5">企業一覧</div>
                    <div class="hidden md:flex">
                        <div><x-company.search route="admin.company.search"/></div>
                        <div>
                            <div class="w-32 md:w-48">
                                <select name="" id="" class="rounded-md border-none text-gray-500 text-xs md:text-sm py-2 px-2 md:px-4 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0 w-32 md:w-48">
                                    <option value="">最終更新日</option>
                                    <option value="">企業名</option>
                                    <option value="">GR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <a href="{{ route("mypage.index") }}">
                       <x-button.primary-button class="py-1">新規登録</x-button.primary-button>
                    </a>
                </div>
            </div>
            <div class="flex mt-2 md:hidden">
                <div><x-company.search route="admin.company.search"/></div>
                <div class="w-32 md:w-48">
                    <select name="" id="" class="rounded-md border-none text-gray-500 text-xs md:text-sm py-2 px-2 md:px-4 leading-tight focus:outline-none foucus:border-none foucus:appearance-none focus:ring-0 w-32 md:w-48">
                        <option value="">企業名</option>
                        <option value="">GR</option>
                        <option value="">最終更新日</option>
                    </select>
                </div>
            </div>
        </div>
        
        {{-- Companies --}}
        <div class="mt-5">
            <table class="mt-2 w-full">
                <tr>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">企業名</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">住所</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">GR</th>
                    <th class="border-r-2 border-gray-100 bg-gray-400 text-white text-xs p-1">最終更新日時</th>
                    <th class=" border-gray-100 bg-gray-400 text-white text-xs sm:text-md px-1"></th>
                </tr>
                @foreach ($companies as $company)
                <tr  class="border-b-2 border-gray-300">
                    <td class="w-3/12 text-xs p-1">{{ $company->name }}</td>
                    <td class="w-5/12 md:w-6/12 text-xs p-1">{{ $company->address }}</td>
                    <td class="w-1/12 text-xs p-1 text-center">{{ $company->gr }}</td>
                    <td class="w-1/12 text-xs p-1">{{ $company->updated_at->format('y/m/d') }}</td>
                    <td class="w-2/12 mg:w-1/12 text-xs p-1 text-center">
                        <a href="{{ route('admin.company.edit', ['company' => $company->id]) }}">
                            <button class="px-1 sm:px-2 py-1 bg-green-400 text-white rounded-lg font-semibold">編集</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="my-5">
                {{ $companies->links() }}
            </div>

            {{-- データが登録されていない時 --}}
            @if (count($companies)===0)
                <div class="text-center font-bold mt-5 text-gray-500">Reviewは登録されていません</div>
            @endif
        </div>
    </div>

</x-app-layout>