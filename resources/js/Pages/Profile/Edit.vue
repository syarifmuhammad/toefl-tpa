<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
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
    name: '',
    nik_or_nim: '',
    number_phone: '',
    province: '',
    district: '',
    sub_district: '',
    village: '',
    zip_code: '',
    address: '',
});

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
                    </div>
                    <h3 class="font-medium text-lg text-center mt-6 text-biru underline">Ubah foto profil</h3>

                </div>
            </section>
            <section class="bg-white rounded-lg w-2/3">
                <div class="md:px-8 md:py-8 px-4 py-4 flex flex-col justify-between h-full">
                    <form action="">
                        <div>
                            <InputLabel for="name" value="Nama Lengkap Peserta (tercetak di sertifikat)" required>
                                Nama sesuai KTP (tanpa gelar)
                            </InputLabel>

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus />

                            <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                        </div>
                        <div class="flex justify-between gap-x-5 mt-4">
                            <div class="w-1/2">
                                <InputLabel for="nik_or_nim" value="NIK/NIM" required>
                                    No. Kartu Tanda Penduduk (KTP) / No. Induk Mahasiswa
                                </InputLabel>

                                <TextInput id="nik_or_nim" type="text" class="mt-1 block w-full" v-model="form.nik_or_nim"
                                    required autofocus />

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                            <div class="w-1/2">
                                <InputLabel for="number_phone" value="No WhatsApp" required>
                                    Didahului kode negara. (Contoh: +6281xxxxxx)
                                </InputLabel>

                                <TextInput id="number_phone" type="tel" class="mt-1 block w-full"
                                    v-model="form.number_phone" required autofocus />

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                        </div>
                        <div class="flex justify-between gap-x-5 mt-4">
                            <div class="w-1/3">
                                <InputLabel for="province" value="Provinsi" required>
                                    Provinsi Tempat Tinggal
                                </InputLabel>

                                <TextInput id="province" type="text" class="mt-1 block w-full" v-model="form.province"
                                    required autofocus />

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                            <div class="w-1/3">
                                <InputLabel for="district" value="Kota/Kabupaten" required>
                                    Kota/Kabupaten Tempat Tinggal
                                </InputLabel>

                                <TextInput id="district" type="text" class="mt-1 block w-full" v-model="form.district"
                                    required autofocus />

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                            <div class="w-1/3">
                                <InputLabel for="sub_district" value="Kecamatan" required>
                                    Kecamatan Tempat Tinggal
                                </InputLabel>

                                <TextInput id="sub_district" type="text" class="mt-1 block w-full"
                                    v-model="form.sub_district" required autofocus />

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                        </div>
                        <div class="flex justify-between gap-x-5 mt-4">
                            <div class="w-1/2">
                                <div>
                                    <InputLabel for="province" value="Provinsi" required>
                                        Provinsi Tempat Tinggal
                                    </InputLabel>

                                    <TextInput id="province" type="text" class="mt-1 block w-full" v-model="form.province"
                                        required autofocus />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="province" value="Provinsi" required>
                                        Provinsi Tempat Tinggal
                                    </InputLabel>

                                    <TextInput id="province" type="text" class="mt-1 block w-full" v-model="form.province"
                                        required autofocus />
                                </div>

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                            <div class="w-1/2 items-stretch flex flex-col">
                                <InputLabel for="address" value="Alamat (pengiriman sertifikat dan legalisir)" required>
                                    Alamat Rumah
                                </InputLabel>

                                <TextArea id="address" class="mt-1 block w-full items-stretch h-full" v-model="form.address"
                                    required autofocus />

                                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                            </div>
                        </div>
                        <div class="mt-20">
                            <PrimaryButton class="px-4 mr-5">Simpan</PrimaryButton>
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
