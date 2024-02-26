<template>
    <Layout>
        <div class="bg-gradient-to-br from-blue-400 to-blue-600 p-6 rounded-lg  mb-6">
            <h1 class="text-2xl">Editează echipa: {{ team.name }}</h1>
        </div>
        <div class="w-full p-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Echipa curentă</h2>
                    <div>
                        <p><strong>Numele echipei:</strong> {{ team.name }}</p>
                        <p><strong>Numărul de jucători:</strong> {{ teamPlayers.length }}</p>
                        <p><strong>Eveniment:</strong> {{ team.event.description }}</p>
                        <p><strong>Data:</strong> {{ team.event.date }}</p>
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            <div v-for="player in teamPlayers" :key="player.id" class="bg-white rounded-lg shadow-md p-4">
                                <h2 class="text-lg font-semibold">{{ player.name }}</h2>
                                <p class="text-gray-500">{{ player.position }}</p>
                                <button @click="removeFromTeam(player)"
                                    class="mt-4 bg-red-500  rounded-md px-4 py-2 hover:bg-red-600 focus:outline-none">
                                    Elimină din echipă
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                    <div v-for="player in playersNotOnTeam" :key="player.id" class="bg-white rounded-lg shadow-md p-4">
                        <h2 class="text-lg font-semibold">{{ player.name }}</h2>
                        <p class="text-gray-500">{{ player.position }}</p>
                        <button @click="addToTeam(player)"
                            class="mt-4 bg-blue-500  rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none">
                            Adaugă la echipă
                        </button>
                    </div>
                </div>
                <Pagination class="mt-6" :links="players.links" />
            </div>
            <div class="flex justify-end">
                <button @click="saveTeam"
                    class="bg-blue-500  rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none">
                    Salvează modificările
                </button>
            </div>
        </div>
    </Layout>
</template>
  
<script>
import Layout from '../../Layouts/Layout.vue';
import Pagination from '../../Components/Pagination.vue';

export default {
    name: 'Teams/Edit',

    components: {
        Layout,
        Pagination,
    },

    props: {
        team: Object,
        players: Object,
    },

    computed: {
        teamPlayers() {
            return this.team.players;
        },
        playersNotOnTeam() {
            return this.players.data.filter(player => !this.team.players.find(tp => tp.id === player.id));
        },
    },

    methods: {
        removeFromTeam(player) {
            const index = this.team.players.findIndex(tp => tp.id === player.id);
            if (index !== -1) {
                this.team.players.splice(index, 1);
            }
        },

        addToTeam(player) {
            this.team.players.push(player);
        },

        saveTeam() {
            this.$inertia.put(route('teams.update', this.team), {
                players: this.team.players.map(player => player.id),
            });
        },
    },
};
</script>
  