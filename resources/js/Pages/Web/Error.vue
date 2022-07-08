<script setup>
import { computed } from "vue";

const props = defineProps({
    status: {
        type: Number,
    }
})

const defaultStatus = computed(() => {
    if (! props.status) {
        return 404
    }
    return props.status
})

const title = {
    503: '503: Service Unavailable',
    500: '500: Server Error',
    404: '404: Page Not Found',
    403: '403: Forbidden',
}[defaultStatus.value]

const description = {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
}[defaultStatus.value]
</script>

<template>
    <Head :title="__(title)" />

    <div class="flex flex-col h-screen justify-center items-center">
        <div class="flex flex-col items-center bg-white shadow rounded-md p-8">
            <span class="text-5xl font-mono font-bold">{{ __(title) }}</span>
            <span class="text-xl font-semibold">{{ __(description) }}</span>
            <ButtonInertiaLink :href="route('home')" class="mt-4 capitalize">{{ __('back to home') }}</ButtonInertiaLink>
        </div>
    </div>
</template>

<!--<script>-->
<!--import { defineComponent } from "vue";-->
<!--import EmptyLayout from "@/layouts/Empty"-->
<!--import { Inertia } from "@inertiajs/inertia";-->

<!--export default defineComponent({-->

<!--    layout: EmptyLayout,-->

<!--    props: {-->
<!--        status: {-->
<!--            type: Number,-->
<!--            default: 404-->
<!--        }-->
<!--    },-->

<!--    computed: {-->
<!--        title() {-->
<!--            return {-->
<!--                503: '503: Service Unavailable',-->
<!--                500: '500: Server Error',-->
<!--                404: '404: Page Not Found',-->
<!--                403: '403: Forbidden',-->
<!--            }[this.status]-->
<!--        },-->
<!--        description() {-->
<!--            return {-->
<!--                503: 'Sorry, we are doing some maintenance. Please check back soon.',-->
<!--                500: 'Whoops, something went wrong on our servers.',-->
<!--                404: 'Sorry, the page you are looking for could not be found.',-->
<!--                403: 'Sorry, you are forbidden from accessing this page.',-->
<!--            }[this.status]-->
<!--        },-->
<!--    },-->
<!--})-->
<!--</script>-->
