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
                <input v-model="search" type="text"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="Cari obat berdasarkan ID / Nama" />
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
                            <th class="py-3 px-4 rounded-r-lg">Bentuk</th>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- tombol pindah halaman -->
        <div class="flex justify-end mt-6">
            <button @click="simpanSemua"
                class="bg-green-900 hover:bg-green-800 text-white font-semibold text-xl px-16 py-3 rounded-xl">
                Simpan
            </button>
        </div>   
    </div>
</template>