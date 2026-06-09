<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6 mb-8">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-emerald-800 dark:text-emerald-400">
                    Form Pendaftaran Pasien
                </h1>
            </div>

            <div class="max-w-4xl mx-auto mt-5">

                <!-- No RM -->
                <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                    <label class="font-bold text-xl">
                        No. RM
                    </label>

                    <input type="text" class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white">
                </div>

                <!-- Nama Pasien -->
                <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                    <label class="font-bold text-xl">
                        Nama Pasien
                    </label>

                    <input type="text" class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white">
                </div>

                <!-- Tanggal Lahir -->
                <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                    <label class="font-bold text-xl">
                        Tanggal Lahir
                    </label>

                    <div class="flex items-center gap-4">

                        <button
                            class="w-20 h-12 border border-gray-500 rounded-lg bg-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V8.25A2.25 2.25 0 015.25 6h13.5A2.25 2.25 0 0121 8.25v10.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75z" />
                            </svg>
                        </button>

                        <input type="text" placeholder="DD-MM-YYYY"
                            class="w-52 h-12 border border-gray-500 rounded-lg px-4 bg-white">
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="grid grid-cols-[220px_1fr] items-center mb-8">
                    <label class="font-bold text-xl">
                        Jenis Kelamin
                    </label>

                    <div class="flex items-center gap-6">

                        <label class="flex items-center gap-3 cursor-pointer ">
                            <input type="radio" name="gender">
                            <span class="text-xl">Perempuan</span>
                        </label>
                        
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="radio" name="gender">
                            <span class="text-xl">Laki-laki</span>
                        </label>

                    </div>
                </div>

                <!-- Alamat -->
                <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                    <label class="font-medium text-xl">
                        Alamat
                    </label>

                    <input type="text" class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white">
                </div>

                <!-- Kelas BPJS -->
                <div class="grid grid-cols-[220px_1fr] items-center mb-12">
                    <label class="font-medium text-xl">
                        Kelas BPJS
                    </label>

                    <input type="text" class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white">
                </div>

                <!-- Button -->
                <div class="flex justify-end p-8">
                    <button
                        class="bg-green-800 hover:bg-green-900 text-white font-semibold text-xl px-3 py-3 rounded-lg">
                        Daftar
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>