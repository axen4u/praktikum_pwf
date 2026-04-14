<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama Produk</label>
                        <p class="mt-1 text-lg">{{ $product->nama_produk }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Kategori</label>
                        <p class="mt-1">{{ $product->kategori->nama_kategori ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</label>
                        <p class="mt-1">{{ $product->deskripsi ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Harga</label>
                        <p class="mt-1">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Stok</label>
                        <p class="mt-1">{{ $product->stok }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Pemilik</label>
                        <p class="mt-1">{{ $product->user->name ?? '-' }}</p>
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        @can('update', $product)
                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 transition ease-in-out duration-150">
                            Edit
                        </a>
                        @endcan

                        @can('delete', $product)
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition ease-in-out duration-150">
                                Hapus
                            </button>
                        </form>
                        @endcan

                        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
