<script setup>
import { ref, onMounted, watch } from 'vue';
import SkeletonLoader from './SkeletonLoader.vue';

const props = defineProps({
    src: String,
    alt: String,
    space: {
        type: Boolean,
        default: false
    },
    skeleton: {
        type: Boolean,
        default: false
    },
    imgClass: {
        type: String,
        default: ''
    }
});

const imageIsLoaded = ref(false);
const imageHasError = ref(false);

// Funzione per gestire il caricamento dell'immagine
const handleImageLoad = () => {
    imageIsLoaded.value = true;
    imageHasError.value = false;
};

// Funzione per gestire l'errore nel caricamento dell'immagine
const handleImageError = () => {
    imageIsLoaded.value = false;
    imageHasError.value = true;
    // console.error(`Failed to load image: ${props.src}`); // Opzionale: log dell'errore
};

// Funzione per inizializzare o resettare lo stato e avviare il caricamento
const initAndLoadImage = () => {
    imageIsLoaded.value = false;
    imageHasError.value = false;

    if (!props.src) {
        imageHasError.value = true; // Se non c'è src, consideralo un errore
        return;
    }

    // Il pre-caricamento con new Image() è utile per verificare lo stato 'complete'
    // e per avviare il download, ma gli eventi @load/@error sull'elemento <img>
    // nel template sono quelli che determinano lo stato finale per la visualizzazione.
    const img = new Image();
    img.src = props.src;

    if (img.complete) {
        // Se l'immagine è già in cache e completamente caricata
        handleImageLoad();
    } else {
        // Se non è completa, l'elemento <img> nel template gestirà
        // gli eventi @load e @error quando il browser tenterà di caricarla.
        // Non è strettamente necessario aggiungere listener qui (img.onload/img.onerror)
        // se ci affidiamo all'elemento <img> del template, ma può essere un fallback.
        // Per semplicità, ci affidiamo all'<img> nel template per questi eventi.
    }
};

// Esegui all'mount iniziale
onMounted(initAndLoadImage);

// Riesegui se la prop 'src' cambia
watch(() => props.src, initAndLoadImage);

</script>

<template>
    <SkeletonLoader
        v-if="!imageIsLoaded && props.skeleton"
        :class="props.imgClass"
    />

    <div
        v-else-if="!imageIsLoaded && props.space"
        :class="props.imgClass"
    ></div>

    <img
        v-if="props.src && !imageHasError"
        v-show="imageIsLoaded"
        @load="handleImageLoad"
        @error="handleImageError"
        :src="props.src"
        :alt="props.alt"
        :class="props.imgClass"
    />

    <div
        v-if="imageHasError && !props.skeleton && !props.space"
        :class="props.imgClass"
        role="alert"
    >
    </div>
</template>
