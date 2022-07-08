<script setup>
import { computed, resolveDynamicComponent } from "vue";

const props = defineProps({
    bigLogo: {
        type: Boolean,
        default: false,
    }
})

const isComponent = name => typeof resolveDynamicComponent(name) !== 'string'

const logo = computed(() => {
    let appName = Nova.config('appName').replace(/\s+/g, '') + "Logo"

    if (! isComponent(appName)) {
        appName = "HomeLogo"
    }

    return appName
})

const logoClass = computed(() => {
    if (props.bigLogo) {
        return "block h-36 w-auto"
    }
    return "block h-9 w-auto"
})

</script>

<template>
    <Link :href="route('home')" class="block hover:opacity-75 rounded focus:outline-none focus:ring focus:ring-primary-300 dark:focus:ring-primary-700">
        <component :is="logo" :class="logoClass" />
    </Link>
</template>
