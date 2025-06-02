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
        Cancel
      </Link>
    </SectionTitleLineWithButton>

    <CardBox>
      <form @submit.prevent="saveForm">
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
          <FormControl v-model="form.car" placeholder="Yes / No" />
        </FormField>

        <BaseButtons>
          <BaseButton :icon="mdiClose" :href="route(`${routeName}index`)" color="white" label="Cancel" />
          <BaseButton :icon="mdiContentSave" type="submit" color="success" label="Save" />
        </BaseButtons>
      </form>
    </CardBox>
  </LayoutMain>
</template>
