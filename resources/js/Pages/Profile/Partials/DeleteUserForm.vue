<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Elimina l'account</h2>
            <p class="mt-1 text-sm text-gray-900 dark:text-gray-400">
                Il tuo account e tutti i dati associati verranno eliminati in modo permanente.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Elimna l'account</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">
                    Sei sicuro di voler cancellare l'account?
                </h2><hr>
                <p class="my-3 text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold text-base">Attenzione:</span> confermando l'eliminazione dell'account, tutti i tuoi dati personali verranno eliminati definitivamente secondo le modalità della nostra privacy policy.
                </p>

                <div class="mt-6 flex flex-wrap items-start justify-between gap-x-2">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <div>
                        <TextInput
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            placeholder="Password"
                            @keyup.enter="deleteUser"
                        />
                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <DangerButton
                            class="md:ms-3 ms-0 mt-3 md:mt-0"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteUser"
                        >
                            Elimina il mio account
                        </DangerButton>
                    </div>
                </div>

                <InputError :message="$page.props.DBerror" class="mt-2" />

            </div>
        </Modal>
    </section>
</template>
