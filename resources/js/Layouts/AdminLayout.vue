<script setup>
import { ref } from 'vue';
import AdminSidebar from '@/Components/Admin/AdminSidebar.vue';

const isSidebarExpanded = ref(true);

function handleSidebarToggle(expanded) {
    isSidebarExpanded.value = expanded;
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <AdminSidebar @update:expanded="handleSidebarToggle" />

        <main
            class="transition-all duration-300 ease-in-out"
            :class="{
                'pl-64': isSidebarExpanded,
                'pl-20': !isSidebarExpanded
            }"
        >
            <div class="p-8">
                <slot />
            </div>
        </main>
    </div>
</template>
