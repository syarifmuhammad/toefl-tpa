<script setup>

import { defineProps } from 'vue'

defineProps({
    mode: String
})
</script>

<template>
    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M9.48149 32L32 32L22.5185 22.5185L3.05176e-05 22.5185L9.48149 32ZM22.5185 22.5185L22.5185 0L32 9.48146V31.9999L22.5185 22.5185Z"
            :fill="mode == 'light' ? '#000' : 'white'" />
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M22.5185 0H4.3869e-05L9.4815 9.48146H32L22.5185 0ZM9.48146 9.48156V32L0 22.5186V0.000100493L9.48146 9.48156Z"
            fill="#CCCCCC" />
    </svg>
</template>
