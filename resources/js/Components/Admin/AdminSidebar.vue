<script setup>
import { ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import { vAutoAnimate } from '@formkit/auto-animate';
import ApplicationLogo from '../ApplicationLogo.vue';
import LightDarkModeButton from '../LightDarkModeButton.vue';

const isExpanded = ref(true);

const emit = defineEmits(['update:expanded']);

watch(isExpanded, (newValue) => {
    emit('update:expanded', newValue);
});

const navLinks = ref([
    { route: 'admin.dashboard', label: 'Servizi', icon: 'pi-database', component: 'Admin/AdminDashboard' },
]);
</script>

<template>
    <aside
        :class="[
            'fixed top-0 left-0 h-screen bg-gray-300 dark:bg-gray-800 text-gray-200 transition-all duration-300 ease-in-out z-40',
            isExpanded ? 'w-72' : 'w-20'
        ]"
    >
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center gap-x-3 h-20 px-3 border-b border-gray-700">
                <LightDarkModeButton />
                <!-- <span v-if="isExpanded" class="text-lg font-bold text-gray-700 dark:text-gray-200">Preventivo Automatico</span> -->
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2" v-auto-animate>
                    <li v-for="link in navLinks" :key="link.route">
                        <Link
                            :href="route(link.route)"
                            :class="[
                                'flex items-center p-3 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-700 transition-colors duration-200 text-gray-700 dark:text-gray-100',
                                { 'bg-white dark:bg-gray-900 font-semibold': $page.component === link.component }
                            ]"
                        >
                            <i :class="['pi', link.icon, 'text-xl']"></i>
                            <span
                                :class="[
                                    'ml-4 transition-opacity duration-200',
                                    isExpanded ? 'opacity-100' : 'opacity-0'
                                ]"
                            >{{ link.label }}</span>
                        </Link>
                    </li>
                </ul>
            </nav>

            <!-- Toggle Button -->
            <div class="px-4 py-4 border-t border-gray-700">
                <div class="flex items-center justify-between gap-x-3">
                    <button
                        @click="isExpanded = !isExpanded"
                        class="flex items-center justify-center w-full p-3 rounded-lg text-gray-700 dark:text-gray-100 hover:bg-gray-400 dark:hover:bg-gray-700 transition-colors duration-200"
                    >
                        <i :class="['pi', isExpanded ? 'pi-angle-left' : 'pi-angle-right', 'text-xl']"></i>
                    </button>
                </div>
            </div>
        </div>
    </aside>
</template>

<style scoped>
/* Nasconde il testo quando la sidebar è compressa per evitare che vada a capo */
aside:not(.w-72) nav span {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}
</style>
