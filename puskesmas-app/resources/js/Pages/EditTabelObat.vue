<script setup>

import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

    const search = ref('')

    const props = defineProps({
        obat: Array
    })

    const obatFilter = computed(() => {
        if (!search.value) return props.obat

        return props.obat.filter(item =>
            item.id_obat.toLowerCase().includes(search.value.toLowerCase()) ||
            item.nama_obat.toLowerCase().includes(search.value.toLowerCase())
        )
    })

    const simpanSemua = () => {
        console.log(props.obat)

        router.put(route('obat.update.semua'), {
            obat: props.obat
        })
    }

    const tambahObat = () => {
        props.obat.push({
            id_obat: '',
            nama_obat: '',
            stok: 0,
            harga_satuan: 0,
            bentuk: '',
            satuan: '',
            is_new: true
        })
    }
</script> 

<template>
    <div class="p-8 bg-gray-100 min-h-screen dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <!-- Header dengan grid 2 kolom: Judul di kiri, Search di kanan -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <!-- Kolom Kiri: Judul -->
            <div class="col-span-3">
                <h1 class="text-2xl font-extrabold text-[#144B29] dark:text-blue-400">
                    Tabel Obat
                </h1>
            </div>

            <!-- Kolom Kanan: Search -->
            <div>
                <div>
                    <input v-model="search" type="text"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="Cari obat berdasarkan ID / Nama" />
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="py-3 px-4 rounded-l-lg">ID</th>
                            <th class="py-3 px-4 ">Nama</th>
                            <th class="py-3 px-4 ">Stok</th>
                            <th class="py-3 px-4 ">Harga Satuan</th>
                            <th class="py-3 px-4 ">Bentuk</th>
                            <th class="py-3 px-4 rounded-r-lg">Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in obatFilter" :key="item.id_obat" class="border-b dark:border-gray-700">
                            <!-- ID -->
                            <td class="py-3 px-4">
                                <input type="text" :value="item.id_obat" disabled
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg bg-gray-100" />
                            </td>

                            <!-- Nama Obat -->
                            <td class="py-3 px-4">
                                <input v-model="item.nama_obat" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg" />
                            </td>

                            <!-- Stok -->
                            <td class="py-3 px-4">
                                <input v-model="item.stok" type="number" min="0"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg" />
                            </td>

                            <!-- Harga -->
                            <td class="py-3 px-4">
                                <input v-model="item.harga_satuan" type="number" min="0"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg" />
                            </td>

                            <!-- Bentuk -->
                            <td class="py-3 px-4">
                                <input v-model="item.bentuk" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg" />
                            </td>

                            <td class="py-3 px-4">
                                <input v-model="item.satuan" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- tombol pindah halaman -->
        <div class="flex justify-end items-center gap-4 mt-6">
            <button @click="tambahObat"
                class="flex items-center gap-2 bg-white border-2 border-green-900 text-green-900 hover:bg-green-50 font-semibold px-6 py-3 rounded-xl transition duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Obat
            </button>

            <button @click="simpanSemua"
                class="flex items-center gap-2 bg-green-900 hover:bg-green-800 text-white font-semibold px-8 py-3 rounded-xl transition duration-200 shadow-md">
                Simpan
            </button>
        </div>   
    </div>
</template>