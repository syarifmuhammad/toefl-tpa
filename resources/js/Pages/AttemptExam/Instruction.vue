<script setup>
import ExamLayout from '@/Layouts/ExamLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue'

const page = usePage()

const user = computed(() => page.props.auth.user)

</script>



<template>
    <Head title="Dashboard" />

    <ExamLayout>
        <section class="mt-4 px-4 sm:px-6 lg:px-8 pb-6">
            <div class="bg-white px-4 sm:px-6 lg:px-8 pb-6">
                <div class="border-b border-abu-component w-full py-4">
                    <h1 class="font-bold text-lg">Petunjuk</h1>
                </div>
                <div class="py-32 border-b border-abu-component">
                    <div class="mx-auto w-7/12">
                        <span class="text-lg">Structure and Written Expressions</span>
                        <ul class="text-sm mt-4 list-disc">
                            <li>
                                The Structure Test will be administered on a computer or electronic device.
                            </li>
                            <li>
                                There are 40 multiple-choice questions that you need to answer in 25 minutes.
                            </li>
                            <li>
                                Each question will appear on the screen, and you will need to choose the best answer from
                                the
                                four
                                answer choices provided.
                            </li>
                            <li>
                                Make sure to read each question carefully and understand what it is asking before you choose
                                your
                                answer.
                            </li>
                            <li>
                                You can navigate back and forth between questions and change your answers before submitting
                                the
                                test.
                            </li>
                            <li>
                                There is no penalty for guessing, so if you are unsure of an answer, make your best guess.
                            </li>
                        </ul>
                    </div>
                </div>
                <PrimaryButton class="px-10 mt-4 float-right">Selanjutnya</PrimaryButton>
                <div class="clear-both"></div>
            </div>
        </section>
    </ExamLayout></template>