<!-- <script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    antrian: { type: Array, default: () => [] }
})

const search = ref('')
const currentPage = ref(1)
const perPage = ref(20)

const filtered = computed(() => {
    const source = props.antrian ?? []
    if (!search.value) return source
    const q = search.value.toLowerCase()
    return source.filter(p =>
        p.no_rm.toLowerCase().includes(q) ||
        (p.pasien?.nama ?? '').toLowerCase().includes(q)
    )
})

const totalPages = computed(() => Math.ceil(filtered.value.length / perPage.value))

const paginated = computed(() => {
    const start = (currentPage.value - 1) * perPage.value
    return filtered.value.slice(start, start + perPage.value)
})

function prevPage() {
    if (currentPage.value > 1) currentPage.value--
}
function nextPage() {
    if (currentPage.value < totalPages.value) currentPage.value++
}
function firstPage() {
    currentPage.value = 1
}
function lastPage() {
    currentPage.value = totalPages.value
}
</script>

<template>
    <div class="p-8 bg-gray-100 min-h-screen dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="col-span-3">
                <h1 class="text-2xl font-extrabold text-[#144B29] dark:text-blue-400">
                    Tabel Antrian
                </h1>
                <pre>{{ antrian.length }} total | page {{ currentPage }} | start: {{ (currentPage - 1) * perPage }} | showing {{ paginated.length }}</pre>
            </div>
            <div>
                <input
                    v-model="search"
                    type="text"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Cari pasien No RM/Nama"
                />
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-4">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="py-3 px-4 rounded-l-lg">No Registrasi</th>
                            <th class="py-3 px-4">No RM</th>
                            <th class="py-3 px-4">Nama Pasien</th>
                            <th class="py-3 px-4 rounded-r-lg">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-if="paginated.length === 0"
                            class="border-b dark:border-gray-700"
                        >
                            <td colspan="4" class="py-6 text-center text-gray-400">
                                Tidak ada data antrian.
                            </td>
                        </tr>
                        <tr
                            v-for="(item, index) in paginated"
                            :key="item.no-registrasi"
                            class="border-b dark:border-gray-700"
                        >
                            <!-- <td class="py-3 px-4 text-center">
                                {{ (currentPage - 1) * perPage.value + index + 1 }}
                            </td> -->
                            <!-- <td class="py-3 px-4">{{ item.no_registrasi }}</td>
                            <td class="py-3 px-4">{{ item.no_rm }}</td>
                            <td class="py-3 px-4">{{ item.pasien?.nama ?? '-' }}</td>
                            <td class="py-3 px-4 text-center"> -->
                                <!-- <button
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md"
                                >
                                    Detail
                                </button>
                            </td> -->
                        <!-- </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end mt-4 gap-2">
            <button
                @click="firstPage"
                :disabled="currentPage === 1"
                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                </svg>
            </button>
            <button
                @click="prevPage"
                :disabled="currentPage === 1"
                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>

            <template v-for="page in totalPages" :key="page">
                <button
                    @click="currentPage = page"
                    :class="page === currentPage
                        ? 'border border-emerald-800 bg-emerald-800 text-white w-10 h-10 rounded-lg'
                        : 'w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800'"
                >
                    {{ page }}
                </button>
            </template>

            <button
                @click="nextPage"
                :disabled="currentPage === totalPages || totalPages === 0"
                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
            <button
                @click="lastPage"
                :disabled="currentPage === totalPages || totalPages === 0"
                class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div> -->
<!-- </template> --> 

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    antrian: { type: Array, default: () => [] }
})

const sidebarOpen = ref(false)
const search = ref('')
const currentPage = ref(1)
const perPage = 15

const filtered = computed(() => {
    const source = Array.isArray(props.antrian) ? props.antrian : []
    if (!search.value) return source
    const q = search.value.toLowerCase()
    return source.filter(p =>
        (p.no_rm ?? '').toLowerCase().includes(q) ||
        (p.pasien?.nama ?? '').toLowerCase().includes(q)
    )
})

const paginated = computed(() => {
    const data = filtered.value ?? []
    const start = (currentPage.value - 1) * perPage
    return data.slice(start, start + perPage)
})

const totalPages = computed(() => Math.ceil(filtered.value.length / perPage))

// const paginated = computed(() => {
//     const start = (currentPage.value - 1) * perPage
//     return filtered.value.slice(start, start + perPage)
// })
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
                        <h1 class="text-2xl font-extrabold text-[#144B29]">Daftar Antrian</h1>
                        <!-- <pre>{{ antrian }}</pre> -->
                    </div>
                    <div>
                        <input v-model="search" type="text"
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Cari No. RM / Nama" />
                    </div>
                </div>

                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4">
                        <table class="table-auto w-full text-sm">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 text-left rounded-l-lg">No. Registrasi</th>
                                    <th class="py-3 px-4 text-left">No. RM</th>
                                    <th class="py-3 px-4 text-left">Nama</th>
                                    <th class="py-3 px-4 text-left">Tanggal Kunjungan</th>
                                    <th class="py-3 px-4 text-center rounded-r-lg">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="paginated.length === 0">
                                    <td colspan="7" class="text-center text-slate-400 py-8">
                                        Tidak ada antrian
                                    </td>
                                </tr>
                                <tr v-for="item in paginated" :key="item.no_registrasi"
                                    class="border-b hover:bg-slate-50">
                                    <td class="py-3 px-4">{{ item.no_registrasi }}</td>
                                    <td class="py-3 px-4">{{ item.no_rm }}</td> 
                                    <td class="py-3 px-4 font-medium">{{ item.pasien?.nama }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ item.tanggal_kunjungan }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <Link :href="route('detail-pasien', item.no_registrasi)"
                                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-4 py-1 rounded-lg shadow-md text-xs inline-block">
                                            Detail
                                        </Link>
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