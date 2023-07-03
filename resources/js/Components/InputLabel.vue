<script setup>
defineProps({
    value: {
        type: String,
    },
    required: {
        type: Boolean,
    }
});
</script>

<template>
    <label v-if="value" class="block">
        <span class="font-semibold">
            {{ value }}<span v-if="required" class="text-merah-warning">*</span>
        </span>
        <span class="block text-sm text-abu-label"><slot /></span>
    </label>
    <label v-else class="block font-semibold">
        <span><slot /></span><span v-if="required" class="text-merah-warning">*</span>
    </label>
</template>
