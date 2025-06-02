<script setup>
import { Head, router } from '@inertiajs/vue3'
import LayoutMain from '@/Layouts/LayoutMain.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import BaseButton from '@/Components/BaseButton.vue'
import Pagination from '@/Shared/Pagination.vue'
import { ref } from 'vue'

const props = defineProps({
    title: String,
    routeName: String,
    applicants: Object,
    search: String,
    order: String,
    direction: String,
})

const search = ref(props.search)

const submitSearch = () => {
    router.get(route(`${props.routeName}index`), { search: search.value })
}
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">{{ title }}</h1>
            <BaseButtons>
                <BaseButton :routeName="`${routeName}create`" color="info" label="Add" />
            </BaseButtons>
        </div>
        <div class="mb-4">
            <input v-model="search" @keyup.enter="submitSearch" class="border rounded p-2" placeholder="Search" />
            <BaseButton @click="submitSearch" color="info" label="Search" class="ml-2" />
        </div>
        <table class="w-full text-left border">
            <thead>
                <tr>
                    <th class="px-2 py-1">Name</th>
                    <th class="px-2 py-1">Surname</th>
                    <th class="px-2 py-1">Email</th>
                    <th class="px-2 py-1">Phone</th>
                    <th class="px-2 py-1">Car</th>
                    <th class="px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="applicant in applicants.data" :key="applicant.id">
                    <td class="px-2 py-1">{{ applicant.name }}</td>
                    <td class="px-2 py-1">{{ applicant.surname }}</td>
                    <td class="px-2 py-1">{{ applicant.email }}</td>
                    <td class="px-2 py-1">{{ applicant.phone }}</td>
                    <td class="px-2 py-1">{{ applicant.car }}</td>
                    <td class="px-2 py-1">
                        <BaseButtons>
                            <BaseButton :routeName="`${routeName}edit`" :parameter="applicant.id" color="info" label="Edit" small />
                            <BaseButton :href="route(`${routeName}destroy`, applicant.id)" method="delete" color="danger" label="Delete" small />
                        </BaseButtons>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="applicants.links" :total="applicants.total" />
    </LayoutMain>
</template>
