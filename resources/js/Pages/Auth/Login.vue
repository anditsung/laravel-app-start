<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { computed } from "vue";
import ApplicationLogo from "../../components/ApplicationLogo";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const loginButtonText = computed(() => {
    if (form.processing) {
        return "Logging in..."
    }
    return "Log in"
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="__('Log in')" />

    <JetAuthenticationCard>
        <template #logo>
            <ApplicationLogo :bigLogo="true" />
        </template>

        <JetValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ __(status) }}
        </div>

        <form @submit.prevent="submit">
            <div>
               <JetLabel for="email" :value="__('Email')" />
                <TextField
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
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
                    autocomplete="current-password"
                />
            </div>

            <div class="flex items-center justify-between block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
                <TextLink :href="route('password.request')" class="underline">
                    {{ __('Forgot your password?') }}
                </TextLink>
            </div>

            <DefaultButton class="w-full mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ __(loginButtonText) }}
            </DefaultButton>
        </form>
    </JetAuthenticationCard>
</template>
