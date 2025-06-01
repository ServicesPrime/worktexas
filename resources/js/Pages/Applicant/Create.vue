<script setup>
import CardBox from '@/Components/CardBox.vue';
import LayoutMain from '@/Layouts/LayoutMain.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import ColoredButton from '@/Components/ColoredButton.vue';
import { Link, Head, useForm, provide } from '@inertiajs/vue3';
import Form from './Partials/Form.vue';

const props = defineProps({
    title: String,
    routeName: String,
});

const form = useForm({
    name: '',
    surname: '',
    email: '',
    phone: '',
    car: '',
});

const saveForm = () => {
    form.post(route(`${props.routeName}store`));
};

provide('form', form);
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
            <Form />
            <template #footer>
                <BaseButtons>
                    <Link :href="route(`${routeName}index`)">
                        <ColoredButton color="red">Cancel</ColoredButton>
                    </Link>
                    <ColoredButton type="submit" color="green">Save</ColoredButton>
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
