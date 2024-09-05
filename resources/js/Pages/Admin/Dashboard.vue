<template>
    <DashboardLayout>
        <div
            class="max-w-7xl mx-auto mb-10 w-full bg-gradient-to-br from-blue-400 to-blue-600 p-10 rounded-lg text-white text-left">
            <span class="text-xl block text-left ml-0">Salut, {{ $page.props.user.name }} 👋</span>
        </div>
        <div class="flex flex-col gap-5 w-full max-w-7xl mx-auto">
            <div class="w-full">
                <div class="flex flex-col md:flex-row gap-5">
                    <div class="w-3/12 bg-white p-4 rounded-lg">
                        <h1 class="title block ml-0 !text-left">{{ players }}</h1>
                        <p class="text-gray-500">Jucători</p>
                        <inertia-link class="text-blue-500 text-xs" :href="route('tenant.admin.dashboard.players.index')">
                            Vezi jucători
                        </inertia-link>
                    </div>

                    <!-- <div class="w-3/12 bg-white p-4 rounded-lg">
                        <h1 class="title block ml-0 !text-left">{{ coaches }}</h1>
                        <p class="text-gray-500">Antrenori</p>
                        <inertia-link class="text-blue-500 text-xs" :href="route('admin.dashboard.coaches.index')">
                            Vezi antrenori
                        </inertia-link>
                    </div> -->

                    <div class="w-3/12 bg-white p-4 rounded-lg">
                        <h1 class="title block ml-0 !text-left">{{ playerGroups }}</h1>
                        <p class="text-gray-500">Grupe de vârstă</p>
                        <inertia-link class="text-blue-500 text-xs" :href="route('tenant.admin.dashboard.groups.index')">
                            Vezi grupele de vârstă</inertia-link>
                    </div>

                    <!-- <div class="w-3/12 bg-white p-4 rounded-lg">
                        <h1 class="title block ml-0 !text-left">{{ locations }}</h1>
                        <p class="text-gray-500">Locații</p>
                        <inertia-link class="text-blue-500 text-xs" :href="route('admin.dashboard.joins.index')">
                            Vezi locațiile tale
                        </inertia-link>
                    </div> -->
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-5">
                <!-- <div class="w-full bg-white px-3 rounded-lg">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class=" text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Cereri de inscriere</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="join in lastJoins" v-bind:key="join.id"
                                class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 font-medium px-6 text-left whitespace-nowrap">
                                    {{ formatDate(join.created_at) }}
                                </td>
                                <td class="py-3 font-medium px-6 text-left whitespace-nowrap">
                                    {{ join.first_name }} {{ join.last_name }}
                                </td>
                                <td class="py-3 font-medium text-blue-500 px-6 text-left whitespace-nowrap">
                                    <inertia-link class="text-blue-500 text-xs"
                                        :href="route('admin.dashboard.joins.index')">
                                        Vizualizeaza
                                    </inertia-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->

                <div class="w-full bg-white px-3 rounded-lg">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class=" text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Jucători</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="player in lastPlayers" v-bind:key="player.id"
                                class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 font-medium px-6 text-left whitespace-nowrap">
                                    {{ player.first_name }} {{ player.last_name }}
                                </td>
                                <td class="py-3 font-medium text-blue-500 px-6 text-left whitespace-nowrap">
                                    <inertia-link class="text-blue-500 text-xs"
                                        :href="route('admin.dashboard.players.show', player)">
                                        Vizualizeaza
                                    </inertia-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../Layouts/DashboardLayout.vue';

export default {
    name: 'Admin/Dashboard',

    components: { DashboardLayout },

    props: {
        players: Number,
        lastPlayers: Array,
        coaches: Number,
        playerGroups: Number,
        locations: Number,
    },

    methods: {
        formatDate(dateString) {
            // Crearea unui obiect de tip Date
            const date = new Date(dateString);

            // Opțiunile pentru formatarea datei
            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };

            // Formatarea datei în limba română
            const formattedDate = date.toLocaleString('ro-RO', options);

            return formattedDate;
        },
    }

}

</script>
