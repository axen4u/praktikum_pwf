<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama Kategori</label>
                        <p class="mt-1 text-lg">{{ $kategori->nama_kategori }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</label>
                        <p class="mt-1">{{ $kategori->deskripsi ?? '-' }}</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Produk dalam Kategori ini</label>
                        @if ($kategori->products->count() > 0)
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($kategori->products as $product)
                                    <li>{{ $product->nama_produk }} - Rp {{ number_format($product->harga, 0, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">Belum ada produk di kategori ini.</p>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('kategoris.edit', $kategori) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">Edit</a>
                        <form action="{{ route('kategoris.destroy', $kategori) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                        </form>
                        <a href="{{ route('kategoris.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
