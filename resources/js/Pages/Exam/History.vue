<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Riwayat Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Ujian</h2>
        </template>

        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg px-8 py-4 pb-12">
                <table class="w-full border-b-2 border-abu-component text-medium text-xl">
                    <thead class="text-merah-component">
                        <tr class="border-b-2 border-abu-component">
                            <th class="py-5">Jenis Tes</th>
                            <th class="py-5">Tanggal Tes</th>
                            <th class="py-5">Tanggal Pendaftaran</th>
                            <th class="py-5">Status</th>
                            <th class="py-5">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="n in 10" class="border-b-2 border-abu-component">
                            <td class="py-5">TOEFL</td>
                            <td class="py-5">Selasa, 2 Mei 2023</td>
                            <td class="py-5">10 April 2023</td>
                            <td class="py-5">Menunggu Pembayaran</td>
                            <td class="py-5">
                                <Link :href="route('exam.history.detail', n)">
                                <PrimaryButton class="px-4">Detail</PrimaryButton>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
