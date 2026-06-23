<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        pendaftaran: Object,
        obat: Array
    })

    const form = useForm({
        no_registrasi: props.pendaftaran.no_registrasi,
        id_obat: '',
        aturan_pakai: '',
        jumlah: 1
    })

    const submit = () => {
        form.post(route('resep.simpan'))
    }
</script>

<template>
    <div class="min-h-screen bg-gray-100 p-4 md:p-8">
        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-4 md:p-6 mb-8">

            <!-- Keterangan Pasien -->
            <div class="bg-green-100 rounded-lg p-6 md:p-10 shadow">
                <h1 class="text-2xl md:text-3xl mb-6 md:mb-8 font-extrabold text-emerald-800 dark:text-emerald-400">
                    Keterangan Pasien
                </h1>
                <div class="grid grid-cols-2 gap-4 md:gap-8">
                    <!-- Kolom 1 -->
                    <div>
                        <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                            <span class="font-bold md:w-40 shrink-0">No RM</span>
                            <span class="hidden md:inline mr-4">:</span>
                            <span class="break-words min-w-0">{{ pendaftaran.pasien.no_rm }}</span>
                        </div>
                        <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                            <span class="font-bold md:w-40 shrink-0">Nama Pasien</span>
                            <span class="hidden md:inline mr-4">:</span>
                            <span class="break-words min-w-0">{{ pendaftaran.pasien.nama }}</span>
                        </div>
                        <div class="flex flex-col md:flex-row">
                            <span class="font-bold md:w-40 shrink-0">Tanggal Lahir</span>
                            <span class="hidden md:inline mr-4">:</span>
                            <span class="break-words min-w-0">{{ pendaftaran.pasien.tanggal_lahir }}</span>
                        </div>
                    </div>
                    <!-- Kolom 2 -->
                    <div>
                        <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                            <span class="font-bold md:w-40 shrink-0">Jenis Kelamin</span>
                            <span class="hidden md:inline mr-4">:</span>
                            <span class="break-words min-w-0">{{ pendaftaran.pasien.jenis_kelamin }}</span>
                        </div>
                        <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                            <span class="font-bold md:w-40 shrink-0">TB / BB</span>
                            <span class="hidden md:inline mr-4">:</span>
                            <span class="break-words min-w-0">
                                {{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm /
                                {{ pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg
                            </span>
                        </div>
                        <div class="flex flex-col md:flex-row">
                            <span class="font-bold md:w-40 shrink-0">Kelas BPJS</span>
                            <span class="hidden md:inline mr-4">:</span>
                            <span class="break-words min-w-0">{{ pendaftaran.pasien.kelas_bpjs }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="p-4 md:p-8">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6 md:mb-8">
                    <h1 class="text-2xl md:text-4xl font-bold text-green-900">
                        Input Resep Obat
                    </h1>
                </div>

                <div class="max-w-4xl">

                    <!-- Nama Obat -->
                    <div class="flex flex-col md:grid md:grid-cols-[220px_1fr] md:items-center mb-4 gap-2 md:gap-0">
                        <label class="text-xl md:text-2xl font-medium">Nama Obat</label>
                        <select v-model="form.id_obat"
                            class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                            <option value="">Pilih Obat</option>
                            <option v-for="item in props.obat" :key="item.id_obat" :value="item.id_obat">
                                {{ item.nama_obat }}
                            </option>
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div class="flex flex-col md:grid md:grid-cols-[220px_1fr] md:items-center mb-4 gap-2 md:gap-0">
                        <label class="text-xl md:text-2xl font-medium">Jumlah</label>
                        <input type="number" v-model="form.jumlah"
                            class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                    </div>

                    <!-- Aturan Pakai -->
                    <div class="flex flex-col md:grid md:grid-cols-[220px_1fr] md:items-center mb-4 gap-2 md:gap-0">
                        <label class="text-xl md:text-2xl font-medium">Aturan Pakai</label>
                        <input type="text" v-model="form.aturan_pakai"
                            class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                    </div>

                    <!-- Button -->
                    <div class="flex justify-end mt-6 md:mt-0">
                        <button @click="submit"
                            class="bg-green-900 hover:bg-green-800 text-white font-semibold text-lg md:text-xl px-10 md:px-16 py-3 rounded-xl">
                            Kirim
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>