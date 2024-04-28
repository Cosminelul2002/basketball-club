<template>
    <AdminLayout>
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
            <div class="px-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>

            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nume
                                produs</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" autocomplete="given-name" v-model="form.name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="description"
                                class="block text-sm font-medium leading-6 text-gray-900">Descriere</label>
                            <div class="mt-2">
                                <input type="text" name="description" id="description" autocomplete="family-name"
                                    v-model="form.description"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Preț
                            </label>
                            <div class="mt-2">
                                <input id="price" name="price" type="text" autocomplete="price" v-model="form.price"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="availability" class="block text-sm font-medium leading-6 text-gray-900">Valabil
                            </label>
                            <div class="mt-2">
                                <select id="availability" name="availability" autocomplete="availability"
                                    v-model="form.availability"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="true">Da</option>
                                    <option value="false">Nu</option>
                                </select>
                            </div>
                        </div>

                        <!-- select with all the categories -->
                        <div class="sm:col-span-4">
                            <label for="category_id" class="block text
                            -sm font-medium leading-6 text-gray-900">Categorie</label>
                            <div class="mt-2">
                                <select id="category_id" name="category_id" autocomplete="category_id"
                                    v-model="form.category_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button @click="saveProduct"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvează</button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';


export default {
    name: 'Admin/Products/Create',

    components: { AdminLayout },

    props: {
        categories: Array,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                category_id: '',
                price: '',
                description: '',
                availability: '',
                slug: '',
            }),
        };
    },
    methods: {
        saveProduct() {

            if (this.form.availability === 'Da') {
                this.form.availability = true;
            } else {
                this.form.availability = false;
            }
            this.makeSlug();
            this.form.post(route('admin.dashboard.products.store', this.form));
        },

        makeSlug() {
            this.form.slug = this.form.name.toLowerCase().replace(/ /g, '-');
        },
    },
}


</script>