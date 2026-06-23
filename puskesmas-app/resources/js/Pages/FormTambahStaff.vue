<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const sidebarOpen = ref(false)

const jabatanOptions = ['dokter', 'perawat', 'apoteker', 'administrasi']

const form = useForm({
    jabatan: '',
    nama: '',
    nip: '',
    no_hp: '',
    alamat: '',
    // dokter
    spesialisasi: '',
    no_str: '',
    // perawat
    no_sip: '',
    // apoteker
    no_stra: '',
    // akun
    username: '',
    password: '',
})

function submit() {
    form.post(route('staff.store'))
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">

                <div class="mb-6">
                    <h1 class="text-2xl font-extrabold text-[#144B29]">Tambah Staff</h1>
                    <p class="text-sm text-slate-500 mt-1">Isi data staff dan akun login mereka</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
                    <div class="grid grid-cols-2 gap-4">

                        <!-- Jabatan -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan</label>
                            <select v-model="form.jabatan"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option value="" disabled>Pilih jabatan</option>
                                <option v-for="j in jabatanOptions" :key="j" :value="j">{{ j }}</option>
                            </select>
                            <p v-if="form.errors.jabatan" class="text-red-500 text-xs mt-1">{{ form.errors.jabatan }}</p>
                        </div>

                        <!-- Nama -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                            <input v-model="form.nama" type="text"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            <p v-if="form.errors.nama" class="text-red-500 text-xs mt-1">{{ form.errors.nama }}</p>
                        </div>

                        <!-- NIP -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">NIP</label>
                            <input v-model="form.nip" type="text"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            <p v-if="form.errors.nip" class="text-red-500 text-xs mt-1">{{ form.errors.nip }}</p>
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">No. HP</label>
                            <input v-model="form.no_hp" type="text"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            <p v-if="form.errors.no_hp" class="text-red-500 text-xs mt-1">{{ form.errors.no_hp }}</p>
                        </div>

                        <!-- Alamat -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Alamat</label>
                            <textarea v-model="form.alamat" rows="2"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            <p v-if="form.errors.alamat" class="text-red-500 text-xs mt-1">{{ form.errors.alamat }}</p>
                        </div>

                        <!-- Field khusus dokter -->
                        <template v-if="form.jabatan === 'dokter'">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Spesialisasi</label>
                                <input v-model="form.spesialisasi" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">No. STR</label>
                                <input v-model="form.no_str" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            </div>
                        </template>

                        <!-- Field khusus perawat -->
                        <template v-if="form.jabatan === 'perawat'">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">No. SIP</label>
                                <input v-model="form.no_sip" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            </div>
                        </template>

                        <!-- Field khusus apoteker -->
                        <template v-if="form.jabatan === 'apoteker'">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">No. STRA</label>
                                <input v-model="form.no_stra" type="text"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            </div>
                        </template>

                        <!-- Divider akun -->
                        <div class="col-span-2 border-t pt-4 mt-2">
                            <p class="text-sm font-semibold text-slate-700">Data Akun Login</p>
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                            <input v-model="form.username" type="text"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            <p v-if="form.errors.username" class="text-red-500 text-xs mt-1">{{ form.errors.username }}</p>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                            <input v-model="form.password" type="password"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            <p v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</p>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 mt-6">
                        <Link :href="route('staff.index')"
                            class="px-4 py-2 text-sm border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50">
                            Batal
                        </Link>
                        <button @click="submit" :disabled="form.processing"
                            class="px-4 py-2 text-sm bg-[#144B29] text-white rounded-lg hover:bg-emerald-800 disabled:opacity-50">
                            Simpan
                        </button>
                    </div>
                </div>

            </main>
        </div>
    </div>
</template>