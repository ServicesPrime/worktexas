<script setup>
import { useForm } from '@inertiajs/vue3'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
    applicant: { type: Object, default: () => ({ address: {} }) },
    routeName: String,
})

const form = useForm({
    name: props.applicant.name || '',
    surname: props.applicant.surname || '',
    email: props.applicant.email || '',
    phone: props.applicant.phone || '',
    car: props.applicant.car || 'Yes',
    full_address: props.applicant.address?.full_address || '',
    street: props.applicant.address?.street || '',
    city: props.applicant.address?.city || '',
    state: props.applicant.address?.state || '',
    zip_code: props.applicant.address?.zip_code || '',
    apt_number: props.applicant.address?.apt_number || '',
    country: props.applicant.address?.country || '',
})

defineExpose({ form })
</script>

<template>
    <div class="space-y-4">
        <div>
            <label class="block">Name</label>
            <input v-model="form.name" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Surname</label>
            <input v-model="form.surname" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Email</label>
            <input v-model="form.email" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Phone</label>
            <input v-model="form.phone" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Car</label>
            <select v-model="form.car" class="border rounded w-full p-2">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <hr />
        <h2 class="font-bold">Address</h2>
        <div>
            <label class="block">Full Address</label>
            <input v-model="form.full_address" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Street</label>
            <input v-model="form.street" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">City</label>
            <input v-model="form.city" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">State</label>
            <input v-model="form.state" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Zip Code</label>
            <input v-model="form.zip_code" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Apartment</label>
            <input v-model="form.apt_number" class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block">Country</label>
            <input v-model="form.country" class="border rounded w-full p-2" />
        </div>
    </div>
</template>
