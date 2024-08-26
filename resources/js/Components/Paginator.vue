<script setup>
defineProps({
    link: Object
})
</script>

<template>
    <component
        :is="link.url ? 'Link' : 'div'"
        class="mx-1 mb-1 px-3 py-2 text-sm leading-4 border border-gray-800 rounded"
        :class="{
            'paginator-active': link.active,
            'text-gray-400' : link.url == null,
            'shadow paginator-link' : link.url !== null
        }"
        :href="link.url"
    />
</template>
