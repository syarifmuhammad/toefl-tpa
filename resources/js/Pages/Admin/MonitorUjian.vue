<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DashboardIcon from '@/Components/IconMenu/Dashboard.vue';
import JadwalTesIcon from '@/Components/IconMenu/JadwalTes.vue';
import LegalisirIcon from '@/Components/IconMenu/Legalisir.vue';
import PembayaranIcon from '@/Components/IconMenu/Pembayaran.vue';
import SoalIcon from '@/Components/IconMenu/Soal.vue';
import { Head, Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Monitor Ujian</h2>
        </template>

        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg mt-4 px-8 py-6">
                <h1 class="font-semibold text-lg pb-1">Monitor Ujian</h1>
                
            </div>
        </section>

</AuthenticatedLayout></template>
