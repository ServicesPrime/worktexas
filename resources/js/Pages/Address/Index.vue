<script setup>
import LayoutMain from '@/Layouts/LayoutMain.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import BaseButton from '@/Components/BaseButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import CardBox from '@/Components/CardBox.vue';
import Pagination from '@/Shared/Pagination.vue';
import { ref } from 'vue';
import { router, Head } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    addresses: Object,
    routeName: String,
    search: String,
    order: String,
    direction: String,
});

const search = ref(props.search);

const updateSearch = () => {
    router.get(route(`${props.routeName}index`), { search: search.value }, { preserveState: true });
};
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :title="title" main>
            <BaseButton :routeName="`${routeName}create`" color="success" label="Add" />
        </SectionTitleLineWithButton>
        <CardBox>
            <div class="mb-4">
                <input v-model="search" @input="updateSearch" placeholder="Search..." class="rounded border p-2 w-full" />
            </div>
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1">Street</th>
                        <th class="px-2 py-1">City</th>
                        <th class="px-2 py-1">State</th>
                        <th class="px-2 py-1">Zip</th>
                        <th class="px-2 py-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="a in addresses.data" :key="a.id" class="border-t">
                        <td class="px-2 py-1">{{ a.street }}</td>
                        <td class="px-2 py-1">{{ a.city }}</td>
                        <td class="px-2 py-1">{{ a.state }}</td>
                        <td class="px-2 py-1">{{ a.zip_code }}</td>
                        <td class="px-2 py-1 text-right">
                            <BaseButtons>
                                <BaseButton :routeName="`${routeName}edit`" :parameter="a.id" color="info" label="Edit" />
                                <BaseButton :routeName="`${routeName}destroy`" method="delete" :parameter="a.id" color="danger" label="Delete" />
                            </BaseButtons>
                        </td>
                    </tr>
                    <tr v-if="addresses.data.length === 0">
                        <td class="px-2 py-4 text-center" colspan="5">No records found.</td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data="addresses" class="mt-4" />
        </CardBox>
    </LayoutMain>
</template>
