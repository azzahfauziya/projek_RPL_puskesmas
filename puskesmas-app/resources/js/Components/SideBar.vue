<template>
    <aside :class="open ? 'w-64' : 'w-0'"
        class="h-screen overflow-hidden bg-white border-r transition-all duration-300 ease-in-out">

        <nav class="mt-4 px-3 pt-20">
            <a v-for="item in menus" :key="item.name" :href="item.href"
                class="mb-1 flex items-center gap-3 rounded-lg px-4 py-3 text-emerald-800 hover:bg-emerald-50">
                <component :is="item.icon" class="h-5 w-5 shrink-0" />
                <span>{{ item.name }}</span>
            </a>
        </nav>
    </aside>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'  // ← ambil role dari auth
import {
    HomeIcon,
    UserGroupIcon,
    ClipboardDocumentListIcon,
    BeakerIcon,
    DocumentTextIcon,
    QueueListIcon,
} from '@heroicons/vue/24/outline'
import { CreditCardIcon } from 'lucide-vue-next'

defineProps({
    open: Boolean
})


const page = usePage()
const role = computed(() => page.props.auth?.user?.role ?? '')

const menuPerRole = {
    administrasi: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/administrasi' },
        { name: 'Pendaftaran Pasien', icon: ClipboardDocumentListIcon, href: '/pendaftaran' },
        { name: 'Daftar Antrian', icon: QueueListIcon, href: '/antrian' },
        { name: 'Data Kunjungan', icon: UserGroupIcon, href: '/kunjungan' },
        { name: 'Data Pasien', icon: UserGroupIcon, href: '/data-pasien' },
    ],
    dokter: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/dokter' },
        { name: 'Daftar Antrian', icon: ClipboardDocumentListIcon, href: '/antrian' },
        { name: 'Data Pasien', icon: UserGroupIcon, href: '/pasien' },
        { name: 'Data Obat', icon: ClipboardDocumentListIcon, href: '/obat-dokter' },
        { name: 'Data Resep', icon: ClipboardDocumentListIcon, href: '/resep' },
    ],
    apoteker: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/apoteker' },
        { name: 'Data Obat', icon: BeakerIcon, href: '/obat' },
        { name: 'Resep Masuk', icon: DocumentTextIcon, href: '/resep-masuk' },
    ],
}

const menus = computed(() => menuPerRole[role.value] ?? [])
</script>