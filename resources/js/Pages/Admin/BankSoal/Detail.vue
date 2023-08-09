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
import Editor from '@tinymce/tinymce-vue'

const formSoal = useForm({
    soal: [
        {
            id: null,
            soal: '',
            image: null,
            jawaban: [
                {
                    id: null,
                    text: '',
                }
            ],
            jawaban_benar: null,
        },
    ],
})

const modal = ref(false)
const jawaban_sementara = ref('')
const selected_index = ref(null)
const name_file_temp = ref(null)
const show_sidebar = ref(false)

const openModalUploadFileForSoal = (index) => {
    selected_index.value = index;
    modal.value = true;
}

const uploadFileClient = (index, file) => {
    formSoal.soal[index].image = file
    formSoal.soal[index].preview_image = URL.createObjectURL(file)
    modal.value = false
    name_file_temp.value = null
}

const listenFileUpload = (file) => {
    name_file_temp.value = file.files[0].name
}

const simpanJawaban = (index) => {
    formSoal.soal[index].jawaban.push(
        {
            id: null,
            image: null,
            preview_image: null,
            jawaban: '',
        },
    )
}

const addOrSave = (index) => {
    if (formSoal.soal[index].id == null) {
        formSoal.soal.push({
            id: null,
            soal: '',
            image: null,
            jawaban: [
                {
                    id: null,
                    text: '',
                }
            ],
            jawaban_benar: null,
        })
    }
    simpanSoal(index)
}

const simpanSoal = (index) => {
    
}

</script>

