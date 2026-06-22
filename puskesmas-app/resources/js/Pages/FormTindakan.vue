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
            <main class="flex-1 overflow-y-auto p-8">
                <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6 mb-8">
                    <div class="bg-green-100 rounded-lg p-10 shadow">
                        <h1 class="text-3xl mb-8 font-extrabold text-emerald-800">
                            Keterangan Pasien
                        </h1>
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">No RM</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.no_rm }}</span>
                                </div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">Nama Pasien</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.nama }}</span>
                                </div>
                                <div class="flex">
                                    <span class="font-bold w-40">Tanggal Lahir</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.tanggal_lahir }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">Jenis Kelamin</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.jenis_kelamin }}</span>
                                </div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">TB / BB</span>
                                    <span class="mr-4">:</span>
                                    <span>
                                        {{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm /
                                        {{ pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg
                                    </span>
                                </div>
                                <div class="flex">
                                    <span class="font-bold w-40">Kelas BPJS</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.kelas_bpjs }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex justify-between items-center mb-8">
                            <h1 class="text-4xl font-bold text-green-900">Input Tindakan</h1>
                        </div>

                        <div class="max-w-4xl">
                            <!-- Baris tindakan dinamis -->
                            <div v-for="(item, index) in tindakanList" :key="index"
                                class="grid grid-cols-[220px_1fr_120px_40px] items-center gap-4 mb-4">

                                <label class="text-2xl font-medium" v-if="index === 0">Nama Tindakan</label>
                                <div v-else></div>

                                <!-- Dropdown tindakan dari DB (props.tindakan) -->
                                <select v-model="tindakanList[index].id_tindakan"
                                    class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full">
                                    <option value="">Pilih Tindakan</option>
                                    <option v-for="t in props.tindakan" :key="t.id_tindakan" :value="t.id_tindakan">
                                        {{ t.nama_tindakan }}
                                    </option>
                                </select>

                                <input v-model="tindakanList[index].jumlah" type="number"
                                    class="border border-gray-500 rounded-lg h-12 px-4 bg-white w-full"
                                    placeholder="Jumlah" />

                                <button v-if="tindakanList.length > 1" @click="hapusTindakan(index)"
                                    class="text-red-500 hover:text-red-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <div v-else></div>
                            </div>

                            <!-- Tombol tambah -->
                            <div class="grid grid-cols-[220px_1fr_120px_40px] items-center gap-4 mb-4">
                                <div></div>
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
                                    class="bg-green-900 hover:bg-green-800 text-white font-semibold text-xl px-16 py-3 rounded-xl">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popup sukses -->
                <div v-if="showModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
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