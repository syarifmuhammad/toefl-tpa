<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import logo from '../../assets/Sample Logo.svg';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/">
                <img src="/assets/sampleLogo.svg" />
                <!-- <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" /> -->
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 p-8 bg-white shadow-[0_4px_40px_0_rgba(0,0,0,0.25)] overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
        <div class="mt-4" v-if="route().current('login')">
            Belum punya akun ? <Link :href="route('register')" class="text-biru inline">Register</Link>
        </div>
    </div>
</template>
