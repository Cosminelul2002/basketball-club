<template>
    <Layout>
        <div
            class="max-w-7xl mx-auto mb-10 w-full bg-gradient-to-br from-blue-400 to-blue-600 p-10 rounded-lg  text-left">
            <span class="text-xl block text-left ml-0">Creează un eveniment</span>
        </div>
        <form @submit.prevent="submit">
            <div class="flex flex-col">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descriere</label>
                        <input type="text" id="description" v-model="form.description"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="John" required>
                    </div>
                    <div class="mb-6">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Data</label>
                        <input type="date" id="date" v-model="form.date"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="18" required>
                    </div>
                    <div>
                        <label for="hours" class="block mb-2 text-sm font-medium text-gray-900">Oră</label>
                        <input type="time" id="hours" v-model="form.hour"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="8" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4 mb-5">
                    <template v-for="team in createdTeams" :key="team.id">
                        <template v-if="team.isSubmitted">
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="flex flex-col justify-between gap-5">
                                    <h2 class="text-xl font-semibold">Echipa {{ team.id }}</h2>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4">
                                        <div v-for="player in team.players" :key="player.id"
                                            class="bg-white rounded-lg shadow-md p-4">
                                            <h2 class="text-lg font-semibold">{{ player.name }}</h2>
                                            <p class="text-gray-700">{{ player.position }}</p>
                                            <div class="flex items-center justify-center p-2">
                                                <button type="button" @click="removeFromTeam(team.id, player)"
                                                    class=" bg-red-500 hover-bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover-bg-red-700 dark:focus:ring-red-800">Șterge
                                                    jucător</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div v-else class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex flex-col justify-between gap-5">
                                <div class="flex flex-row items-center justify-between">
                                    <h2 class="text-xl font-semibold">Echipa curentă</h2>
                                    <div @click="closeTeam(team)">
                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5" d="M17.25 6.75L6.75 17.25"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5" d="M6.75 6.75L17.25 17.25"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex flex-row items-center justify-center gap-5 w-12/12">
                                    <label for="nm" id="name"
                                        class="block mb-2 text-xl font-medium text-gray-900 w-6/12">Nume:</label>
                                    <input type="text" v-model="team.name" id="nm"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg w-6/12 focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="John" required>
                                </div>
                                <div class="flex flex-row items-center justify-center gap-5 w-12/12">
                                    <label for="cpt" id="captain"
                                        class="block mb-2 text-xl font-medium text-gray-900 w-6/12">Căpitan:</label>
                                    <input type="text" v-model="team.captain" id="cpt"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg w-6/12 focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="John" required>
                                </div>
                                <div class="flex flex-row items-center justify-center gap-5 w-12/12">
                                    <label for="playersNum" id="playersNumber"
                                        class="block mb-2 text-xl font-medium text-gray-900 w-6/12">Numărul de
                                        jucători:</label>
                                    <input type="number" v-model="team.playersNumber" id="playersNum"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg w-6/12 focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="18" required>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4">
                                    <div v-for="player in vPlayers" :key="player.id" @click="playerClick(player)"
                                        class="rounded-lg shadow-md p-4 cursor-pointer"
                                        :class="{ 'bg-blue-400': player.isSelected, 'bg-white ': !player.isSelected }">
                                        <h2 class="text-lg font-semibold">{{ player.name }}</h2>
                                        <p class="text-gray-700">{{ player.position }}</p>
                                    </div>
                                </div>
                                <EventPagination :links="players.links" />
                                <div class="flex flex-row justify-center gap-5 w-12/12">
                                    <button type="button" @click="saveTeam(team)"
                                        class=" bg-blue-500 hover-bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover-bg-blue-700 dark:focus:ring-blue-800">Salvează
                                        echipa</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div>
                    <button type="button" @click="addTeam" :class="{ 'hidden': !submittedTeam }"
                        class=" bg-blue-500 hover-bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover-bg-blue-700 dark:focus:ring-blue-800">Adaugă
                        echipă nouă</button>
                </div>
            </div>
            <button type="submit"
                class=" mt-4 bg-blue-500 hover-bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover-bg-blue-700 dark:focus:ring-blue-800">Salvează</button>
        </form>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';
import EventPagination from '../../Components/EventPagination.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';


