<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    nim_or_nik: '',
    name: '',
    email: '',
    phone: '',
    street: '',
    sub_district: '',
    district: '',
    province: '',
    village: '',
    postal_code: '',
    profile_picture: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const setProfilePicture = (data) => {
    if (data.target.files.length > 0) {
        form.profile_picture = data.target.files[0]
    }
};

</script>

<template>
    <Head title="Register" />
    <div class="h-screen px-20 py-2">
        <div class="bg-white rounded-[10px] p-8">
            <h1 class="font-bold text-lg">Biodata Diri</h1>
            <form @submit.prevent="submit" class="mt-6" >
                <div class="flex gap-x-4 items-start">
                    <div class="w-1/2">
                        <InputLabel for="name" value="Nama Lengkap Peserta  (tercetak di sertifikat)" required>
                            Nama sesuai KTP (tanpa gelar)
                        </InputLabel>

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                            autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="w-1/2">
                        <InputLabel for="phone" value="No WhatsApp" required>
                            Didahului kode negara. (Contoh: 6281xxxxxx)
                        </InputLabel>

                        <TextInput id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone"
                            required autocomplete="tel" />

                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                </div>
                <div class="flex gap-x-4 items-start mt-4">
                    <div class="w-1/2">
                        <InputLabel for="nim_or_nik" value="NIK" required>
                            No. Kartu Tanda Penduduk (KTP)
                        </InputLabel>

                        <TextInput id="nim_or_nik" type="text" class="mt-1 block w-full" v-model="form.nim_or_nik" required autofocus
                            autocomplete="nim_or_nik" />

                        <InputError class="mt-2" :message="form.errors.nim_or_nik" />
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
                        <InputLabel for="profile_picture" value="Foto Profil" required>
                            Format file .jpg / .png (Maks .2MB)
                        </InputLabel>

                        <TextInput id="profile_picture" type="file" class="mt-1 block w-full py-1" required @input="form.profile_picture = $event.target.files[0]" />

                        <InputError class="mt-2" :message="form.errors.profile_picture" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="province" value="Provinsi" required>
                            Provinsi Tempat Tinggal
                        </InputLabel>

                        <TextInput id="province" type="text" class="mt-1 block w-full" v-model="form.province" required
                            autocomplete="address-level1" />

                        <InputError class="mt-2" :message="form.errors.province" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="district" value="Kota/Kabupaten" required>
                            Kota/Kabupaten Tempat Tinggal
                        </InputLabel>

                        <TextInput id="district" type="text" class="mt-1 block w-full" v-model="form.district" required
                            autocomplete="address-level2" />

                        <InputError class="mt-2" :message="form.errors.district" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="sub_district" value="Kecamatan" required>
                            Kecamatan Tempat Tinggal
                        </InputLabel>

                        <TextInput id="sub_district" type="text" class="mt-1 block w-full" v-model="form.sub_district" required
                            autocomplete="address-level3" />

                        <InputError class="mt-2" :message="form.errors.sub_district" />
                    </div>
                </div>
                <div class="flex gap-x-4 mt-4">
                    <div class="w-1/2 flex flex-col gap-y-4">
                        <div class="flex gap-x-4">
                            <div class="w-1/2">
                                <InputLabel for="village" value="Desa/Kelurahan*" required>
                                    Desa/Kelurahan Tempat Tinggal
                                </InputLabel>

                                <TextInput id="village" type="text" class="mt-1 block w-full" v-model="form.village" required
                                    autofocus autocomplete="address-level4" />

                                <InputError class="mt-2" :message="form.errors.village" />
                            </div>
                            <div class="w-1/2">
                                <InputLabel for="postal_code" value="Kode Pos" required>
                                    Kode Pos Daerah Tempat Tinggal
                                </InputLabel>

                                <TextInput id="postal_code" type="text" class="mt-1 block w-full" v-model="form.postal_code"
                                    required autofocus autocomplete="postal-code" />

                                <InputError class="mt-2" :message="form.errors.postal_code" />
                            </div>
                        </div>
                        <div class="">
                            <InputLabel for="street" value="Alamat (pengiriman sertifikat dan legalisir)" required>
                                Alamat Rumah
                            </InputLabel>

                            <textarea id="street" name="street"
                                class="border-abu-text rounded-md shadow-sm focus:border-2 focus:ring-0 mt-1 block w-full"
                                autocomplete="street-address" v-model="form.street" required></textarea>

                            <InputError class="mt-2" :message="form.errors.street" />
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
