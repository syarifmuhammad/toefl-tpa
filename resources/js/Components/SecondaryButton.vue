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
        class="inline-flex items-center py-2 bg-abu-component border border-transparent rounded-md font-semibold text-white focus:outline-none focus:ring-2 focus:ring-abu-component focus:ring-offset-2 transition ease-in-out duration-150 disabled:bg-abu-component/40">
        <slot />
    </button>
</template>
