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
                        <span class="font-bold w-40">No Registrasi</span>
                        <span class="mr-4">:</span>
                        <span>REG-01234</span>
                    </div>

                    <div class="flex">
                        <span class="font-bold w-40">Nama Pasien</span>
                        <span class="mr-4">:</span>
                        <span>Soso Momomo</span>
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
                        <span class="font-bold w-40">Tanggal Lahir</span>
                        <span class="mr-4">:</span>
                        <span>28-04-2026</span>
                    </div>
                </div>

                <!-- Kolom 3 -->
                <div>
                    <div class="flex mb-6">
                        <span class="font-bold w-40">Alamat</span>
                        <span class="mr-4">:</span>
                        <span>Jalan Veteran No 4, Depok, Sleman</span>
                    </div>

                    <div class="flex">
                        <span class="font-bold w-40">Kelas BPJS</span>
                        <span class="mr-4">:</span>
                        <span>1</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="my-4 bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <h1 class="text-2xl p-4 font-extrabold text-emerald-800 dark:text-emerald-400">
                Rincian Tindakan
            </h1>
            <div>
                <div class="pl-4 pr-4 pb-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-3 px-4 rounded-l-lg">ID Tindakan</th>
                                <th class="py-3 px-4 ">Nama Tindakan</th>
                                <th class="py-3 px-4 ">Jumlah</th>
                                <th class="py-3 px-4 ">Harga</th>
                                <th class="py-3 px-4 rounded-r-lg">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">Rp 20.000</td>
                                <td class="py-3 px-4">Rp 60.000</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">Rp 20.000</td>
                                <td class="py-3 px-4">Rp 60.000</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">Rp 20.000</td>
                                <td class="py-3 px-4">Rp 60.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h1 class="text-2xl p-4 font-extrabold text-emerald-800 dark:text-emerald-400">
                Rincian Obat
            </h1>
            <div>
                <div class="pl-4 pr-4 pb-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-3 px-4 rounded-l-lg">ID Obat</th>
                                <th class="py-3 px-4 ">Nama Obat</th>
                                <th class="py-3 px-4 ">Jumlah</th>
                                <th class="py-3 px-4 ">Harga</th>
                                <th class="py-3 px-4 rounded-r-lg">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">Rp 20.000</td>
                                <td class="py-3 px-4">Rp 60.000</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">Rp 20.000</td>
                                <td class="py-3 px-4">Rp 60.000</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-3 px-4">1222</td>
                                <td class="py-3 px-4">Cek Laboratorium</td>
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">Rp 20.000</td>
                                <td class="py-3 px-4">Rp 60.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end mt-4 p-4">
                <button
                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md flex items-center gap-2">
                    Lihat Kwitansi
                </button>
            </div>

        </div>
    </div>
</template>