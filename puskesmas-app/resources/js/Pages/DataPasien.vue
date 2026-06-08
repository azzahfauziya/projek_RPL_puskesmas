<template>
    <div class="p-8 bg-gray-100 min-h-screen dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <!-- Header dengan grid 2 kolom: Judul di kiri, Search di kanan -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <!-- Kolom Kiri: Judul -->
            <div class="col-span-3">
                <h1 class="text-2xl font-extrabold text-[#144B29] dark:text-blue-400">
                    Tabel Pasien
                </h1>
            </div>

            <!-- Kolom Kanan: Search -->
            <div class="flex justify-end gap-2">
                <button
                    class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 0 1 .628.74v2.288a2.25 2.25 0 0 1-.659 1.59l-4.682 4.683a2.25 2.25 0 0 0-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 0 1 8 18.25v-5.757a2.25 2.25 0 0 0-.659-1.591L2.659 6.22A2.25 2.25 0 0 1 2 4.629V2.34a.75.75 0 0 1 .628-.74Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Tabel -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="py-3 px-4 rounded-l-lg">No RM</th>
                            <th class="py-3 px-4 ">No Reg</th>
                            <th class="py-3 px-4 ">Nama Pasien</th>
                            <th class="py-3 px-4 ">Tanggal</th>
                            <th class="py-3 px-4 rounded-r-lg">Lihat Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">REG-01239</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 px-4">24-04-2026</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Tagihan
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">REG-01239</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 px-4">24-04-2026</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Tagihan
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">REG-01239</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 px-4">24-04-2026</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Tagihan
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">REG-01239</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 px-4">24-04-2026</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Tagihan
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">REG-01239</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 px-4">24-04-2026</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Tagihan
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3 px-4">2012334</td>
                            <td class="py-3 px-4">REG-01239</td>
                            <td class="py-3 px-4">Soso Momomo</td>
                            <td class="py-3 px-4">24-04-2026</td>
                            <td class="py-3 items-center justify-center text-center">
                                <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md items-center gap-2">
                                    Tagihan
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