<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import * as common from '@/common';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="block md:inline-block mr-2 mt-3 md:mt-0 w-fit px-5 py-1.5 text-gray-900 bg-white rounded border border-gray-300">
                    <span class="textTertiary font-bold">Username&nbsp;</span> {{ $page.props.auth.user.name }}
                </div>
                <div class="block md:inline-block mr-2 mt-3 md:mt-0 w-fit px-5 py-1.5 text-gray-900 bg-white rounded border border-gray-300">
                    <span class="textTertiary font-bold">Email&nbsp;</span> {{ $page.props.auth.user.email }}
                </div>
                <span class="block mt-8 text-gray-700 dark:text-gray-400 text-sm">Account attivo dal giorno: {{ common.getFormattedDate($page.props.auth.user.created_at) }}</span>
                <!-- <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                /> -->
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </div>
</template>
