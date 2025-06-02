<script setup>
import { Head, router } from '@inertiajs/vue3'
import LayoutMain from '@/Layouts/LayoutMain.vue'
import { ref } from 'vue'

const form = ref({
    name: '',
    surname: '',
    email: '',
    phone: '',
    car: ''
})

const submit = () => {
    router.post(route('applicants.store'), form.value)
}
</script>

<template>
    <Head title="Create Applicant" />
    <LayoutMain>
        <h1 class="text-2xl font-bold mb-4">Create Applicant</h1>
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
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        </form>
    </LayoutMain>
</template>
