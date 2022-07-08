<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-400 text-sm font-medium leading-5 focus:outline-none transition text-primary-500 hover:text-primary-400 focus:ring focus:ring-primary-200 dark:focus:ring-primary-700'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 transition focus:outline-none text-gray-700 dark:text-gray-400 hover:text-primary-500 dark:hover:text-primary-500 hover:border-primary-500 focus:ring focus:ring-primary-200 dark:focus:ring-primary-700';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
