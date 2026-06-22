<script setup>
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pendaftaran: Object,
    tindakan: Array,
    obat: Array,
    totalTindakan: { type: Number, default: 0 },
    totalObat: { type: Number, default: 0 },
    totalKotor: { type: Number, default: 0 },
    potongan: { type: Number, default: 0 },
    totalBayar: { type: Number, default: 0 },
    sudahDibayar: { type: Number, default: 0 },
    sisaTagihan: { type: Number, default: 0 },
    statusPembayaran: { type: String, default: 'belum_lunas' },
    metodePembayaran: { type: String, default: '-' },
    waktuBayar: { type: String, default: '-' },
})

const sidebarOpen = ref(false)

const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    }).format(angka ?? 0)
}

const isLunas = props.statusPembayaran === 'lunas'
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">
                <div class="min-h-screen bg-gray-100 p-8">

                    <!-- Header Kwitansi -->
                    <div class="bg-emerald-700 text-white rounded-lg px-8 py-6 shadow mb-6 flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-extrabold">Kwitansi Pembayaran</h1>
                            <p class="text-emerald-200 mt-1">No. Registrasi: {{ pendaftaran.no_registrasi }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-emerald-200 text-sm">Waktu Bayar</div>
                            <div class="font-semibold text-lg">{{ waktuBayar }}</div>
                        </div>
                    </div>

                    <!-- Keterangan Pasien -->
                    <div class="bg-emerald-50 rounded-lg p-8 shadow mb-6">
                        <h2 class="text-xl font-extrabold text-emerald-800 mb-5">Keterangan Pasien</h2>
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <div class="flex mb-4">
                                    <span class="font-semibold w-36">No RM</span>
                                    <span class="mr-3">:</span>
                                    <span>{{ pendaftaran.pasien.no_rm }}</span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-36">Nama Pasien</span>
                                    <span class="mr-3">:</span>
                                    <span>{{ pendaftaran.pasien.nama }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="flex mb-4">
                                    <span class="font-semibold w-36">Jenis Kelamin</span>
                                    <span class="mr-3">:</span>
                                    <span>{{ pendaftaran.pasien.jenis_kelamin }}</span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-36">Tanggal Lahir</span>
                                    <span class="mr-3">:</span>
                                    <span>{{ pendaftaran.pasien.tanggal_lahir }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="flex mb-4">
                                    <span class="font-semibold w-36">Kelas BPJS</span>
                                    <span class="mr-3">:</span>
                                    <span>{{ pendaftaran.pasien.kelas_bpjs ?? '-' }}</span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-36">Metode Bayar</span>
                                    <span class="mr-3">:</span>
                                    <span class="capitalize">{{ metodePembayaran }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Tindakan -->
                    <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
                        <h2 class="text-xl font-extrabold text-emerald-800 p-4">Rincian Tindakan</h2>
                        <div class="px-4 pb-4 text-center">
                            <table class="table-auto w-full">
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
                            <div class="flex justify-end mt-3">
                                <span class="font-semibold">Total Tindakan:&nbsp;</span>
                                <span class="font-bold text-emerald-700">{{ formatRupiah(totalTindakan) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Obat -->
                    <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
                        <h2 class="text-xl font-extrabold text-emerald-800 p-4">Rincian Obat</h2>
                        <div class="px-4 pb-4 text-center">
                            <table class="table-auto w-full">
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
                            <div class="flex justify-end mt-3">
                                <span class="font-semibold">Total Obat:&nbsp;</span>
                                <span class="font-bold text-emerald-700">{{ formatRupiah(totalObat) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Pembayaran -->
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-extrabold text-emerald-800 mb-4">Ringkasan Pembayaran</h2>
                        <div class="grid grid-cols-2 gap-y-3 max-w-sm ml-auto text-right">
                            <span class="font-semibold text-left">Total Tindakan</span>
                            <span>{{ formatRupiah(totalTindakan) }}</span>

                            <span class="font-semibold text-left">Total Obat</span>
                            <span>{{ formatRupiah(totalObat) }}</span>

                            <span class="font-semibold text-left">Total Kotor</span>
                            <span>{{ formatRupiah(totalKotor) }}</span>

                            <span class="font-semibold text-left text-emerald-700">Potongan BPJS</span>
                            <span class="text-emerald-700">{{ potongan > 0 ? formatRupiah(potongan) : '-' }}</span>

                            <span class="font-bold text-left text-lg border-t pt-2">Total Harus Dibayar</span>
                            <span class="font-bold text-lg border-t pt-2">{{ formatRupiah(totalBayar) }}</span>

                            <span class="font-semibold text-left">Sudah Dibayar</span>
                            <span class="text-emerald-700 font-semibold">{{ formatRupiah(sudahDibayar) }}</span>

                            <span class="font-semibold text-left">Sisa Tagihan</span>
                            <span :class="sisaTagihan > 0 ? 'text-red-600 font-semibold' : 'text-emerald-700 font-semibold'">
                                {{ sisaTagihan > 0 ? formatRupiah(sisaTagihan) : 'Lunas' }}
                            </span>
                        </div>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="flex flex-col items-center rounded-lg p-8 shadow"
                        :style="isLunas ? 'background-color: rgba(209, 250, 229, 0.6)' : 'background-color: rgba(254, 202, 202, 0.6)'">
                        <h2 class="text-2xl font-extrabold mb-3" :class="isLunas ? 'text-emerald-900' : 'text-red-700'">
                            Status Pembayaran
                        </h2>
                        <div class="flex items-center gap-4">
                            <svg v-if="isLunas" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-10 text-emerald-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-10 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span :class="isLunas ? 'text-emerald-800' : 'text-red-600'" class="text-5xl font-extrabold">
                                {{ isLunas ? 'LUNAS' : 'BELUM LUNAS' }}
                            </span>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="flex justify-end mt-6">
                        <button @click="router.visit(route('tagihan', { no_registrasi: pendaftaran.no_registrasi }))"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-8 py-3 rounded-lg shadow-md">
                            Kembali ke Tagihan
                        </button>
                    </div>

                </div>
            </main>
        </div>
    </div>
</template>