<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavBar from '@/Components/NavBar.vue';
import SideBar from '@/Components/SideBar.vue'
import WelcomeCard from '@/Components/WelcomeCard.vue'
import InformasiCard from '@/Components/InformasiCard.vue'
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />

        <div class="flex h-screen">
            <SideBar :open="true" />

            <div class="flex-1 p-6">
                <NavBar />

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <WelcomeCard name="Dr. Siti Aminah" role="Dokter Umum" nip="1234567890" />
                    <InformasiCard />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
