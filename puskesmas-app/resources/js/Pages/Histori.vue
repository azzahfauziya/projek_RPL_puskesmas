<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="bg-green-100 rounded-lg p-8 shadow">
            <h1 class="text-3xl mb-8 font-extrabold text-emerald-800 dark:text-emerald-400">
                Keterangan Pasien
            </h1>

            <div class="grid grid-cols-3 gap-8">

                <!-- Kolom 1 -->
                <div>
                    <div class="flex mb-6">
                        <span class="font-bold w-40">No RM</span>
                        <span class="mr-4">:</span>
                        <span>08253674887</span>
                    </div>

                    <div class="flex mb-6">
                        <span class="font-bold w-40">Nama Pasien</span>
                        <span class="mr-4">:</span>
                        <span>Soso Momomo</span>
                    </div>

                    <div class="flex">
                        <span class="font-bold w-40">Tanggal Lahir</span>
                        <span class="mr-4">:</span>
                        <span>28-04-2026</span>
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div>
                    <div class="flex mb-6">
                        <span class="font-bold w-40">Jenis Kelamin</span>
                        <span class="mr-4">:</span>
                        <span>Laki-laki</span>
                    </div>

                    <div class="flex mb-6">
                        <span class="font-bold w-40">TB / BB</span>
                        <span class="mr-4">:</span>
                        <span>170 cm / 50 kg</span>
                    </div>

                    <div class="flex">
                        <span class="font-bold w-40">Kelas BPJS</span>
                        <span class="mr-4">:</span>
                        <span>1</span>
                    </div>
                </div>

                <!-- Kolom 3 -->
                <div>
                    <div class="flex mb-6">
                        <span class="font-bold w-40">Alamat</span>
                        <span class="mr-4">:</span>
                        <span>Jalan Veteran No 4, Depok, Sleman</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-white border-4 border-blue-500 rounded-2xl p-8 mt-4 shadow overflow-hidden">
            <div class="grid grid-cols-3 gap-8 items-start">
                <!-- Kolom Kiri -->
                <div>
                    <div class="flex mb-6">
                        <span class="font-bold w-40">No Registrasi</span>
                        <span class="mr-4">:</span>
                        <span>REG-01234</span>
                    </div>

                    <div class="flex mb-6">
                        <span class="font-bold w-40 shrink-0">Keluhan Awal</span>
                        <span class="mr-4 shrink-0">:</span>
                        <span>
                            Pusing, Mual, bintik-bintik merah
                        </span>
                    </div>
                </div>

                <div>
                    <div class="flex">
                        <span class="font-bold w-40">Diagnosa</span>
                        <span class="mr-4">:</span>
                        <span>Demam Berdarah Dengue</span>
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="border border-emerald-700 rounded-2xl px-6 py-5 min-w-[260px] items-center">

                    <div class="flex items-center gap-4">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="size-8 text-emerald-800">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6h15A1.5 1.5 0 0 1 21 7.5v12A1.5 1.5 0 0 1 19.5 21h-15A1.5 1.5 0 0 1 3 19.5v-12A1.5 1.5 0 0 1 4.5 6Z" />

                        </svg>

                        <span class="font-semibold text-lg">
                            Selasa, 28 April 2026
                        </span>

                    </div>

                </div>
            </div>
        </div>

        <div class="my-4 bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <h1 class="text-2xl p-4 font-extrabold text-emerald-800 dark:text-emerald-400">
                Tindakan
            </h1>
            <div>
                <div class="pl-4 pr-4 pb-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-3 px-4 rounded-l-lg">ID Tindakan</th>
                                <th class="py-3 px-4 ">Nama Tindakan</th>
                                <th class="py-3 px-4 rounded-r-lg">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h1 class="text-2xl p-4 font-extrabold text-emerald-800 dark:text-emerald-400">
                Obat
            </h1>
            <div>
                <div class="pl-4 pr-4 pb-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-3 px-4 rounded-l-lg">ID Obat</th>
                                <th class="py-3 px-4 ">Nama Obat</th>
                                <th class="py-3 px-4 ">Jumlah</th>
                                <th class="py-3 px-4 rounded-r-lg">Aturan Pakai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">3x sehari setelah makan</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">3x sehari setelah makan</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">3x sehari setelah makan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex mt-4 p-4">
                <button
                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md flex items-center gap-2">
                    Lihat Kwitansi
                </button>
            </div>

        </div>
    </div>
</template>