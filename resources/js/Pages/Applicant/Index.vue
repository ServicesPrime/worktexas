<script setup>
import { Head, router } from '@inertiajs/vue3'
import LayoutMain from '@/Layouts/LayoutMain.vue'

const props = defineProps({
    records: Object,
    search: String,
    order: String,
    direction: String,
    routeName: String,
    title: String
})
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <h1 class="text-2xl font-bold mb-4">{{ title }}</h1>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Surname</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Car</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records.data" :key="record.id">
                    <td class="border px-4 py-2">{{ record.name }}</td>
                    <td class="border px-4 py-2">{{ record.surname }}</td>
                    <td class="border px-4 py-2">{{ record.email }}</td>
                    <td class="border px-4 py-2">{{ record.phone }}</td>
                    <td class="border px-4 py-2">{{ record.car }}</td>
                </tr>
            </tbody>
        </table>
    </LayoutMain>
</template>
