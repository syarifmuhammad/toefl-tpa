<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
// import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import moment from 'moment/min/moment-with-locales'
moment.locale('id')

const props = defineProps({
    registrar: Object
})

const modal = ref(false)
const title = ref('Konfirmasi Pembayaran')
let form = useForm({
    status: props.registrar.data.status,
    file: null,
})

const ubahStatus = () => {
    if (form.status == 1) {
        modal.value = true
    } else {
        form.post(route('admin.pembayaran.update', props.registrar.data.id), {
            onSuccess: (data) => {
            },
            onError: (errors) => {
                console.log(errors)
            }
        })
    }
}


const submit = () => {
    form.post(route('admin.pembayaran.update', props.registrar.data.id), {
        onSuccess: (data) => {
            modal.value = false
        },
        onError: (errors) => {
            modal.value = false
            console.log(errors)
        }
    })
}

</script>

<template>
    <Head title="Detail Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Detail Ujian</h2>
        </template>
        <Modal :show="modal" @close="modal = false">
            <form class="p-5" @submit.prevent="submit">
                <div>
                    <InputLabel class="font-semibold">{{ title }}</InputLabel>
                    <div @click="$refs.file.click()"
                        class="h-28 rounded-lg border border-abu-text mt-2 text-sm flex justify-center items-center">
                        <span v-if="form.file == null">Upload files here ...</span>
                        <span v-else>
                            {{ form.file.name }}
                            <br />Klik untuk mengganti file
                        </span>
                    </div>
                    <input @input="form.file = $event.target.files[0]" ref="file" type="file" class="hidden">
                </div>
                <div class="flex justify-between gap-x-4 mt-4">
                    <PrimaryButton :disabled="form.file == null" class="w-full flex justify-center">Upload</PrimaryButton>
                    <SecondaryButton class="w-full flex justify-center" @click="modal = false">Batal</SecondaryButton>
                </div>
            </form>
        </Modal>
        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg overflow-hidden">
                <div
                    class="px-8 py-3 w-full flex items-center justify-between border rounded-ss-lg rounded-se-lg border-abu-text">
                    <div class="font-semibold text-md">
                        <h3>{{ moment(registrar.data.create_at).format('DD MMMM YYYY') }}</h3>
                        <h3>ID: {{ registrar.data.payment.payment_id }}</h3>
                    </div>
                    <div class="flex gap-x-3">
                        <select class="border-abu-text rounded-md shadow-sm focus:border-2 focus:ring-0 w-full"
                            v-model="form.status">
                            <option value="0">Menunggu Pembayaran</option>
                            <option value="1">Selesai</option>
                            <option value="2">Dibatalkan</option>
                        </select>
                        <PrimaryButton :disabled="form.status == registrar.data.status" class="px-4" @click="ubahStatus">
                            Simpan</PrimaryButton>
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <div>
                        <h2 class="font-semibold text-xl">Rincian Permintaan</h2>
                        <table class="h-full mt-4">
                            <tr>
                                <td class="w-[175px]">Jenis Permintaan</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Pendaftaran Ujian {{
                                    String(registrar.data.questionbank.category).toUpperCase() }}</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Tanggal tes</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Selasa, 2 Mei 2023 10:00 WIB</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Status</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">
                                    <span v-if="registrar.data.status == 0">Menunggu Pembayaran</span>
                                    <span v-if="registrar.data.status == 1">Sudah Lunas</span>
                                    <span v-if="registrar.data.status == 2" class="text-merah-warning">Kadaluwarsa</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-8">
                        <h2 class="font-semibold text-xl">Rincian Pembayaran</h2>
                        <table class="h-full mt-4">
                            <tr>
                                <td class="w-[175px]">ID Pembayaran</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">{{ registrar.data.payment.payment_id }}</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Metode Pembayaran</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">{{ String(registrar.data.payment.payment_type).toUpperCase() }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">No. Rekening</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">000-000-000</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Atas Nama</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">PT. Gatau Apalah Sejahtera, Cabang Ini Itu</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Total Biaya</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Rp {{ new
                                    Intl.NumberFormat("id").format(registrar.data.payment.biaya) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-8" v-if="registrar.data.status == 1">
                        <img class="w-[300px]" :src="registrar.data.bukti_pembayaran.file" alt="">
                    </div>
                    <div class="mt-8 flex gap-x-4">
                        <Link :href="route('admin.pembayaran.index')">
                        <SecondaryButton class="px-4">Kembali</SecondaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
<style scoped>
td {
    vertical-align: top;
}</style>
