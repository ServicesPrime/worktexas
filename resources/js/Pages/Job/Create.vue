<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus, mdiContentSave, mdiClose } from "@mdi/js";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";

const props = defineProps({
    title: { type: String, required: true },
    routeName: { type: String, required: true },
});

const form = useForm({ name: '', description: '' });

const saveForm = () => {
    form.post(route(`${props.routeName}store`));
};
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main>
            <Link :href="route(`${routeName}index`)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </Link>
        </SectionTitleLineWithButton>

        <CardBox form @submit.prevent="saveForm">
            <FormField label="Name" :required="true" :error="form.errors.name">
                <FormControl v-model="form.name" placeholder="Name" />
            </FormField>

            <FormField label="Description" :required="true" :error="form.errors.description">
                <FormControl v-model="form.description" placeholder="Description" />
            </FormField>

            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancel" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success" label="Save" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
