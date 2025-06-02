<script setup>
import { Head } from '@inertiajs/vue3'
import LayoutMain from '@/Layouts/LayoutMain.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import BaseButton from '@/Components/BaseButton.vue'
import Form from './Form.vue'
import { ref } from 'vue'

const props = defineProps({
    title: String,
    routeName: String,
    applicant: Object,
})

const formRef = ref(null)

const submit = () => {
    formRef.value.form.put(route(`${props.routeName}update`, props.applicant.id))
}
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
        <h1 class="text-xl font-bold mb-4">{{ title }}</h1>
        <Form ref="formRef" :routeName="routeName" :applicant="applicant" />
        <BaseButtons class="mt-4">
            <BaseButton :routeName="`${routeName}index`" label="Back" color="white" />
            <BaseButton @click="submit" label="Update" color="success" />
        </BaseButtons>
    </LayoutMain>
</template>
