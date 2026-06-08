<template>
    <div class="p-8 bg-gray-100 min-h-screen dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <!-- Header dengan grid 2 kolom: Judul di kiri, Search di kanan -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <!-- Kolom Kiri: Judul -->
            <div class="col-span-3">
                <h1 class="text-2xl font-extrabold text-[#144B29] dark:text-blue-400">
                    Tabel Obat
                </h1>
            </div>

            <!-- Kolom Kanan: Search -->
            <div>
                <input type="text"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="cari obat berdasarkan ID / Nama">
            </div>
        </div>

        <!-- Tabel -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-4 text-center">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="py-3 px-4 rounded-l-lg">ID</th>
                            <th class="py-3 px-4 ">Nama</th>
                            <th class="py-3 px-4 ">Stok</th>
                            <th class="py-3 px-4 ">Harga Satuan</th>
                            <th class="py-3 px-4 ">Bentuk</th>
                            <th class="py-3 px-4 rounded-r-lg">Update stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">O-123</td>
                            <td class="py-3 px-4">Aito</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">Rp 3000</td>
                            <td class="py-3 px-4">Tablet</td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-emerald-700 hover:text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-7">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="col-span-1">
                <!-- tombol edit -->
                <div class="flex justify-start- mt-4">
                    <button
                        class="pl-10 flex items-center justify-center text-emerald-800 font-extrabold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <h2 class="text-lg">Edit Tabel Obat</h2>
                    </button>
                </div>
            </div>
            <div class="col-span-3">
                <!-- tombol pindah halaman -->
                <div>
                    <div class="flex justify-end mt-4 gap-2">
                        <div>
                            <button
                                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <button
                                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <button class="border border-emerald-800 bg-emerald-800 text-white w-10 h-10 rounded-lg">1</button>
                        </div>
                        <div>
                            <button
                                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <button
                                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>