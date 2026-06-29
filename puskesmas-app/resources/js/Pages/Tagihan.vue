<script setup>
import { ref, computed } from 'vue'
import { useForm, router, usePage } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pendaftaran: Object,
    tindakan: { type: Array, default: () => [] },
    obat: { type: Array, default: () => [] },
    totalTindakan: { type: Number, default: 0 },
    totalObat: { type: Number, default: 0 },
    totalKotor: { type: Number, default: 0 },
    sudahDibayar: { type: Number, default: 0 },
    kelasBpjs: { type: String, default: null },
})

const page = usePage()
const showSuccess = ref(false)
const sidebarOpen = ref(false)
const sudahProses = ref(false)

const form = useForm({
    no_registrasi: props.pendaftaran.no_registrasi,
    metode_pembayaran: '',
    jumlah_dibayarkan: '',
})

const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    }).format(angka ?? 0)
}

// Hitung potongan di frontend berdasarkan metode & kelas BPJS
const potonganPreview = computed(() => {

    const persen = {
        '1': 0.20,
        '2': 0.15,
        '3': 0.10
    }[props.kelasBpjs] ?? 0

    return Math.round(props.totalKotor * persen)
})

const totalBayarPreview = computed(() => props.totalKotor - potonganPreview.value)

const sisaTagihan = computed(() => {
    return totalBayarPreview.value - Number(props.sudahDibayar)
})

const kekurangan = computed(() => {
    const dibayar = Number(form.jumlah_dibayarkan) || 0
    const sisa = sisaTagihan.value - dibayar
    return sisa > 0 ? sisa : 0
})

const statusLunas = computed(() => {
    if (sudahProses.value) return true
    if (props.sudahDibayar >= totalBayarPreview.value && totalBayarPreview.value > 0) return true
    return false
})

// Validasi: tidak bisa proses kalau tidak ada tindakan/obat
const bisaProses = computed(() => {
    return props.tindakan.length > 0 || props.obat.length > 0
})

