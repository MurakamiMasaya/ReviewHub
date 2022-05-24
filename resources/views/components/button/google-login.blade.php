<button class="flex justify-center items-center bg-white border-2 border-blue-400 rounded-lg px-3 py-2 w-92 mx-auto">
    <div class="w-7 mr-1"><img src="{{ asset('images/google-logo.png') }}" alt=""></div>
    <div class="text-blue-400 text-sm md:text-md font-bold mr-1">
        <a href="{{ route('google.login') }}">{{ $slot }}</a>
    </div>
</button>