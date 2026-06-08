<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'
import WelcomeCard from '@/Components/WelcomeCard.vue'
import InformasiCard from '@/Components/InformasiCard.vue'

const sidebarOpen = ref(true)
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">

        <!-- Sidebar -->
        <SideBar :open="sidebarOpen" />

        <!-- Konten kanan -->
        <div class="flex flex-1 flex-col overflow-hidden">

            <!-- Navbar -->
            <NavBar @toggle-sidebar="toggleSidebar" />

            <!-- Main -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="flex flex-col gap-6 ">
                    <WelcomeCard name="Dr. Friss" role="Dokter Umum" nip="1234567890" />
                    <InformasiCard />
                </div>
            </main>

        </div>
    </div>
</template>