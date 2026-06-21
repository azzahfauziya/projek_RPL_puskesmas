<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'
import WelcomeCard from '@/Components/WelcomeCard.vue'
import InformasiCard from '@/Components/InformasiCard.vue'

const sidebarOpen = ref(false)
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value
}

const page = usePage()

// Ambil data profil dari auth
const profil = computed(() => page.props.auth?.profil)
const role   = computed(() => page.props.auth?.user?.role)
console.log('profil:', page.props.auth?.profil)  // ← cek di browser console

const props = defineProps({
    pendaftaranHariIni: Number,
})
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">

        <!-- Sidebar -->
        <SideBar :open="sidebarOpen" />

        <!-- Konten kanan -->
        <div class="flex flex-1 flex-col overflow-hidden">

            <!-- Navbar -->
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />

            <!-- Main -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="flex flex-col gap-6 ">
                    <WelcomeCard  
                        :name="profil?.nama"
                        :role="role"
                        :nip="profil?.nip"/>
                    <InformasiCard :pendaftaran-hari-ini="pendaftaranHariIni"/>
                </div>
            </main>

        </div>
    </div>
</template>