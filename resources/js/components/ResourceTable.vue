<script setup>
import ResourceTableRow from "./ResourceTableRow";

const props = defineProps({
    fields: Object,
    resources: Object,
})

</script>

<template>
    <div class="overflow-auto">
        <table class="table w-full">
            <thead class="bg-primary-500 text-white">
            <tr>
                <th class="p-3 w-16 text-left">ID</th>
                <th v-for="(field, key) in fields" class="p-3 text-left capitalize truncate">{{ field.label }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <ResourceTableRow v-for="(resource, index) in resources" :index="index+1" :fields="fields" :resource="resource" />
            </tbody>
        </table>
    </div>
</template>
