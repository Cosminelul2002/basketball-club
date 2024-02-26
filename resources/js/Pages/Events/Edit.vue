<template>
    <Layout>
        <div
            class="max-w-7xl mx-auto mb-10 w-full bg-gradient-to-br from-blue-400 to-blue-600 p-10 rounded-lg  text-left">
            <span class="text-xl block text-left ml-0">Editează evenimentul</span>
        </div>
        <div class="flex flex-row justify-end gap-3">
            <button @click="toggleEdit"
                class=" bg-gradient-to-br from-blue-400 to-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ edit ? 'Anulează' : 'Editează' }}
            </button>
        </div>
        <form @submit.prevent="submit">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Descriere</label>
                    <input type="text" id="name" v-model="form.description"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required readonly>
                </div>
                <div class="mb-6">
                    <label for="age" class="block mb-2 text-sm font-medium text-gray-900 ">Data</label>
                    <input type="date" id="age" v-model="form.date"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required readonly>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="team in event.teams" :key="team.id" class="bg-white rounded-lg shadow-lg">
                    <div class="p-4">
                        <div class="flex flex-col w-full gap-5">
                            <span class="text-gray-700 font-bold text-lg text-center">{{ team.name }}</span>
                            <div class="flex flex-row items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-gray-700 text-md font-semibold">Nume</span>
                                    <template v-for="player in team.players">
                                        <span class="text-gray-500 text-sm">{{ player.name }}</span>
                                    </template>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-gray-700 text-md font-semibold">Pozitie</span>
                                    <template v-for="player in team.players">
                                        <span class="text-gray-500 text-sm">{{ player.position }}</span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-row justify-between">
                            <inertia-link :href="route('teams.show', team)"
                                class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded-full cursor-pointer">Vezi
                                echipa</inertia-link>
                            <div @click="editTeam(team)"
                                class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded-full cursor-pointer">
                                Editează echipa</div>
                            <div @click="deleteTeam(team)"
                                class="bg-red-500 hover:bg-red-700  font-bold py-2 px-4 rounded-full cursor-pointer">
                                Șterge echipa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" v-show="edit"
                class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvează</button>
        </form>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';

export default {
    name: 'Events/Edit',

    components: {
        Layout,
    },

    props: {
        event: Object,
    },

    data() {
        return {
            edit: false,
            form: {
                description: this.event.description,
                date: this.formatDate(this.event.date),
            },
        }
    },

    methods: {
        toggleEdit() {
            this.edit = !this.edit;
            const inputs = document.querySelectorAll('input');
            const selects = document.querySelectorAll('select');
            if (this.edit) {
                inputs.forEach(input => input.removeAttribute('readonly'));
                selects.forEach(select => select.removeAttribute('disabled'));
            } else {
                inputs.forEach(input => input.setAttribute('readonly', 'readonly'));
                selects.forEach(select => select.setAttribute('disabled', 'disabled'));
                this.form = {
                    description: this.event.description,
                    date: this.formatDate(this.event.date),
                }
            }
        },

        editTeam(team) {
            this.$inertia.visit(route('teams.edit', team));
        },

        deleteTeam(team) {
            this.$inertia.delete(route('teams.destroy', team));
        },

        submit() {
            this.$inertia.put(route('events.update', this.event), this.form);
            // this.toggleEdit();
        },

        formatDate(inputDate) {
            const date = new Date(inputDate);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
    }
}
</script>