function submit() {
    if (!bisaProses.value) return
    form.post(route('billing.store'), {
        onSuccess: () => {
            sudahProses.value = true
            showSuccess.value = true
        }
    })
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100 min-w-0 max-w-full">
        <SideBar :open="sidebarOpen" @close="sidebarOpen = false"/>
        <div class="flex flex-1 flex-col overflow-hidden min-w-0">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-4 sm:p-6 md:p-8">
                <div class="bg-gray-100">

                    <!-- Keterangan Pasien -->
                    <div class="bg-emerald-100 rounded-lg p-4 sm:p-6 md:p-8 shadow"
                        style="background-color: rgba(209, 250, 229, 0.8)">
                        <h1 class="text-xl sm:text-2xl md:text-3xl mb-6 sm:mb-8 font-extrabold text-emerald-800">
                            Keterangan Pasien</h1>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 min-w-0">
                            <div class="min-w-0">
                                <div class="flex flex-col mb-4 sm:mb-6">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">No RM</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.pasien.no_rm }}</span>
                                </div>
                                <div class="flex flex-col mb-4 sm:mb-6">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">No Registrasi</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.no_registrasi }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">Nama Pasien</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.pasien.nama }}</span>
                                </div>
                            </div>
                            <div class="min-w-0">
                                <div class="flex flex-col mb-4 sm:mb-6">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">Jenis Kelamin</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.pasien.jenis_kelamin }}</span>
                                </div>
                                <div class="flex flex-col mb-4 sm:mb-6">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">TB / BB</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm / {{ pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">Tanggal Lahir</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.pasien.tanggal_lahir }}</span>
                                </div>
                            </div>
                            <div class="col-span-2 lg:col-span-1 min-w-0">
                                <div class="flex flex-col mb-4 sm:mb-6">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">Alamat</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.pasien.alamat }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-sm sm:text-base text-slate-500 sm:text-slate-700">Kelas BPJS</span>
                                    <span class="text-sm sm:text-base font-medium break-words min-w-0">{{ pendaftaran.pasien.kelas_bpjs ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Tindakan & Obat -->
                    <div class="my-4 bg-white rounded-lg shadow overflow-hidden">
                        <h1 class="text-xl sm:text-2xl p-4 font-extrabold text-emerald-800">Rincian Tindakan</h1>
                        <div class="px-4 text-center overflow-x-auto">
                            <table class="table-auto w-full min-w-[500px]">
                                <thead>
                                    <tr class="bg-slate-200">
                                        <th class="py-3 px-4 rounded-l-lg">ID Tindakan</th>
                                        <th class="py-3 px-4">Nama Tindakan</th>
                                        <th class="py-3 px-4">Jumlah</th>
                                        <th class="py-3 px-4">Harga</th>
                                        <th class="py-3 px-4 rounded-r-lg">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="tindakan.length === 0">
                                        <td colspan="5" class="py-6 text-slate-400">Belum ada tindakan</td>
                                    </tr>
                                    <tr v-for="item in tindakan" :key="item.id_tindakan" class="border-b">
                                        <td class="py-3 px-4">{{ item.id_tindakan }}</td>
                                        <td class="py-3 px-4">{{ item.nama_tindakan }}</td>
                                        <td class="py-3 px-4">{{ item.jumlah }}</td>
                                        <td class="py-3 px-4">{{ formatRupiah(item.harga) }}</td>
                                        <td class="py-3 px-4">{{ formatRupiah(item.total_harga) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex justify-end mt-4">
                                <div class="px-6 py-3 text-sm sm:text-base">
                                    <span class="font-semibold">Total Tindakan : </span>
                                    <span class="font-bold text-emerald-700">{{ formatRupiah(totalTindakan) }}</span>
                                </div>
                            </div>
                        </div>

                        <h1 class="text-xl sm:text-2xl pb-4 px-4 font-extrabold text-emerald-800">Rincian Obat</h1>
                        <div class="px-4 text-center overflow-x-auto">
                            <table class="table-auto w-full min-w-[500px]">
                                <thead>
                                    <tr class="bg-slate-200">
                                        <th class="py-3 px-4 rounded-l-lg">ID Obat</th>
                                        <th class="py-3 px-4">Nama Obat</th>
                                        <th class="py-3 px-4">Jumlah</th>
                                        <th class="py-3 px-4">Harga</th>
                                        <th class="py-3 px-4 rounded-r-lg">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="obat.length === 0">
                                        <td colspan="5" class="py-6 text-slate-400">Belum ada obat</td>
                                    </tr>
                                    <tr v-for="item in obat" :key="item.id_obat" class="border-b">
                                        <td class="py-3 px-4">{{ item.id_obat }}</td>
                                        <td class="py-3 px-4">{{ item.nama_obat }}</td>
                                        <td class="py-3 px-4">{{ item.jumlah }}</td>
                                        <td class="py-3 px-4">{{ formatRupiah(item.harga) }}</td>
                                        <td class="py-3 px-4">{{ formatRupiah(item.total_harga) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex justify-end mt-4 pb-4">
                                <div class="px-6 py-3 text-sm sm:text-base">
                                    <span class="font-semibold">Total Obat : </span>
                                    <span class="font-bold text-emerald-700">{{ formatRupiah(totalObat) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Harga -->
                    <div class="bg-white rounded-lg shadow overflow-hidden mt-4">
                        <div class="grid grid-cols-2 px-4 sm:px-6 py-4 sm:py-5">
                            <div>
                                <div class="mb-4"><span class="font-bold text-sm sm:text-base">Total Harga</span></div>
                                <div class="mb-4"><span class="font-bold text-sm sm:text-base">Potongan BPJS</span></div>
                                <div><span class="font-bold text-sm sm:text-base">Harga Yang Harus Dibayarkan</span></div>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="mb-4"><span class="font-bold text-sm sm:text-base">{{ formatRupiah(totalKotor) }}</span></div>
                                <div class="mb-4">
                                    <span class="font-bold text-sm sm:text-base">
                                        {{ potonganPreview > 0 ? formatRupiah(potonganPreview) : '-' }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-bold text-emerald-700 text-sm sm:text-base">{{ formatRupiah(totalBayarPreview) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Pembayaran -->
                    <div v-if="!statusLunas && bisaProses" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div class="bg-white rounded-2xl shadow border border-emerald-700 p-4 sm:p-6">
                            <label class="block text-xl sm:text-2xl font-extrabold text-emerald-800 mb-4">Metode Pembayaran</label>
                            <select v-model="form.metode_pembayaran"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-base sm:text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option value="" disabled>Pilih metode pembayaran</option>
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                            </select>
                            <div v-if="form.metode_pembayaran === 'bpjs' && potonganPreview > 0"
                                class="mt-3 text-sm text-emerald-700 font-semibold">
                                Potongan BPJS kelas {{ kelasBpjs }}: {{ formatRupiah(potonganPreview) }}
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl shadow border border-emerald-700 p-4 sm:p-6">
                            <label class="block text-xl sm:text-2xl font-extrabold text-emerald-800 mb-4">Jumlah yang dibayarkan</label>
                            <input v-model="form.jumlah_dibayarkan" type="number"
                                placeholder="Masukkan nominal yang dibayarkan"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-base sm:text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <div v-if="sudahDibayar > 0" class="mt-3 text-sm text-slate-600">
                                Sudah dibayar sebelumnya: <span class="font-semibold text-emerald-700">{{ formatRupiah(sudahDibayar) }}</span>
                            </div>
                            <div v-if="sudahDibayar > 0" class="mt-1 text-sm text-slate-600">
                                Sisa tagihan: <span class="font-semibold text-red-600">{{ formatRupiah(sisaTagihan) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Peringatan belum ada tindakan/obat -->
                    <div v-if="!bisaProses"
                        class="mt-4 bg-yellow-50 border border-yellow-400 text-yellow-800 rounded-lg px-4 sm:px-6 py-4 font-semibold text-sm sm:text-base">
                        Pasien belum memiliki tindakan atau obat. Proses pembayaran tidak dapat dilakukan.
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="flex flex-col items-center mt-7 rounded-lg p-6 sm:p-8 shadow"
                        :style="statusLunas ? 'background-color: rgba(209, 250, 229, 0.6)' : 'background-color: rgba(254, 202, 202, 0.6)'">
                        <h2 class="text-xl sm:text-2xl font-extrabold mb-3"
                            :class="statusLunas ? 'text-emerald-900' : 'text-red-700'">
                            Status Pembayaran
                        </h2>
                        <div class="flex items-center gap-3 sm:gap-4">
                            <svg v-if="statusLunas" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-8 sm:size-10 text-emerald-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-8 sm:size-10 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span :class="statusLunas ? 'text-emerald-800' : 'text-red-600'"
                                class="text-3xl sm:text-4xl md:text-5xl font-extrabold">
                                {{ statusLunas ? 'LUNAS' : 'BELUM LUNAS' }}
                            </span>
                        </div>
                        <div v-if="!statusLunas && form.jumlah_dibayarkan"
                            class="mt-4 text-red-600 font-semibold text-base sm:text-lg">
                            Kekurangan: {{ formatRupiah(kekurangan) }}
                        </div>
                    </div>

                    <!-- Tombol Proses -->
                    <div v-if="!statusLunas && bisaProses" class="flex justify-end mt-4">
                        <button @click="submit"
                            :disabled="form.processing || !form.metode_pembayaran || !form.jumlah_dibayarkan"
                            class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-8 py-3 rounded-lg shadow-md disabled:opacity-50">
                            Proses Pembayaran
                        </button>
                    </div>

                </div>
            </main>
        </div>

        <!-- Popup Sukses -->
        <div v-if="showSuccess" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
            <div class="bg-white rounded-xl shadow-xl p-6 sm:p-8 flex flex-col items-center gap-4 max-w-sm w-full">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-8 h-8 text-emerald-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Pembayaran Berhasil!</h2>
                <p class="text-gray-500 text-center text-sm">{{ page.props.flash.success }}</p>
                <button @click="router.visit(route('kwitansi', { no_registrasi: pendaftaran.no_registrasi }))"
                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-2 rounded-lg w-full">
                    OK
                </button>
            </div>
        </div>
    </div>
</template>