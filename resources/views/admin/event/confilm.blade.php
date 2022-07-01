<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="md:px-10 text-gray-700">
            <div>
                <div class="text-xl md:text-2xl font-bold text-red-500">イベント情報の確認</div>
            </div>
            <div class="my-5 p-5 md:p-10 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <div class="">
                    <x-detail-top :target="$event" fileName="events"/>

                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">イベント種別 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->segment ==="1" ? '勉強会' : 'その他' }}</div>
                    </div>
    
                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">開催地 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">
                            {{ $event->online ==="1" ? 'オンライン' : $event->area }}
                        </div>
                    </div>
    
                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">定員 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->capacity }}</div>
                    </div>
    
                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">開催期間 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">
                            {{ $event->start_date->format('y/m/d') }}~{{ $event->end_date->format('y/m/d') }}
                        </div>
                    </div>
    
                    <div class="mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">イベント内容 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contents }}</div>
                    </div>
    
                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">ハッシュタグ : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->tag }}</div>
                    </div>
    
                    <div class="flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">連絡先 : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contact_address }}</div>
                    </div>
    
                    <div class="md:flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">メールアドレス : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->contact_email }}</div>
                    </div>
    
                    <div class="md:flex items-center mt-3">
                        <div class="font-bold text-sm md:text-lg lg:text-xl text-red-500 mr-2">URL : </div>
                        <div class="font-bold text-sm md:text-lg lg:text-xl">{{ $event->url }}</div>
                    </div>

                    <delete-modal 
                        :text='@json('イベントの削除')'
                        :id='@json($event->id)'
                        :path='@json('event')'
                        :admin='@json(true)'
                        :auth='@json(Auth::check())'>
                    </delete-modal>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>