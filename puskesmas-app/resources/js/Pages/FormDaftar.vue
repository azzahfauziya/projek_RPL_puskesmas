<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import axios from 'axios'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const showSuccess = computed(() => !!page.props.flash?.success)
const sidebarOpen = ref(false)
const searchQuery = ref('')
const searchResults = ref([])
const searchNotFound = ref(false)
const selectedPasien = ref(null)
const isExisting = computed(() => selectedPasien.value !== null)


const props = defineProps({
    pasienAwal: { type: Object, default: null }
})

onMounted(() => {
    if (props.pasienAwal) {
        pilihPasien(props.pasienAwal)
    }
})

const today = new Date()
const offset = today.getTimezoneOffset() * 60000
const localToday = new Date(today - offset).toISOString().split('T')[0]


const form = useForm({
    is_existing: false,
    no_rm: '',
    nama: '',
    tanggal_lahir: '',
    jenis_kelamin: '',
    alamat: '',
    no_hp: '',
    kelas_bpjs: '',
    // id_dokter:          '',
    keluhan_awal: '',
    tanggal_kunjungan: localToday,
})

watch(searchQuery, async (val) => {
    if (!val || val.length < 2) {
        searchResults.value = []
        searchNotFound.value = false
        return
    }
    const res = await axios.get('/pendaftaran/cari', { params: { q: val } })
    searchResults.value = res.data
    searchNotFound.value = res.data.length === 0
})

function pilihPasien(pasien) {
    selectedPasien.value = pasien
    searchQuery.value = pasien.no_rm
    searchResults.value = []
    searchNotFound.value = false

    axios.get(`/pasien/${pasien.no_rm}/detail`).then(res => {
        const p = res.data
        form.is_existing = true
        form.no_rm = p.no_rm
        form.nama = p.nama
        form.tanggal_lahir = p.tanggal_lahir
        form.jenis_kelamin = p.jenis_kelamin
        form.alamat = p.alamat
        form.no_hp = p.no_hp
        form.kelas_bpjs = p.kelas_bpjs
    })
}

function resetForm() {
    selectedPasien.value = null
    searchQuery.value = ''
    searchResults.value = []
    searchNotFound.value = false
    form.reset()
    form.is_existing = false
    form.tanggal_kunjungan = new Date().toISOString().split('T')[0]
}

