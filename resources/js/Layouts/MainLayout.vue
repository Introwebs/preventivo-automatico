<script setup>
import AuthenticatedLayout from './AuthenticatedLayout.vue';

</script>

<template>
    <AuthenticatedLayout>
        <Transition
            name="page-fade"
            mode="out-in"
        >
            <div :key="$page.url">
                <slot />
            </div>
        </Transition>
    </AuthenticatedLayout>
</template>

<style>
.page-fade-enter-active,
.page-fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.page-fade-enter-from,
.page-fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}

.page-fade-leave-from,
.page-fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}
</style>
