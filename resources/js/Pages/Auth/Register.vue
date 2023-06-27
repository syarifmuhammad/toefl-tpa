<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
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
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="nim_or_nik" value="NIM/NIK" />

                <TextInput id="nim_or_nik" type="text" class="mt-1 block w-full" v-model="form.nim_or_nik" required
                    autofocus />

                <InputError class="mt-2" :message="form.errors.nim_or_nik" />
            </div>
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="mt-4">
                <InputLabel for="street" value="Address" />

                <TextArea id="street" class="mt-1 block w-full" v-model="form.street" required autocomplete="street" />

                <InputError class="mt-2" :message="form.errors.street" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="No Whatsapp" />

                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                    autocomplete="phone" />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>
            <div class="mt-4">
                <InputLabel for="sub_district" value="Kecamatan" />

                <TextInput id="sub_district" type="text" class="mt-1 block w-full" v-model="form.sub_district" required
                    autocomplete="sub_district" />

                <InputError class="mt-2" :message="form.errors.sub_district" />
            </div>
            <div class="mt-4">
                <InputLabel for="district" value="Kabupaten/Kota" />

                <TextInput id="district" type="text" class="mt-1 block w-full" v-model="form.district" required
                    autocomplete="district" />

                <InputError class="mt-2" :message="form.errors.district" />
            </div>
            <div class="mt-4">
                <InputLabel for="province" value="Provinsi" />

                <TextInput id="province" type="text" class="mt-1 block w-full" v-model="form.province" required
                    autocomplete="province" />

                <InputError class="mt-2" :message="form.errors.province" />
            </div>
            <div class="mt-4">
                <InputLabel for="village" value="Desa/Kelurahan" />

                <TextInput id="village" type="text" class="mt-1 block w-full" v-model="form.village" required
                    autocomplete="village" />

                <InputError class="mt-2" :message="form.errors.village" />
            </div>
            <div class="mt-4">
                <InputLabel for="postal_code" value="Kode Pos" />

                <TextInput id="postal_code" type="text" class="mt-1 block w-full" v-model="form.postal_code" required
                    autocomplete="postal_code" />

                <InputError class="mt-2" :message="form.errors.postal_code" />
            </div>
            <div class="mt-4">
                <InputLabel for="profile_picture" value="Foto Profil" />

                <TextInput type="file" accept="image/png, image/gif, image/jpeg" id="profile_picture"
                    class="mt-1 block w-full" v-model="form.profile_picture" required />

                <InputError class="mt-2" :message="form.errors.profile_picture" />
            </div>
            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
