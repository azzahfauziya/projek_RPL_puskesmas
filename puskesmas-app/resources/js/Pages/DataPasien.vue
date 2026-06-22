<!-- data pasien yg punya rm -->
<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pasien: { type: Array, default: () => [] }
})

const sidebarOpen = ref(false)
const search = ref('')
const currentPage = ref(1)
const perPage = 15

const filtered = computed(() => {
    const source = Array.isArray(props.pasien) ? props.pasien : []
    if (!search.value) return source
    const q = search.value.toLowerCase()
    return source.filter(p =>
        (p.no_rm ?? '').toLowerCase().includes(q) ||
        (p.nama ?? '').toLowerCase().includes(q)
    )
})

const paginated = computed(() => {
    const data = filtered.value ?? []
    const start = (currentPage.value - 1) * perPage
    return data.slice(start, start + perPage)
})

const totalPages = computed(() => Math.ceil(filtered.value.length / perPage))

</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">

                        <!-- Header -->
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            <div class="col-span-3">
                                <h1 class="text-2xl font-extrabold text-[#144B29]">Data Pasien</h1>
                                <!-- <pre>{{ pasien }}</pre> -->
                            </div>
                            <div>
                                <input v-model="search" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Cari No. RM / Nama" />
                            </div>
                        </div>

                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 rounded-l-lg">No RM</th>
                                    <th class="py-3 px-4 ">Nama Pasien</th>
                                    <th class="py-3 px-4 rounded-r-lg">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="paginated.length === 0">
                                    <td colspan="7" class="text-center text-slate-400 py-8">
                                        Tidak ada Data Pasien
                                    </td>
                                </tr>
                                <tr v-for="item in paginated" :key="item.no_rm"
                                    class="border-b hover:bg-slate-50">
                                    <td class="py-3 px-4">{{ item.no_rm }}</td> 
                                    <td class="py-3 px-4 font-medium">{{ item.nama }}</td>
                                    <td class="py-3 items-center justify-center text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="router.visit(route('histori-pasien', item.no_rm))"
                                                class="bg-slate-600 hover:bg-slate-500 text-white font-semibold px-4 py-1 rounded-lg shadow-md">
                                                Riwayat
                                            </button>
                                        </div>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-end mt-4 gap-2">
                    <button @click="currentPage = 1" :disabled="currentPage === 1"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                        </svg>
                    </button>
                    <button @click="currentPage--" :disabled="currentPage === 1"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <button v-for="page in totalPages" :key="page" @click="currentPage = page"
                        :class="currentPage === page ? 'bg-emerald-800 text-white' : 'text-emerald-800'"
                        class="w-10 h-10 border border-emerald-800 rounded-lg">
                        {{ page }}
                    </button>

                    <button @click="currentPage++" :disabled="currentPage === totalPages"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                    <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>

            </main>
        </div>
    </div>

</template>