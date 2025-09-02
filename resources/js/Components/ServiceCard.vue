<script setup>
import { ref } from 'vue';
import { useAutoAnimate } from '@formkit/auto-animate/vue'

const props = defineProps({
  service: {
    type: Object,
    required: true
  }
});

const [parent] = useAutoAnimate({ duration: 300 })
const isExpanded = ref(false);

const toggleExpand = () => {
  isExpanded.value = !isExpanded.value;
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('it-IT', { style: 'currency', currency: 'EUR' }).format(price);
}
</script>

<template>
    <div ref="parent" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200/80 dark:border-gray-700 transition-all hover:shadow-xl mb-6">
        <!-- Always visible header -->
        <div class="p-6 cursor-pointer" @click="toggleExpand">
            <div class="flex flex-col sm:flex-row justify-between items-start">
                <div class="flex-grow pr-4 mb-4 sm:mb-0">
                    <div class="flex items-center gap-3 mb-1">
                        <span
                            :class="[service.is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300']"
                            class="text-xs font-medium px-2.5 py-0.5 rounded-full"
                        >
                            {{ service.is_active ? 'Attivo' : 'Inattivo' }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ service.name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">{{ service.short_description }}</p>
                </div>
                <div class="text-left sm:text-right flex-shrink-0">
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ formatPrice(service.base_price) }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Prezzo base</p>
                </div>
            </div>
             <div class="flex justify-end items-center mt-4">
                <button class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-1">
                    <span>{{ isExpanded ? 'Mostra meno' : 'Mostra dettagli' }}</span>
                    <i :class="[isExpanded ? 'pi-chevron-up' : 'pi-chevron-down']" class="pi transition-transform duration-300"></i>
                </button>
            </div>
        </div>

        <!-- Expandable content -->
        <div v-if="isExpanded" class="px-6 pb-6 bg-gray-50/50 dark:bg-gray-900/50 border-t border-gray-200/80 dark:border-gray-700">
            <!-- Full Description -->
            <div class="mt-6">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Descrizione Completa</h4>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ service.description }}</p>
            </div>

            <!-- Keywords -->
            <div class="mt-6" v-if="service.keywords && service.keywords.length">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Keywords</h4>
                <div class="flex flex-wrap gap-2">
                    <span v-for="keyword in service.keywords" :key="keyword.name" class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 text-xs font-medium px-3 py-1 rounded-full flex items-center gap-2">
                        {{ keyword.name }}
                        <span class="text-blue-600/70 dark:text-blue-400/70 text-[10px]">P:{{ keyword.priority }}</span>
                        <i v-if="keyword.is_exclusive" class="pi pi-lock text-blue-600/70 dark:text-blue-400/70 text-xs" v-tooltip="'Esclusiva'"></i>
                    </span>
                </div>
            </div>

            <!-- Options -->
            <div class="mt-6" v-if="service.options && service.options.length">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Opzioni</h4>
                <ul class="space-y-3">
                    <li v-for="option in service.options" :key="option.name" class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start">
                        <div class="mb-4 sm:mb-0">
                            <div class="flex items-center gap-2">
                                <span
                                    :class="[option.is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300']"
                                    class="text-[10px] font-medium px-2 py-0.5 rounded-full"
                                >
                                    {{ option.is_active ? 'Attiva' : 'Inattiva' }}
                                </span>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ option.name }}</p>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ option.description }}</p>
                            <div v-if="option.keywords && option.keywords.length" class="mt-2 flex flex-wrap gap-1.5">
                                <span v-for="kw in option.keywords" :key="kw" class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 text-[11px] font-medium px-2 py-0.5 rounded-md">{{ kw }}</span>
                            </div>
                        </div>
                        <div class="text-left sm:text-right ml-0 sm:ml-4 flex-shrink-0">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ formatPrice(option.price) }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
