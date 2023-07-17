<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
// import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3'

const modal = ref(false)
const title = ref('Konfirmasi Pembayaran')

</script>

<template>
    <Head title="Detail Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Detail Ujian</h2>
        </template>
        <Modal :show="modal" @close="modal = false">
            <form class="p-5" action="">
                <div>
                    <InputLabel class="font-semibold">{{ title }}</InputLabel>
                    <div class="h-28 rounded-lg border border-abu-text mt-2 text-sm flex justify-center items-center">
                       Upload files here ...
                    </div>
                    <input type="file" class="hidden" name="" id="">
                </div>
                <div class="flex justify-between gap-x-4 mt-4">
                    <PrimaryButton class="w-full flex justify-center">Upload</PrimaryButton>
                    <SecondaryButton class="w-full flex justify-center" @click="modal = false">Batal</SecondaryButton>
                </div>
            </form>
        </Modal>
        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg overflow-hidden">
                <div
                    class="px-8 py-3 w-full flex items-center justify-between border rounded-ss-lg rounded-se-lg border-abu-text">
                    <div class="font-semibold text-md">
                        <h3>15 Juni 2023</h3>
                        <h3>ID: 1234</h3>
                    </div>
                    <div class="flex gap-x-3">
                        <select class="border-abu-text rounded-md shadow-sm focus:border-2 focus:ring-0 w-full">
                            <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <PrimaryButton class="px-4" @click="modal = true">Simpan</PrimaryButton>
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <div>
                        <h2 class="font-semibold text-xl">Rincian Permintaan</h2>
                        <table class="h-full mt-4">
                            <tr>
                                <td class="w-[175px]">Jenis Permintaan</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Legalisir</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Tanggal tes</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">2 Mei 2023</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Status</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Menunggu Pembayaran</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-8">
                        <h2 class="font-semibold text-xl">Rincian Pembayaran</h2>
                        <table class="h-full mt-4">
                            <tr>
                                <td class="w-[175px]">ID Pembayaran</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">1234</td>
                            </tr>
                            <tr>
                                <td class="w-[175px]">Rekening Tujuan</td>
                                <td class="font-semibold">:</td>
                                <td class="font-semibold">Bank BNI, Alamat Sekian, No. Sekian, Kabupaten Sekian</td>
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
                                <td class="font-semibold">Rp. 42.069,99-</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-8 flex gap-x-4">
                        <Link :href="route('admin.legalisir.index')">
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
}
</style>
