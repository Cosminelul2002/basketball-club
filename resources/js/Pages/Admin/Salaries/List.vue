<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Salaries Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Salarii</h1>
                    <p class="mt-2 text-md text-gray-700">Listă salariilor.</p>
                </div>

                <!-- Add Salary Button -->
                <div v-if="!salaries" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.salaries.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        un salariu nou</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div v-if="!salaries" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by amount -->
                <div>
                    <Filter :filter="amountFilter" :value="filters.amount" :onUpdateValue="updateAmountFilter" />
                </div>
                <!-- Filter by type -->
                <div>
                    <Filter :filter="typeFilter" :value="filters.type" :onUpdateValue="updateTypeFilter" />
                </div>
                <!-- Filter by start date -->
                <div>
                    <Filter :filter="startDateFilter" :value="filters.start_date"
                        :onUpdateValue="updateStartDateFilter" />
                </div>
                <!-- Filter by end date -->
                <div>
                    <Filter :filter="endDateFilter" :value="filters.end_date" :onUpdateValue="updateEndDateFilter" />
                </div>
            </div>

            <!-- Main Locations Section -->
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Locations table  -->
                            <template v-if="!salaries">
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu există salarii disponibile.
                                    </p>
                                    <inertia-link :href="route('admin.dashboard.salaries.create')"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Adaugă salariu
                                    </inertia-link>
                                </div>
                            </template>

                            <table v-else class="min-w-full divide-y divide-gray-300 text-center">
                                <thead class="bg-gray-50">
                                    <tr class="">
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Monedă</th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3  text-md font-semibold text-gray-900 sm:pl-6">
                                            Salriu</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Tip salariu</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Durată</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            Tip durată</th>
                                        <th scope="col" class="px-3 py-3.5  text-md font-semibold text-gray-900">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                        <!-- <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Delete</span>
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="salary in salaries" :key="salary.id">
                                        <td class="py-4 px-3 text-md text-gray-500">{{ salary.currency }}</td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6">
                                            {{ salary.amount }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ translateSalaryType(salary.type)
                                            }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{ salary.duration }}</td>
                                        <td class="py-4 px-3 text-md text-gray-500">{{
                    translateDurationType(salary.duration_type) }}</td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-md font-medium sm:pr-6">
                                            <inertia-link :href="route('admin.dashboard.salaries.show', salary)"
                                                class="text-indigo-600 hover:text-indigo-900">Editează / <span
                                                    class="sr-only"></span></inertia-link><button
                                                @click="deleteSalary(salary)"
                                                class="text-red-600 hover:text-red-400">Șterge<span
                                                    class="sr-only"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Filter from '../../../Components/Filter.vue';

export default {

    name: "Admin/Salaries/List",

    components: { AdminLayout, Filter },

    computed: {
        filteredSalaries() {
            const { amount, type, start_date, end_date } = this.filters;
            // return this.salaries.filter(location => {
            //     return location.address.toLowerCase().includes(address.toLowerCase()) &&
            //         location.city.toLowerCase().includes(city.toLowerCase()) &&
            //         location.area.toLowerCase().includes(area.toLowerCase());
            // });
        },

        amountFilter() {
            return {
                id: 'amount',
                label: 'Salariu',
                type: 'number',
            };
        },

        typeFilter() {
            return {
                id: 'type',
                label: 'Tip salariu',
                type: 'select',
                placeholder: 'Selectează tipul salariului',
                options: [
                    { value: 'fixed', label: 'Fix' },
                    { value: 'hourly', label: 'Pe oră' },
                    { value: 'daily', label: 'Zilnic' },
                    { value: 'weekly', label: 'Săptămânal' },
                    { value: 'monthly', label: 'Lunar' },
                    { value: 'commission', label: 'Comision' },
                    { value: 'bonus', label: 'Bonus' },
                    { value: 'other', label: 'Altele' }
                ],
            };
        },

        startDateFilter() {
            return {
                id: 'start_date',
                label: 'Data de început a salariului',
                type: 'date',
            };
        },

        endDateFilter() {
            return {
                id: 'end_date',
                label: 'Data de sfârșit a salariului',
                type: 'date',
            };
        },
    },

    props: {
        salaries: Array,
    },

    data() {
        return {
            filters: {
                amount: '',
                type: '',
                start_date: '',
                end_date: '',
            }
        }
    },

    methods: {
        deleteSalary(salary) {
            if (confirm('Sunteți sigur că doriți să ștergeți această locație?')) {
                this.$inertia.delete(route('admin.dashboard.salaries.destroy', salary));
            }
        },

        updateAmountFilter(value) {
            this.filters.amount = value;
        },

        updateTypeFilter(value) {
            this.filters.type = value;
        },

        updateStartDateFilter(value) {
            this.filters.start_date = value;
        },

        updateEndDateFilter(value) {
            this.filters.end_date = value;
        },

        translateDurationType(value) {
            switch (value) {
                case 'years':
                    return 'Ani';
                case 'months':
                    return 'Luni';
                case 'weeks':
                    return 'Săptămâni';
                case 'days':
                    return 'Zile';
                default:
                    return value;
            }
        },

        translateSalaryType(value) {
            switch (value) {
                case 'fixed':
                    return 'Fix';
                case 'hourly':
                    return 'Pe oră';
                case 'daily':
                    return 'Zilnic';
                case 'weekly':
                    return 'Săptămânal';
                case 'monthly':
                    return 'Lunar';
                case 'commission':
                    return 'Comision';
                case 'bonus':
                    return 'Bonus';
                case 'other':
                    return 'Altele';
                default:
                    return value;
            }
        },
    }
}

</script>