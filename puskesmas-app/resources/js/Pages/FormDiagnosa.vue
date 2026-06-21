<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

    const props = defineProps({
        pendaftaran: Object
    })

    const tanggalHariIni = computed(() => {
        return new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        })
    })

    const form = useForm({
        no_registrasi: props.pendaftaran.no_registrasi,
        tinggi_badan: '',
        berat_badan: '',
        tensi: '',
        suhu: '',
        diagnosa: ''
    })

    const submit = () => {
        form.post(route('diagnosa.store'))
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
                            <span>{{ pendaftaran.pasien?.no_rm }}</span>
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

                        <div class="flex">
                            <span class="font-bold w-40">Kelas BPJS</span>
                            <span class="mr-4">:</span>
                            <span>{{ pendaftaran.pasien.kelas_bpjs }}</span>
                        </div>
                    </div>

                </div>
            </div>
    
            <div class="min-h-screen p-10">
                <form @submit.prevent="submit">
        
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-4xl font-bold text-green-900">
                            Input Diagnosa
                        </h1>
        
                        <div class="flex items-center gap-3 border-2 border-green-900 rounded-2xl px-6 py-3 bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="size-8 text-emerald-800">
        
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6h15A1.5 1.5 0 0 1 21 7.5v12A1.5 1.5 0 0 1 19.5 21h-15A1.5 1.5 0 0 1 3 19.5v-12A1.5 1.5 0 0 1 4.5 6Z" />
        
                            </svg>
        
                            <span class="font-semibold text-lg capitalize">
                                {{ tanggalHariIni }}
                            </span>
                        </div>
                    </div>
        
                    <!-- Form -->
                    <div class="max-w-4xl">
                        <div class="grid grid-cols-2 gap-6 mb-4">

                            <div>
                                <label class="block text-xl font-medium mb-2">
                                    Tinggi Badan
                                </label>

                                <div class="flex items-center gap-3">
                                    <input type="number" v-model="form.tinggi_badan"
                                        class="border border-gray-500 rounded-lg h-12 w-full px-3 bg-white">

                                    <span>cm</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xl font-medium mb-2">
                                    Berat Badan
                                </label>

                                <div class="flex items-center gap-3">
                                    <input type="number" v-model="form.berat_badan"
                                        class="border border-gray-500 rounded-lg h-12 w-full px-3 bg-white">

                                    <span>kg</span>
                                </div>
                            </div>

                        </div>
                                        <!-- BB -->
                        <div class="grid grid-cols-2 gap-6 mb-6">

                            <div>
                                <label class="block text-xl font-medium mb-2">
                                    Suhu
                                </label>

                                <div class="flex items-center gap-3">
                                    <input type="number" step="0.1" v-model="form.suhu"
                                        class="border border-gray-500 rounded-lg h-12 w-full px-3 bg-white">

                                    <span>°C</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xl font-medium mb-2">
                                    Tensi
                                </label>

                                <div class="flex items-center gap-3">
                                    <input type="text" placeholder="120/80" v-model="form.tensi"
                                        class="border border-gray-500 rounded-lg h-12 w-full px-3 bg-white">
                                    <span>mmHg</span>
                                </div>
                            </div>

                        </div>
                        <!-- Diagnosa -->
                        <div class="grid grid-cols-[220px_1fr] items-center mb-4">
                            <label class="text-2xl font-medium">
                                Diagnosa
                            </label>
        
                            <textarea rows="4" v-model="form.diagnosa"
                                class="border border-gray-500 rounded-lg p-4 bg-white w-full resize-none"></textarea>
                        </div>

                        <p v-if="$page.props.errors.diagnosa" class="text-red-500 text-sm mt-2">
                            {{ $page.props.errors.diagnosa }}
                        </p>
                    </div>
                
        
                    <!-- Button -->
                    <div class="flex justify-end mt-8">
                        <button type="submit"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-8 py-3 rounded-lg shadow">
                            Simpan Diagnosa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>