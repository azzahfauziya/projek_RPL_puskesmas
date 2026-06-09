<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6 mb-8">
            <div class="bg-green-100 rounded-lg p-10 shadow">
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
    
            <div class="min-h-screen p-10">
    
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-green-900">
                        Input pendaftaran
                    </h1>
    
                    <div class="flex items-center gap-3 border-2 border-green-900 rounded-2xl px-6 py-3 bg-white">
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
    
                <!-- Form -->
                <div class="max-w-4xl">
    
                    <!-- No Registrasi -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            No. Registrasi
                        </label>
    
                        <input type="text" class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                    </div>
    
                    <!-- Keluhan Awal -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            Keluhan Awal
                        </label>
    
                        <input type="text" class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                    </div>
    
                    <!-- TB -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            TB
                        </label>
    
                        <div class="flex items-center gap-3">
                            <input type="number" class="border border-gray-500 rounded-lg h-12 w-24 px-3 bg-white">
    
                            <span class="text-2xl">
                                cm
                            </span>
                        </div>
                    </div>
    
                    <!-- BB -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            BB
                        </label>
    
                        <div class="flex items-center gap-3">
                            <input type="number" class="border border-gray-500 rounded-lg h-12 w-24 px-3 bg-white">
    
                            <span class="text-2xl">
                                kg
                            </span>
                        </div>
                    </div>
    
                    <!-- Diagnosa -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            Diagnosa
                        </label>
    
                        <input type="text" class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                    </div>
    
                    <!-- Dokter -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-8">
                        <label class="text-2xl font-medium">
                            Dokter
                        </label>
    
                        <div class="relative w-full max-w-md">
                            <input type="text" class="border border-gray-500 rounded-lg h-12 px-4 pr-12 bg-white w-full">
    
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-700">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
    
                    <!-- Button -->
                    <div class="flex justify-end">
                        <button
                            class="bg-green-900 hover:bg-green-800 text-white font-semibold text-xl px-16 py-3 rounded-xl">
                            Kirim
                        </button>
                    </div>
    
                </div>
    
            </div>
        </div>
    </div>
</template>