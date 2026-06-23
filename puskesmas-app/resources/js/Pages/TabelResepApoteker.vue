<script setup>
import { ref, computed, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const sidebarOpen = ref(false)

const props = defineProps({
    resepApoteker: Array
})

const updateStatus = (resep) => {
    router.put(route('resep.updateStatus', resep.id_resep), {
        status: resep.status
    })
}

const search = ref('')
const halaman = ref(1)
const perPage = 10

const resepFilter = computed(() => {
    let data = [...props.resepApoteker]

    if (search.value) {
        const keyword = search.value.toLowerCase()

        data = data.filter(item => {
            const nama =
                item.resep?.rekam_medis?.pendaftaran?.pasien?.nama?.toLowerCase() || ''

            const noReg =
                item.resep?.rekam_medis?.pendaftaran?.no_registrasi?.toLowerCase() || ''

            return nama.includes(keyword) || noReg.includes(keyword)
        })
    }

    data.sort((a, b) => {

        // proses selalu di atas
        if (
            a.resep?.status === 'proses' &&
            b.resep?.status === 'selesai'
        ) {
            return -1
        }

        if (
            a.resep?.status === 'selesai' &&
            b.resep?.status === 'proses'
        ) {
            return 1
        }

        // terbaru di atas
        return new Date(b.resep?.created_at) -
            new Date(a.resep?.created_at)
    })

    return data
})

const totalHalaman = computed(() =>
    Math.ceil(resepFilter.value.length / perPage)
)

const resepTampil = computed(() => {
    const start = (halaman.value - 1) * perPage
    return resepFilter.value.slice(start, start + perPage)
})

watch(search, () => {
    halaman.value = 1
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
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">

                <!-- Header dengan grid 2 kolom: Judul di kiri, Search di kanan -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
                    <h1 class="text-2xl font-extrabold text-[#144B29] dark:text-blue-400 sm:flex-1">
                        Tabel Resep Obat
                    </h1>
                    <input v-model="search" type="text"
                        class="w-full sm:w-64 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="Cari obat berdasarkan ID / Nama" />
                </div>

                <!-- Tabel -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="p-4 text-center overflow-x-auto">
                        <table class="table-auto w-full min-w-[500px]">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="py-3 px-4 min-w-0 rounded-l-lg">No Registrasi</th>
                                    <th class="py-3 px-4 ">Nama Pasien</th>
                                    <th class="py-3 px-4 ">Nama Obat</th>
                                    <th class="py-3 px-4 ">Jumlah</th>
                                    <th class="py-3 px-4 ">Aturan Pakai</th>
                                    <th class="py-3 px-4 rounded-r-lg">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in resepTampil" :key="item.id_resep"
                                    class="border-b dark:border-gray-700">
                                    <td class="py-3 px-4 ">
                                        {{ item.resep?.rekam_medis?.no_registrasi }}
                                    </td>

                                    <td class="py-3 px-4">
                                        {{ item.resep?.rekam_medis?.pendaftaran?.pasien?.nama }}
                                    </td>

                                    <td class="py-3 px-4">
                                        {{ item.nama_obat_saat_resep }}
                                    </td>

                                    <td class="py-3 px-4">
                                        {{ item.jumlah }}
                                    </td>

                                    <td class="py-3 px-4">
                                        {{ item.aturan_pakai }}
                                    </td>

                                    <td class="py-3 px-4 text-center">
                                        <select v-model="item.resep.status" @change="updateStatus(item.resep)"
                                            class="px-8 py-1 rounded-full font-semibold outline-none cursor-pointer"
                                            :class="{
                                                'bg-red-100 text-red-700': item.resep.status === 'proses',
                                                'bg-green-100 text-green-700': item.resep.status === 'selesai'
                                            }">
                                            <option value="proses">Proses</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <!-- Pagination -->
                    <div class="flex justify-end mt-4 gap-2">
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
                </div>
            </main>
        </div>
    </div>
</template>