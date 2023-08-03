<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.patch(route('profile.update-password'), {
        onFinish: () => form.reset('current_password', 'password', 'password_confirmation'),
    });
};

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>
        <div class="flex gap-8 mx-4 sm:mx-6 lg:mx-8 mt-8 items-start">
            <section class="bg-white rounded-lg w-1/3">
                <div class="md:px-8 md:py-8 px-4 py-4 flex flex-col justify-center items-center">
                    <h3 class="font-bold lg:text-xl text-lg text-center">Informasi Akun</h3>
                    <div class="max-w-[210px] w-full aspect-square bg-abu-component rounded-full mt-10 overflow-hidden">
                        <img class="w-full h-full object-cover" :src="$page.props.auth.user.profile_picture" alt="">
                    </div>
                    <h3 class="font-bold lg:text-xl text-lg text-center mt-6 text-merah-component">{{
                        $page.props.auth.user.name }}</h3>

                </div>
            </section>
            <section class="bg-white rounded-lg w-2/3">
                <div class="md:px-8 md:py-8 px-4 py-4 flex flex-col justify-between h-full">
                    <form @submit.prevent="updatePassword" class="space-y-4">
                        <div>
                            <InputLabel for="current_password" value="Masukkan kata sandi saat ini" />

                            <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                                type="password" class="mt-1 block w-full" autocomplete="current-password" />

                            <InputError :message="form.errors.current_password" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Masukkan kata sandi baru" />

                            <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />

                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="password_confirmation" value="Konfirmasi kata sandi baru" />

                            <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />

                            <InputError :message="form.errors.password_confirmation" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing" class="px-4 mr-5">Simpan</PrimaryButton>
                            <Link :href="route('profile.index')">
                            <SecondaryButton class="px-4">Batal</SecondaryButton>
                            </Link>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
