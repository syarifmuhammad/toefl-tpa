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
            jawaban: [],
            jawaban_benar: null,
        },
        {
            id: null,
            soal: '',
            jawaban: [],
            jawaban_benar: null,
        },

    ],
})

const modal = ref(false)
const jawaban_sementara = ref('')

const file_picker_callback = (cb, value, meta) => {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/* audio/*');
    input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            // call the callback and populate the Title field with the file name
            cb(blobInfo.blobUri(), { title: file.name });
        };
    };

    input.click();
}

const audio_template_callback = (data) => {
    return '<audio controls>\n' +
        `<source src="${data.source}"${data.sourcemime ? ` type="${data.sourcemime}"` : ''} />\n` +
        (data.altsource ? `<source src="${data.altsource}"${data.altsourcemime ? ` type="${data.altsourcemime}"` : ''} />\n` : '') +
        '</audio>'
}

const video_template_callback = (data) => {
    return `<video width="${data.width}" height="${data.height}"${data.poster ? ` poster="${data.poster}"` : ''} controls="controls">\n` +
        `<source src="${data.source}"${data.sourcemime ? ` type="${data.sourcemime}"` : ''} />\n` +
        (data.altsource ? `<source src="${data.altsource}"${data.altsourcemime ? ` type="${data.altsourcemime}"` : ''} />\n` : '') +
        '</video>'
}

const simpanJawaban = (index) => {
    formSoal.soal[index].jawaban.push(
        {
            id: null,
            jawaban: '',
        },
    )
}

</script>

<template>
    <Head title="Bank Soal" />
    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard > Soal > 1</h2>
        </template>

        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full flex flex-col space-y-8">
            <div v-for="(soal, index) in formSoal.soal" class="bg-white rounded-lg mt-4 px-8 py-6">
                <Editor api-key="qqwl0cjq288n5dzojlo4fi75t6wrwvysnhi6qpunf44od0mx" :init="{
                    width: '100%',
                    plugins: 'lists link image media table code help wordcount',
                    toolbar: 'undo redo | image | media',
                    file_picker_types: 'image media',
                    audio_template_callback: audio_template_callback,
                    video_template_callback: video_template_callback,
                    file_picker_callback: file_picker_callback,
                }" />

                <div class="mt-8">
                    <h2 class="font-semibold text-md">Opsi Jawaban</h2>
                    <div class="flex flex-col space-y-4 mt-4">
                        <div v-for="(jawaban, index_jawaban) in soal.jawaban" class="flex items-start gap-x-3">
                            <div class="flex flex-col gap-y-3 items-center">
                                <input type="radio" name="jawaban_benar" :id="`jawaban_${index}__${index_jawaban}`"
                                    :value="index_jawaban" v-model="soal.jawaban_benar">

                                <SecondaryButton2 class="px-2" @click="soal.jawaban.splice(index_jawaban, 1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px" height="24px">
                                        <path
                                            d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                                    </svg>
                                </SecondaryButton2>
                            </div>

                            <Editor v-model="jawaban.jawaban" api-key="qqwl0cjq288n5dzojlo4fi75t6wrwvysnhi6qpunf44od0mx"
                                :init="{
                                    width: '100%',
                                    height: 200,
                                    min_height: 200,
                                    max_height: 500,
                                    resize: true,
                                    plugins: 'lists link image table code help wordcount',
                                    toolbar: 'undo redo | image',
                                    file_picker_types: 'image',
                                    file_picker_callback: file_picker_callback,
                                }" />
                            <div v-if="index_jawaban != soal.jawaban.length - 1" class="border border-top mt-6 mb-1"></div>
                        </div>
                    </div>
                    <PrimaryButton @click="simpanJawaban(index)" class="px-4 mt-6 float-right">Tambah Jawaban
                    </PrimaryButton>
                </div>

            </div>
        </section>
    </AuthenticatedLayout>
</template>
