<script setup>
const props = defineProps({
    route: String
});
</script>

<template>
    <fieldset class="border-t border-gray-400 text-center mt-6">
        <legend class="px-2 text-gray-600">Oppure</legend>
    </fieldset>
    <div class="flex items-center justify-center mt-4">
        <a :href="props.route">
            <button class="px-4 py-2 border flex gap-2 border-slate-200 dark:border-slate-700 rounded-lg text-gray-700 dark:text-gray-400 hover:text-gray-400 hover:border-slate-400 dark:hover:border-slate-500 hover:shadow-lg transition duration-150">
                <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy" alt="google logo">
                <span class="ml-2">Continua con Google</span>
            </button>
        </a>
    </div>
</template>
