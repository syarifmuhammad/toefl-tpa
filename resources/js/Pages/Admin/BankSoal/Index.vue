<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SecondaryButton2 from '@/Components/SecondaryButton2.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import moment from 'moment';

const formBankSoal = useForm({
    id: null,
    name: '',
    category: '',
    file: null
})

const props = defineProps(({
    questionBanks: Array
}))

const modal = ref(false)
const modal_update = ref(false)
const modal_delete = ref(false)

const submit = () => {
    if (!modal_update.value) {
        formBankSoal.post(route('admin.bank_soal.store'), {
            onSuccess: () => {
                modal.value = false
                formBankSoal.reset()
            },
            onError: (errors) => {
                // alert(errors)
                console.log(errors)
            }
        });
    } else {
        console.log(formBankSoal.id)
        
        formBankSoal.post(route('admin.bank_soal.update'), {
            onSuccess: () => {
                modal_update.value = false
                modal.value = false
                formBankSoal.reset()
            },
            onError: (errors) => {
                console.log(errors)
            }
        });
    }
};

const deleteBanks = () => {
    formBankSoal.delete(route('admin.bank_soal.destroy', formBankSoal.id), {
        onSuccess: () => {
            modal_delete.value = false,
                formBankSoal.reset()
        },
        onError: (errors) => {
            console.log(errors)
        }
    })
}

const checkFile = (e) => {
    const file = e.target.files[0];
    const allowedExtensions = ['csv'];

    if (file) {
        const extension = file.name.split('.').pop();
        if (!allowedExtensions.includes(extension.toLowerCase())) {
            alert('hanya menerima file csv')
            e.target.value = '';
        }else{
            formBankSoal.file = file
        }
    }

}

</script>

