<template>
    <DashboardLayout>
        <div class="max-w-3xl mx-auto bg-white p-3.5 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Creează Un Tenant</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                <FormInput v-for="field in formFields" :key="field.name" :field="field" v-model="form[field.model]"
                    :error="errors[field.model]" />
            </div>
            <div class="flex items-center justify-end mt-6 gap-x-4">
                <inertia-link :href="route('super_admin.dashboard.tenants.index')"
                    class="text-sm font-semibold text-gray-700 hover:text-gray-900">Anulează</inertia-link>
                <button @click="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                    Salvează
                </button>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3';
import DashboardLayout from '../../../Layouts/DashboardLayout.vue'
import Dropdown from '../../../Components/Dropdown.vue'
import FormInput from '../../../Components/FormInput.vue'

export default {
    name: 'Players/Create',
    components: {
        DashboardLayout,
        FormInput,
        Dropdown,
    },
    props: {
        groups: {
            type: Array,
            required: true
        },
    },
    data() {
        return {
            form: useForm({
                name: '',
                type: '',
                domain: '',
                email: '',
                password: '',
                confirmedPassword: '',
            }),
            errors: {},
            formFields: [
                { name: 'name', label: 'Nume', model: 'name', type: 'input', inputType: 'text', autocomplete: 'given-name', colSpan: 'sm:col-span-3' },
                { name: 'last_name', label: 'Prenume', model: 'last_name', type: 'input', inputType: 'text', autocomplete: 'family-name', colSpan: 'sm:col-span-3' },
                { name: 'email', label: 'Email', model: 'email', type: 'input', inputType: 'email', autocomplete: 'email', colSpan: 'sm:col-span-6' },
                { name: 'type', label: 'Tip', model: 'type', type: 'input', inputType: 'text', autocomplete: 'type', colSpan: 'sm:col-span-6' },
                { name: 'domain', label: 'Domeniu', model: 'domain', type: 'input', inputType: 'text', autocomplete: 'domain', colSpan: 'sm:col-span-6', hasAddon: true, addon: '.localhost' },
                { name: 'password', label: 'Parola', model: 'password', type: 'input', inputType: 'password', autocomplete: 'new-password', colSpan: 'sm:col-span-6' },
                { name: 'confirmedPassword', label: 'Confirmă Parola', model: 'confirmedPassword', type: 'input', inputType: 'password', autocomplete: 'new-password', colSpan: 'sm:col-span-6' },
            ],
        };
    },
    methods: {
        submit() {
            this.form.post(route('super_admin.dashboard.tenants.store'), {
                onError: (errors) => {
                    this.errors = errors;
                },
                onSuccess: () => {
                    this.form.reset();
                }
            });
        },
    },
};
</script>

<style scoped>
/* Add any custom styles here if necessary */
</style>