<template>
    <DashboardLayout>
        <div class="max-w-3xl mx-auto bg-white p-3.5 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Creează Un Jucător</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                <FormInput v-for="field in formFields" :key="field.name" :field="field" v-model="form[field.model]"
                    :error="errors[field.model]" />
                <Dropdown class="sm:col-span-6" v-model="form.skill_level" :options="skillLevelOptions" label="Nivel:"
                    :error="errors.skill_level" />
                <Dropdown class="sm:col-span-6" v-model="form.group_id" :options="groupOptions" label="Grupe de vârstă:"
                    :error="errors.group_id" />
            </div>
            <div class="flex items-center justify-end mt-6 gap-x-4">
                <inertia-link :href="route('admin.dashboard.players.index')"
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
                first_name: '',
                last_name: '',
                weight: '',
                height: '',
                date_of_birth: '',
                parent_phone: '',
                parent_name: '',
                skill_level: '',
                group_id: '',
            }),
            errors: {},
            formFields: [
                { name: 'first-name', label: 'Nume', model: 'first_name', type: 'input', inputType: 'text', autocomplete: 'given-name', colSpan: 'sm:col-span-3' },
                { name: 'last-name', label: 'Prenume', model: 'last_name', type: 'input', inputType: 'text', autocomplete: 'family-name', colSpan: 'sm:col-span-3' },
                { name: 'weight', label: 'Greutate', model: 'weight', type: 'input', inputType: 'number', autocomplete: 'weight', colSpan: 'sm:col-span-3' },
                { name: 'height', label: 'Înălțime', model: 'height', type: 'input', inputType: 'number', autocomplete: 'height', colSpan: 'sm:col-span-3' },
                { name: 'date-of-birth', label: 'Data de naștere', model: 'date_of_birth', type: 'input', inputType: 'date', autocomplete: 'date-of-birth', colSpan: 'sm:col-span-6' },
                { name: 'phone', label: 'Număr de telefon părinte', model: 'parent_phone', type: 'input', inputType: 'text', autocomplete: 'phone', colSpan: 'sm:col-span-3' },
                { name: 'parent_name', label: 'Nume părinte', model: 'parent_name', type: 'input', inputType: 'text', autocomplete: 'parent_name', colSpan: 'sm:col-span-3' },
            ],
            skillLevelOptions: [
                { value: 'Începător', label: 'Începător' },
                { value: 'Intermediar', label: 'Intermediar' },
                { value: 'Avansat', label: 'Avansat' },
            ],
            groupOptions: this.groups.map(group => ({ value: group.id, label: group.name })),
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.dashboard.players.store'), {
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