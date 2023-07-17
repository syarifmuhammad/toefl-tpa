<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SuccessLogo from '@/Components/SuccessLogo.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue'

const status = ref('canceled')

</script>

<template>
    <Head title="Riwayat Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Ujian</h2>
        </template>

        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg overflow-hidden">
                <div class="px-8 py-3 w-full flex items-center" :class="{
                    'bg-kuning-warning': status == 'unpaid',
                    'bg-merah-warning': status == 'canceled',
                    'bg-hijau-warning': status == 'paid',
                }">
                    <svg v-if="status != 'paid'" width="32" height="29" viewBox="0 0 32 29"
                        :fill="status == 'canceled' ? 'white' : 'black'" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.35964 29H28.6404C31.2255 29 32.837 26.1524 31.5445 23.8846L18.9041 1.70087C17.6115 -0.566956 14.3885 -0.566956 13.0959 1.70087L0.455542 23.8846C-0.837032 26.1524 0.774488 29 3.35964 29ZM16 17.0641C15.0767 17.0641 14.3213 16.2968 14.3213 15.359V11.9487C14.3213 11.0109 15.0767 10.2436 16 10.2436C16.9233 10.2436 17.6787 11.0109 17.6787 11.9487V15.359C17.6787 16.2968 16.9233 17.0641 16 17.0641ZM17.6787 23.8846H14.3213V20.4743H17.6787V23.8846Z" />
                    </svg>
                    <SuccessLogo v-else />
                    <div class="ml-4" :class="status == 'canceled' ? 'text-white' : ''">
                        <h3 class="font-semibold text-2xl">Pembayaran belum dilakukan</h3>
                        <p class="font-medium">Silahkan membayar terlebih dahulu untuk melanjutkan pendaftaran
                            sebelum tanggal <span class="font-bold" :class="{ 'text-merah-warning': status == 'unpaid' }">28
                                April 2023, 11:59 WIB</span></p>
                    </div>
                </div>

                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <div>
                        <h2 class="font-semibold text-xl">Rincian Pendaftaran</h2>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Jenis tes</p>
                            <p class="font-semibold">: TOEFL</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Tanggal tes</p>
                            <p class="font-semibold">: 2 Mei 2023</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Status</p>
                            <p class="font-semibold">: Menunggu Pembayaran</p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h2 class="font-semibold text-xl">Rincian Pembayaran</h2>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Id Pembayaran</p>
                            <p class="font-semibold">: 1234</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Rekening Tujuan</p>
                            <p class="font-semibold">: Bank BNI, Alamat Sekian, No. Sekian, Kabupaten Sekian</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">No. Rekening</p>
                            <p class="font-semibold">: 000-000-000</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Atas Nama</p>
                            <p class="font-semibold">: PT. Gatau Apalah Sejahtera, Cabang Ini Itu</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Total Biaya</p>
                            <p class="font-semibold">: Rp. 42.069,99-</p>
                        </div>
                        <div class="flex mt-4">
                            <p class="w-[175px]">Waktu Batas Pembayaran</p>
                            <p class="font-semibold">: <span class="text-merah-warning">Jum’at, 28 April 2023, 11:59
                                    WIB</span></p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h2 class="font-semibold text-xl">Perhatian</h2>
                        <ul class="list-disc px-4 sm:px-6 lg:px-8 mt-4">
                            <li>
                                Harap membayar sesuai dengan total biaya yang sudah ditentukan sampain digit terakhir.
                            </li>
                            <li>
                                Harap melakukan pembayaran sebelum batas waktu pembayaran.
                            </li>
                            <li>
                                Jika tidak ada transaksi sebelum batas waktu pembayaran yang telah ditentukan, <span
                                    class="font-extrabold">peserta akan secara otomatis membatalkan proses pendaftaran
                                    tes.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full mb-12 flex items-center">
            <button class="px-4 py-2 bg-hijau-warning text-white font-semibold flex items-center rounded-lg">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.2111 3.75685C21.0132 2.5613 19.5865 1.61338 18.014 0.968382C16.4415 0.323384 14.7548 -0.00578377 13.0523 7.69036e-05C5.91859 7.69036e-05 0.104523 5.74496 0.104523 12.7937C0.104523 15.053 0.705528 17.2477 1.82915 19.1841L0 25.8198L6.8593 24.0382C8.75377 25.0581 10.8834 25.6003 13.0523 25.6003C20.1859 25.6003 26 19.8554 26 12.8067C26 9.38555 24.6543 6.17099 22.2111 3.75685ZM13.0523 23.4315C11.1186 23.4315 9.22412 22.9151 7.56482 21.9468L7.17286 21.7145L3.09648 22.7731L4.1809 18.8485L3.9196 18.4483C2.8453 16.7532 2.27486 14.7938 2.27337 12.7937C2.27337 6.93267 7.10754 2.15602 13.0392 2.15602C15.9136 2.15602 18.6181 3.26627 20.6432 5.28021C21.646 6.26648 22.4406 7.43959 22.9811 8.73157C23.5216 10.0235 23.7972 11.4087 23.792 12.8067C23.8181 18.6677 18.9839 23.4315 13.0523 23.4315ZM18.9578 15.479C18.6312 15.3241 17.0372 14.5495 16.7497 14.4333C16.4492 14.33 16.2402 14.2784 16.0181 14.5882C15.796 14.911 15.1819 15.6339 14.999 15.8405C14.8161 16.0599 14.6201 16.0858 14.2935 15.9179C13.9668 15.763 12.9216 15.4145 11.6935 14.33C10.7266 13.478 10.0864 12.4323 9.89045 12.1095C9.70754 11.7868 9.86432 11.619 10.0342 11.4511C10.1779 11.3091 10.3608 11.0767 10.5176 10.896C10.6744 10.7153 10.7397 10.5733 10.8442 10.3667C10.9487 10.1472 10.8965 9.96649 10.8181 9.81157C10.7397 9.65665 10.0864 8.08165 9.82512 7.43616C9.56382 6.81648 9.28945 6.89394 9.09347 6.88103H8.46633C8.24422 6.88103 7.90452 6.95849 7.60402 7.28124C7.31658 7.60399 6.4804 8.37858 6.4804 9.95358C6.4804 11.5286 7.64322 13.0519 7.8 13.2585C7.95678 13.478 10.0864 16.7054 13.3266 18.0868C14.0975 18.4225 14.6985 18.6161 15.1688 18.7581C15.9397 19.0034 16.6452 18.9647 17.207 18.8872C17.8342 18.7968 19.1276 18.1126 19.3889 17.3638C19.6633 16.6151 19.6633 15.9825 19.5719 15.8405C19.4804 15.6985 19.2844 15.6339 18.9578 15.479Z"
                        fill="#F8F8F8" />
                </svg>
                <span class="ml-4">Konfirmasi Pembayaran</span>
            </button>
            <Link class="ml-4" :href="route('exam.history')"><SecondaryButton class="px-4">Kembali</SecondaryButton></Link>
        </section>
    </AuthenticatedLayout>
</template>
