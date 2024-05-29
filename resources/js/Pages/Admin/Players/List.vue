<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 lg:px-8">

            <!-- Players Section Description -->
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Jucători</h1>
                    <p class="mt-2 text-md text-gray-700">Listă Jucători.</p>
                </div>

                <!-- Add Player Button -->
                <div v-if="filteredPlayers.length != 0" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.players.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        jucător nou</inertia-link>
                </div>
            </div>

            <!-- Filter section -->
            <div v-if="filteredPlayers.length != 0" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Filter by name -->
                <div>
                    <Filter :filter="nameFilter" :value="filters.name" :onUpdateValue="updateNameFilter" />
                </div>
                <!-- Filter by group -->
                <div>
                    <Filter :filter="groupFilter" :value="filters.group" :onUpdateValue="updateGroupFilter" />
                </div>
                <!-- Filter by skill level -->
                <div>
                    <Filter :filter="skillLevelFilter" :value="filters.skill_level"
                        :onUpdateValue="updateSkillLevelFilter" />
                </div>
                <!-- Filter by year from date_of_birth -->
                <div>
                    <Filter :filter="yearFilter" :value="filters.year" :onUpdateValue="updateYearFilter" />
                </div>
            </div>

            <!-- Player table -->
            <div class="mt-8 overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">

                            <!-- Coaches table  -->
                            <template v-if="filteredPlayers.length === 0">
                                <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                    <p class="text-md text-gray-500">
                                        Nu ai adăugat încă niciun jucător. Fă clic pe butonul de mai jos pentru a adăuga
                                        primul tău
                                        jucător și începe să îți formezi echipa de vis!
                                    </p>
                                    <inertia-link :href="route('admin.dashboard.players.create')"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md bg-indigo-600 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Adaugă jucător
                                    </inertia-link>
                                </div>
                            </template>

                            <table v-else class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Nume</th>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Prenume</th>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Zi de
                                            naștere</th>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Nivel</th>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Grupă</th>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Nume părinte
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Număr
                                            telefon părinte</th>
                                        <th scope="col"
                                            class="text-center px-6 py-3 text-left text-md font-semibold text-gray-900">
                                            Acțiuni</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="player in filteredPlayers" :key="player.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">{{
                    player.first_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{
                    player.last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{
                    player.date_of_birth }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{
                    player.skill_level }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                            <template v-if="player.groups.length != 0">
                                                <span class="flex flex-col" v-for="group in player.groups">{{ group.name
                                                    }}</span>
                                            </template>
                                            <span v-else>Fără grupe</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{
                    player.parent_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{
                    player.parent_phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-md font-medium">
                                            <inertia-link :href="route('admin.dashboard.players.show', player)"
                                                class="text-indigo-600 hover:text-indigo-900">Editează</inertia-link>
                                            <button @click="deletePlayer(player)"
                                                class="ml-4 text-red-600 hover:text-red-400">Șterge</button>
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

    name: "Players/List",

    components: { AdminLayout, Filter },

    props: {
        players: Array,
        groups: Array,
    },

    computed: {
        filteredPlayers() {
            const { name, group, skill_level, year } = this.filters;
            return this.players.filter(player => {
                return (!name || player.first_name.toLowerCase().includes(name.toLowerCase())) &&
                    (!group || (player.player_group && player.player_group.name.toLowerCase().includes(group.toLowerCase()))) &&
                    (!skill_level || player.skill_level === skill_level) &&
                    (!year || player.date_of_birth.includes(year));
            });
        },

        nameFilter() {
            return {
                id: 'filter-name',
                label: 'Filtru după nume',
                type: 'text',
            };
        },

        groupFilter() {
            return {
                id: 'filter-group',
                label: 'Filtru după grupă',
                type: 'select',
                placeholder: 'Alegeți o grupă',
                options: this.groups.map(group => ({ value: group.name, label: group.name })),
            };
        },

        skillLevelFilter() {
            return {
                id: 'filter-skill-level',
                label: 'Filtru după nivel',
                type: 'select',
                placeholder: 'Alegeți un nivel',
                options: [
                    { value: 'Începător', label: 'Începător' },
                    { value: 'Intermediar', label: 'Intermediar' },
                    { value: 'Avansat', label: 'Avansat' },
                ],
            };
        },

        yearFilter() {
            return {
                id: 'filter-year',
                label: 'Filtru după an',
                type: 'text',
            };
        },
    },

    data() {
        return {
            filters: {
                name: '',
                group: '',
                skill_level: '',
                year: '',
            }
        };
    },

    methods: {
        deletePlayer(player) {
            if (confirm('Sunteți sigur că doriți să ștergeți aceast jucător?')) {
                this.$inertia.delete(route('admin.dashboard.players.destroy', player));
            }
        },

        updateNameFilter(newValue) {
            this.filters.name = newValue;
        },

        updateGroupFilter(newValue) {
            this.filters.group = newValue;
        },

        updateYearFilter(newValue) {
            this.filters.year = newValue;
        },

        updateSkillLevelFilter(newValue) {
            this.filters.skill_level = newValue;
        },
    }
}

</script>