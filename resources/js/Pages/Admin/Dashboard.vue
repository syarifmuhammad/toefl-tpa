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

const props = defineProps(({
    schedule: Array
}))

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <section class="mt-6 px-4 sm:px-6 lg:px-8 flex gap-x-4 w-full">
            <Link :href="route('admin.dashboard')" class="bg-merah-primary rounded-3xl pt-12 pb-8 w-1/5 flex flex-col justify-between">
                <DashboardIcon class="mx-auto w-[51px] h-[51px]" />
                <span class="block text-center mx-auto text-white mt-6 font-semibold">Dashboard</span>
            </Link>
            <Link :href="route('admin.jadwal_tes.index')" class="bg-merah-primary rounded-3xl pt-12 pb-8 w-1/5 flex flex-col justify-between">
                <JadwalTesIcon class="mx-auto"></JadwalTesIcon>
                <span class="block text-center mx-auto text-white mt-6 font-semibold">Jadwal Tes</span>
            </Link>
            <Link :href="route('admin.legalisir.index')" class="bg-merah-primary rounded-3xl pt-12 pb-8 w-1/5 flex flex-col justify-between">
                <LegalisirIcon class="mx-auto"></LegalisirIcon>
                <span class="block text-center mx-auto text-white mt-6 font-semibold">Legalisir</span>
            </Link>
            <Link :href="route('admin.pembayaran.index')" class="bg-merah-primary rounded-3xl pt-12 pb-8 w-1/5 flex flex-col justify-between">
                <PembayaranIcon class="mx-auto" />
                <span class="block text-center mx-auto text-white mt-6 font-semibold">Pembayaran</span>
            </Link>
            <Link :href="route('admin.bank_soal.index')"
                class="bg-merah-primary rounded-3xl pt-12 pb-8 w-1/5 flex flex-col justify-between">
            <SoalIcon class="mx-auto" />
            <span class="block text-center mx-auto text-white mt-6 font-semibold">Soal</span>
            </Link>
        </section>

        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="font-semibold text-lg text-merah-component pb-1 border-merah-component">Ujian hari ini</h1>
            <div class="bg-white rounded-lg mt-4 px-8 py-6">
                <table class="w-full border-b-2 border-abu-component text-medium">
                    <thead class="text-merah-component">
                        <tr class="border-b-2 border-abu-component">
                            <th class="py-5">No.</th>
                            <th class="py-5">Jenis</th>
                            <th class="py-5">Waktu</th>
                            <th class="py-5">Kuota</th>
                            <th class="py-5">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr v-if="schedule.data.length > 0" v-for="(i, index) in schedule.data"
                            class="border-b-2 border-abu-component">
                            <td class="py-5">{{ index + 1 }}.</td>
                            <td class="py-5">{{ i.category }}</td>
                            <td class="py-5">{{ i.waktu }}</td>
                            <td class="py-5">{{ i.terisi }}/{{ i.kuota }}</td>
                            <td class="py-5">
                                <Link :href="route('admin.monitor', index)">
                                <PrimaryButton class="px-4">Monitor</PrimaryButton>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full mb-8">
            <h1 class="font-semibold text-lg text-merah-component pb-1 border-merah-component">Permintaan Legalisir</h1>
            <div class="bg-white rounded-lg mt-4 px-8 py-6">
                <table class="w-full border-b-2 border-abu-component text-medium">
                    <thead class="text-merah-component">
                        <tr class="border-b-2 border-abu-component">
                            <th class="py-5">No.</th>
                            <th class="py-5">ID</th>
                            <th class="py-5">Tanggal Tes</th>
                            <th class="py-5">Tanggal Permintaan</th>
                            <th class="py-5">Metode</th>
                            <th class="py-5">Status</th>
                            <th class="py-5">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="n in 3" class="border-b-2 border-abu-component">
                            <td class="py-5">{{ n }}.</td>
                            <td class="py-5">1234</td>
                            <td class="py-5">10 Juni 2023</td>
                            <td class="py-5">15 Juni 2023</td>
                            <td class="py-5">Dikirim</td>
                            <td class="py-5">
                                <span class="text-kuning-warning">Menunggu Pembayaran</span>
                                <span class="text-hijau-warning">Lunas</span>
                            </td>
                            <td class="py-5 flex items-center gap-x-4">
                                <Link :href="route('admin.monitor', n)">
                                <PrimaryButton class="px-4">Detail</PrimaryButton>
                                </Link>
                                <Link :href="route('jadwal.detail', n)">
                                <SecondaryButton class="px-4">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M5 6.77273H9.2M19 6.77273H14.8M9.2 6.77273V5.5C9.2 4.94772 9.64772 4.5 10.2 4.5H13.8C14.3523 4.5 14.8 4.94772 14.8 5.5V6.77273M9.2 6.77273H14.8M6.4 8.59091V15.8636C6.4 17.5778 6.4 18.4349 6.94673 18.9675C7.49347 19.5 8.37342 19.5 10.1333 19.5H13.8667C15.6266 19.5 16.5065 19.5 17.0533 18.9675C17.6 18.4349 17.6 17.5778 17.6 15.8636V8.59091M9.2 10.4091V15.8636M12 10.4091V15.8636M14.8 10.4091V15.8636"
                                                stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </SecondaryButton>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
