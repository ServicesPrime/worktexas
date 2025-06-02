<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiBallotOutline, mdiInformation, mdiPencil, mdiTrashCan, mdiBroom, mdiMagnify, mdiPlus } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import Dropdown from "@/Components/DropdownTable.vue";
import { router, Head } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { reactive, ref, watch } from "vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/css/index.css";
import debounce from "lodash/debounce";

const props = defineProps({
    title: { type: String, required: true },
    jobs: { type: Object, required: true },
    routeName: { type: String, required: true },
    search: { type: String, required: true },
    direction: { type: String, required: true },
});

const search = ref(props.search);
const isLoading = ref(false);
const state = reactive({
    filters: {
        search: search,
        order: 'created_at',
        direction: props.direction,
    },
});

watch(
    search,
    debounce((value) => {
        router.get(route(`${props.routeName}index`, state.filters, { replace: true }));
    }, 500)
);

const cleanFilters = () => {
    router.get(route(`${props.routeName}index`));
};

const filterBy = (order, direction) => {
    state.filters.order = order;
    state.filters.direction = direction;
    router.get(route(`${props.routeName}index`, state.filters));
};

const opts = [
    {
        label: 'Name',
        key: 'name',
        menu: [
            { title: 'Order A - Z', direction: 'asc' },
            { title: 'Order Z - A', direction: 'desc' },
        ],
    },
    {
        label: 'Description',
        key: 'description',
        menu: [
            { title: 'Order A - Z', direction: 'asc' },
            { title: 'Order Z - A', direction: 'desc' },
        ],
    },
];
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiBallotOutline" :title="title" main>
        </SectionTitleLineWithButton>

        <NotificationBar v-if="$page.props.flash.success" color="success" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.success }}
        </NotificationBar>
        <NotificationBar v-if="$page.props.flash.error" color="danger" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.error }}
        </NotificationBar>

        <form class="w-full mb-5">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="relative w-full md:w-1/2 mr-1 my-4">
                    <input
                        type="search"
                        id="search-dropdown"
                        class="block p-2.5 md:h-11 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-l-lg md:rounded-l-none rounded-r-lg md:border-l-gray-300 border-l-gray-300 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Search"
                        v-model="search"
                    />
                    <BaseButton class="absolute top-0 right-0 h-full rounded-l-none rounded-r-lg" @click="cleanFilters" :icon="mdiBroom" color="info" title="Clear filter" />
                </div>

                <BaseButtons>
                    <BaseButton :routeName="`${routeName}create`" color="info" :icon="mdiPlus" label="Add job" class="w-full" />
                </BaseButtons>
            </div>
        </form>

        <CardBox v-if="jobs.data.length > 0">
            <table>
                <thead>
                    <tr>
                        <th><Dropdown title="Name" :options="opts" /></th>
                        <th><Dropdown title="Description" :options="opts" /></th>
                        <th class="relative inline-block text-left">
                            <span class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-md font-bold text-gray-900 dark:text-white ring-inset ring-gray-300 hover:bg-gray-100">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in jobs.data" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.description }}</td>
                        <td>
                            <BaseButtons>
                                <BaseButton color="info" :icon="mdiPencil" small :routeName="`${routeName}edit`" :parameter="item.id" title="Edit job" />
                                <BaseButton color="danger" :icon="mdiTrashCan" small :routeName="`${routeName}destroy`" method="delete" :parameter="item.id" />
                            </BaseButtons>
                        </td>
                    </tr>
                </tbody>
            </table>
        </CardBox>
        <CardBox v-else>
            <p>No data available.</p>
        </CardBox>
        <pagination :links="jobs.links" :total="jobs.total" :to="jobs.to" :from="jobs.from" />
        <div class="vl-parent">
            <loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true" />
        </div>
    </LayoutMain>
</template>
