<!-- <script setup>
import { ref } from 'vue'
import { Users, ClipboardList, CreditCard } from 'lucide-vue-next'
import Navbar from '@/Components/NavBar.vue'
import Sidebar from '@/Components/SideBar.vue'
import WelcomeCard from '@/Components/WelcomeCard.vue'
import StatsCard from '@/Components/StatsCard.vue'

defineProps({
  totalPasien:      { type: Number, default: 0 },
  pendaftaranHariIni: { type: Number, default: 0 },
  billingBelumLunas:  { type: Number, default: 0 },
  antrian:          { type: Array,  default: () => [] },
})

const sidebarOpen = ref(false)
</script>

<template>
  <div class="flex min-h-screen bg-slate-100">
    <Sidebar :open="sidebarOpen" />
    <div class="flex-1 flex flex-col">
      <Navbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />
      <main class="flex-1 p-6 space-y-6">

        <WelcomeCard />

        <!-- Stats -->
        <!-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
          <StatsCard title="Total Pasien"          :value="totalPasien"        :icon="Users" />
          <StatsCard title="Pendaftaran Hari Ini"  :value="pendaftaranHariIni" :icon="ClipboardList" />
          <StatsCard title="Tagihan Belum Lunas"   :value="billingBelumLunas"  :icon="CreditCard" />
        </div> -->

        <!-- Antrian hari ini -->
        <!-- <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-lg font-bold text-[#144B29] mb-4">Antrian Hari Ini</h2>
          <div v-if="antrian.length === 0" class="text-slate-400 text-sm text-center py-8">
            Belum ada antrian hari ini
          </div>
          <table v-else class="w-full text-sm"> -->
            <!-- <thead>
              <tr class="text-left text-slate-500 border-b">
                <th class="pb-3">No. Reg</th>
                <th class="pb-3">Nama Pasien</th>
                <th class="pb-3">Dokter</th>
                <th class="pb-3">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y"> -->
              <!-- <tr v-for="item in antrian" :key="item.no_registrasi" class="py-3">
                <td class="py-3 text-slate-600">{{ item.no_registrasi }}</td>
                <td class="py-3 font-medium">{{ item.pasien?.nama }}</td>
                <td class="py-3 text-slate-600">{{ item.dokter?.nama }}</td>
                <td class="py-3">
                  <span :class="{
                    'bg-yellow-100 text-yellow-700': item.status_antrian === 'menunggu',
                    'bg-blue-100 text-blue-700':    item.status_antrian === 'diperiksa',
                    'bg-green-100 text-green-700':  item.status_antrian === 'selesai',
                  }" class="px-3 py-1 rounded-full text-xs font-medium capitalize">
                    {{ item.status_antrian }}
                  </span>
                </td>
              </tr>
            </tbody> -->
          <!-- </table>
        </div>

      </main>
    </div>
  </div>
</template> --> 

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
                    <InformasiCard />
                </div>
            </main>

        </div>
    </div>
</template>