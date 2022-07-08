<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import ButtonInertiaLink from "../../Nova/Buttons/ButtonInertiaLink";

const appName = Nova.config('appName')

const isOpenRegistration = computed(() => Nova.config('openRegistration'))

const user = usePage().props.value.user

</script>

<template>
    <Head :title="__('Home')" />

    <div class="min-h-screen flex flex-col">
        <div class="flex justify-end space-x-4 px-8 py-4">
            <template v-if="user">
                <TextLink :href="route('dashboard')">{{ __('Dashboard') }}</TextLink>
            </template>
            <template v-else>
                <TextLink :href="route('login')">{{ __('Log in') }}</TextLink>
                <TextLink v-if="isOpenRegistration" :href="route('register')">{{ __('Register') }}</TextLink>
            </template>
        </div>
        <div class="flex flex-col flex-grow items-center justify-center">
            <div class="text-7xl">{{ __('Welcome to') }}</div>
            <div class="text-7xl font-extrabold text-primary-500">
                Latexindo Tobaperkasa
            </div>
        </div>
    </div>
</template>
