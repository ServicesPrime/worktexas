<script setup>
import LayoutMain from '@/Layouts/LayoutMain.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import CardBox from '@/Components/CardBox.vue';
import ColoredButton from '@/Components/ColoredButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import Pagination from '@/Shared/Pagination.vue';
import { Link, router, Head } from '@inertiajs/vue3';
import { ref, reactive, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    title: String,
    routeName: String,
    applicants: Object,
    search: String,
    order: String,
    direction: String,
});

const search = ref(props.search);
const state = reactive({
    filters: {
        search: search,
        order: props.order,
        direction: props.direction,
    },
});

watch(search, debounce(() => {
    router.get(route(`${props.routeName}index`, state.filters), { replace: true });
}, 500));

const cleanFilters = () => {
    router.get(route(`${props.routeName}index`));
};
</script>
<template>
    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :title="title" main />
        <form @submit.prevent="">
            <div class="flex mb-5">
                <input type="search" class="flex-1 border rounded-l-lg md:rounded-r-none" placeholder="search" v-model="search" />
                <ColoredButton color="blue" @click="cleanFilters" type="button" class="rounded-r-lg">Clear</ColoredButton>
                <Link :href="route(`${routeName}create`)" class="ml-2">
                    <ColoredButton color="green">Add</ColoredButton>
                </Link>
            </div>
        </form>
        <CardBox v-if="applicants.data.length">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Car</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in applicants.data" :key="item.id">
                        <td>{{ item.nombre }}</td>
                        <td>{{ item.apellido }}</td>
                        <td>{{ item.correo }}</td>
                        <td>{{ item.numero }}</td>
                        <td>{{ item.car }}</td>
                        <td class="before:hidden lg:w-1 whitespace-nowrap">
                            <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                <Link :href="route(`${routeName}edit`, item.id)">
                                    <ColoredButton color="blue" small>Edit</ColoredButton>
                                </Link>
                            </BaseButtons>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :links="applicants.links" :total="applicants.total" :to="applicants.to" :from="applicants.from" />
        </CardBox>
        <CardBox v-else>
            <p>No applicants.</p>
        </CardBox>
    </LayoutMain>
</template>
