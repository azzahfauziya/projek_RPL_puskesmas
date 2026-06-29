<script setup>
import { ref, computed } from 'vue'
import { Link, usePage, useForm } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    antrian: { type: Array, default: () => [] }
})

const sidebarOpen = ref(false)
const showModal = ref(false)
const search = ref('')
const currentPage = ref(1)
const perPage = 15
const page = usePage()

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

const form = useForm({
    jenis_kelamin: '',
    keluhan_awal: '',
    tensi: '',
    suhu: ''
})

const submitDarurat = () => {
    form.post(route('pasien-darurat.store'), {
        onSuccess: () => {
            showModal.value = false
            form.reset()
        }
    })
}

const role = computed(() => {
    return page.props.auth?.user?.role
})
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" @close="sidebarOpen = false"/>
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
                    <div class="flex-1">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-[#144B29]">Daftar Antrian</h1>
                    </div>
                    <div class="w-full sm:w-64">
                        <input v-model="search" type="text"
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Cari No. RM / Nama" />
                    </div>
                </div>

                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 overflow-x-auto">
                        <table class="table-auto w-full text-sm min-w-[400px]">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 text-left rounded-l-lg">No. Registrasi</th>
                                    <th class="py-3 px-4 text-left">No. RM</th>
                                    <th class="py-3 px-4 text-left">Nama</th>
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
                                    :class="['border-b',
                                        item.jenis_pendaftaran === 'darurat'
                                            ? 'text-red-700 font-bold rounded-lg'
                                            : ''
                                    ]"
                                    class="border-b hover:bg-slate-50">
                                    <td class="py-3 px-4">{{ item.no_registrasi }}</td>
                                    <td class="py-3 px-4">{{ item.no_rm }}</td>
                                    <td class="py-3 px-4 font-medium">{{ item.pasien?.nama }}</td>
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

                <!-- Footer: tombol darurat + pagination -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mt-4">
                    <!-- Tombol Pasien Darurat -->
                    <div class="flex-1">
                        <div v-if="role === 'administrasi'">
                            <button @click="showModal = true"
                                class="text-red-800 font-extrabold text-sm">
                                Tambahkan Pasien Darurat
                            </button>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex flex-wrap justify-end gap-2">
                        <button @click="currentPage = 1" :disabled="currentPage === 1"
                            class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                            </svg>
                        </button>
                        <button @click="currentPage--" :disabled="currentPage === 1"
                            class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <button v-for="p in totalPages" :key="p" @click="currentPage = p"
                            :class="currentPage === p ? 'bg-emerald-800 text-white' : 'text-emerald-800'"
                            class="w-10 h-10 border border-emerald-800 rounded-lg">
                            {{ p }}
                        </button>

                        <button @click="currentPage++" :disabled="currentPage === totalPages"
                            class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                        <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                            class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Modal Pasien Darurat -->
    <div v-if="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl p-6 sm:p-8 w-full max-w-lg">

            <h2 class="text-xl sm:text-2xl font-bold mb-6">
                Pasien Darurat
            </h2>

            <form @submit.prevent="submitDarurat">

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                    <select v-model="form.jenis_kelamin" class="w-full border rounded-lg p-3 text-sm">
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Keluhan Awal</label>
                    <textarea v-model="form.keluhan_awal" class="w-full border rounded-lg p-3 text-sm"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">Tensi</label>
                        <input type="text" v-model="form.tensi" class="w-full border rounded-lg p-3 text-sm"
                            placeholder="120/80">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Suhu</label>
                        <input type="number" step="0.1" v-model="form.suhu" class="w-full border rounded-lg p-3 text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" @click="showModal = false"
                        class="px-5 py-2 border rounded-lg text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-red-600 text-white px-5 py-2 rounded-lg text-sm">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>