<script setup>
import AuthenticatedLayout from './AuthenticatedLayout.vue';

</script>

<template>
    <AuthenticatedLayout showAdminTag>
        <div class="pt-24">
            <slot />
        </div>
    </AuthenticatedLayout>
</template>