<template>
    <Head title="Bank Soal" />
    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard > Soal</h2>
        </template>

        <Modal :show="modal" @close="modal = false">
            <form class="p-5">
                <div>
                    <!-- <InputLabel class="font-semibold"></InputLabel> -->
                    <div @click="$refs.file_uploaded.click()"
                        class="h-28 rounded-lg border border-abu-text mt-2 text-sm flex justify-center items-center">
                        {{ selected_index && formSoal.soal[selected_index].image ? formSoal.soal[selected_index].image.name
                            : (name_file_temp ?? 'Upload files here ...') }}
                    </div>
                    <input @change="listenFileUpload($event.target)" ref="file_uploaded" type="file" class="hidden">
                </div>
                <div class="flex justify-between gap-x-4 mt-4">
                    <PrimaryButton type="button" @click="uploadFileClient(selected_index, $refs.file_uploaded.files[0])"
                        class="w-full flex justify-center">Upload</PrimaryButton>
                    <SecondaryButton class="w-full flex justify-center" @click="modal = false, name_file_temp = null">Batal
                    </SecondaryButton>
                </div>
            </form>
        </Modal>

        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full flex bg-white py-8">
            <div class="w-7/12 flex flex-col divide-y-2">
                <div v-for="(soal, index) in formSoal.soal" class="mt-4 flex justify-between py-8">
                    <div class="rounded-lg pl-8 grow">
                        <div>
                            <img v-if="soal.preview_image != null" class="max-w-[720px] mx-auto mb-3"
                                :src="soal.preview_image" alt="">
                            <textarea class="rounded-md w-full" rows="8"></textarea>
                        </div>
                        <div class="mt-6">
                            <h2 class="font-semibold text-md">Opsi Jawaban</h2>
                            <div class="flex flex-col space-y-4 mt-4">
                                <div v-for="(jawaban, index_jawaban) in soal.jawaban" class="flex gap-x-3">
                                    <input type="radio" name="jawaban_benar" :value="index_jawaban"
                                        v-model="soal.jawaban_benar">
                                    <textarea class="rounded-md" name="" id="" cols="60" rows="3"></textarea>
                                    <SecondaryButton2 class="px-2 self-start" v-if="soal.jawaban.length > 1"
                                        @click="soal.jawaban.splice(index_jawaban, 1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px"
                                            height="24px">
                                            <path
                                                d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                        </svg>
                                    </SecondaryButton2>
                                </div>
                                <div class="flex gap-x-3 cursor-pointer" @click="soal.jawaban.push({ id: null, text: '' })">
                                    <span>+</span>
                                    <span>Tambah opsi</span>
                                </div>
                            </div>
                        </div>
                        <!-- <PrimaryButton @click="simpanJawaban(index)" class="px-4 mt-6 float-right">Tambah Jawaban
                        </PrimaryButton> -->
                    </div>
                    <div class="ml-3 bg-merah-primary self-start text-white py-4 flex flex-col">
                        <div @click="addOrSave(index)" class="cursor-pointer box-content py-2 px-3 hover:bg-merah-warning">
                            <svg class="w-[23px]" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 50 50">
                                <path
                                    d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24 13 L 24 24 L 13 24 L 13 26 L 24 26 L 24 37 L 26 37 L 26 26 L 37 26 L 37 24 L 26 24 L 26 13 L 24 13 z" />
                            </svg>
                        </div>
                        <div @click="openModalUploadFileForSoal(index)"
                            class="cursor-pointer box-content py-2 px-3 hover:bg-merah-warning flex justify-center">
                            <img class="w-[20px] aspect-square" src="../../../Assets/image-icon.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <aside class="fixed transition-all w-3/12 max-h-[70vh] overflow-y-auto bg-merah-primary"
                :class="show_sidebar ? 'right-0' : '-right-1/4'">
                <svg @click="show_sidebar = false" class="fixed right-0" width="61" height="63" viewBox="0 0 61 63"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="1" width="61" height="61" fill="black" stroke="black" />
                    <path
                        d="M48.0607 32.5607C48.6464 31.9749 48.6464 31.0251 48.0607 30.4393L38.5147 20.8934C37.9289 20.3076 36.9792 20.3076 36.3934 20.8934C35.8076 21.4792 35.8076 22.4289 36.3934 23.0147L44.8787 31.5L36.3934 39.9853C35.8076 40.5711 35.8076 41.5208 36.3934 42.1066C36.9792 42.6924 37.9289 42.6924 38.5147 42.1066L48.0607 32.5607ZM15 33L47 33L47 30L15 30L15 33Z"
                        fill="white" />
                </svg>

                <div class="w-full p-4 pr-16">
                    <h1 class="text-white text-lg">Nomor Soal</h1>
                    <hr class="w-full border-2 border-white my-5">
                    <div class="text-white text-lg mb-3">Structured</div>
                    <div class="grid grid-cols-5 gap-2">
                        <div v-for="n in 10" class="flex items-center justify-center aspect-square bg-blue-400 rounded-sm">
                            {{ n }}
                        </div>
                    </div>
                    <div class="mt-4 text-white text-lg mb-3">Grammar</div>
                    <div class="grid grid-cols-5 gap-2">
                        <div v-for="n in 10" class="flex items-center justify-center aspect-square bg-blue-400 rounded-sm">
                            {{ n }}
                        </div>
                    </div>
                </div>
            </aside>
            <svg v-if="!show_sidebar" @click="show_sidebar = true" class="fixed right-0" width="61" height="63"
                viewBox="0 0 61 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="61.5" y="62" width="61" height="61" transform="rotate(180 61.5 62)" fill="black" stroke="black" />
                <path
                    d="M13.9393 30.4393C13.3536 31.0251 13.3536 31.9749 13.9393 32.5607L23.4853 42.1066C24.0711 42.6924 25.0208 42.6924 25.6066 42.1066C26.1924 41.5208 26.1924 40.5711 25.6066 39.9853L17.1213 31.5L25.6066 23.0147C26.1924 22.4289 26.1924 21.4792 25.6066 20.8934C25.0208 20.3076 24.0711 20.3076 23.4853 20.8934L13.9393 30.4393ZM47 30L15 30L15 33L47 33L47 30Z"
                    fill="white" />
            </svg>

        </section>
    </AuthenticatedLayout>
</template>
