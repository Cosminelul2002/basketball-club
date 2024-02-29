<template>
    <AdminLayout>
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nume</label>
                        <div class="mt-2">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                v-model="form.first_name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.first_name" class="text-red-500 text-sm">{{ errors.first_name
                            }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Prenume</label>
                        <div class="mt-2">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                v-model="form.last_name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.last_name" class="text-red-500 text-sm">{{ errors.last_name
                            }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" v-model="form.email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.email
                            }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Număr de
                            telefon</label>
                        <div class="mt-2">
                            <input id="phone" name="phone" autocomplete="phone" v-model="form.phone"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.phone" class="text-red-500 text-sm">{{ errors.phone
                            }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="date-of-birth" class="block text-sm font-medium leading-6 text-gray-900">Data de
                            naștere</label>
                        <div class="mt-2">
                            <input type="date" name="date-of-birth" id="date-of-birth" autocomplete="date-of-birth"
                                v-model="form.date_of_birth"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.date_of_birth" class="text-red-500 text-sm">{{ errors.date_of_birth
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
    name: 'Coaches/Create',

    components: {
        AdminLayout,
    },

    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                date_of_birth: '',
                description: '',
            },
            errors: {},
        }
    },

    methods: {
        save() {
            this.errors = {};
            if (!this.form.first_name) {
                this.errors.first_name = 'Numele este obligatoriu';
            }
            if (!this.form.last_name) {
                this.errors.last_name = 'Prenumele este obligatoriu';
            }
            if (!this.form.email) {
                this.errors.email = 'Emailul este obligatoriu';
            }
            if (!this.form.phone) {
                this.errors.phone = 'Numărul de telefon este obligatoriu';
            }
            if (this.form.phone && !/^(07)\d{8}$/.test(this.form.phone)) this.errors.phone = 'Numărul de telefon nu este valid.';
            if (!this.form.date_of_birth) {
                this.errors.date_of_birth = 'Data de naștere este obligatorie';
            }
            if (!this.form.description) {
                this.errors.description = 'Descrierea este obligatorie';
            }

            if (Object.keys(this.errors).length === 0) {
                this.$inertia.post(route('admin.dashboard.coaches.create'), this.form);
                this.form = {
                    first_name: null,
                    last_name: null,
                    email: null,
                    age: null,
                    phone: null,
                    message: null
                }
            }
        }
    }
}

</script>