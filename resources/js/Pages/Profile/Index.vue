<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>
        <div class="grid md:grid-cols-[1fr_2fr] gap-8 mx-4 sm:mx-6 lg:mx-8 mt-8 items-start">
            <section class="bg-white rounded-lg">
                <div class="md:px-8 md:py-8 px-4 py-4 flex flex-col justify-center items-center">
                    <h3 class="font-bold lg:text-xl text-lg text-center">Informasi Akun</h3>
                    <div class="max-w-[210px] w-full aspect-square bg-abu-component rounded-full mt-10 overflow-hidden"></div>
                    <h3 class="font-bold lg:text-xl text-lg text-center mt-6 text-merah-component">{{ $page.props.auth.user.name }}</h3>

                </div>
            </section>
            <section class="bg-white rounded-lg">
                <div class="md:px-8 md:py-8 px-4 py-4 flex flex-col">
                    <div class="flex flex-col space-y-4">
                        <div class="flex justify-between pb-4 border-b border-abu-component">
                            <label class="font-medium" for="name">Nama (Tercetak di Sertifikat)</label>
                            <p>{{ $page.props.auth.user.name }}</p>
                        </div>
                        <div class="flex justify-between pb-4 border-b border-abu-component">
                            <label class="font-medium" for="nik_or_nim">Nik / NIM</label>
                            <p>12012000016</p>
                        </div>
                        <div class="flex justify-between pb-4 border-b border-abu-component">
                            <label class="font-medium" for="number_phone">Nomor Telepon</label>
                            <p>+6281352671896</p>
                        </div>
                        <div class="flex justify-between pb-4 border-b border-abu-component">
                            <label class="font-medium" for="number_phone">Alamat</label>
                            <p>Jl. Teluk Gadang, RT. 03, RW. 01 Desa Semayap</p>
                        </div>
                    </div>
                    <div class="mt-20">
                        <Link :href="route('profile.edit')">
                            <PrimaryButton class="px-4 mr-5">Ubah Profil</PrimaryButton>
                        </Link>
                        <Link :href="route('profile.password')">
                            <PrimaryButton class="px-4">Ubah Kata Sandi</PrimaryButton>
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
<!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
            class="max-w-xl"
        />
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <UpdatePasswordForm class="max-w-xl" />
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <DeleteUserForm class="max-w-xl" />
    </div>
</div> -->