export default {
    name: 'Events/Create',

    components: {
        Layout,
        EventPagination
    },

    // put a watch on the players prop so when it changes, we can update the vPlayers data
    watch: {
        players: {
            handler() {
                this.vPlayers = this.players.data.map(element => ({ ...element, dropdown: false, isSelected: false, }));
            },
            immediate: true,
        },
    },

    props: {
        players: Object,
    },

    data() {
        return {
            form: {
                description: '',
                date: '',
                hour: '',
                teams: [],
            },
            teamId: 1,
            submittedTeam: true,
            vPlayers: this.players.data.map(element => ({ ...element, dropdown: false, isSelected: false, })),
            selectedPlayers: [],
            createdTeams: [],
        }
    },

    methods: {
        addTeam() {
            this.submittedTeam = false;
            this.createdTeams.push({
                id: this.teamId++,
                name: '',
                captain: '',
                playersNumber: '',
                players: [],
                isSubmitted: false,
            });
        },

        closeTeam(team) {
            this.createdTeams = this.createdTeams.filter(t => t.id !== team.id);
            this.submittedTeam = true;
        },

        removeFromTeam(teamIndex, player) {
            this.createdTeams[teamIndex - 1].players = this.createdTeams[teamIndex - 1].players.filter(p => p.id !== player.id);
        },

        playerClick(player) {
            player.isSelected = !player.isSelected

            if (player.isSelected) {
                this.selectedPlayers.push(player)
            } else {
                this.selectedPlayers = this.selectedPlayers.filter(p => p.id !== player.id)
            }
        },

        submit() {
            if ( this.createdTeams.length <= 1 ) {
                toast.error('Trebuie să adăugați cel puțin două echipe!');
                return;
            }
            this.$inertia.post(route('events.store'), this.form = {
                ...this.form,
                teams: this.createdTeams,
            })
        },

        saveTeam(team) {

            if (this.validateTeam(team) === 'error') {
                return;
            }

            this.refreshTeam(team);

            toast.success('Echipa a fost salvată cu succes!');
        },

        refreshTeam(team) {
            team.players = this.selectedPlayers;
            team.isSubmitted = true;
            this.vPlayers = this.vPlayers.filter(p => !p.isSelected);
            this.selectedPlayers = [];
            this.submittedTeam = true;
            team.players.forEach(player => {
                player.isSelected = false;
            });
        },

        validateTeam(team) {
            const validationRules = {
                name: {
                    required: true,
                    minLength: 3,
                    maxLength: 20,
                },

                captain: {
                    required: true,
                    minLength: 3,
                    maxLength: 20,
                },

                playersNumber: {
                    required: true,
                    number: true,
                    range: [1, 10]
                }
            }

            const validateInput = (input, rules, label) => {
                if (rules.required && !input) {
                    this.requiredToast(document.getElementById(label).innerHTML.slice(0, -1));
                    return 'required';
                }

                if (rules.minLength && input.length < rules.minLength) {
                    this.minLengthToast(document.getElementById(label).innerHTML.slice(0, -1), rules.minLength);
                    return 'minLength';
                }

                if (rules.maxLength && input.length > rules.maxLength) {
                    this.maxLengthToast(document.getElementById(label).innerHTML.slice(0, -1), rules.maxLength);
                    return 'maxLength';
                }

                if (rules.range && (input < rules.range[0] || input > rules.range[1])) {
                    this.rangeToast(document.getElementById(label).innerHTML.slice(0, -1), rules.range[0], rules.range[1]);
                    return 'range';
                }

                return null; // No validation errors
            };

            const errors = {};
            for (const key of Object.keys(validationRules)) {
                const error = validateInput(team[key], validationRules[key], key);
                console.log(error);
                if (error) {
                    errors[key] = error;
                }
            }

            if (Object.keys(errors).length > 0) {
                console.log('Validation errors:', errors);
                return 'error';
            }
        },

        requiredToast(label) {
            toast.error(`Câmpul "${label}" este obligatoriu!`);
        },

        minLengthToast(label, minLength) {
            toast.error(`Câmpul "${label}" trebuie să conțină minim ${minLength} caractere!`);
        },

        maxLengthToast(label, maxLength) {
            toast.error(`Câmpul "${label}" trebuie să conțină maxim ${maxLength} caractere!`);
        },

        rangeToast(label, min, max) {
            toast.error(`Câmpul "${label}" trebuie să conțină între ${min} și ${max} caractere!`);
        },
    }
}

</script>