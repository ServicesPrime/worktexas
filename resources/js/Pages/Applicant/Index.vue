<script setup>
import LayoutMain from '@/Layouts/LayoutMain.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    routeName: String,
    applicants: Object,
    search: String,
    order: String,
    direction: String,
});
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <h1 class="text-2xl font-bold mb-4">{{ title }}</h1>
        <div v-if="applicants.data && applicants.data.length">
            <table class="min-w-full border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Apellido</th>
                        <th class="px-4 py-2 border">Correo</th>
                        <th class="px-4 py-2 border">Numero</th>
                        <th class="px-4 py-2 border">Car</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in applicants.data" :key="item.id">
                        <td class="border px-4 py-2">{{ item.nombre }}</td>
                        <td class="border px-4 py-2">{{ item.apellido }}</td>
                        <td class="border px-4 py-2">{{ item.correo }}</td>
                        <td class="border px-4 py-2">{{ item.numero }}</td>
                        <td class="border px-4 py-2">{{ item.car }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-else>No applicants found</div>
    </LayoutMain>
</template>
