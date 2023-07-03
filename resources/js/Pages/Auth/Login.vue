<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    nim_or_nik: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <label for="email" class="font-medium">NIK / NIM</label>
                <input type="text" class="mt-2 border-[#DAE0E6] px-3 py-2 w-full rounded-lg text-abu-text" v-model="form.form.nim_or_nik" placeholder="Masukkan NIK / NIM anda" required autocomplete="username">
                <InputError class="mt-2" :message="form.errors.form.nim_or_nik" />
            </div>

            <div class="mt-6">
                <label for="password" class="font-medium">Password</label>

                <input type="password" class="mt-2 border-[#DAE0E6] px-3 py-2 w-full rounded-lg text-abu-text" v-model="form.password" placeholder="Masukkan password anda" required autocomplete="current-password">

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="px-11 py-2 bg-merah-primary text-white font-bold rounded-lg flex gap-x-2 items-center"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    LOGIN
                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.1906 8.72169C19.5891 8.32311 19.5891 7.67689 19.1906 7.27831L12.6954 0.783122C12.2968 0.384545 11.6506 0.384545 11.252 0.783122C10.8534 1.1817 10.8534 1.82792 11.252 2.2265L17.0255 8L11.252 13.7735C10.8534 14.1721 10.8534 14.8183 11.252 15.2169C11.6506 15.6155 12.2968 15.6155 12.6954 15.2169L19.1906 8.72169ZM0.53125 9.02062H18.4689V6.97938H0.53125V9.02062Z"
                            fill="white" />
                    </svg>
    
    
                </button>
                <!-- <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link> -->

            </div>
        </form>
    </GuestLayout>
</template>
