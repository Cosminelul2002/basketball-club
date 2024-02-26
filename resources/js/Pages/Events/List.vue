<template>
    <Layout>
        <div
            class="max-w-7xl mx-auto mb-10 w-full bg-gradient-to-br from-blue-400 to-blue-600 p-10 rounded-lg  text-left">
            <span class="text-xl block text-left ml-0">Evenimente</span>
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-row justify-start gap-3">
                <input v-model="searchQuery"
                    class="bg-gray-200 text-gray-600 border border-slate-300 hover:border-slate-400 rounded-md px-2"
                    placeholder="Caută" />
                <inertia-link :href="route('events.create')" class="button">Adauga</inertia-link>
            </div>
            <div class="relative overflow-x-auto rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left  ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Descriere
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Număr de echipe
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Dată
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Acțiuni
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="event in vEvents" class="border-b bg-blue-500 dark:border-gray-700 hover:bg-blue-900">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                {{ event.description }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ event.teams.length }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ formatDate(event.date) }}
                            </td>
                            <td class="px-6 py-4 flex items-center justify-center">
                                <div class="flex flex-row gap-2">
                                    <button @click="editEvent(event)"
                                        class=" bg-green-500 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                        Editează
                                    </button>
                                    <button @click="deleteEvent(event)"
                                        class=" bg-red-500 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                        Șterge
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="mt-6" :links="events.links" />
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';
import Pagination from '../../Components/Pagination.vue';

export default {
    name: 'Events/List',

    components: {
        Layout,
        Pagination,
    },

    props: {
        events: Object,
    },

    data() {
        return {
            searchQuery: '',
            vEvents: this.events.data.map(element => ({ ...element, dropdown: false }))
        }
    },

    methods: {
        editEvent(event) {
            this.$inertia.visit(route('events.edit', event));
        },



        deleteEvent(event) {
            this.$inertia.delete(route('events.destroy', event), {
                replace: false,
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.$inertia.reload({
                        only: ['events'],
                        onFinish: () => {
                            this.vEvents = this.events.data.map(element => ({ ...element, dropdown: false }))
                        }
                    })
                }
            })
        },

        formatDate(inputDate) {
            const date = new Date(inputDate);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            return `${year}-${month}-${day} ${hours}:${minutes}`;
        }
    }
}

</script>
