<script setup>
import { ref, computed } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pendaftaran: Object,
    tindakan: Array  // list tindakan dari DB
})

const sidebarOpen = ref(false)
const page = usePage()
const showSuccess = computed(() => !!page.props.flash?.success)
const showModal = ref(false)

// Pisah dari useForm supaya reaktif
const tindakanList = ref([{ id_tindakan: '', jumlah: null }])

const form = useForm({
    no_registrasi: props.pendaftaran.no_registrasi,
})

function tambahTindakan() {
    tindakanList.value.push({ id_tindakan: '', jumlah: null })
}

function hapusTindakan(index) {
    tindakanList.value.splice(index, 1)
}

function submit() {
    form.transform(data => ({
        ...data,
        tindakan: tindakanList.value
    })).post(route('tindakan.simpan'), {
        preserveScroll: true,
        onSuccess: () => {
            showModal.value = true
        }
    })
}
function kembaliKeDetail() {
    router.visit(
        route('detail-pasien', props.pendaftaran.no_registrasi)
    )
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="bg-white rounded-lg shadow-md border border-gray-300 p-4 md:p-6 mb-8">

                    <!-- Keterangan Pasien -->
                    <div class="bg-green-100 rounded-lg p-6 md:p-10 shadow">
                        <h1 class="text-2xl md:text-3xl mb-6 md:mb-8 font-extrabold text-emerald-800">
                            Keterangan Pasien
                        </h1>
                        <div class="grid grid-cols-2 gap-4 md:gap-8">
                            <div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">No RM</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pendaftaran.pasien.no_rm }}</span>
                                </div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">Nama Pasien</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pendaftaran.pasien.nama }}</span>
                                </div>
                                <div class="flex flex-col md:flex-row">
                                    <span class="font-bold md:w-40 shrink-0">Tanggal Lahir</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pendaftaran.pasien.tanggal_lahir }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">Jenis Kelamin</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pendaftaran.pasien.jenis_kelamin }}</span>
                                </div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">TB / BB</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">
                                        {{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm /
                                        {{ pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg
                                    </span>
                                </div>
                                <div class="flex flex-col md:flex-row">
                                    <span class="font-bold md:w-40 shrink-0">Kelas BPJS</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pendaftaran.pasien.kelas_bpjs }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Tindakan -->
                    <div class="p-4 md:p-8">
                        <div class="flex justify-between items-center mb-6 md:mb-8">
                            <h1 class="text-2xl md:text-4xl font-bold text-green-900">Input Tindakan</h1>
                        </div>

                        <div class="max-w-4xl">
                            <!-- Baris tindakan dinamis -->
                            <div v-for="(item, index) in tindakanList" :key="index" class="mb-4">

                                <label class="text-xl md:text-2xl font-medium mb-2 block" v-if="index === 0">
                                    Nama Tindakan
                                </label>

                                <div class="flex gap-3 items-center">
                                    <select v-model="tindakanList[index].id_tindakan"
                                        class="border border-gray-500 rounded-lg h-12 px-4 bg-white flex-1 min-w-0">
                                        <option value="">Pilih Tindakan</option>
                                        <option v-for="t in props.tindakan" :key="t.id_tindakan" :value="t.id_tindakan">
                                            {{ t.nama_tindakan }}
                                        </option>
                                    </select>

                                    <input v-model="tindakanList[index].jumlah" type="number"
                                        class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-20 md:w-28 shrink-0"
                                        placeholder="Jumlah" />

                                    <button v-if="tindakanList.length > 1" @click="hapusTindakan(index)"
                                        class="text-red-500 hover:text-red-700 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <div v-else class="w-5 shrink-0"></div>
                                </div>
                            </div>

                            <!-- Tombol tambah -->
                            <div class="mb-4">
                                <button type="button" @click="tambahTindakan"
                                    class="w-fit border border-gray-500 rounded-xl px-5 py-2 hover:bg-gray-100 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-5">
                                        <path
                                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                                    </svg>
                                    Tambah Tindakan
                                </button>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" @click="submit"
                                    class="bg-green-900 hover:bg-green-800 text-white font-semibold text-lg md:text-xl px-10 md:px-16 py-3 rounded-xl">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popup sukses -->
                <div v-if="showModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
                    <div class="bg-white rounded-xl shadow-xl p-8 flex flex-col items-center gap-4 max-w-sm w-full">
                        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-8 h-8 text-emerald-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Tindakan Berhasil Disimpan!</h2>
                        <button @click="kembaliKeDetail"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-2 rounded-lg w-full">
                            OK
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>