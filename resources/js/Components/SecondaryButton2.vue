<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center py-2 border border-black rounded-md font-semibold text-white focus:outline-none focus:ring-2 focus:ring-abu-component focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
