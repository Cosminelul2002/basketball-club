<template>
    <Layout>
        <div
            class="max-w-7xl mx-auto mb-10 w-full bg-gradient-to-br from-blue-400 to-blue-600 p-10 rounded-lg  text-left">
            <span class="text-xl block text-left ml-0">Echipa {{ team.name }}</span>
        </div>
        <div class="flex flex-col gap-2">
            <!-- <div class="flex flex-row justify-end gap-3">
                <button @click="toggleEdit"
                    class=" bg-gradient-to-br from-blue-400 to-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ edit ? 'Anulează' : 'Editează' }}
                </button>
            </div> -->
            <div class="relative overflow-x-auto rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left  ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nume
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Vârstă
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Înălțime
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Greutate
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Poziție
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="player in team.players" @click="editPlayer(player)"
                            class="border-b bg-blue-500 dark:border-gray-700 hover:bg-blue-900">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                {{ player.name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ player.age }}
                            </td>
                            <td class="px-6 py-4">
                                {{ player.height }}
                            </td>
                            <td class="px-6 py-4">
                                {{ player.weight }}
                            </td>
                            <td class="px-6 py-4">
                                {{ player.position }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';

export default {
    name: 'Teams/Edit',

    components: {
        Layout,
    },

    props: {
        team: Object,
    },
}

</script>