<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import LoadingIcon from '@/Components/LoadingIcon.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

defineOptions({ layout: AdminLayout });

const loadingServices = ref(false);
const services = ref([]);
const getServices = async () => {
    loadingServices.value = true;
    try {
        const response = await axios.get(route('admin.getServices'));
        services.value = response.data;
    } catch (e) {
        console.error(e);
    } finally {
        loadingServices.value = false;
    }
}

onMounted(() => {
    getServices();
})

</script>

<template>
    <Head title="Admin" />
    <div class="max-w-7xl mx-auto py-10">
        <div v-if="loadingServices">
            <LoadingIcon size="lg" />
        </div>
        <div v-else>
            {{ services }}
        </div>
    </div>
</template>
