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
                <div class="pl-4 pr-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
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

                    <div class="flex justify-end mt-4">
                        <div class="px-6 ps-3 rounded-lg">
                            <span class="font-semibold">Total Tindakan : </span>
                            <span class="font-bold text-emerald-700">
                                Rp 180.000
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            <h1 class="text-2xl pb-4 pr-4 pl-4 font-extrabold text-emerald-800 dark:text-emerald-400">
                Rincian Obat
            </h1>
            <div>
                <div class="pl-4 pr-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
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

                    <div class="flex justify-end mt-4">
                        <div class="px-6 py-3 rounded-lg">
                            <span class="font-semibold">Total Tindakan : </span>
                            <span class="font-bold text-emerald-700">
                                Rp 180.000
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Ringkasan Harga -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mt-4">
            <div class="grid grid-cols-2 px-6 py-5">
                <div>
                    <div class="mb-4">
                        <span class="font-bold">Total Harga</span>
                    </div>

                    <div class="mb-4">
                        <span class="font-bold">Potongan Harga</span>
                    </div>

                    <div>
                        <span class="font-bold">Harga Yang Harus Dibayarkan</span>
                    </div>
                </div>

                <div class="flex flex-col items-end">
                    <div class="mb-4">
                        <span class="font-bold">Rp 360.000</span>
                    </div>

                    <div class="mb-4">
                        <span class="font-bold">Rp 10.000</span>
                    </div>

                    <div>
                        <span class="font-bold text-emerald-700">
                            Rp 350.000
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metode Pembayaran + Jumlah Bayar -->
        <div class="grid grid-cols-2 gap-4 mt-4">

            <!-- Metode Pembayaran -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-emerald-700 p-6">
                <label class="block text-2xl font-extrabold text-emerald-800 mb-4">
                    Metode Pembayaran
                </label>

                <select
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option selected disabled>
                        Pilih metode pembayaran
                    </option>
                    <option>Tunai</option>
                    <option>Debit</option>
                    <option>Kredit</option>
                    <option>QRIS</option>
                </select>
            </div>

            <!-- Jumlah Dibayarkan -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-emerald-700 p-6">
                <label class="block text-2xl font-extrabold text-emerald-800 mb-4">
                    Jumlah yang dibayarkan
                </label>

                <input type="number" placeholder="Masukkan nominal yang dibayarkan"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

        </div>

        <!-- Status Pembayaran -->
        <div class="bg-green-100 border border-emerald-700 rounded-2xl p-6 mt-4">

            <div class="flex flex-col items-center">

                <h2 class="text-2xl font-extrabold text-emerald-900 mb-3">
                    Status Pembayaran
                </h2>

                <div class="flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="size-10 text-emerald-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span class="text-5xl font-extrabold text-emerald-900">
                        LUNAS
                    </span>

                </div>
            </div>
        </div>

    </div>
</template>