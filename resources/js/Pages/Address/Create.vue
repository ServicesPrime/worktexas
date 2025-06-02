<script setup>
import LayoutMain from '@/Layouts/LayoutMain.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import BaseButton from '@/Components/BaseButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import CardBox from '@/Components/CardBox.vue';
import FormField from '@/Components/FormField.vue';
import FormControl from '@/Components/FormControl.vue';
import { useForm, Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    routeName: String,
    zipCodes: Array,
});

const form = useForm({
    full_address: '',
    street: '',
    city: '',
    state: '',
    zip_code: '',
    apt_number: '',
    country: '',
    zip_code_id: '',
});

const saveForm = () => {
    form.post(route(`${props.routeName}store`));
};
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :title="title" main>
            <Link :href="route(`${routeName}index`)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </Link>
        </SectionTitleLineWithButton>

        <CardBox form @submit.prevent="saveForm">
            <FormField label="Street" :error="form.errors.street">
                <FormControl v-model="form.street" placeholder="Street" />
            </FormField>
            <FormField label="City" :error="form.errors.city">
                <FormControl v-model="form.city" placeholder="City" />
            </FormField>
            <FormField label="State" :error="form.errors.state">
                <FormControl v-model="form.state" placeholder="State" />
            </FormField>
            <FormField label="Zip" :error="form.errors.zip_code">
                <FormControl v-model="form.zip_code" placeholder="Zip" />
            </FormField>
            <FormField label="Apartment" :error="form.errors.apt_number">
                <FormControl v-model="form.apt_number" placeholder="Apartment" />
            </FormField>
            <FormField label="Country" :error="form.errors.country">
                <FormControl v-model="form.country" placeholder="Country" />
            </FormField>
            <FormField label="Zip Code" :error="form.errors.zip_code_id">
                <select v-model="form.zip_code_id" class="form-select rounded w-full">
                    <option value="">Select Zip</option>
                    <option v-for="z in zipCodes" :key="z.id" :value="z.id">{{ z.zip }}</option>
                </select>
            </FormField>
            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" color="white" label="Cancel" />
                    <BaseButton @click="saveForm" type="submit" color="success" label="Save" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
