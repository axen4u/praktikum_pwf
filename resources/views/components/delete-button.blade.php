<form action="{{ $url }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
    @csrf
    @method('DELETE')
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
        {{ $slot->isEmpty() ? 'Hapus' : $slot }}
    </button>
</form>
