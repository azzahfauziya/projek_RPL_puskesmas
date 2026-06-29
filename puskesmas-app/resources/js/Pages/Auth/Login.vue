<script setup>
import { ref } from 'vue'
import { useForm, Head } from '@inertiajs/vue3'

const form = useForm({
    username: '',
    password: '',
})

const submit = () => {
    form.post('/login', {
        onError: () => {
            form.reset('password')
        }
    })
}
</script>

<template>
    <Head title="Login" />
    <div class="min-h-screen flex items-center justify-center bg-slate-100">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-[#144B29]">Puskesmas Sehat</h1>
                <p class="text-slate-500 text-sm mt-1">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Error global -->
            <div v-if="form.errors.username" class="mb-4 p-3 bg-red-50 text-red-600 rounded-lg text-sm">
                {{ form.errors.username }}
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input
                        v-model="form.username"
                        type="text"
                        placeholder="Masukkan username"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#144B29]"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        placeholder="Masukkan password"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#144B29]"
                    />
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-[#144B29] text-white py-2 rounded-lg font-semibold hover:bg-[#0f3a1f] transition disabled:opacity-50"
                >
                    {{ form.processing ? 'Memproses...' : 'Masuk' }}
                </button>
            </form>
        </div>
    </div>
</template>