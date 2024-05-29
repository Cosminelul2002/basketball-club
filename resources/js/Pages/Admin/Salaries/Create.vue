<template>
    <AdminLayout>
        <div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Creează Un Salariu</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                <FormInput v-for="field in formFields" :key="field.name" :field="field" v-model="form[field.model]"
                    :error="errors[field.model]" />
            </div>
            <div class="flex items-center justify-end mt-6 gap-x-4">
                <inertia-link :href="route('admin.dashboard.salaries.index')"
                    class="text-sm font-semibold text-gray-700 hover:text-gray-900">Anulează</inertia-link>
                <button @click="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                    Salvează
                </button>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue'
import FormInput from '../../../components/FormInput.vue'

export default {
    name: 'Salaries/Create',
    components: {
        AdminLayout,
        FormInput,
    },
    props: {
        salary_types: {
            type: Array,
            required: true
        },
        currencies: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            form: useForm({
                amount: '',
                // start_date: '',
                // end_date: '',
                description: '',
                duration: '',
                duration_type: '',
                salary_type: '',
                currency: ''
            }),
            errors: {},
            formFields: [
                { name: 'amount', label: 'Valoare', model: 'amount', type: 'input', inputType: 'number', autocomplete: 'amount', colSpan: 'sm:col-span-6' },
                // { name: 'start_date', label: 'Data de început', model: 'start_date', type: 'input', inputType: 'date', autocomplete: 'start-date', colSpan: 'sm:col-span-3' },
                // { name: 'end_date', label: 'Data de sfârșit', model: 'end_date', type: 'input', inputType: 'date', autocomplete: 'end-date', colSpan: 'sm:col-span-3' },
                { name: 'description', label: 'Descriere', model: 'description', type: 'input', inputType: 'text', autocomplete: 'description', colSpan: 'sm:col-span-6' },
                { name: 'duration', label: 'Durată', model: 'duration', type: 'input', inputType: 'number', autocomplete: 'duration', colSpan: 'sm:col-span-3' },
                {
                    name: 'duration_type', label: 'Tip Durată', model: 'duration_type', type: 'select', options: [
                        { value: 'years', label: 'Ani' },
                        { value: 'months', label: 'Luni' },
                        { value: 'weeks', label: 'Săptămâni' },
                        { value: 'days', label: 'Zile' },
                    ], colSpan: 'sm:col-span-3'
                },
                {
                    name: 'salary_type', label: 'Tip Salariu', model: 'salary_type', type: 'select', options: this.salary_types.map(type => ({ value: type, label: type })), colSpan: 'sm:col-span-3'
                },
                {
                    name: 'currency', label: 'Monedă', model: 'currency', type: 'select', options: this.currencies.map(currency => ({ value: currency, label: currency })), colSpan: 'sm:col-span-3'
                },
            ],
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.dashboard.salaries.store'), {
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