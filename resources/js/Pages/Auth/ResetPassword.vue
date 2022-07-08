<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import TextField from "../../components/TextField";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <JetAuthenticationCard>
        <template #logo>
            <ApplicationLogo :bigLogo="true" />
        </template>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="email" :value="__('Email')" />
                <TextField
                    id="email"
                    v-model="props.email"
                    type="email"
                    class="mt-1 block w-full cursor-not-allowed"
                    required
                    disabled
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password" :value="__('Password')" />
                <TextField
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password_confirmation" :value="__('Confirm Password')" />
                <TextField
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <DefaultButton class="w-full mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ __('Reset Password') }}
            </DefaultButton>
        </form>
    </JetAuthenticationCard>
</template>
