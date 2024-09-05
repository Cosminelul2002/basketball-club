<template>
    <DashboardLayout>
        <div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Creează Un Membru</h2>
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
    </DashboardLayout>
</template>

<script>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3';
import DashboardLayout from '../../../Layouts/DashboardLayout.vue'
import FormInput from '../../../Components/FormInput.vue'

export default {
    name: 'Salaries/Create',
    components: {
        DashboardLayout,
        FormInput,
    },
    props: {
        salaries: {
            type: Array,
            required: true
        },

        roles: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            form: useForm({
                first_name: '',
                staff_role_id: '',
                last_name: '',
                email: '',
                phone: '',
                salary_id: '',
                date_of_birth: ''
            }),
            errors: {},
            formFields: [
                { name: 'first_name', label: 'Nume', model: 'first_name', type: 'input', inputType: 'text', autocomplete: 'first_name', colSpan: 'sm:col-span-3' },
                { name: 'last_name', label: 'Prenume', model: 'last_name', type: 'input', inputType: 'text', autocomplete: 'last_name', colSpan: 'sm:col-span-3' },
                { name: 'email ', label: 'Email', model: 'email', type: 'input', inputType: 'text', autocomplete: 'email', colSpan: 'sm:col-span-6' },
                { name: 'phone', label: 'Telefon', model: 'phone', type: 'input', inputType: 'text', autocomplete: 'phone', colSpan: 'sm:col-span-6' },
                { name: 'date_of_birth', label: 'Data nașterii', model: 'date_of_birth', type: 'input', inputType: 'date', autocomplete: 'date_of_birth', colSpan: 'sm:col-span-6' },
                { name: 'salary', label: 'Salariu', model: 'salary_id', type: 'select', colSpan: 'sm:col-span-6', options: this.salaries.map(salary => ({ value: salary.id, label: salary.name })) },
                { name: 'role', label: 'Rol', model: 'staff_role_id', type: 'select', colSpan: 'sm:col-span-6', options: this.roles.map(role => ({ value: role.id, label: role.name })) },
            ],
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.dashboard.staff.store'), {
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