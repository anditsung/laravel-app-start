<script setup>
import { ref, computed, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

const props = defineProps({
    requiresConfirmation: Boolean,
});

const enabling = ref(false);
const confirming = ref(false);
const disabling = ref(false);
const qrCode = ref(null);
const setupKey = ref(null);
const recoveryCodes = ref([]);

const confirmationForm = useForm({
    code: '',
});

const twoFactorEnabled = computed(
    () => ! enabling.value && usePage().props.value.user?.two_factor_enabled,
);

watch(twoFactorEnabled, () => {
    if (! twoFactorEnabled.value) {
        confirmationForm.reset();
        confirmationForm.clearErrors();
    }
});

const enableTwoFactorAuthentication = () => {
    enabling.value = true;

    Inertia.post('/user/two-factor-authentication', {}, {
        preserveScroll: true,
        onSuccess: () => Promise.all([
            showQrCode(),
            showSetupKey(),
            showRecoveryCodes(),
        ]),
        onFinish: () => {
            enabling.value = false;
            confirming.value = props.requiresConfirmation;
        },
    });
};

const showQrCode = () => {
    return Nova.request().get('/user/two-factor-qr-code').then(response => {
        qrCode.value = response.data.svg;
    });
};

const showSetupKey = () => {
    return Nova.request().get('/user/two-factor-secret-key').then(response => {
        setupKey.value = response.data.secretKey;
    });
}

const showRecoveryCodes = () => {
    return Nova.request().get('/user/two-factor-recovery-codes').then(response => {
        recoveryCodes.value = response.data;
    });
};

const confirmTwoFactorAuthentication = () => {
    confirmationForm.post('/user/confirmed-two-factor-authentication', {
        errorBag: "confirmTwoFactorAuthentication",
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            confirming.value = false;
            qrCode.value = null;
            setupKey.value = null;
        },
    });
};

const regenerateRecoveryCodes = () => {
    Nova.request()
        .post('/user/two-factor-recovery-codes')
        .then(() => showRecoveryCodes());
};

const disableTwoFactorAuthentication = () => {
    disabling.value = true;

    Inertia.delete('/user/two-factor-authentication', {
        preserveScroll: true,
        onSuccess: () => {
            disabling.value = false;
            confirming.value = false;
        },
    });
};
</script>

<template>
    <JetActionSection>
        <template #title>
            <span class="dark:text-gray-400">{{ __('two.factor.authentication.title') }}</span>
        </template>

        <template #description>
            <span class="dark:text-gray-500">{{ __('two.factor.authentication.description') }}</span>
        </template>

        <template #content>
            <h3 v-if="twoFactorEnabled && ! confirming" class="text-lg font-medium text-gray-900 dark:text-gray-400">
                {{ __('two.factor.authentication.content.enabled') }}
            </h3>

            <h3 v-else-if="twoFactorEnabled && confirming" class="text-lg font-medium text-gray-900 dark:text-gray-400">
                {{ __('two.factor.authentication.content.enabling') }}
            </h3>

            <h3 v-else class="text-lg font-medium text-gray-900 dark:text-gray-400">
                {{ __('two.factor.authentication.content.not.enable') }}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-500">
                <p>
                    {{ __('two.factor.authentication.content') }}
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-900 dark:text-gray-400">
                        <p v-if="confirming" class="font-semibold">
                            {{ __('two.factor.authentication.qrcode.confirming') }}
                        </p>

                        <p v-else>
                            {{ __('two.factor.authentication.qrcode.enabled') }}
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode" />

                    <div class="mt-4 max-w-xl text-sm text-gray-900 dark:text-gray-400" v-if="setupKey">
                        <p class="font-semibold">
                            {{ __('Setup Key') }}: <span v-html="setupKey"></span>
                        </p>
                    </div>

                    <div v-if="confirming" class="mt-4">
                        <JetLabel for="code" value="Code" />

                        <TextField
                            id="code"
                            v-model="confirmationForm.code"
                            type="text"
                            name="code"
                            class="block mt-1 w-1/2"
                            inputmode="numeric"
                            autofocus
                            autocomplete="one-time-code"
                            @keyup.enter="confirmTwoFactorAuthentication"
                        />

                        <JetInputError :message="confirmationForm.errors.code" class="mt-2" />
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0 && ! confirming">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('two.factor.authentication.recovery.code') }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <AlwaysConfirmsPassword @confirmed="enableTwoFactorAuthentication">
                        <DefaultButton type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            {{ __('Enable') }}
                        </DefaultButton>
                    </AlwaysConfirmsPassword>
                </div>

                <div v-else>
                    <JetConfirmsPassword @confirmed="confirmTwoFactorAuthentication">
                        <DefaultButton
                            v-if="confirming"
                            type="button"
                            class="mr-3"
                            :class="{ 'opacity-25': enabling }"
                            :disabled="enabling"
                        >
                            {{ __('Confirm') }}
                        </DefaultButton>
                    </JetConfirmsPassword>

                    <AlwaysConfirmsPassword @confirmed="regenerateRecoveryCodes">
                        <OutlineButton
                            v-if="recoveryCodes.length > 0 && ! confirming"
                            class="mr-3"
                        >
                            {{ __('Regenerate Recovery Codes') }}
                        </OutlineButton>
                    </AlwaysConfirmsPassword>

                    <AlwaysConfirmsPassword @confirmed="showRecoveryCodes">
                        <OutlineButton
                            v-if="recoveryCodes.length === 0 && ! confirming"
                            class="mr-3"
                        >
                            {{ __('Show Recovery Codes') }}
                        </OutlineButton>
                    </AlwaysConfirmsPassword>

                    <JetConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <OutlineButton
                            v-if="confirming"
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling"
                        >
                            {{ __('Cancel') }}
                        </OutlineButton>
                    </JetConfirmsPassword>

                    <AlwaysConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <DangerButton
                            v-if="! confirming"
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling"
                        >
                            {{ __('Disable') }}
                        </DangerButton>
                    </AlwaysConfirmsPassword>
                </div>
            </div>
        </template>
    </JetActionSection>
</template>
