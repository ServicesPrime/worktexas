<script setup>
const props = defineProps({
    color: { type: String, default: 'blue' },
    type: { type: String, default: 'button' },
});

const colors = {
    blue: 'bg-blue-600 hover:bg-blue-700 text-white',
    green: 'bg-green-600 hover:bg-green-700 text-white',
    red: 'bg-red-600 hover:bg-red-700 text-white',
};
</script>

<template>
    <button :type="type" :class="`px-4 py-2 rounded ${colors[color]}`">
        <slot />
    </button>
</template>