function submit() {
    form.post('/pendaftaran', {
        onSuccess: () => {
            resetForm()
        }
    })
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">

                <div class="min-h-screen bg-gray-100 p-8">
                    <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6 mb-8">
                        <div class="mb-8">
                            <h1 class="text-4xl font-bold text-emerald-800">
                                Form Pendaftaran Pasien
                            </h1>
                        </div>

                        <div class="max-w-4xl mx-auto mt-5">

                            <!-- Search No RM -->
                            <div class="grid grid-cols-[220px_1fr] items-start mb-6">
                                <label class="font-bold text-xl pt-3">No. RM</label>
                                <div class="relative">
                                    <input v-model="searchQuery" type="text"
                                        placeholder="Ketik No. RM untuk cari pasien lama, kosongkan jika pasien baru..."
                                        class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white" />
                                    <div v-if="searchResults.length > 0"
                                        class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1">
                                        <div v-for="p in searchResults" :key="p.no_rm" @click="pilihPasien(p)"
                                            class="px-4 py-3 hover:bg-emerald-50 cursor-pointer flex justify-between">
                                            <span class="font-medium">{{ p.no_rm }}</span>
                                            <span class="text-slate-500">{{ p.nama }}</span>
                                        </div>
                                    </div>
                                    <p v-if="searchNotFound" class="text-red-500 text-sm mt-1">
                                        No. RM tidak ditemukan. Data akan didaftarkan sebagai pasien baru.
                                    </p>
                                    <p v-if="isExisting" class="text-emerald-600 text-sm mt-1">
                                        Pasien ditemukan — data terisi otomatis.
                                    </p>
                                </div>
                            </div>

                            <!-- Nama Pasien -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                                <label class="font-bold text-xl">Nama Pasien</label>
                                <input type="text" v-model="form.nama" :readonly="isExisting"
                                    :class="isExisting ? 'bg-gray-100 text-gray-500' : 'bg-white'"
                                    class="h-12 border border-gray-500 rounded-lg px-4 w-full" />
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                                <label class="font-bold text-xl">Tanggal Lahir</label>
                                <input v-if="!isExisting" type="date" v-model="form.tanggal_lahir"
                                    class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white" />
                                <input v-else type="text" :value="form.tanggal_lahir" readonly
                                    class="h-12 border border-gray-300 rounded-lg px-4 w-full bg-gray-100 text-gray-500" />
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-8">
                                <label class="font-bold text-xl">Jenis Kelamin</label>
                                <div v-if="!isExisting" class="flex items-center gap-6">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="radio" v-model="form.jenis_kelamin" value="P"
                                            name="gender">
                                        <span class="text-xl">Perempuan</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="radio" v-model="form.jenis_kelamin" value="L"
                                            name="gender">
                                        <span class="text-xl">Laki-laki</span>
                                    </label>
                                </div>
                                <input v-else type="text" :value="form.jenis_kelamin" readonly
                                    class="h-12 border border-gray-300 rounded-lg px-4 w-full bg-gray-100 text-gray-500" />
                            </div>

                            <!-- Alamat -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                                <label class="font-medium text-xl">Alamat</label>
                                <input type="text" v-model="form.alamat"
                                    class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white" />
                            </div>

                            <!-- No HP -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                                <label class="font-medium text-xl">No. HP</label>
                                <input type="text" v-model="form.no_hp" :readonly="isExisting"
                                    :class="isExisting ? 'bg-gray-100 text-gray-500' : 'bg-white'"
                                    class="h-12 border border-gray-500 rounded-lg px-4 w-full" />
                            </div>

                            <!-- Kelas BPJS -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                                <label class="font-medium text-xl">Kelas BPJS</label>
                                <select v-model="form.kelas_bpjs" :disabled="isExisting"
                                    :class="isExisting ? 'bg-gray-100 text-gray-500' : 'bg-white'"
                                    class="h-12 border border-gray-500 rounded-lg px-4 w-full">
                                    <option value="">-- Pilih Kelas BPJS --</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="Umum">Umum</option>
                                </select>
                            </div>

                            <!-- Tanggal Kunjungan -->
                            <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                                <label class="font-bold text-xl">Tanggal Kunjungan</label>
                                <input type="date" v-model="form.tanggal_kunjungan"
                                    class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white" />
                            </div>

                                    <!-- Dokter -->
                                    <!-- <div class="grid grid-cols-[220px_1fr] items-center mb-6">
                            <label class="font-bold text-xl">Dokter</label>
                            <select v-model="form.id_dokter"
                                class="h-12 border border-gray-500 rounded-lg px-4 w-full bg-white">
                                <option value="" disabled>Pilih dokter</option>
                                <option v-for="d in dokter" :key="d.id_dokter" :value="d.id_dokter">
                                    {{ d.nama }}
                                </option>
                            </select>
                        </div> -->

                            <!-- Keluhan Awal -->
                            <div class="grid grid-cols-[220px_1fr] items-start mb-12">
                                <label class="font-bold text-xl pt-3">Keluhan Awal</label>
                                <textarea v-model="form.keluhan_awal" rows="4"
                                    class="border border-gray-500 rounded-lg px-4 py-3 w-full bg-white resize-none"
                                    placeholder="Tulis keluhan pasien..."></textarea>
                            </div>

                            <!-- Button -->
                            <div class="flex justify-end p-8 gap-4">
                                <button type="button" @click="resetForm"
                                    class="bg-slate-400 hover:bg-slate-500 text-white font-semibold text-xl px-6 py-3 rounded-lg">
                                    Reset
                                </button>
                                <button type="button" @click="submit" :disabled="form.processing"
                                    class="bg-green-800 hover:bg-green-900 text-white font-semibold text-xl px-6 py-3 rounded-lg disabled:opacity-50">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Popup sukses -->
        <div v-if="showSuccess"
            class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-8 flex flex-col items-center gap-4 max-w-sm w-full">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-emerald-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Pendaftaran Berhasil!</h2>
                <p class="text-gray-500 text-center text-sm">Pasien telah berhasil didaftarkan ke antrian.</p>
                <button @click="() => router.visit('/pendaftaran')"
                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-2 rounded-lg w-full">
                    OK
                </button>
            </div>
        </div>
    </div>
</template>