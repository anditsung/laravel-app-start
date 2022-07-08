<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const user = computed(() => usePage().props.value.user)

</script>

<template>
    <AppLayout :title="__('Dashboard')">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-500 dark:text-gray-400 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700">
                        <div class="text-2xl">{{ __('Welcome back') }} {{ user.name }}!</div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
