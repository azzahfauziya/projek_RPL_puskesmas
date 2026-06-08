<template>
    <aside :class="open ? 'w-64' : 'w-0'"
        class="h-screen overflow-hidden bg-white border-r transition-all duration-300 ease-in-out">

        <nav class="mt-4 px-3 pt-20">
            <a v-for="item in menus" :key="item.name" :href="item.href"
                class="mb-1 flex items-center gap-3 rounded-lg px-4 py-3 text-green-900 hover:bg-green-500">
                <component :is="item.icon" class="h-5 w-5" />
                <span>{{ item.name }}</span>
            </a>
        </nav>
    </aside>
</template>

<script setup>
import { computed } from 'vue'
import {
    HomeIcon,
    UserGroupIcon,
    ClipboardDocumentListIcon,
    BeakerIcon,
    DocumentTextIcon,
} from '@heroicons/vue/24/outline'

defineProps({
    open: Boolean
})

const role = computed(() => 'administrasi')

const menuPerRole = {
    administrasi: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/administrasi' },
        { name: 'Data Pasien', icon: UserGroupIcon, href: '/pasien' },
        { name: 'Pendaftaran Pasien', icon: ClipboardDocumentListIcon, href: '/pendaftaran' },
    ],
    dokter: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/dokter' },
        { name: 'Daftar Antrian', icon: ClipboardDocumentListIcon, href: '/antrian' },
        { name: 'Data Pasien', icon: UserGroupIcon, href: '/pasien' },
    ],
    apoteker: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/apoteker' },
        { name: 'Data Obat', icon: BeakerIcon, href: '/obat' },
        { name: 'Resep Masuk', icon: DocumentTextIcon, href: '/resep' },
    ],
}

const menus = computed(() => menuPerRole[role.value] ?? [])
</script>