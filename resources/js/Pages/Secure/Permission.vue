<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    resources: Object,
    fields: Object,
})

</script>

<template>
    <AppLayout :title="__('Permission')">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permission') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-5 bg-white border-b border-gray-200">

                        <ResourceTable :fields="fields" :resources="resources" />

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
