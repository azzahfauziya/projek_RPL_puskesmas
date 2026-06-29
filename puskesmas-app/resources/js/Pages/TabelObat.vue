<script setup>
    import { ref, computed, watch } from 'vue'

    import NavBar from '@/Components/NavBar.vue'
    import SideBar from '@/Components/SideBar.vue'

    const search = ref('')
    const sidebarOpen = ref(false)
    const props = defineProps({
        obatDokter: Array
    })

    const halaman = ref(1)
    const perPage = 10

    const totalHalaman = computed(() => {
        return Math.ceil(obatFilter.value.length / perPage)
    })

    const obatTampil = computed(() => {
        const start = (halaman.value - 1) * perPage
        const end = start + perPage

        return obatFilter.value.slice(start, end)
    })

    const obatFilter = computed(() => {
        if (!search.value) return props.obatDokter

        return props.obatDokter.filter(item =>
            item.id_obat.toLowerCase().includes(search.value.toLowerCase()) ||
            item.nama_obat.toLowerCase().includes(search.value.toLowerCase())
        )
    })

    const nextPage = () => {
        if (halaman.value < totalHalaman.value) {
            halaman.value++
        }
    }

    const prevPage = () => {
        if (halaman.value > 1) {
            halaman.value--
        }
    }

    const firstPage = () => {
        halaman.value = 1
    }

    const lastPage = () => {
        halaman.value = totalHalaman.value
    }

    watch(search, () => {
        halaman.value = 1
    })
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" @close="sidebarOpen = false" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 md:p-8">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
                    <h1 class="text-2xl font-extrabold text-[#144B29] sm:flex-1">
                        Tabel Obat
                    </h1>
                    <input v-model="search" type="text"
                        class="w-full sm:w-64 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="Cari obat berdasarkan ID / Nama" />
                </div>

                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 text-center overflow-x-auto">
                        <table class="table-auto w-full min-w-[500px]">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 rounded-l-lg">ID</th>
                                    <th class="py-3 px-4">Nama</th>
                                    <th class="py-3 px-4">Stok</th>
                                    <th class="py-3 px-4">Harga Satuan</th>
                                    <th class="py-3 px-4 rounded-r-lg">Bentuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in obatTampil" :key="item.id_obat"
                                    class="border-b"
                                    :class="{ 'bg-red-100 text-red-700 font-semibold': item.stok == 0 }">
                                    <td class="py-3 px-4">{{ item.id_obat }}</td>
                                    <td class="py-3 px-4">{{ item.nama_obat }}</td>
                                    <td class="py-3 px-4">{{ item.stok }}</td>
                                    <td class="py-3 px-4">
                                        Rp {{ Number(item.harga_satuan).toLocaleString('id-ID') }}
                                    </td>
                                    <td class="py-3 px-4">{{ item.bentuk }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex flex-wrap justify-end mt-4 gap-2">
                    <button @click="firstPage"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                        </svg>
                    </button>
                    <button @click="prevPage" :disabled="halaman === 1"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="border border-emerald-800 bg-emerald-800 text-white w-10 h-10 rounded-lg">
                        {{ halaman }}
                    </button>
                    <button @click="nextPage" :disabled="halaman === totalHalaman"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                    <button @click="lastPage"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>

            </main>
        </div>
    </div>
</template>