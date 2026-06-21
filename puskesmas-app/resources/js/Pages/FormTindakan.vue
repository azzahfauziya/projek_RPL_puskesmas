<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        pendaftaran: Object,
        tindakan: Array
    })

    const form = useForm({
        no_registrasi: props.pendaftaran.no_registrasi,
        id_tindakan: '',
        jumlah: 1
    })

    const submit = () => {
        form.post(route('tindakan.simpan'))
    }
</script>

<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6 mb-8">
            <div class="bg-green-100 rounded-lg p-10 shadow">
                <h1 class="text-3xl mb-8 font-extrabold text-emerald-800 dark:text-emerald-400">
                    Keterangan Pasien
                </h1>

                <div class="grid grid-cols-2 gap-8">

                    <!-- Kolom 1 -->
                    <div>
                        <div class="flex mb-6">
                            <span class="font-bold w-40">No RM</span>
                            <span class="mr-4">:</span>
                            <span>{{ pendaftaran.pasien.no_rm }}</span>
                        </div>

                        <div class="flex mb-6">
                            <span class="font-bold w-40">Nama Pasien</span>
                            <span class="mr-4">:</span>
                            <span>{{ pendaftaran.pasien.nama }}</span>
                        </div>

                        <div class="flex">
                            <span class="font-bold w-40">Tanggal Lahir</span>
                            <span class="mr-4">:</span>
                            <span>{{ pendaftaran.pasien.tanggal_lahir }}</span>
                        </div>
                    </div>

                    <!-- Kolom 2 -->
                    <div>
                        <div class="flex mb-6">
                            <span class="font-bold w-40">Jenis Kelamin</span>
                            <span class="mr-4">:</span>
                            <span>{{ pendaftaran.pasien.jenis_kelamin }}</span>
                        </div>

                        <div class="flex mb-6">
                            <span class="font-bold w-40">TB / BB</span>
                            <span class="mr-4">:</span>
                            <span>
                                {{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm /
                                {{ pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg
                            </span> 
                        </div>

                        <div class="flex">
                            <span class="font-bold w-40">Kelas BPJS</span>
                            <span class="mr-4">:</span>
                            <span>{{ pendaftaran.pasien.kelas_bpjs }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="p-8">

                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-green-900">
                        Input Tindakan
                    </h1>
                </div>

                <!-- Form -->
                <div class="max-w-4xl">

                    <!-- No Registrasi -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            Nama Tindakan
                        </label>

                        <select v-model="form.id_tindakan"
                            class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">

                            <option value="">Pilih Tindakan</option>

                            <option v-for="item in tindakan" :key="item.id_tindakan" :value="item.id_tindakan">

                                {{ item.nama_tindakan }}
                            </option>

                        </select>
                    </div>

                    <!-- Keluhan Awal -->
                    <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                        <label class="text-2xl font-medium">
                            Jumlah
                        </label>

                        <input v-model="form.jumlah" type="number" min="1"
                            class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                    </div>
                    
                    <div class="grid grid-cols-[220px_1fr] mb-4">
                        <div></div>

                        <button
                            class="w-fit border border-gray-500 rounded-xl px-5 py-2 hover:bg-gray-100 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="size-5">
                                <path
                                    d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                            </svg>
                            Tambah Tindakan Lain
                        </button>
                    </div>

                    <!-- Button -->
                    <div class="flex justify-end">
                        <button @click="submit"
                            class="bg-green-900 hover:bg-green-800 text-white font-semibold text-xl px-16 py-3 rounded-xl">
                            Kirim
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>