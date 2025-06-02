<script setup>
import { Head, router } from '@inertiajs/vue3'
import LayoutMain from '@/Layouts/LayoutMain.vue'
import { ref } from 'vue'

const props = defineProps({
    applicant: Object
})

const form = ref({
    name: props.applicant.name,
    surname: props.applicant.surname,
    email: props.applicant.email,
    phone: props.applicant.phone,
    car: props.applicant.car
})

const submit = () => {
    router.put(route('applicants.update', props.applicant.id), form.value)
}
</script>

<template>
    <Head title="Edit Applicant" />
    <LayoutMain>
        <h1 class="text-2xl font-bold mb-4">Edit Applicant</h1>
        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block">Name</label>
                <input v-model="form.name" class="border rounded px-2 py-1 w-full" />
            </div>
            <div>
                <label class="block">Surname</label>
                <input v-model="form.surname" class="border rounded px-2 py-1 w-full" />
            </div>
            <div>
                <label class="block">Email</label>
                <input v-model="form.email" class="border rounded px-2 py-1 w-full" />
            </div>
            <div>
                <label class="block">Phone</label>
                <input v-model="form.phone" class="border rounded px-2 py-1 w-full" />
            </div>
            <div>
                <label class="block">Car</label>
                <select v-model="form.car" class="border rounded px-2 py-1 w-full">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </LayoutMain>
</template>
