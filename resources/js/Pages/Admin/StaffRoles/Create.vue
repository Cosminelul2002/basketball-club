<template>

    <AdminLayout>
        <div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Creează Un Rol</h2>
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
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import FormInput from '../../../components/FormInput.vue';


export default {
    name: 'Admin/staffroles/Create',

    components: {
        AdminLayout,
        FormInput,
    },

    props: {

    },

    data() {
        return {
            form: useForm({
                name: '',
                description: ''
            }),
            errors: {},
            formFields: [
                { name: 'name', label: 'Nume', model: 'name', type: 'input', inputType: 'text', autocomplete: 'name', colSpan: 'sm:col-span-6' },
                { name: 'description', label: 'Descriere', model: 'description', type: 'input', inputType: 'text', autocomplete: 'description', colSpan: 'sm:col-span-6' },
            ]
        }
    },

    methods: {
        submit() {
            this.form.post(route('admin.dashboard.staff-roles.store'), {
                onFinish: () => this.$emit('close'),
                onError: (errors) => {
                    if (errors.hasOwnProperty('name')) {
                        this.errors.name = errors.name[0];
                    }
                    if (errors.hasOwnProperty('description')) {
                        this.errors.description = errors.description[0];
                    }
                }
            });
        }
    }
}

</script>