<script setup>
import ExamLayout from '@/Layouts/ExamLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { ref, computed, defineProps } from 'vue'

const page = usePage()

const props = defineProps({
    soal: Array
})

const formAnswer = useForm({
    answer: [],
    attempt_schedule_id: null
})

const answer = ref([])

const modal = ref(false)
const modal_update = ref(false)
const modal_delete = ref(false)

const user = computed(() => page.props.auth.user)
const navigation_modal = ref(false)

const submit = (e) => {
    const isEmpty = answer.value.some(item => item === '');
    formAnswer.attempt_schedule_id = new URL(window.location.href).searchParams.get('id')
    // formAnswer.answer = formAnswer.answer.map(item => item === null ? "" : item);
    console.log(formAnswer)

    formAnswer.post(route('attempt_exam.attempt'), {
        onSuccess: () => {
            console.log('success')
        },
        onError: (e) => {
            console.log(e)
        }
    })
    
}
</script>



<template>
    <Head title="Dashboard" />

    <ExamLayout>
        <div class="fixed right-[20px] bg-merah-primary p-2 cursor-pointer">
            <svg width="30" height="24" viewBox="0 0 37 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="7" height="7" fill="white" />
                <rect y="12" width="7" height="7" fill="white" />
                <rect y="24" width="7" height="7" fill="white" />
                <rect x="15" width="7" height="7" fill="white" />
                <rect x="15" y="12" width="7" height="7" fill="white" />
                <rect x="15" y="24" width="7" height="7" fill="white" />
                <rect x="30" width="7" height="7" fill="white" />
                <rect x="30" y="12" width="7" height="7" fill="white" />
                <rect x="30" y="24" width="7" height="7" fill="white" />
            </svg>
        </div>
        <section class="mt-4 pl-4 pr-12 sm:pl-6 sm:pr-12 lg:pl-8 lg:pr-14 pb-6 flex gap-x-4">
            <div class="bg-white px-4 sm:px-6 lg:px-8 pb-6 w-3/4">
                <form @submit.prevent="submit">
                    <div class="border-b border-abu-component w-full py-4 flex justify-between">
                        <h1 class="font-bold text-lg">Soal No. 1 - 5</h1>
                        <h1 class="font-bold text-lg">Sisa Waktu : <span class="text-merah-component">59.30</span></h1>
                    </div>
                    <div class="py-4 px-8 border-b border-abu-component">
                        <div v-for="(m, idx) in soal" class="flex flex-col space-y-4 mt-4 mb-16">
                            <div class="mb-2 gap-x-3">
                                {{ idx+1 }}. {{ m.soal }}                            
                                <div v-if="m.img">
                                    <img :src="m.img" :alt="m.img" width="300" height="200">
                                </div>
                                <div v-if="m.audio">
                                    <audio controls>
                                        <source :src="m.audio">
                                    </audio>
                                </div>
                            </div>
                            <div class="flex items-start gap-x-3">
                                <div class="flex flex-col gap-y-3 items-center">
                                    <input type="radio" v-model="formAnswer.answer[idx]" :name="'jawaban_benar'+idx" :id="`jawaban_${idx}__a`"
                                        value="a">
                                </div>
                                <div class="-mt-1">
                                    {{ m.a }}
                                </div>
                            </div>
                            <div class="flex items-start gap-x-3">
                                <div class="flex flex-col gap-y-3 items-center">
                                    <input type="radio" v-model="formAnswer.answer[idx]" :name="'jawaban_benar'+idx" :id="`jawaban_${idx}__b`"
                                        value="b">
                                </div>
                                <div class="-mt-1">
                                    {{ m.b }}
                                </div>
                            </div>
                            <div class="flex items-start gap-x-3">
                                <div class="flex flex-col gap-y-3 items-center">
                                    <input type="radio" v-model="formAnswer.answer[idx]" :name="'jawaban_benar'+idx" :id="`jawaban_${idx}__c`"
                                        value="c">
                                </div>
                                <div class="-mt-1">
                                    {{ m.c }}
                                </div>
                            </div>
                            <div class="flex items-start gap-x-3">
                                <div class="flex flex-col gap-y-3 items-center">
                                    <input type="radio" v-model="formAnswer.answer[idx]" :name="'jawaban_benar'+idx" :id="`jawaban_${index}__d`"
                                        value="d">
                                </div>
                                <div class="-mt-1">
                                    {{ m.d }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <PrimaryButton type="button" class="px-10 mt-4 float-right">Sebelumnya</PrimaryButton>
                        <PrimaryButton type="submit" class="px-10 mt-4 float-none">Submit</PrimaryButton>
                        <PrimaryButton type="button" class="px-10 mt-4 float-right">Selanjutnya</PrimaryButton>
                    </div>
                </form>
            </div>
            <div
                class="w-1/4 right-[20px] min-h-[400px] max-h-[600px] text-white bg-merah-primary py-6 px-4 overflow-y-auto sticky">
                <div class="font-bold">Nomor Soal</div>
                <hr class="my-3">
                <div class="grid grid-cols-5 gap-4">
                    <div v-for="n in 50" class="bg-white aspect-square rounded-lg">{{ n }}</div>
                </div>
            </div>
        </section>
    </ExamLayout>
</template>