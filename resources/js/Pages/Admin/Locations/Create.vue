<template>
    <AdminLayout>
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Adresa</label>
                        <div class="mt-2">
                            <input type="text" name="address" id="address" autocomplete="given-name"
                                v-model="form.address"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.address" class="text-red-500 text-sm">{{ errors.address
                                }}</span>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Oraș</label>
                        <div class="mt-2">
                            <input id="city" name="city" autocomplete="city" v-model="form.city"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.city" class="text-red-500 text-sm">{{ errors.city
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Sectorul</label>
                        <div class="mt-2">
                            <input id="area" name="area" autocomplete="area" v-model="form.area"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.area" class="text-red-500 text-sm">{{ errors.area
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
    name: 'Locations/Create',

    components: {
        AdminLayout,
    },

    data() {
        return {
            form: {
                address: '',
                city: '',
                area: '',
            },
            errors: {},
        }
    },

    methods: {
        save() {
            this.errors = {};
            if (!this.form.address) {
                this.errors.address = 'Adresa este obligatorie';
            }
            if (!this.form.city) {
                this.errors.city = 'Orașul este obligatoriu';
            }
            if (!this.form.area) {
                this.errors.area = 'Sectorul este obligatoriu';
            }

            if (Object.keys(this.errors).length === 0) {
                this.$inertia.post(route('admin.dashboard.locations.store'), this.form);
                this.form = {
                    address: null,
                    city: null,
                    area: null,
                }
            }
        }
    }
}

</script>