<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import 'moment/locale/id';
import moment from 'moment/min/moment-with-locales';

defineProps({
    histories: Object,
})

moment.locale('id');

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
                        <tr v-for="history in histories.data" class="border-b-2 border-abu-component">
                            <td class="py-5">{{ String(history.questionbank.category).toUpperCase() }}</td>
                            <td class="py-5">{{ moment(history.schedule.tanggal).format("dddd, DD MMMM YYYY") }}</td>
                            <td class="py-5">{{ moment(history.created_at).format("dddd, DD MMMM YYYY") }}</td>
                            <td class="py-5">
                                <div v-if="history.status == 0" class="text-kuning-warning">Menunggu Pembayaran</div>
                                <div v-if="history.status == 1" class="text-hijau-warning">Sudah Lunas</div>
                                <div v-if="history.status == 2" class="text-merah-warning">Dibatalkan</div>
                            </td>
                            <td class="py-5">
                                <Link :href="route('jadwal.history.detail', history.id)">
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
