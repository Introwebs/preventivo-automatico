<script setup>
import { ref } from 'vue';
import AdminSidebar from '@/Components/Admin/AdminSidebar.vue';

const isSidebarExpanded = ref(true);
const isMobileSidebarOpen = ref(false);

function handleSidebarToggle(expanded) {
    isSidebarExpanded.value = expanded;
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <AdminSidebar
            @update:expanded="handleSidebarToggle"
            :isOpenOnMobile="isMobileSidebarOpen"
            @close="isMobileSidebarOpen = false"
        />

        <main
            class="transition-all duration-300 ease-in-out"
            :class="{
                'lg:pl-72': isSidebarExpanded,
                'lg:pl-20': !isSidebarExpanded
            }"
        >
            <div class="p-4 lg:p-8">
                <button @click="isMobileSidebarOpen = true" class="lg:hidden mt-6">
                    <i class="pi pi-bars text-2xl text-gray-700 dark:text-gray-200"></i>
                </button>
                <slot />
            </div>
        </main>
    </div>
</template>
