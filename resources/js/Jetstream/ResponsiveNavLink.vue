<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block pl-3 pr-4 py-2 border-l-4 border-primary-400 text-base font-medium focus:outline-none transition text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 bg-primary-50 dark:bg-primary-900 focus:ring focus:ring-primary-300 dark:focus:ring-primary-700'
        : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium focus:outline-none transition text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900 focus:ring focus:ring-primary-300 dark:focus:ring-primary-700';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
