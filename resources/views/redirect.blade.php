<x-guest-layout>
    <x-auth-card>
        <div class="py-5 px-5 max-w-md mx-auto">
            <div class="w-40 sm:w-56 mt-10">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>
    
            <div class="mt-10">
                <div class="text-center">
                    <div class="font-bold text-red-500 text-lg md:text-xl">ありがとうございます！</div>
                    <div class="font-bold text-red-500 text-lg md:text-xl">{{ $text }}</div>
                </div>
                
                <div class="mt-10">
                    <x-button.go-refere type="button" :route="$link" :text="$linkText"/>
                </div>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
