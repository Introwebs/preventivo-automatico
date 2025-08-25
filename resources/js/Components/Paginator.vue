<script setup>
import { computed } from 'vue';

const props = defineProps({
    paginationData: {
        type: Object,
        required: true,
        default: () => ({
            current_page: 1,
            last_page: 1,
            prev_page_url: null,
            next_page_url: null,
        })
    }
});

const emit = defineEmits(['page-changed']);

const goToPage = (pageNumber) => {
    if (pageNumber >= 1 && pageNumber <= props.paginationData.last_page && pageNumber !== props.paginationData.current_page) {
        emit('page-changed', pageNumber);
    }
};

const goToFirstPage = () => {
    if (props.paginationData.current_page > 1) {
        emit('page-changed', 1);
    }
};

const goToPrevPage = () => {
    if (props.paginationData.prev_page_url) {
        emit('page-changed', props.paginationData.current_page - 1);
    }
};

const goToNextPage = () => {
    if (props.paginationData.next_page_url) {
        emit('page-changed', props.paginationData.current_page + 1);
    }
};

const goToLastPage = () => {
    if (props.paginationData.current_page < props.paginationData.last_page) {
        emit('page-changed', props.paginationData.last_page);
    }
};

const canGoToFirst = computed(() => props.paginationData.current_page > 1);
const canGoToPrev = computed(() => !!props.paginationData.prev_page_url);
const canGoToNext = computed(() => !!props.paginationData.next_page_url);
const canGoToLast = computed(() => props.paginationData.current_page < props.paginationData.last_page);

</script>

<template>
    <div v-if="paginationData" class="flex justify-center items-center gap-x-2 sm:gap-x-3">
        <!-- Pulsante Prima Pagina -->
        <button
            @click="goToFirstPage"
            :disabled="!canGoToFirst"
            class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center bgSecondary rounded-full border border-gray-300 select-none transition-colors duration-150 ease-in-out"
            :class="{
                'cursor-pointer hover:bg-gray-100 active:bg-gray-200 text-white hover:text-gray-900': canGoToFirst,
                'text-gray-200 cursor-not-allowed opacity-75': !canGoToFirst
            }"
            aria-label="Vai alla prima pagina"
        >
            <span class="text-sm sm:text-base">«</span>
        </button>

        <!-- Pulsante Pagina Precedente -->
        <button
            @click="goToPrevPage"
            :disabled="!canGoToPrev"
            class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center bgSecondary rounded-full border border-gray-300 select-none transition-colors duration-150 ease-in-out"
            :class="{
                'cursor-pointer hover:bg-gray-100 active:bg-gray-200 text-white hover:text-gray-900': canGoToPrev,
                'text-gray-200 cursor-not-allowed opacity-75': !canGoToPrev
            }"
            aria-label="Vai alla pagina precedente"
        >
            <span class="text-sm sm:text-base"><</span>
        </button>

        <!-- Indicatore Pagina Corrente / Totale Pagine -->
        <div class="w-fit min-w-[3rem] sm:min-w-[4rem] h-9 sm:h-10 px-2 sm:px-3 flex items-center justify-center select-none">
            <span class="text-sm sm:text-base font-semibold textSecondary">
                {{ paginationData.current_page }} / {{ paginationData.last_page }}
            </span>
        </div>

        <!-- Pulsante Pagina Successiva -->
        <button
            @click="goToNextPage"
            :disabled="!canGoToNext"
            class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center bgSecondary rounded-full border border-gray-300 select-none transition-colors duration-150 ease-in-out"
            :class="{
                'cursor-pointer hover:bg-gray-100 active:bg-gray-200 text-white hover:text-gray-900': canGoToNext,
                'text-gray-200 cursor-not-allowed opacity-75': !canGoToNext
            }"
            aria-label="Vai alla pagina successiva"
        >
            <span class="text-sm sm:text-base">></span>
        </button>

        <!-- Pulsante Ultima Pagina -->
        <button
            @click="goToLastPage"
            :disabled="!canGoToLast"
            class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center bgSecondary rounded-full border border-gray-300 select-none transition-colors duration-150 ease-in-out"
            :class="{
                'cursor-pointer hover:bg-gray-100 active:bg-gray-200 text-white hover:text-gray-900': canGoToLast,
                'text-gray-200 cursor-not-allowed opacity-75': !canGoToLast
            }"
            aria-label="Vai all'ultima pagina"
        >
            <span class="text-sm sm:text-base">»</span>
        </button>
    </div>
</template>
