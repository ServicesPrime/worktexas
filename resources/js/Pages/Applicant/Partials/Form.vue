<script setup>
import FormField from '@/Components/FormField.vue';
import FormControl from '@/Components/FormControl.vue';
import { inject } from 'vue';

const form = inject('form');
</script>
<template>
    <div class="md:flex md:space-x-4 mb-5">
        <div class="md:w-1/2 max-lg:mb-5">
            <FormField label="Name" required :error="form.errors.name">
                <FormControl v-model="form.name" placeholder="Name" />
            </FormField>
        </div>
        <div class="md:w-1/2">
            <FormField label="Surname" required :error="form.errors.surname">
                <FormControl v-model="form.surname" placeholder="Surname" />
            </FormField>
        </div>
    </div>
    <div class="md:flex md:space-x-4 mb-5">
        <div class="md:w-1/2 max-lg:mb-5">
            <FormField label="Email" required :error="form.errors.email">
                <FormControl v-model="form.email" type="email" placeholder="Email" />
            </FormField>
        </div>
        <div class="md:w-1/2">
            <FormField label="Phone" required help="Enter 10 digits" :error="form.errors.phone">
                <FormControl v-model="form.phone" maxlength="10" inputmode="numeric" @input="form.phone = form.phone.replace(/\D/g,'').slice(0,10)" />
            </FormField>
        </div>
    </div>
    <div class="md:flex md:space-x-4 mb-5">
        <div class="md:w-1/2 max-lg:mb-5">
            <FormField label="Owns car?" required :error="form.errors.car">
                <FormControl v-model="form.car" :options="['Yes','No']" type="select" />
            </FormField>
        </div>
    </div>
</template>
