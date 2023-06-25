<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SuccessLogo from '@/Components/SuccessLogo.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue'

const status = ref('paid')

</script>

<template>
    <Head title="Riwayat Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Ujian</h2>
        </template>

        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-lg overflow-hidden pb-12">
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
                        <h3 class="font-semibold text-3xl">Pembayaran belum dilakukan</h3>
                        <p class="font-medium text-xl">Silahkan membayar terlebih dahulu untuk melanjutkan pendaftaran
                            sebelum tanggal <span class="font-bold" :class="{ 'text-merah-warning': status == 'unpaid' }">28
                                April 2023, 11:59 WIB</span></p>
                    </div>
                </div>

                <h2 class="font-semibold text-4xl"></h2>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
