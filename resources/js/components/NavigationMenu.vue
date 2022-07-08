<script setup>
import { computed } from "vue";

const props = defineProps({
    responsive: {
        type: Boolean,
        required: true,
    }
})

const menus = computed(() => Nova.config('navigationMenus'))

</script>
<template>
    <template v-if="! responsive">
        <JetNavLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            {{ __('Dashboard') }}
        </JetNavLink>
        <JetNavLink
            v-for="menu in menus"
            :href="route(menu)"
            :active="route().current(menu)"
        >
            {{ __(menu) }}
        </JetNavLink>
    </template>
    <template v-else>
        <JetResponsiveNavLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            {{ __('Dashboard') }}
        </JetResponsiveNavLink>
        <JetResponsiveNavLink
            v-for="menu in menus"
            :href="route(menu)"
            :active="route().current(menu)"
        >
            {{ __(menu) }}
        </JetResponsiveNavLink>
    </template>
</template>
