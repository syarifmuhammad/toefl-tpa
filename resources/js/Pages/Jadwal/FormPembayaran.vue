<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import Bca from '@/Components/IconPayment/Bca.vue';
import Bri from '@/Components/IconPayment/Bri.vue';
import Bni from '@/Components/IconPayment/Bni.vue';
import Ovo from '@/Components/IconPayment/Ovo.vue';
import ShopeePay from '@/Components/IconPayment/ShopeePay.vue';
import LinkAja from '@/Components/IconPayment/LinkAja.vue';
import Cod from '@/Components/IconPayment/Cod.vue';
// import SuccessLogo from '@/Components/SuccessLogo.vue';
import KartuUjian from '@/Components/KartuUjian.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue'

const props = defineProps({
    schedule: Object,
})

const modal = ref(false)
const message_errors = ref('')

const form = useForm({
    payment_type: ''
})

const save = () => {
    form.post(route('jadwal.daftar', props.schedule.id), {
        onSuccess: (data) => {
            console.log(data)
        },
        onError: (errors) => {
            modal.value = true
            message_errors.value = errors.payment_type
            let timeout = window.setTimeout(() => {
                if (modal.value == true) {
                    modal.value = false
                } else {
                    clearTimeout(timeout)
                }
            }, 2000)
        }
    })
}

</script>

<template>
    <Head title="Detail Ujian" />

    <AuthenticatedLayout>
        <template #breadcrumb>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Ujian</h2>
        </template>

        <Modal :show="modal" @close="modal = false">
            <div class="p-8 flex flex-col justify-between items-center relative">
                <svg class="absolute right-8 cursor-pointer" @click="modal = false" width="43" height="43"
                    viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <p class="text-abu-text">{{ message_errors }}</p>
                </div>
                <!-- <PrimaryButton class="px-4 w-full flex justify-center mt-3" @click="remove">Continue</PrimaryButton> -->
            </div>
        </Modal>

        <form @submit.prevent="save" class="mt-10 px-4 sm:px-6 lg:px-8 w-full flex gap-x-6 items-start">
            <div class="bg-white rounded-lg overflow-hidden w-1/2 px-6 py-8">
                <div>
                    <h1 class="font-semibold text-lg">Transfer Bank</h1>
                    <div class="flex flex-col mt-2 divide-y-2">
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'bca'">
                                <Bca class="w-24"></Bca>
                                <p>Bank BCA</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="bca">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'bri'">
                                <Bri class="w-24"></Bri>
                                <p>Bank BRI</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="bri">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'bni'">
                                <Bni class="w-24"></Bni>
                                <p>Bank BNI</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="bni">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h1 class="font-semibold text-lg">E-Wallet</h1>
                    <div class="flex flex-col mt-2 divide-y-2">
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'ovo'">
                                <div class="w-24">
                                    <Ovo class="w-16"></Ovo>
                                </div>
                                <p>OVO</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="ovo">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'shopee pay'">
                                <div class="w-24">
                                    <ShopeePay class="w-20"></ShopeePay>
                                </div>
                                <p>Shopee Pay</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="shopee pay">
                        </div>
                        <div class="py-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'link aja'">
                                <div class="w-24">
                                    <LinkAja class="w-10"></LinkAja>
                                </div>
                                <p>Link Aja</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="link aja">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h1 class="font-semibold text-lg">Lainnya</h1>
                    <div class="flex flex-col mt-2 divide-y-2">
                        <div class="pt-3 flex justify-between font-medium">
                            <div class="flex items-center gap-x-8 cursor-pointer" @click="form.payment_type = 'cod'">
                                <div class="w-24">
                                    <Cod class="w-12"></Cod>
                                </div>
                                <p>Cash On Delivery</p>
                            </div>
                            <input type="radio" class="rounded-full" v-model="form.payment_type" name="payment_type"
                                value="cod">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden w-1/2 px-6 py-8">
                <table>
                    <tr>
                        <td class="w-[200px]">Metode Pembayaran</td>
                        <td class="font-semibold">: {{ form.payment_type.trim() != '' ? form.payment_type.toUpperCase() :
                            '-' }}</td>
                    </tr>
                    <tr>
                        <td class="w-[200px] pt-2">Total Belanja</td>
                        <td class="font-semibold">: Rp {{ new Intl.NumberFormat("id").format(schedule.biaya) }} </td>
                    </tr>
                    <!-- <tr>
                        <td class="w-[calc(100%_-_18%)] pt-2">Biaya Layanan</td>
                        <td class="font-semibold">: Rp. 6.500</td>
                    </tr> -->
                </table>
                <div class="mt-8">
                    <span class="font-semibold">Total Tagihan</span>
                    <div class="mt-2 flex justify-between items-center">
                        <p class="font-bold text-lg">Rp {{ new Intl.NumberFormat("id").format(schedule.biaya) }}</p>
                        <div class="flex gap-x-4">
                            <!-- <Link :href="route('jadwal.payment', { id: schedule.id })"> -->
                            <PrimaryButton class="px-4">Bayar</PrimaryButton>
                            <!-- </Link> -->
                            <Link :href="route('dashboard')">
                            <SecondaryButton type="button" class="px-4">Batal</SecondaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
