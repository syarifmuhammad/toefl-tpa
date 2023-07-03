<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Bca from '@/Components/IconPayment/Bca.vue';
import Bri from '@/Components/IconPayment/Bri.vue';
import Bni from '@/Components/IconPayment/Bni.vue';
import Ovo from '@/Components/IconPayment/Ovo.vue';
import ShopeePay from '@/Components/IconPayment/ShopeePay.vue';
import LinkAja from '@/Components/IconPayment/LinkAja.vue';
import Cod from '@/Components/IconPayment/Cod.vue';
// import SuccessLogo from '@/Components/SuccessLogo.vue';
import KartuUjian from '@/Components/KartuUjian.vue';
import { Head, Link } from '@inertiajs/vue3';
// import { ref } from 'vue'

</script>

<template>
    <Head title="Detail Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Ujian</h2>
        </template>

        <section class="mt-10 px-4 sm:px-6 lg:px-8 w-full flex gap-x-6 items-start">
            <form class="bg-white rounded-lg overflow-hidden w-1/2 px-6 py-8">
                <div>
                    <h1 class="font-semibold text-lg">Transfer Bank</h1>
                    <div class="flex flex-col mt-2 divide-y-2">
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <Bca class="w-24"></Bca>
                                <p>Bank BCA</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="bca">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <Bri class="w-24"></Bri>
                                <p>Bank BRI</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="bri">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <Bni class="w-24"></Bni>
                                <p>Bank BNI</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="bni">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h1 class="font-semibold text-lg">E-Wallet</h1>
                    <div class="flex flex-col mt-2 divide-y-2">
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <div class="w-24">
                                    <Ovo class="w-16"></Ovo>
                                </div>
                                <p>OVO</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="ovo">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <div class="w-24">
                                    <ShopeePay class="w-20"></ShopeePay>
                                </div>
                                <p>Shopee Pay</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="shopeepay">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <div class="w-24">
                                    <LinkAja class="w-10"></LinkAja>
                                </div>
                                <p>Link Aja</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="linkaja">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h1 class="font-semibold text-lg">Lainnya</h1>
                    <div class="flex flex-col mt-2 divide-y-2">
                        <div class="pt-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8">
                                <div class="w-24">
                                    <Cod class="w-12"></Cod>
                                </div>
                                <p>Cash On Delivery</p>
                            </div>
                            <input type="radio" class="rounded-full" name="payment_type" value="cod">
                        </div>
                    </div>
                </div>
            </form>
            <div class="bg-white rounded-lg overflow-hidden w-1/2 px-6 py-8">
                <table>
                    <tr>
                        <td class="w-[calc(100%_-_18%)]">Rekening Tujuan</td>
                        <td class="font-semibold">: Bank BRI</td>
                    </tr>
                    <tr>
                        <td class="w-[calc(100%_-_18%)] pt-2">Total Belanja</td>
                        <td class="font-semibold">: Rp. 200.000</td>
                    </tr>
                    <tr>
                        <td class="w-[calc(100%_-_18%)] pt-2">Biaya Layanan</td>
                        <td class="font-semibold">: Rp. 6.500</td>
                    </tr>
                </table>
                <div class="mt-8">
                    <span class="font-semibold">Total Tagihan</span>
                    <div class="mt-2 flex justify-between items-center">
                        <p class="font-bold text-lg">Rp. 206.500</p>
                        <div class="flex gap-x-4">
                            <Link :href="route('exam.payment', { id: $page.props.id })">
                            <PrimaryButton class="px-4">Bayar</PrimaryButton>
                            </Link>
                            <Link :href="route('index')">
                            <SecondaryButton class="px-4">Batal</SecondaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
