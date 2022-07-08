<script setup>
const props = defineProps({
    status: String,
})
</script>

<template>
    <Icon v-if="status" class="text-green-500" solid type="check-circle" />
    <Icon v-else class="text-red-500" solid type="x-circle" />
</template>
