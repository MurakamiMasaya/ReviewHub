<div>
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-red-500 border-2 border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-white hover:text-red-600 hover:border-red-600 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-red-200 disabled:opacity-25 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
</div>