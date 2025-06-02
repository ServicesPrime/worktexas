<script setup>
import { provide } from 'vue';
import { Link, Head, useForm } from '@inertiajs/vue3';

import CardBox from '@/Components/CardBox.vue';
import LayoutMain from '@/Layouts/LayoutMain.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import ColoredButton from '@/Components/ColoredButton.vue';
import Form from './Partials/Form.vue';

const props = defineProps({
  title: String,
  routeName: String,
  applicant: Object,
});

// useForm con los campos esperados por el backend
const form = useForm({
  name: props.applicant.name,
  surname: props.applicant.surname,
  email: props.applicant.email,
  phone: props.applicant.phone,
  car: props.applicant.car,
});

const saveForm = () => {
  form.put(route(`${props.routeName}update`, props.applicant.id));
};

provide('form', form);
</script>

<template>
  <Head :title="title" />

  <LayoutMain>
    <SectionTitleLineWithButton :title="title" main>
      <Link :href="route(`${routeName}index`)">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          class="bi bi-x"
          viewBox="0 0 16 16"
        >
          <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
          />
        </svg>
      </Link>
    </SectionTitleLineWithButton>

    <CardBox>
      <form @submit.prevent="saveForm">
        <Form />

        <BaseButtons class="mt-4">
          <Link :href="route(`${routeName}index`)">
            <ColoredButton type="button" color="red">Cancel</ColoredButton>
          </Link>
          <ColoredButton type="submit" color="green">Save</ColoredButton>
        </BaseButtons>
      </form>
    </CardBox>
  </LayoutMain>
</template>
