<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        class="dark:bg-gray-900 rounded border-gray-300 dark:border-gray-700 text-primary-600 shadow-sm focus:border-primary-300 dark:focus:border-primary-700 focus:ring focus:ring-primary-200 dark:focus:ring-primary-700 focus:ring-opacity-50"
    >
</template>
