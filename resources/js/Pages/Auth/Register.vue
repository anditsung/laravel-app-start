<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { computed } from "vue";

const props = defineProps({
    message: String,
    canRegister: Boolean,
    token: String,
    email: String,
})

const form = useForm({
    token: props.token,
    name: '',
    email: props.email,
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="__('Register')" />

    <JetAuthenticationCard>
        <template #logo>
            <ApplicationLogo :bigLogo="true" />
        </template>

        <div v-if="canRegister">
            <JetValidationErrors class="mb-4" />

            <form @submit.prevent="submit">
                <div v-if="props.token" class="mb-4">
                    <JetLabel for="token" :value="__('Token')" />
                    <TextField
                        id="name"
                        v-model="form.token"
                        type="text"
                        class="mt-1 form-control form-input form-input-bordered block w-full"
                        :disabled="props.token"
                        :class="{ 'cursor-not-allowed' : props.token }"
                        required
                    />
                </div>

                <div>
                    <JetLabel for="name" :value="__('Name')" />
                    <TextField
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 form-control form-input form-input-bordered block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                </div>

                <div class="mt-4">
                    <JetLabel for="email" :value="__('Email')" />
                    <TextField
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        :disabled="props.email"
                        :class="{ 'cursor-not-allowed' : props.email }"
                        required
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

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <JetLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                    </JetLabel>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <TextLink :href="route('login')" class="underline text-sm">
                        {{ __('Already registered?') }}
                    </TextLink>
                </div>

                <DefaultButton class="w-full mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ __('Register') }}
                </DefaultButton>
            </form>
        </div>
        <div v-else class="flex flex-col items-center">
            <span class="text-3xl capitalize">{{ message }}</span>
            <ButtonInertiaLink :href="route('home')" class="mt-4 capitalize">{{ __('back to home') }}</ButtonInertiaLink>
        </div>
    </JetAuthenticationCard>
</template>
