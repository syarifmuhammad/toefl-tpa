<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SecondaryButton2 from '@/Components/SecondaryButton2.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { ref, defineProps, computed } from 'vue'
import Editor from '@tinymce/tinymce-vue'

const props = defineProps({
    question_bank: Object,
    id: Number,
    page: Number,
    category: String,
    questions: Array,
    list_questions: Array,
})
const formSoal = computed(() => {
    let questions = props.questions
    questions.push(
        {
            id: null,
            value: '',
            image: null,
            preview_image: null,
            category: '',
            choices: [
                {
                    id: null,
                    text: '',
                    true: false,
                }
            ],
        }
    )
    return questions
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
    formSoal.value[index].image = file
    formSoal.value[index].preview_image = URL.createObjectURL(file)
    modal.value = false
    name_file_temp.value = null
}

const listenFileUpload = (file) => {
    name_file_temp.value = file.files[0].name
}

const simpanJawaban = (index) => {
    formSoal.value[index].questions.push(
        {
            id: null,
            value: "",
            true: false,
        },
    )
}

const pilihJawabanBenar = (indexSoal, indexJawaban) => {
    formSoal.value[indexSoal].choices.forEach((val, index) => {
        formSoal.value[indexSoal].choices[index].true = indexJawaban == index
    });
}

const addOrSave = (index) => {
    let soal = formSoal.value[index]

    if (!soal.choices.some(val => val.true == true)) {
        alert('Wajib pilih jawaban yang benar')
        return;
    }

    if (soal.choices.length < 2) {
        alert("Pilihan jawaban wajib lebih dari 1")
        return;
    }

    const form = useForm({
        id: soal.id,
        value: soal.value,
        image: soal.image,
        category: soal.category,
        choices: soal.choices,
        page: props.page,
    })

    form.post(route('admin.bank_soal.soal.save', props.id), {
        onSuccess: () => {
            // if (formSoal.value[index].id == null) {
            //     formSoal.value.push({
            //         id: null,
            //         value: '',
            //         image: null,
            //         preview_image: null,
            //         category: '',
            //         choices: [
            //             {
            //                 id: null,
            //                 value: '',
            //                 true: false,
            //             }
            //         ],
            //     })
            // }
        },
        onError: (errors) => {
            alert(errors)
        }
    })
}

const deleteSoal = (index) => {
    if (confirm("Apakah anda yakin ingin menghapus soal ini ?")) {
        const formDelete = useForm({});
        formDelete.delete(route('admin.bank_soal.soal.destroy', formSoal.value[index].id))
        // formSoal.value.splice(index, 1)
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
                <form v-for="(soal, index) in formSoal" @submit.prevent="addOrSave(index)" :id="`soal_${index}`"
                    class="mt-4 flex justify-between py-8">
                    <div class="rounded-lg pl-8 grow">
                        <select required v-model="soal.category" v-if="question_bank.category == 'toefl'">
                            <option value="structured">Structured</option>
                            <option value="grammar">Grammar</option>
                        </select>
                        <select required v-model="soal.category" v-if="question_bank.category == 'tpa'">
                            <option value="verbal">Verbal</option>
                            <option value="angka">Angka</option>
                            <option value="logika">Logika</option>
                            <option value="spasial">Spasial</option>
                        </select>
                        <div>
                            <img v-if="soal.preview_image != null" class="max-w-[720px] mx-auto mb-3"
                                :src="soal.preview_image" alt="">
                            <div class="flex">
                                <textarea required class="rounded-md w-full" rows="8" v-model="soal.value"></textarea>
                                <div class="ml-3 bg-merah-primary self-start text-white flex flex-col">
                                    <button type="submit"
                                        class="cursor-pointer box-content py-2 px-3 hover:bg-merah-warning flex justify-center">
                                        <svg v-if="soal.id != null" class="w-[20px]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            fill="#fff" version="1.1" id="Capa_1"
                                            viewBox="0 0 407.096 407.096" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086    c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032    C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z" />
                                                    <path
                                                        d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08    c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z" />
                                                </g>
                                            </g>
                                        </svg>
                                        <svg v-else class="w-[23px]" xmlns="http://www.w3.org/2000/svg" fill="white"
                                            viewBox="0 0 50 50">
                                            <path
                                                d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24 13 L 24 24 L 13 24 L 13 26 L 24 26 L 24 37 L 26 37 L 26 26 L 37 26 L 37 24 L 26 24 L 26 13 L 24 13 z" />
                                        </svg>
                                    </button>
                                    <div @click="openModalUploadFileForSoal(index)"
                                        class="cursor-pointer box-content py-2 px-3 hover:bg-merah-warning flex justify-center">
                                        <img class="w-[20px] aspect-square" src="../../../Assets/image-icon.png" alt="">
                                    </div>
                                    <div v-if="soal.id != null" @click="deleteSoal(index)"
                                        class="cursor-pointer box-content py-2 px-3 hover:bg-merah-warning flex justify-center">
                                        <svg class="w-[25px] aspect-square" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 32 32" fill="#ffffff">
                                            <path
                                                d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h2 class="font-semibold text-md">Opsi Jawaban</h2>
                            <div class="flex flex-col space-y-4 mt-4">
                                <div v-for="(choice, index_jawaban) in soal.choices" class="flex gap-x-3">
                                    <input required type="radio" name="jawaban_benar" :checked="choice.true"
                                        @change="pilihJawabanBenar(index, index_jawaban)">
                                    <textarea required class="rounded-md" name="" id="" cols="60" rows="3"
                                        v-model="choice.value"></textarea>
                                    <SecondaryButton2 class="px-2 self-start" v-if="soal.choices.length > 1"
                                        @click="soal.choices.splice(index_jawaban, 1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px"
                                            height="24px">
                                            <path
                                                d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                        </svg>
                                    </SecondaryButton2>
                                </div>
                                <div class="flex gap-x-3 cursor-pointer"
                                    @click="soal.choices.push({ id: null, value: '', true: false, })">
                                    <span>+</span>
                                    <span>Tambah opsi</span>
                                </div>
                            </div>
                        </div>
                        <!-- <PrimaryButton @click="simpanJawaban(index)" class="px-4 mt-6 float-right">Tambah Jawaban
                        </PrimaryButton> -->
                    </div>

                </form>
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
                    <div class="grid grid-cols-5 gap-2">
                        <Link v-for="(list, index) in props.list_questions"
                            :href="route('admin.bank_soal.detail', props.id) + `?page=${list.page}#soal_${index}`"
                            class="flex items-center justify-center aspect-square rounded-sm"
                            :class="list.page == props.page ? 'bg-blue-400' : 'bg-white'">
                        {{ index + 1 }}
                        </Link>
                        <Link :href="route('admin.bank_soal.detail', props.id) + `?page=${props.list_questions.length + 1}`"
                            class="flex items-center justify-center aspect-square rounded-sm"
                            :class="props.page >= props.list_questions.length + 1 ? 'bg-blue-400' : 'bg-white'">
                        ?
                        </Link>
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
    </AuthenticatedLayout></template>
