<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus, mdiContentSave, mdiClose } from "@mdi/js";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  title: { type: String, required: true },
  routeName: { type: String, required: true },
});

const form = useForm({
  first_name: "",
  last_name: "",
  email: "",
  number: "",
  car: "",
});

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
      <FormField label="First name" :error="form.errors.first_name" required>
        <FormControl v-model="form.first_name" placeholder="First name" />
      </FormField>

      <FormField label="Last name" :error="form.errors.last_name" required>
        <FormControl v-model="form.last_name" placeholder="Last name" />
      </FormField>

      <FormField label="Email" :error="form.errors.email" required>
        <FormControl v-model="form.email" type="email" placeholder="Email" />
      </FormField>

      <FormField label="Phone number" :error="form.errors.number" required>
        <FormControl v-model="form.number" placeholder="Phone number" />
      </FormField>

      <FormField label="Car" :error="form.errors.car" required>
        <FormControl v-model="form.car" placeholder="Car" />
      </FormField>

      <template #footer>
        <BaseButtons>
          <BaseButton :icon="mdiClose" :href="route(`${routeName}index`)" color="white" label="Cancel" />
          <BaseButton :icon="mdiContentSave" type="submit" color="success" label="Save" />
        </BaseButtons>
      </template>
    </CardBox>
  </LayoutMain>
</template>
