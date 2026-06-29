<script setup>
import { ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    profilData: Object,
    username:   String,
    role:       String,
})

const sidebarOpen = ref(false)
const showPasswordForm = ref(false)

const passwordForm = useForm({
    password_lama:              '',
    password_baru:              '',
    password_baru_confirmation: '',
})

function submitPassword() {
    passwordForm.put(route('profil.password'), {
        onSuccess: () => {
            passwordForm.reset()
            showPasswordForm.value = false
        }
    })
}

const labelMap = {
    dokter:        'Dokter',
    perawat:       'Perawat',
    apoteker:      'Apoteker',
    administrasi:  'Administrasi',
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" @close="sidebarOpen = false"/>
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8">

                <div class="mb-6">
                    <h1 class="text-xl sm:text-2xl font-extrabold text-[#144B29]">Profil Saya</h1>
                    <p class="text-sm text-slate-500 mt-1">Informasi data diri dan akun login</p>
                </div>

                <div class="grid grid-cols-1 gap-6 w-full">

                    <!-- Data Diri -->
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                        <h2 class="text-sm font-semibold text-slate-700 mb-4 uppercase tracking-wide">Data Diri</h2>
                        <div class="space-y-3">
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                <span class="text-slate-500">Nama</span>
                                <span class="font-medium text-slate-800">{{ profilData?.nama ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                <span class="text-slate-500">NIP</span>
                                <span class="font-medium text-slate-800">{{ profilData?.nip ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                <span class="text-slate-500">No. HP</span>
                                <span class="font-medium text-slate-800">{{ profilData?.no_hp ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                <span class="text-slate-500">Alamat</span>
                                <span class="font-medium text-slate-800 sm:text-right sm:max-w-xs">{{ profilData?.alamat ?? '-' }}</span>
                            </div>

                            <!-- field khusus per role -->
                            <template v-if="role === 'dokter'">
                                <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                    <span class="text-slate-500">Spesialisasi</span>
                                    <span class="font-medium text-slate-800">{{ profilData?.spesialisasi ?? '-' }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                    <span class="text-slate-500">No. STR</span>
                                    <span class="font-medium text-slate-800">{{ profilData?.no_str ?? '-' }}</span>
                                </div>
                            </template>
                            <template v-if="role === 'perawat'">
                                <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                    <span class="text-slate-500">No. SIP</span>
                                    <span class="font-medium text-slate-800">{{ profilData?.no_sip ?? '-' }}</span>
                                </div>
                            </template>
                            <template v-if="role === 'apoteker'">
                                <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                    <span class="text-slate-500">No. STRA</span>
                                    <span class="font-medium text-slate-800">{{ profilData?.no_stra ?? '-' }}</span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Informasi Akun -->
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                        <h2 class="text-sm font-semibold text-slate-700 mb-4 uppercase tracking-wide">Informasi Akun</h2>
                        <div class="space-y-3">
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                <span class="text-slate-500">Username</span>
                                <span class="font-medium text-slate-800">{{ username }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm gap-1 sm:gap-0">
                                <span class="text-slate-500">Role</span>
                                <span class="font-medium text-slate-800 capitalize">{{ labelMap[role] ?? role }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between text-sm sm:items-center gap-1 sm:gap-0">
                                <span class="text-slate-500">Password</span>
                                <button
                                    @click="showPasswordForm = !showPasswordForm"
                                    class="text-xs text-emerald-700 underline hover:text-emerald-900 text-left sm:text-right">
                                    {{ showPasswordForm ? 'Batal' : 'Ganti Password' }}
                                </button>
                            </div>
                        </div>

                        <!-- Form ganti password -->
                        <div v-if="showPasswordForm" class="mt-4 border-t pt-4 space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password Lama</label>
                                <input v-model="passwordForm.password_lama" type="password"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                                <p v-if="passwordForm.errors.password_lama" class="text-red-500 text-xs mt-1">
                                    {{ passwordForm.errors.password_lama }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                                <input v-model="passwordForm.password_baru" type="password"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                                <p v-if="passwordForm.errors.password_baru" class="text-red-500 text-xs mt-1">
                                    {{ passwordForm.errors.password_baru }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
                                <input v-model="passwordForm.password_baru_confirmation" type="password"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" />
                            </div>
                            <div class="flex justify-end">
                                <button @click="submitPassword" :disabled="passwordForm.processing"
                                    class="px-4 py-2 text-sm bg-[#144B29] text-white rounded-lg hover:bg-emerald-800 disabled:opacity-50">
                                    Simpan Password
                                </button>
                            </div>
                        </div>

                        <!-- Flash success -->
                        <p v-if="$page.props.flash?.success" class="text-emerald-600 text-sm mt-3">
                            {{ $page.props.flash.success }}
                        </p>
                    </div>

                </div>
            </main>
        </div>
    </div>
</template>