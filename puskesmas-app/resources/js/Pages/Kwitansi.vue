<script setup>
import { ref, computed } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pendaftaran: Object,
    tindakan: { type: Array, default: () => [] },
    obat: { type: Array, default: () => [] },
    totalTindakan: { type: Number, default: 0 },
    totalObat: { type: Number, default: 0 },
    totalKotor: { type: Number, default: 0 },
    potongan: { type: Number, default: 0 },
    totalBayar: { type: Number, default: 0 },
})

const sidebarOpen = ref(false)

const form = useForm({
    no_registrasi: props.pendaftaran.no_registrasi,
    metode_pembayaran: '',
    jumlah_dibayarkan: '',
})

function submit() {
    form.post(route('billing.store'))
}

const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    }).format(angka ?? 0)
}

const kekurangan = computed(() => {
    const dibayar = Number(form.jumlah_dibayarkan) || 0
    const sisa = props.totalBayar - dibayar
    return sisa > 0 ? sisa : 0
})

const statusLunas = computed(() => {
    const dibayar = Number(form.jumlah_dibayarkan) || 0
    return dibayar >= props.totalBayar
})
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">
                <div class="min-h-screen bg-gray-100 p-8">
                    <div class="bg-emerald-100 rounded-lg p-8 shadow" style="background-color: rgba(209, 250, 229, 0.8)">
                        <h1 class="text-3xl mb-8 font-extrabold text-emerald-800 ">
                            Keterangan Pasien
                        </h1>

                        <div class="grid grid-cols-3 gap-8">

                            <!-- Kolom 1 -->
                            <div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">No RM</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.no_rm }}</span>
                                </div>

                                <div class="flex mb-6">
                                    <span class="font-bold w-40">No Registrasi</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.no_registrasi }}</span>
                                </div>

                                <div class="flex">
                                    <span class="font-bold w-40">Nama Pasien</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.nama }}</span>
                                </div>
                            </div>

                            <!-- Kolom 2 -->
                            <div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">Jenis Kelamin</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.jenis_kelamin }}</span>
                                </div>

                                <div class="flex mb-6">
                                    <span class="font-bold w-40">TB / BB</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm / {{
                                        pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg</span>
                                </div>

                                <div class="flex">
                                    <span class="font-bold w-40">Tanggal Lahir</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.tanggal_lahir }}</span>
                                </div>
                            </div>

                            <!-- Kolom 3 -->
                            <div>
                                <div class="flex mb-6">
                                    <span class="font-bold w-40">Alamat</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.alamat }}</span>
                                </div>

                                <div class="flex">
                                    <span class="font-bold w-40">Kelas BPJS</span>
                                    <span class="mr-4">:</span>
                                    <span>{{ pendaftaran.pasien.kelas_bpjs }}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="my-4 bg-white bg-gray-800 rounded-lg shadow overflow-hidden">
                        <h1 class="text-2xl p-4 font-extrabold text-emerald-800 text-emerald-700">
                            Rincian Tindakan
                        </h1>
                        <div>
                            <div class="pl-4 pr-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-slate-200">
                                            <th class="py-3 px-4 rounded-l-lg">ID Tindakan</th>
                                            <th class="py-3 px-4 ">Nama Tindakan</th>
                                            <th class="py-3 px-4 ">Jumlah</th>
                                            <th class="py-3 px-4 ">Harga</th>
                                            <th class="py-3 px-4 rounded-r-lg">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in tindakan" :key="item.id_tindakan"
                                            class="border-b border-gray-700">
                                            <td class="py-3 px-4">{{ item.id_tindakan }}</td>
                                            <td class="py-3 px-4">{{ item.nama_tindakan }}</td>
                                            <td class="py-3 px-4">{{ item.jumlah }}</td>
                                            <td class="py-3 px-4">{{ formatRupiah(item.harga) }}</td>
                                            <td class="py-3 px-4">{{ formatRupiah(item.total_harga) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="flex justify-end mt-4">
                                    <div class="px-6 ps-3 rounded-lg">
                                        <span class="font-semibold">Total Tindakan : </span>
                                        <!-- Total tindakan -->
                                        <span class="font-bold text-emerald-700">{{ formatRupiah(totalTindakan)
                                            }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h1 class="text-2xl pb-4 pr-4 pl-4 font-extrabold text-emerald-800 text-emerald-700">
                            Rincian Obat
                        </h1>
                        <div>
                            <div class="pl-4 pr-4 text-center"> <!-- Ganti p-40 ke p-4 biar ga kegedean -->
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-slate-200">
                                            <th class="py-3 px-4 rounded-l-lg">ID Obat</th>
                                            <th class="py-3 px-4 ">Nama Obat</th>
                                            <th class="py-3 px-4 ">Jumlah</th>
                                            <th class="py-3 px-4 ">Harga</th>
                                            <th class="py-3 px-4 rounded-r-lg">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in obat" :key="item.id_obat" class="border-b border-gray-700">
                                            <td class="py-3 px-4">{{ item.id_obat }}</td>
                                            <td class="py-3 px-4">{{ item.nama_obat }}</td>
                                            <td class="py-3 px-4">{{ item.jumlah }}</td>
                                            <td class="py-3 px-4">{{ formatRupiah(item.harga) }}</td>
                                            <td class="py-3 px-4">{{ formatRupiah(item.total_harga) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="flex justify-end mt-4">
                                    <div class="px-6 py-3 rounded-lg">
                                        <span class="font-semibold">Total Obat : </span>
                                        <!-- Total obat -->
                                        <span class="font-bold text-emerald-700">{{ formatRupiah(totalObat) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Harga -->
                    <div class="bg-white bg-gray-800 rounded-lg shadow overflow-hidden mt-4">
                        <div class="grid grid-cols-2 px-6 py-5">
                            <div>
                                <div class="mb-4">
                                    <span class="font-bold">Total Harga</span>
                                </div>

                                <div class="mb-4">
                                    <span class="font-bold">Potongan Harga</span>
                                </div>

                                <div>
                                    <span class="font-bold">Harga Yang Harus Dibayarkan</span>
                                </div>
                            </div>

                            <div class="flex flex-col items-end">
                                <div class="mb-4">
                                    <span class="font-bold">{{ formatRupiah(totalKotor) }}</span>
                                </div>

                                <div class="mb-4">
                                    <span class="font-bold">{{ formatRupiah(potongan) }}</span>
                                </div>

                                <div>
                                    <span class="font-bold text-emerald-700">{{ formatRupiah(totalBayar) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metode Pembayaran + Jumlah Bayar -->
                    <div v-if="!statusLunas" class="grid grid-cols-2 gap-4 mt-4">

                        <!-- Metode Pembayaran -->
                        <div class="bg-white bg-gray-800 rounded-2xl shadow border border-emerald-700 p-6">
                            <label class="block text-2xl font-extrabold text-emerald-800 mb-4">
                                Metode Pembayaran
                            </label>
                            <select v-model="form.metode_pembayaran"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option value="" disabled>Pilih metode pembayaran</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Debit">Debit</option>
                                <option value="Kredit">Kredit</option>
                                <option value="QRIS">QRIS</option>
                            </select>

                            <input v-model="form.jumlah_dibayarkan" type="number"
                                placeholder="Masukkan nominal yang dibayarkan"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <!-- Jumlah Dibayarkan -->
                        <div class="bg-white bg-gray-800 rounded-2xl shadow border border-emerald-700 p-6">
                            <label class="block text-2xl font-extrabold text-emerald-800 mb-4">
                                Jumlah yang dibayarkan
                            </label>

                            <input type="number" placeholder="Masukkan nominal yang dibayarkan"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                    </div>

                    <!-- Status Pembayaran -->
                    <div class="flex flex-col items-center mt-7 rounded-lg p-8 shadow"
                        style="background-color: rgba(209, 250, 229, 0.6)">
                        <h2 class="text-2xl font-extrabold text-emerald-900 mb-3">
                            Status Pembayaran
                        </h2>

                        <div class="flex items-center gap-4">
                            <svg v-if="statusLunas" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-10 text-emerald-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-10 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>

                            <span :class="statusLunas ? 'text-emerald-800' : 'text-red-600'"
                                class="text-5xl font-extrabold">
                                {{ statusLunas ? 'LUNAS' : 'BELUM LUNAS' }}
                            </span>
                        </div>

                        <!-- Kekurangan bayar -->
                        <div v-if="!statusLunas && form.jumlah_dibayarkan"
                            class="mt-4 text-red-600 font-semibold text-lg">
                            Kekurangan: {{ formatRupiah(kekurangan) }}
                        </div>
                    </div>

                    <!-- Tombol hanya muncul kalau belum lunas -->
                    <div v-if="!statusLunas" class="flex justify-end mt-4">
                        <button @click="submit" :disabled="form.processing"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-8 py-3 rounded-lg shadow-md disabled:opacity-50">
                            Proses Pembayaran
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>