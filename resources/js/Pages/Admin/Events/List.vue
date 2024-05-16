<template>
    <AdminLayout>

        <!-- Events Section Description -->
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Evenimente</h1>
                <p class="mt-2 text-md text-gray-700">Listă evenimentelor.</p>
            </div>

            <!-- Calendar Redirect Button -->
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <inertia-link :href="route('admin.dashboard.calendar.index')"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Calendar</inertia-link>
            </div>
        </div>
        <!-- Main Coaches Section -->
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                        <!-- Coaches table  -->
                        <template v-if="events.length === 0">
                            <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                <p class="text-md text-gray-500">
                                    Nu ai adăugat încă niciun eveniment. Fă clic pe butonul de mai jos pentru a adăuga
                                    primul tău eveniment și începe să construiești echipa perfectă!
                                </p>
                                <inertia-link :href="route('admin.dashboard.events.create')"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                                    eveniment</inertia-link>
                            </div>
                        </template>

                        <table v-else class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-6">
                                        Titlu</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Descriere</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Data de început</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Data de sfârșit</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        Status eveniment</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-md font-semibold text-gray-900">
                                        În calendar</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">AddToCal</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="event in editedEvents " :key="event.id">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6">
                                        {{ event.title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{
                    event.description
                }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ event.start_time
                                        }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">{{ event.end_time
                                        }}
                                    </td>
                                    <td class=" px-3 py-4 text-md text-gray-500">{{ event.status
                                        }}</td>
                                    <td class=" px-3 py-4 text-md text-gray-500">{{ event.in_calendar ? 'Da' : 'Nu'
                                        }}</td>
                                    <td v-if="!event.in_calendar"
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                        <button @click="addEventToCalendar(event)"
                                            class="text-green-600 hover:text-green-900">Adaugă în
                                            calendar<span class="sr-only"></span></button>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                        <inertia-link :href="route('admin.dashboard.events.show', event)"
                                            class="text-indigo-600 hover:text-indigo-900">Editează<span
                                                class="sr-only"></span></inertia-link>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-md font-medium sm:pr-6">
                                        <button @click="deleteEvent(event)"
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
    </AdminLayout>

</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';

export default {
    name: "Admin/Events/List",

    components: { AdminLayout },

    computed: {
        editedEvents() {
            return this.events.filter(event => {
                if (event.status === 'completed') {
                    return event.status = 'Finalizat';
                } else if (event.status === 'in_progress') {
                    return event.status = 'În desfășurare';
                } else if (event.status === 'scheduled') {
                    return event.status = 'Programat';
                }
            });
        }
    },

    props: {
        events: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            filters: {
                name: ''
            }
        }
    },

    methods: {
        deleteEvent(event) {
            if (confirm('Sunteți sigur că doriți să ștergeți acest eveniment?')) {
                this.$inertia.delete(route('admin.dashboard.events.destroy', event));
            }
        },

        addEventToCalendar(event) {
            this.$inertia.post(route('admin.dashboard.events.add-to-calendar', event));
        }
    }
}

</script>