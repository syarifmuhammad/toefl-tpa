<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { defineProps } from 'vue'
import moment from 'moment/min/moment-with-locales'
import { ref, watch } from 'vue';
moment.locale('id')

const props = defineProps({
    schedule: Object,
    participants: Object
})

const mulaiUjian = () => {
    if (props.schedule.status != 1) {
        const form = useForm({})
        form.patch(route('admin.mulai-ujian', props.schedule.id), {
            onSuccess: (data) => {
                durasi.value = data.props.schedule.durasi
            }
        })
    }
}

const detikKeDurasi = (detik) => {
    var h = Math.floor(detik / 3600)
    var m = Math.floor((detik - (h * 3600)) / 60)
    var s = Math.floor((detik - (h * 3600 + m * 60)))
    if (h == 0 && m == 0 && s == 0) {
        return "Waktu Habis"
    }
    return String(h).padStart(2, '0') + ":" + String(m).padStart(2, '0') + ":" + String(s).padStart(2, '0')
}

const durasi = ref(props.schedule.durasi)

const durasiFormat = ref(detikKeDurasi(durasi.value))
window.setInterval(() => {
    if (durasi.value > 0) {
        durasi.value--;
        durasiFormat.value = detikKeDurasi(durasi.value)
    }
}, 1000)

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
                <div class="flex justify-between mt-8">
                    <div class="flex gap-x-6 items-center">
                        <div @click="mulaiUjian"
                            class="rounded-full border border-black w-[150px] aspect-square flex items-center justify-center" :class="schedule.status != 1 ? 'cursor-pointer' : ''">
                            <span v-if="schedule.status == 1" class="text-merah-primary text-lg">
                                {{ durasiFormat }}
                            </span>
                            <span v-else class="text-merah-primary text-lg">Mulai Ujian</span>
                        </div>
                        <div class="flex flex-col gap-y-5 text-merah-primary">
                            <div class="text-lg font-semibold">TOEFL 6</div>
                            <div>50 Soal</div>
                        </div>
                    </div>
                    <div>
                        <div class="font-semibold">Jadwal</div>
                        <div>{{ moment(schedule.tanggal).format('DD MMMM YYYY HH:mm') }} WIB</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-x-4 mt-12">
                    <div class="border border-black p-4 flex gap-x-6">
                        <div class="rounded-full h-[70px] aspect-square bg-slate-300"></div>
                        <div class="flex flex-col justify-between">
                            <div class="font-medium">Total Peserta</div>
                            <div class="text-3xl font-medium">{{ schedule.attempt_schedules_count }}</div>
                        </div>
                    </div>
                    <div class="border border-black p-4 flex gap-x-6">
                        <div class="rounded-full h-[70px] aspect-square bg-blue-300"></div>
                        <div class="flex flex-col justify-between">
                            <div class="font-medium">Sedang Mengerjakan</div>
                            <div class="text-3xl font-medium">40</div>
                        </div>
                    </div>
                    <div class="border border-black p-4 flex gap-x-6">
                        <div class="rounded-full h-[70px] aspect-square bg-merah-primary"></div>
                        <div class="flex flex-col justify-between">
                            <div class="font-medium">Tidak Hadir</div>
                            <div class="text-3xl font-medium">40</div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="font-semibold text-lg">Peserta</div>
                    <div class="flex my-8">
                        <input class="w-[300px] border-black border-r-0 text-black placeholder:text-black/80" type="search"
                            placeholder="Cari Peserta ...">
                        <button class="border border-black px-3 bg-merah-primary"><svg class="w-[30px]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                <path fill="white"
                                    d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z" />
                            </svg></button>
                    </div>
                    <table class="w-full border-b-2 border-abu-component text-medium mt-2">
                        <thead class="text-merah-component">
                            <tr class="border-b-2 border-abu-component">
                                <th class="py-5">No.</th>
                                <th class="py-5">Nama</th>
                                <th class="py-5">NIM/NIK</th>
                                <th class="py-5">Status</th>
                                <th class="py-5">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-if="participants.data.length > 0" v-for="(participant, n) in participants.data"
                                class="border-b-2 border-abu-component">
                                <td class="py-5">{{ (n + 1) * participants.current_page }}</td>
                                <td class="py-5">{{ participant.user.name }}</td>
                                <td class="py-5">{{ participant.user.nim_or_nik }}</td>
                                <td class="py-5">{{ }}</td>
                                <td class="py-5">
                                    <!-- <div v-if="participant.status == 0" class="text-kuning-warning">Menunggu Pembayaran</div>
                                    <div v-if="participant.status == 1" class="text-hijau-warning">Selesai</div>
                                    <div v-if="participant.status == 2" class="text-merah-warning">Dibatalkan</div> -->
                                </td>
                                <td class="py-5">
                                    <div class="flex gap-x-4 justify-end">
                                        <!-- <Link :href="route('admin.pembayaran.detail', participant.id)">
                                        <PrimaryButton class="px-4">Detail</PrimaryButton>
                                        </Link>
                                        <SecondaryButton2 class="px-4"
                                            @click="(formBankSoal.id = n), (modal_errors = true)">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px"
                                                height="24px">
                                                <path
                                                    d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                            </svg>
                                        </SecondaryButton2> -->
                                    </div>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="6">
                                    <p class="text-center text-merah-warning font-semibold text-md">Data belum ada !</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
