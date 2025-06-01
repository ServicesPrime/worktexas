<script setup>
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus } from "@mdi/js";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    title: { type: String, required: true },
    records: { type: Object, required: true },
    routeName: { type: String, required: true },
});
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main>
            <Link :href="route(`${routeName}create`)" class="btn btn-primary">
                Add Applicant
            </Link>
        </SectionTitleLineWithButton>
        <div class="mt-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">First name</th>
                        <th class="px-4 py-2">Last name</th>
                        <th class="px-4 py-2">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in records.data" :key="item.id">
                        <td class="border px-4 py-2">{{ item.nombre }}</td>
                        <td class="border px-4 py-2">{{ item.apellido }}</td>
                        <td class="border px-4 py-2">{{ item.correo }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </LayoutMain>
</template>
