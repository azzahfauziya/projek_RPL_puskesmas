<template>
    <div v-if="!isDesktop && open" @click="$emit('close')"
        class="fixed inset-0 z-30 bg-black/40"></div>

    <aside
        :style="isDesktop ? `width: ${open ? sidebarWidth : 0}px` : `width: ${sidebarWidth}px`"
        :class="[
            'fixed md:relative top-0 left-0 h-screen bg-white border-r z-40 select-none overflow-hidden transition-[width,transform] duration-300',
            !isDesktop && !open ? '-translate-x-full' : 'translate-x-0'
        ]">

        <nav class="mt-4 px-3 pt-20">
            <a v-for="item in menus" :key="item.name" :href="item.href"
                @click="onMenuClick"
                class="mb-1 flex items-center gap-3 rounded-lg px-4 py-3 text-emerald-800 hover:bg-emerald-50">
                <component :is="item.icon" class="h-5 w-5 shrink-0" />
                <span>{{ item.name }}</span>
            </a>
        </nav>

        <div v-if="isDesktop" @mousedown="startResize"
            class="absolute top-0 right-0 h-full w-1.5 cursor-col-resize hover:bg-emerald-200">
        </div>
    </aside>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { usePage } from '@inertiajs/vue3'
import {
    HomeIcon, UserGroupIcon, ClipboardDocumentListIcon,
    BeakerIcon, DocumentTextIcon, QueueListIcon,
} from '@heroicons/vue/24/outline'

defineProps({ open: Boolean })
const emit = defineEmits(['close'])

const page = usePage()
const role = computed(() => page.props.auth?.user?.role ?? '')
const sidebarWidth = ref(256)

const isDesktop = ref(window.innerWidth >= 768)
function handleResize() { isDesktop.value = window.innerWidth >= 768 }
onMounted(() => window.addEventListener('resize', handleResize))
onUnmounted(() => window.removeEventListener('resize', handleResize))

function onMenuClick() {
    if (!isDesktop.value) emit('close')
}

function startResize(e) {
    const startX = e.clientX
    const startWidth = sidebarWidth.value
    function onMouseMove(e) {
        const delta = e.clientX - startX
        sidebarWidth.value = Math.min(480, Math.max(160, startWidth + delta))
    }
    function onMouseUp() {
        window.removeEventListener('mousemove', onMouseMove)
        window.removeEventListener('mouseup', onMouseUp)
    }
    window.addEventListener('mousemove', onMouseMove)
    window.addEventListener('mouseup', onMouseUp)
}

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
        { name: 'Data Pasien', icon: UserGroupIcon, href: '/data-pasien' },
        { name: 'Data Obat', icon: ClipboardDocumentListIcon, href: '/obat-dokter' },
        { name: 'Data Resep', icon: ClipboardDocumentListIcon, href: '/resep' },
    ],
    perawat: [
        { name: 'Dashboard', icon: HomeIcon, href: '/dashboard/perawat' },
        { name: 'Daftar Antrian', icon: ClipboardDocumentListIcon, href: '/antrian' },
        { name: 'Data Pasien', icon: UserGroupIcon, href: '/data-pasien' },
        { name: 'Data Obat', icon: ClipboardDocumentListIcon, href: '/obat-perawat' },
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