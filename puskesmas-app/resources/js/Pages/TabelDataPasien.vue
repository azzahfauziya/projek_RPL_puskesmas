<template>
    <div class="p-8 bg-gray-100 min-h-screen dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <!-- Header dengan grid 2 kolom: Judul di kiri, Search di kanan -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <!-- Kolom Kiri: Judul -->
            <div class="col-span-3">
                <h1 class="text-2xl font-extrabold text-[#144B29] dark:text-blue-400">
                    Tabel Antrian
                </h1>
            </div>

            <!-- Kolom Kanan: Search -->
            <div>
                <input type="text"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="cari pasien No reg/Nama">
            </div>
        </div>

        <!-- Tabel -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="py-3 px-4  rounded-l-lg ">No RM</th>
                            <th class="py-3 px-4 ">Nama Pasien</th>
                            <th class="py-3 px-4 ">Daftar</th>
                            <th class="py-3 px-4 rounded-r-lg">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Daftar
                                </button>
                            </td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Daftar
                                </button>
                            </td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Daftar
                                </button>
                            </td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Daftar
                                </button>
                            </td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Daftar
                                </button>
                            </td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

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
</template>