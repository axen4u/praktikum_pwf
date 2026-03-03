<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About Me') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4 border-b pb-2 dark:border-gray-700">Biodata Diri</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <span class="w-1/3 text-gray-500 dark:text-gray-400 font-semibold">Nama</span>
                            <span class="w-2/3">Muhammad Arya Habil Damara</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-1/3 text-gray-500 dark:text-gray-400 font-semibold">NIM</span>
                            <span class="w-2/3">20230140202</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-1/3 text-gray-500 dark:text-gray-400 font-semibold">Program Studi</span>
                            <span class="w-2/3">Teknologi Informasi</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-1/3 text-gray-500 dark:text-gray-400 font-semibold">Hobi</span>
                            <span class="w-2/3">Membaca / Ngoding</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
