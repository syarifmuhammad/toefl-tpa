<script setup>

import { defineProps } from 'vue'
import moment from 'moment/min/moment-with-locales'
moment.locale('id')
const props = defineProps({
    registrar: Object,
})

</script>

<template>
    <div class="w-[440px] aspect-video flex justify-between border border-[#808080]">
        <div class="w-[15%] bg-merah-warning flex py-4">
            <div class="w-full px-4 relative flex flex-col items-center">
                <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.48149 32L32 32L22.5185 22.5185L3.05176e-05 22.5185L9.48149 32ZM22.5185 22.5185L22.5185 0L32 9.48146V31.9999L22.5185 22.5185Z"
                        fill="white" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M22.5185 0H4.3869e-05L9.4815 9.48146H32L22.5185 0ZM9.48146 9.48156V32L0 22.5186V0.000100493L9.48146 9.48156Z"
                        fill="#CCCCCC" />
                </svg>
                <h1 class="text-white font-semibold text-3xl absolute -rotate-90 top-28 tracking-widest">PESERTA</h1>
            </div>
        </div>
        <div class="w-[85%] p-4 flex flex-col justify-between">
            <h2 class="text-center font-semibold">Kartu Ujian Toefl</h2>
            <div class="flex gap-x-4 h-[100px]">
                <div class="h-full aspect-[3/4] border border-[#808080]">
                    <img class="w-full h-full object-cover" :src="$page.props.auth.user.profile_picture" alt="">
                </div>
                <div class="h-full py-2">
                    <table class="h-full text-xs">
                        <tr>
                            <td class="w-[100px]">Nomor Peserta</td>
                            <td class="font-semibold">:</td>
                            <td class="font-semibold">{{ String(registrar.id).padStart(3, '0') }}</td>
                        </tr>
                        <tr>
                            <td class="w-[100px]">Nama</td>
                            <td class="font-semibold">:</td>
                            <td class="font-semibold">{{ $page.props.auth.user.name }}</td>
                        </tr>
                        <tr>
                            <td class="w-[100px]">NIM / NIK</td>
                            <td class="font-semibold">:</td>
                            <td class="font-semibold">{{ $page.props.auth.user.nim_or_nik }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="w-full flex justify-center">
                <table class="h-full text-xs font-semibold">
                    <tr>
                        <td class="w-[100px]">Tanggal Ujian</td>
                        <td>:</td>
                        <td>{{ moment(registrar.schedule.tanggal).format('DD MMMM YYYY HH:mm') }} WIB</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>
td {
    vertical-align: top;
}
</style>