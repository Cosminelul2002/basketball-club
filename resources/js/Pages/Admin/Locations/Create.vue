<template>
    <DashboardLayout>
        <div class="max-w-3xl mx-auto bg-white p-3.5 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Creează O Locație</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                <FormInput v-for="field in formFields" :key="field.name" :field="field" v-model="form[field.model]"
                    :error="errors[field.model]" />
            </div>
            <div class="flex items-center justify-end mt-6 gap-x-4">
                <inertia-link :href="route('admin.dashboard.groups.index')"
                    class="text-sm font-semibold text-gray-700 hover:text-gray-900">Anulează</inertia-link>
                <button @click="submit" :disabled="form.processing"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                    Salvează
                </button>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
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
    data() {
        return {
            form: useForm({
                'address': '',
                'city': '',
                'area': '',
            }),
            errors: {},
            formFields: [
                { name: 'address', label: 'Adresa', model: 'address', type: 'input', inputType: 'text', autocomplete: 'given-name', colSpan: 'sm:col-span-4' },
                { name: 'city', label: 'Oraș', model: 'city', type: 'input', inputType: 'text', autocomplete: 'city', colSpan: 'sm:col-span-4' },
                { name: 'area', label: 'Sectorul', model: 'area', type: 'input', inputType: 'text', autocomplete: 'area', colSpan: 'sm:col-span-4' },
            ],
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.dashboard.locations.store'), {
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