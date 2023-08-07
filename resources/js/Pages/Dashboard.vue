<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import moment from 'moment/min/moment-with-locales'
moment.locale('id')

const props = defineProps(
    {
        my_schedule: Object,
        schedules: Object,
        category: String,
    },
)
</script>



<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <section class="mt-2 px-4 sm:px-6 lg:px-8 py-12 bg-white flex flex-col gap-y-4 lg:flex-row items-center gap-x-8">
            <div>
                <div class="w-[150px] aspect-square rounded-full overflow-hidden">
                    <img class="w-full h-full object-cover" :src="$page.props.auth.user.profile_picture" alt="">
                </div>
            </div>
            <div class="w-full">
                <h3 class="text-xl font-semibold text-merah-component">{{ $page.props.auth.user.name }}</h3>
                <div class="flex flex-wrap gap-x-6 items-center mt-2">
                    <p>{{ $page.props.auth.user.email }}</p>
                    <span class="w-[7px] aspect-square bg-abu-component rounded-full"></span>
                    <p>{{ $page.props.auth.user.phone }}</p>
                    <span class="w-[7px] aspect-square bg-abu-component rounded-full"></span>
                    <p>{{ $page.props.auth.user.address.street }}</p>
                </div>
                <hr class="bg-abu-component h-[2px] my-4" />
                <div class="flex flex-col items-start gap-y-4 lg:flex-row lg:items-center justify-between ">
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test" class="font-medium text-abu-text uppercase">Ujian Akan Datang</label>
                        <p id="incoming_test" class="font-medium">{{ my_schedule ?
                            String(my_schedule.category).toUpperCase() : '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test_date" class="font-medium text-abu-text uppercase">Tanggal</label>
                        <p id="incoming_test_date" class="font-medium">{{ my_schedule ?
                            moment(my_schedule.tanggal).format("DD MMMM YYYY") : '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test_time" class="font-medium text-abu-text uppercase">Waktu</label>
                        <p id="incoming_test_time" class="font-medium">{{ my_schedule ?
                            moment(my_schedule.tanggal).format("HH:mm") : '-' }}</p>
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test_location" class="font-medium text-abu-text uppercase">Lokasi</label>
                        <p id="incoming_test_location" class="font-medium">{{ my_schedule ? "IT Telkom Surabaya" : "-" }}
                        </p>
                    </div>
                    <div class="">
                        <Link v-if="my_schedule" :href="route('jadwal.history.detail', my_schedule.id)">
                        <PrimaryButton class="px-10">Detail</PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-10 px-4 sm:px-6 lg:px-8 py-12 w-full">
            <div class="w-full flex gap-x-6">
                <div>
                    <a class="font-semibold pb-1"
                        :class="category == 'toefl' ? 'text-merah-component border-b-2 border-merah-component' : 'text-abu-text'"
                        href="?category=toefl">TOEFL</a>
                </div>
                <div class="w-[2px] 
                bg-gray-200"></div>
                <div
                    :class="category == 'tpa' ? 'text-merah-component border-b-2 border-merah-component' : 'text-abu-text'">
                    <a class="font-semibold" href="?category=tpa">TPA</a>
                </div>
            </div>
            <div class="bg-white rounded-lg mt-10 px-8 py-12">
                <table class="w-full border-b-2 border-abu-component text-medium">
                    <thead class="text-merah-component">
                        <tr class="border-b-2 border-abu-component">
                            <th class="py-5">No.</th>
                            <th class="py-5">Tanggal</th>
                            <th class="py-5">Waktu</th>
                            <th class="py-5">Kuota</th>
                            <th class="py-5">Status</th>
                            <th class="py-5">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        <tr v-if="schedules.data != null && schedules.data.length > 0" v-for="(row, idx) in schedules.data"
                            :key="idx" class="border-b-2 border-abu-component">
                            <td class="py-5">{{ idx + 1 }}.</td>
                            <td class="py-5">{{ moment(row.tanggal).format("DD MMMM YYYY") }}</td>
                            <td class="py-5">{{ moment(row.tanggal).format("HH:mm") }} WIB</td>
                            <td class="py-5">{{ row.attempt_schedules_count }}/{{ row.kuota }}</td>
                            <td class="py-5">{{ (row.status == 1) ? "Ready" : "Not Ready" }}</td>
                            <td class="py-5">
                                <Link :href="route('jadwal.detail', row.id)">
                                <PrimaryButton class="px-4">Pilih</PrimaryButton>
                                </Link>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="6">
                                <p class="text-center text-merah-warning font-semibold text-md">Jadwal ujian belum ada !</p>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </section>
</AuthenticatedLayout></template>