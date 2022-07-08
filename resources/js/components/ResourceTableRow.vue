<script setup>
import { ref } from 'vue'

const props = defineProps({
    index: Number,
    fields: Object,
    resource: Object
})

const confirmingDelete = ref(false)

const confirmDelete = () => {
    confirmingDelete.value = true
}

const deleteResource = () => {


    closeModal()
}

const closeModal = () => {
    confirmingDelete.value = false
}

</script>

<template>
    <tr class="border">
        <td class="p-3 w-16 text-left">{{ resource.id }}</td>
        <td class="p-3 text-left whitespace-nowrap" v-for="(field, key) in fields">
            <template v-if="field.type === 'text'">
                <span v-if="resource[key]">{{ resource[key] }}</span>
                <span v-else>-</span>
            </template>
            <template v-else-if="field.type === 'status'">
                <StatusField :status="resource[key]" />
            </template>
            <template v-else>?</template>
        </td>
        <td class="p-3 td-fit text-right whitespace-nowrap">
            <LinkButton class="toolbar-button group px-2">
                <Icon type="eye" class="group-hover:text-primary-500" />
            </LinkButton>
            <LinkButton class="toolbar-button group px-2">
                <Icon type="pencil-alt" class="group-hover:text-primary-500" />
            </LinkButton>
            <BasicButton @click="confirmDelete" class="toolbar-button px-2 text-gray-400 hover:text-primary-500">
                <Icon type="trash" />
            </BasicButton>
        </td>
    </tr>

    <JetDialogModal :show="confirmingDelete" @close="closeModal">
        <template #title>
            Delete Resource
        </template>
        <template #content>
            Are you sure want to delete this resource?
        </template>
        <template #footer>
            <OutlineButton @click="closeModal">
                Cancel
            </OutlineButton>
            <DangerButton @click="deleteResource" class="ml-2">
                Delete
            </DangerButton>
        </template>
    </JetDialogModal>
</template>