<template>
    <Head title="Bank Soal" />
    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard > Soal</h2>
        </template>

        <Modal :show="modal" @close="modal = false">
            <form class="p-5" @submit.prevent="submit">
                <div>
                    <InputLabel class="mb-2">Nama soal</InputLabel>
                    <TextInput class="w-full" type="text" placeholder="Tambahkan nama soal" autocomplete="name"
                        v-model="formBankSoal.name"></TextInput>
                </div>
                <div class="mt-4">
                    <InputLabel class="mb-2">Tipe soal</InputLabel>
                    <select class="border-abu-text rounded-md shadow-sm focus:border-2 focus:ring-0 w-full"
                        :class="{ 'text-black/70': formBankSoal.type == '' }" v-model="formBankSoal.category">
                        <option value="" disabled>Pilih tipe soal</option>
                        <option value="toefl">TOEFL</option>
                        <option value="tpa">TPA</option>
                    </select>
                </div>
                <div class="mt-4">
                    <InputLabel class="mb-2">Upload soal (csv)</InputLabel>
                    <input v-on:change="checkFile" type="file" class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full  placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40" />
                </div>
                <div class="mt-4 text-sm text-slate-600">
                    bingung bikin soal? 
                    <a href="https://docs.google.com/spreadsheets/d/1MlDjIsbPc0KG8iTNLg9DJUPUDbP7Zgy9pQtrap6qsD8/edit#gid=0" class=" text-blue-600 hover:underline">format soal csv</a>
                </div>
                <div class="flex justify-between gap-x-4 mt-4">
                    <PrimaryButton class="w-full flex justify-center" type="submit" v-if="modal_update == false">Tambah
                    </PrimaryButton>
                    <PrimaryButton class="w-full flex justify-center" type="submit" v-if="modal_update == true">Update
                    </PrimaryButton>
                    <SecondaryButton class="w-full flex justify-center" @click="modal = false, formBankSoal.reset()">Batal
                    </SecondaryButton>
                </div>
            </form>
        </Modal>

        <Modal :show="modal_delete" @close="modal_delete = false">
            <div class="p-8 flex flex-col justify-between items-center relative">
                <svg class="absolute right-8 cursor-pointer" @click="modal_delete = false, formBankSoal.reset()" width="43"
                    height="43" viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M53.2942 32.7051L32.0986 53.9006M53.2942 53.9007L32.0986 32.7051" stroke="#5F6D7E"
                        stroke-width="3.53966" stroke-linecap="round" />
                </svg>

                <svg width="45" height="45" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M34.9115 48.9145V31.958M34.9115 23.4798V23.4515M65.9983 34.7841C65.9983 51.9529 52.0803 65.8709 34.9115 65.8709C17.7427 65.8709 3.82471 51.9529 3.82471 34.7841C3.82471 17.6153 17.7427 3.69727 34.9115 3.69727C52.0803 3.69727 65.9983 17.6153 65.9983 34.7841Z"
                        stroke="#A22122" stroke-width="4.23911" stroke-linecap="round" />
                </svg>
                <div class="text-center mt-4">
                    <h1 class="font-medium text-lg mb-3">Peringatan</h1>
                    <p class="text-abu-text">Apakah Anda yakin akan menghapus Bank Soal “{{ formBankSoal.name }}” ini?</p>
                </div>
                <PrimaryButton class="px-4 w-full flex justify-center mt-3" @click="deleteBanks()">Continue</PrimaryButton>
            </div>
        </Modal>


        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="font-semibold text-lg text-merah-component pb-1 border-merah-component">List Bank Soal</h1>
            <div class="bg-white rounded-lg mt-4 px-8 py-6">
                <table class="w-full border-b-2 border-abu-component text-medium">
                    <thead class="text-merah-component">
                        <tr class="border-b-2 border-abu-component">
                            <th class="py-5"></th>
                            <th class="py-5">Tipe Soal</th>
                            <th class="py-5">Nama Soal</th>
                            <th class="py-5">Tgl. Dibuat</th>
                            <th class="py-5">Jumlah Soal</th>
                            <th class="py-5">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        <tr v-if="questionBanks.data.length > 0" v-for="(i) in questionBanks.data"
                            class="border-b-2 border-abu-component">
                            <td>
                            </td>
                            <td class="py-5 uppercase">{{ i.category }}</td>
                            <td class="py-5">{{ i.name }}</td>
                            <td class="py-5">{{ moment(i.created_at).format("DD MMMM YYYY") }}</td>
                            <td class="py-5">{{ i.jumlah }}</td>
                            <td class="py-5">
                                <div class="flex gap-x-4 justify-end">
                                    <Link :href="route('admin.bank_soal.detail', i.id)">
                                    <!-- <PrimaryButton class="px-4">Detail</PrimaryButton> -->
                                    </Link>
                                    <SecondaryButton2
                                        @click="formBankSoal.id = i.id, formBankSoal.name = i.name, formBankSoal.category = i.category ,modal = true, modal_update = true"
                                        class="px-4">
                                        <svg width="22" height="21" viewBox="0 0 22 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.7622 0.512126C16.0903 0.184205 16.5353 0 16.9992 0C17.4631 0 17.908 0.184205 18.2362 0.512126L20.8222 3.09813C21.1501 3.42628 21.3343 3.87121 21.3343 4.33513C21.3343 4.79904 21.1501 5.24397 20.8222 5.57213L18.0292 8.36513L18.0172 8.37813L7.18917 18.7131C6.99129 18.9022 6.7519 19.0422 6.49017 19.1221L0.967169 20.8021C0.837313 20.8415 0.699196 20.8448 0.567608 20.8117C0.436021 20.7786 0.31592 20.7103 0.220169 20.6141C0.124024 20.5184 0.055737 20.3983 0.0226199 20.2667C-0.0104972 20.1351 -0.00719635 19.997 0.0321688 19.8671L1.70517 14.3671C1.79291 14.0792 1.95341 13.8189 2.17117 13.6111L12.9752 3.29813L15.7622 0.512126ZM3.20717 14.6961C3.17625 14.726 3.15322 14.7631 3.14017 14.8041L1.87617 18.9581L6.05317 17.6871C6.09063 17.6755 6.12486 17.6553 6.15317 17.6281L16.4262 7.82213L13.4862 4.88313L3.20717 14.6961ZM17.4992 6.77513L19.7622 4.51313C19.7854 4.4899 19.8039 4.46232 19.8165 4.43194C19.8291 4.40157 19.8356 4.36901 19.8356 4.33613C19.8356 4.30324 19.8291 4.27068 19.8165 4.24031C19.8039 4.20994 19.7854 4.18235 19.7622 4.15913L17.1762 1.57313C17.1529 1.54984 17.1254 1.53137 17.095 1.51877C17.0646 1.50617 17.0321 1.49968 16.9992 1.49968C16.9663 1.49968 16.9337 1.50617 16.9034 1.51877C16.873 1.53137 16.8454 1.54984 16.8222 1.57313L14.5602 3.83513L17.4992 6.77513Z"
                                                fill="black" />
                                        </svg>

                                    </SecondaryButton2>
                                    <SecondaryButton2 class="px-4"
                                        @click="formBankSoal.id = i.id, formBankSoal.name = i.name, modal_delete = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px"
                                            height="24px">
                                            <path
                                                d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                        </svg>
                                    </SecondaryButton2>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-5">
                                <button class="border border-black w-7 aspect-square rounded-full"
                                    @click="formBankSoal.reset(), modal = true, modal_update = false">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
