<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <section class="mt-2 px-4 sm:px-6 lg:px-8 py-12 bg-white flex flex-col gap-y-4 lg:flex-row items-center gap-x-8">
            <div>
                <div class="w-[150px] aspect-square bg-abu-component rounded-full"></div>
            </div>
            <div class="w-full">
                <h3 class="text-3xl font-semibold text-merah-component">{{ $page.props.auth.user.name }}</h3>
                <div class="flex flex-wrap gap-x-6 items-center mt-2">
                    <p>{{ $page.props.auth.user.email }}</p>
                    <span class="w-[7px] aspect-square bg-abu-component rounded-full"></span>
                    <p>08123456789</p>
                    <span class="w-[7px] aspect-square bg-abu-component rounded-full"></span>
                    <p>IT Telkom Surabaya</p>
                </div>
                <hr class="bg-abu-component h-[2px] my-4" />
                <div class="flex flex-col items-start gap-y-4 lg:flex-row lg:items-center justify-between ">
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test" class="font-medium text-abu-text uppercase">Ujian Akan Datang</label>
                        <p id="incoming_test" class="font-medium text-xl">TOEFL</p>
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test_date" class="font-medium text-abu-text uppercase">Tanggal</label>
                        <p id="incoming_test_date" class="font-medium text-xl">10 Juni 2023</p>
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test_time" class="font-medium text-abu-text uppercase">Waktu</label>
                        <p id="incoming_test_time" class="font-medium text-xl">10.00 WIB</p>
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="incoming_test_location" class="font-medium text-abu-text uppercase">Lokasi</label>
                        <p id="incoming_test_location" class="font-medium text-xl">IT Telkom Surabaya</p>
                    </div>
                    <div class="">
                        <PrimaryButton class="px-10">Detail</PrimaryButton>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-10 px-4 sm:px-6 lg:px-8 py-12 w-full">
            <div class="w-full flex divide-x-2">
                <div class="pr-10">
                    <a class="font-semibold text-xl text-merah-component border-b-2 pb-1 border-merah-component" href="">TOEFL</a>
                </div>
                <div class="pl-10">
                    <a class="font-semibold text-xl text-abu-text" href="">TPA</a>
                </div>
            </div>
            <div class="bg-white rounded-lg mt-10 px-8 py-12">
                <table class="w-full border-b-2 border-abu-component text-medium text-xl">
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
                        <tr v-for="n in 10" class="border-b-2 border-abu-component">
                            <td class="py-5">{{ n }}.</td>
                            <td class="py-5">10 Juni 2023</td>
                            <td class="py-5">10.00 WIB</td>
                            <td class="py-5">14/40</td>
                            <td class="py-5">Ready</td>
                            <td class="py-5"><PrimaryButton class="px-4">Pilih</PrimaryButton></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
