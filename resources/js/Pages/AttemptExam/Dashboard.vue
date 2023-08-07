<script setup>
import ExamLayout from '@/Layouts/ExamLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { computed, defineProps } from 'vue'
import moment from 'moment/min/moment-with-locales'
moment.locale('id')
const page = usePage()
const props = defineProps({
    schedule: Array,
    questionbank: Object,
    id: {
        type: String,
        default: new URL(window.location).searchParams.get('id')
    }
})

const user = computed(() => page.props.auth.user)
 

</script>



<template>
    <Head title="Dashboard" />

    <ExamLayout>
        <section class="px-4 sm:px-6 lg:px-8 py-12 bg-white flex flex-col gap-y-4 lg:flex-row items-center gap-x-8">
            <div>
                <div class="w-[150px] aspect-square rounded-full bg-slate-200 overflow-hidden">
                    <img class="w-full h-full" :src="user.profile_picture" alt="">
                </div>
            </div>
            <div class="w-full">
                <h3 class="text-xl font-semibold text-merah-component">{{ user.name }}</h3>
                <div class="flex flex-wrap gap-x-6 items-center mt-2">
                    <p>{{ user.email }}</p>
                    <span class="w-[7px] aspect-square bg-abu-component rounded-full"></span>
                    <p>{{ user.phone }}</p>
                    <span class="w-[7px] aspect-square bg-abu-component rounded-full"></span>
                    <p>IT Telkom Surabaya</p>
                </div>
            </div>
        </section>
        <section class="mt-10 px-4 sm:px-6 lg:px-8 py-12 w-full">
            <div class="w-full flex divide-x-2">
                <div class="pr-10">
                    <a class="font-semibold text-merah-component border-b-2 pb-1 border-merah-component" href="">Detail
                        Ujian</a>
                </div>
                <div class="pl-10">
                    <a class="font-semibold text-abu-text" href="">Petunjuk</a>
                </div>
            </div>
            <div class="bg-white rounded-lg mt-10 px-8 py-12 text-center mx-auto">
                <div>
                    <h1 class="text-merah-secondary text-2xl font-bold mb-6">{{ String(questionbank.category).toUpperCase() }}</h1>
                    <div class="flex flex-col divide-x items-start gap-y-4 lg:flex-row lg:items-center justify-center">
                        <div class="flex flex-col gap-y-1 px-8">
                            <label for="incoming_test_date" class="font-medium text-abu-text uppercase text-center">Tanggal</label>
                            <p id="incoming_test_date" class="font-bold">{{ moment(schedule.tanggal).format("DD MMMM YYYY") }}</p>
                        </div>
                        <div class="flex flex-col gap-y-1 px-8">
                            <label for="incoming_test_location" class="font-medium text-abu-text uppercase text-center">Lokasi</label>
                            <p id="incoming_test_location" class="font-bold">IT Telkom Surabaya</p>
                        </div>
                        <div class="flex flex-col gap-y-1 px-8">
                            <label for="incoming_test_time" class="font-medium text-abu-text uppercase text-center">Waktu</label>
                            <p id="incoming_test_time" class="font-bold">{{ moment(schedule.tanggal).format("HH:mm") }} WIB</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 px-8 mt-8">
                        <label for="incoming_test_time" class="font-medium text-black uppercase text-center">Waktu Ujian</label>
                        <p id="incoming_test_time" class="font-bold">02:00:00</p>
                    </div>
                    <Link :href="route('attempt_exam.attempt', {id: props.id, page: 1})">
                        <PrimaryButton class="px-10 mt-4">Mulai</PrimaryButton>
                    </Link>    
                </div>
            </div>
        </section>
    </ExamLayout>
</template>

<!-- <script>
   import { defineComponent } from 'vue';
   
   export default defineComponent({
     props: ['schedule'],
   });
</script> -->