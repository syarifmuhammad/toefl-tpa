<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import KartuUjian from '@/Components/KartuUjian.vue';
import moment from 'moment';
import { defineProps } from 'vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    schedule: Object
})
</script>

<template>
    <Head title="Detail Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Detail Ujian</h2>
        </template>

        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg overflow-hidden">
                <div class="px-8 py-3 w-full flex items-center bg-merah-primary">
                    <h3 class="font-semibold text-2xl text-white">{{ String(schedule.questionbank.category).toUpperCase() }}</h3>
                </div>
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <div>
                        <h2 class="font-semibold text-xl">Detail Kegiatan</h2>
                        <table class="h-full mt-4">
                            <tr>
                                <td class="w-[175px]">Jenis tes</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">{{ String(schedule.questionbank.category).toUpperCase() }}</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Tanggal tes</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">{{ moment(schedule.tanggal).format("DD MMMM YYYY") }}</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Waktu</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">{{ moment(schedule.waktu).format("HH:mm") }}</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Lokasi</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">IT Telkom Surabaya</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Alamat</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Jl. Ketintang No.156, Ketintang, Kec. Gayungan, Surabaya, Jawa
                                    Timur
                                    60231</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-8">
                        <h2 class="font-semibold text-xl">Deskripsi</h2>
                        <ul class="list-disc pl-4 mt-4">
                            <li>Harap membayar sesuai dengan total biaya yang sudah ditentukan sampain digit terakhir.</li>
                            <li>Harap melakukan pembayaran sebelum batas waktu pembayaran</li>
                            <li>Jika tidak ada transaksi sebelum batas waktu pembayaran yang telah ditentukan,
                                <strong>peserta akan
                                    secara otomatis membatalkan proses pendaftaran tes</strong>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="mt-8">
                        <h2 class="font-semibold text-4xl">Kartu Ujian</h2>
                        <div class="flex gap-x-4 mt-4 items-end">
                            <KartuUjian></KartuUjian>
                            <div>
                                <PrimaryButton class="px-4">Cetak</PrimaryButton>
                            </div>
                        </div>
                    </div> -->
                    <div class="mt-8 flex gap-x-4">
                        <Link :href="route('jadwal.payment', { id: schedule.id })">
                        <PrimaryButton class="px-4">Daftar</PrimaryButton>
                        </Link>
                        <Link :href="route('dashboard')">
                        <SecondaryButton class="px-4">Kembali</SecondaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
<style scoped>
td {
    vertical-align: top;
}
</style>
