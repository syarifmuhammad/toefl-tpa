<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SecondaryButton2 from '@/Components/SecondaryButton2.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'

const formBankSoal = useForm({
    name: '',
    type: '',
})

const modal = ref(false)

</script>

<template>
    <Head title="Bank Soal" />
    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard > Soal > 1</h2>
        </template>

        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg mt-4 px-8 py-6">
                
            </div>
        </section>
    </AuthenticatedLayout>
</template>
