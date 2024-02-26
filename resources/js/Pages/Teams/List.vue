
<template>
    <Layout>
        <div
            class="max-w-7xl mx-auto mb-10 w-full bg-gradient-to-br from-blue-400 to-blue-600 p-10 rounded-lg  text-left">
            <span class="text-xl block text-left ml-0">Echipe</span>
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-row justify-start gap-3">
                <input v-model="searchQuery"
                    class="bg-gray-200 text-gray-600 border border-slate-300 hover:border-slate-400 rounded-md p-1"
                    placeholder="Caută" />
                <!-- <inertia-link :href="route('players.create')" class="button">Adauga</inertia-link> -->
            </div>
            <div class="relative overflow-x-auto rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left  ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nume
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Eveniment
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <!-- <th scope="col" class="px-6 py-3 text-center">
                                Număr jucători
                            </th> -->
                            <!-- <th scope="col" class="px-6 py-3">
                            Poziție
                        </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="team in vTeams" @click="viewTeam(team)"
                            class="border-b bg-blue-500 dark:border-gray-700 hover:bg-blue-900 cursor-pointer">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                {{ team.name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ team.event.date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ team.winner ? 'Castigatoare' : 'Pierzatoare' }}
                            </td>
                            <!-- <td class="px-6 py-4 text-center">
                                {{ team.players.length }}
                            </td> -->
                            <!--<td class="px-6 py-4">
                            {{ team.position }}
                        </td> -->
                        </tr>
                    </tbody>
                </table>
                <Pagination class="mt-6" :links="teams.links" />
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';
import Pagination from '../../Components/Pagination.vue';

export default {
    name: 'Teams/List',

    components: {
        Layout,
        Pagination,
    },

    props: {
        teams: Object,
    },

    data() {
        return {
            searchQuery: '',
            vTeams: this.teams.data.map(element => ({ ...element, dropdown: false })),
        }
    },

    methods: {
        viewTeam(team) {
            this.$inertia.visit(route('teams.show', team))
        },
    }
}
</script>