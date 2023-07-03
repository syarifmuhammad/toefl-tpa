<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    nama: '',
    no_whatsapp: '',
    nik_or_nim: '',
    email: '',
    photo: null,
    provinsi: '',
    kota: '',
    kecamatan: '',
    desa: '',
    kode_pos: '',
    alamat: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <div class="h-screen px-20 py-2">
        <div class="bg-white rounded-[10px] p-8">
            <h1 class="font-bold text-lg">Biodata Diri</h1>
            <form @submit.prevent="submit" class="mt-6">
                <div class="flex gap-x-4 items-start">
                    <div class="w-1/2">
                        <InputLabel for="nnamaame" value="Nama Lengkap Peserta  (tercetak di sertifikat)" required>
                            Nama sesuai KTP (tanpa gelar)
                        </InputLabel>

                        <TextInput id="nama" type="text" class="mt-1 block w-full" v-model="form.nama" required autofocus
                            autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.nama" />
                    </div>
                    <div class="w-1/2">
                        <InputLabel for="no_whatsapp" value="No WhatsApp" required>
                            Didahului kode negara. (Contoh: +6281xxxxxx)
                        </InputLabel>

                        <TextInput id="no_whatsapp" type="tel" class="mt-1 block w-full" v-model="form.no_whatsapp"
                            required autocomplete="tel" />

                        <InputError class="mt-2" :message="form.errors.no_whatsapp" />
                    </div>
                </div>
                <div class="flex gap-x-4 items-start mt-4">
                    <div class="w-1/2">
                        <InputLabel for="nik" value="NIK" required>
                            No. Kartu Tanda Penduduk (KTP)
                        </InputLabel>

                        <TextInput id="nik" type="text" class="mt-1 block w-full" v-model="form.nik_or_nim" required autofocus
                            autocomplete="nik" />

                        <InputError class="mt-2" :message="form.errors.nik_or_nim" />
                    </div>
                    <div class="w-1/2">
                        <InputLabel for="email" value="E-mail Aktif" required>
                            E-mail digunakan untuk mengirim sertifikat ujian
                        </InputLabel>

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="email" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </div>
                <div class="flex gap-x-4 items-start mt-4">
                    <div class="w-1/4">
                        <InputLabel for="photo" value="Foto Profil" required>
                            Format file .jpg / .png (Maks .2MB)
                        </InputLabel>

                        <TextInput id="photo" type="file" class="mt-1 block w-full py-1" required />

                        <InputError class="mt-2" :message="form.errors.photo" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="provinsi" value="Provinsi" required>
                            Provinsi Tempat Tinggal
                        </InputLabel>

                        <TextInput id="provinsi" type="text" class="mt-1 block w-full" v-model="form.provinsi" required
                            autocomplete="address-level1" />

                        <InputError class="mt-2" :message="form.errors.provinsi" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="kota" value="Kota/Kabupaten" required>
                            Kota/Kabupaten Tempat Tinggal
                        </InputLabel>

                        <TextInput id="kota" type="text" class="mt-1 block w-full" v-model="form.kota" required
                            autocomplete="address-level2" />

                        <InputError class="mt-2" :message="form.errors.kota" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="kecamatan" value="Kecamatan" required>
                            Kecamatan Tempat Tinggal
                        </InputLabel>

                        <TextInput id="kecamatan" type="text" class="mt-1 block w-full" v-model="form.kecamatan" required
                            autocomplete="address-level3" />

                        <InputError class="mt-2" :message="form.errors.kecamatan" />
                    </div>
                </div>
                <div class="flex gap-x-4 mt-4">
                    <div class="w-1/2 flex flex-col gap-y-4">
                        <div class="flex gap-x-4">
                            <div class="w-1/2">
                                <InputLabel for="desa" value="Desa/Kelurahan*" required>
                                    Desa/Kelurahan Tempat Tinggal
                                </InputLabel>

                                <TextInput id="desa" type="text" class="mt-1 block w-full" v-model="form.desa" required
                                    autofocus autocomplete="address-level4" />

                                <InputError class="mt-2" :message="form.errors.desa" />
                            </div>
                            <div class="w-1/2">
                                <InputLabel for="kode_pos" value="Kode Pos" required>
                                    Kode Pos Daerah Tempat Tinggal
                                </InputLabel>

                                <TextInput id="kode_pos" type="text" class="mt-1 block w-full" v-model="form.kode_pos"
                                    required autofocus autocomplete="postal-code" />

                                <InputError class="mt-2" :message="form.errors.kode_pos" />
                            </div>
                        </div>
                        <div class="">
                            <InputLabel for="alamat" value="Alamat (pengiriman sertifikat dan legalisir)" required>
                                Alamat Rumah
                            </InputLabel>

                            <textarea id="email" name="alamat"
                                class="border-abu-text rounded-md shadow-sm focus:border-2 focus:ring-0 mt-1 block w-full"
                                autocomplete="street-address" v-model="form.alamat" required></textarea>

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div class="w-1/2 flex flex-col justify-between">
                        <h1 class="font-bold text-lg">Kata Sandi</h1>
                        <div>
                            <InputLabel for="password" value="Kata Sandi" required>
                                Kata sandi akun
                            </InputLabel>

                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autocomplete="new-password" />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div>
                            <InputLabel for="password_confirmation" value="Konfirmasi Kata Sandi" required>
                                Kata sandi akun
                            </InputLabel>

                            <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                                v-model="form.password_confirmation" required autocomplete="new-password" />

                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Sudah punya akun ? <span class="text-[#23C1D7]">Login</span>
                    </Link>

                    <PrimaryButton class="ml-4 px-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Buat Akun
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
