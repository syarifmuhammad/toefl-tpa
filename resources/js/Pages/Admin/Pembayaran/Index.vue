<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton2 from '@/Components/SecondaryButton2.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Pembayaran" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran</h2>
        </template>

        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg px-8 py-4 pb-12">
                <h1 class="font-semibold text-xl text-black">
                    Pembayaran
                </h1>
                <div class="flex gap-x-6 mt-6">
                    <Link
                        class="text-merah-component font-semibold text-md border-x-0 border-t-0 border-b border-merah-component">
                    Semua
                    </Link>
                    <Link class="text-black font-semibold text-md">
                    Selesai
                    </Link>
                    <Link class="text-black font-semibold text-md">
                    Proses
                    </Link>
                    <Link class="text-black font-semibold text-md">
                    Dibatalkan
                    </Link>
                </div>
                <table class="w-full border-b-2 border-abu-component text-medium mt-2">
                    <thead class="text-merah-component">
                        <tr class="border-b-2 border-abu-component">
                            <th class="py-5">#</th>
                            <th class="py-5">ID</th>
                            <th class="py-5">Tanggal Tes</th>
                            <th class="py-5">Tanggal Permintaan</th>
                            <th class="py-5">Metode</th>
                            <th class="py-5">Status</th>
                            <th class="py-5">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="n in 10" class="border-b-2 border-abu-component">
                            <td class="py-5">{{ n }}</td>
                            <td class="py-5">1234</td>
                            <td class="py-5">2 Mei 2023</td>
                            <td class="py-5">10 April 2023</td>
                            <td class="py-5">Dikirim</td>
                            <td class="py-5">Menunggu Pembayaran</td>
                            <td class="py-5">
                                <div class="flex gap-x-4 justify-end">
                                    <Link :href="route('admin.pembayaran.detail', n)">
                                    <PrimaryButton class="px-4">Detail</PrimaryButton>
                                    </Link>
                                    <SecondaryButton2 class="px-4" @click="(formBankSoal.id = n), (modal_errors = true)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px"
                                            height="24px">
                                            <path
                                                d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                        </svg>
                                    </SecondaryButton2>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
