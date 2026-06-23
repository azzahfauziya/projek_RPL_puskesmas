<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    staff: { type: Array, default: () => [] }
})

const sidebarOpen = ref(false)
const search = ref('')
const currentPage = ref(1)
const perPage = 10

const page = usePage()
const isAdministrasi = computed(() => page.props.auth?.user?.role === 'administrasi')

const filtered = computed(() => {
    const source = Array.isArray(props.staff) ? props.staff : []
    if (!search.value) return source
    const q = search.value.toLowerCase()
    return source.filter(s =>
        s.nama.toLowerCase().includes(q) ||
        s.jabatan.toLowerCase().includes(q)
    )
})

const totalPages = computed(() => Math.ceil(filtered.value.length / perPage))

const paginated = computed(() => {
    const start = (currentPage.value - 1) * perPage
    return filtered.value.slice(start, start + perPage)
})
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 md:p-8">

                <!-- Header -->
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <h1 class="text-2xl font-extrabold text-[#144B29]">Data Staff</h1>
                    <div class="flex items-center gap-2 flex-wrap">
                        <Link v-if="isAdministrasi" :href="route('staff.create')"
                            class="px-4 py-2.5 text-sm bg-[#144B29] text-white rounded-lg hover:bg-emerald-800">
                            + Tambah Staff
                        </Link>
                        <input v-model="search" type="text"
                            class="px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 w-48 md:w-64"
                            placeholder="Cari Nama" />
                    </div>
                </div>

                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 overflow-x-auto">
                        <table class="table-auto w-full text-sm min-w-[400px]">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 text-left">Nama</th>
                                    <th class="py-3 px-4 text-left">Jabatan</th>
                                    <th class="py-3 px-4 text-left">No. HP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="paginated.length === 0">
                                    <td colspan="7" class="text-center text-slate-400 py-8">
                                        Belum ada data pasien
                                    </td>
                                </tr>
                                <tr v-for="item in paginated" :key="item.id" class="border-b hover:bg-slate-50">
                                    <td class="py-3 px-4 font-medium">{{ item.nama }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ item.jabatan }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ item.no_hp ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-end mt-4 gap-2 flex-wrap">
                    <button @click="currentPage = 1" :disabled="currentPage === 1"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                        </svg>
                    </button>
                    <button @click="currentPage--" :disabled="currentPage === 1"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                    <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                        class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
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