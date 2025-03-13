<script setup>
import { ref, onMounted } from 'vue'

const model = defineModel({
    type: String,
    required: true,
});

const props = defineProps({
    defaultBg: {type: Boolean, default: false},
    id: { type: String, required: true },
    min: { type: Number, default: 1 },
    max: { type: Number, default: 100 },
    step: { type: Number, default: 1 },
    label: { type: String, default: '' }
})

const input = ref(null)
let touched = false

const rangeBar = () => {
    let rangeInput = document.querySelector('#' + props.id);
    if (!rangeInput) return

    if (!touched) {
        rangeInput.style.background = '#1572D3'

    } else {
        let percentage = ((rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min)) * 100
        rangeInput.style.background = `linear-gradient(to right, #1572D3 0%, #1572D3 ${percentage}%, #ffffff ${percentage}%, #ffffff 100%)`
    }
}

const onInput = () => {
    touched = true
    rangeBar()
}

onMounted(() => {
    if (props.defaultBg) rangeBar()
})
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">{{ props.label }}</label>
    <input
        @input="onInput"
        v-model="model"
        ref="input"
        :id="props.id"
        type="range"
        :min="props.min"
        :max="props.max"
        :step="props.step"
        class="rangeInput w-full h-[12px] border border-gray-400 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 mb-3"
    >
</template>

<style>

input[type="range"]::-webkit-slider-thumb {
    background-color: white !important;
    outline-offset: -1px !important;
    outline: 3px solid white !important;
    border-radius: 100% !important;
    width: 14px !important;
    height: 14px !important;
    z-index: 100 !important;
}

input[type="range"]::-webkit-slider-runnable-track {
    margin-left: -5px !important;
    margin-right: -5px !important;
}

input[type="range"]:focus {
    outline: none !important;
}
</style>
