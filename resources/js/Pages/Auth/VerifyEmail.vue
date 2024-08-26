<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 px-4 text-justify">
            Grazie per esserti iscritto! Prima di iniziare, verifica il tuo indirizzo e-mail cliccando sul link che ti abbiamo appena inviato per e-mail. Se non ha ricevuto l'e-mail, saremo lieti di inviartene un'altra.
        </div>

        <div class="mb-4 font-medium text-sm text-green-600 px-4" v-if="verificationLinkSent">
            Un nuovo link di verifica è stato inviato all'indirizzo e-mail fornito durante la registrazione.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between px-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Invia un altro link
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500"
                    >Esci</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
