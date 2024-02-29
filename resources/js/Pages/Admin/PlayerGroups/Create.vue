<template>
    <AdminLayout>
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nume</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="given-name" v-model="form.name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name
                            }}</span>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descriere</label>
                        <div class="mt-2">
                            <textarea rows="3" name="description" id="description" autocomplete="description"
                                v-model="form.description"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.description" class="text-red-500 text-sm">{{ errors.description
                            }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Anulează
                </button>
                <button @click="save"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Salvează
                </button>
            </div>
        </div>
    </AdminLayout>
</template>


<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';


export default {
    name: 'Admin/Dashboard',

    components: { AdminLayout },

    data() {
        return {
            form: {
                name: '',
                description: '',
                tax: '',
            },
            errors: {},
        }
    },

    methods: {
        save() {
            this.errors = {};

            if (!this.form.name) {
                this.errors.name = 'Numele este obligatoriu.';
            }

            if (Object.keys(this.errors).length === 0) {
                this.$inertia.post(route('admin.dashboard.groups.store'), this.form);
            }
        }
    }
}

</script>