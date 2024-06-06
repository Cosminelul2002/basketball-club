<template>
    <GenericList :items="groups" :columns="columns" :filters="filters" :prevFilters="prevFilters" title="Grupuri"
        description="Listă Grupuri." entityName="grup" getRoute="admin.dashboard.groups.index"
        createRoute="admin.dashboard.groups.create" editRouteName="admin.dashboard.groups.show"
        deleteRouteName="admin.dashboard.groups.destroy" />
</template>

<script>
import GenericList from '../../../Components/GenericList.vue';

export default {
    name: 'Admin/PlayerGroups/List',

    components: {
        GenericList
    },

    computed: {
        columns() {
            return [
                { name: 'name', label: 'Nume' },
                {
                    name: 'staff', label: 'Staff', isTemplate: true, template: (item) => {
                        return item.staff.length
                            ? item.staff
                            : 'Fără staff';
                    }, 
                },
                { name: 'number_of_players', label: 'Număr de jucători', valueAlign: 'text-center', columnAlign: 'text-center'},
            ];
        },

        filters() {
            return [
                { model: 'searchName', label: 'Filtru după nume', type: 'text' },
            ];
        }
    },

    props: {
        groups: Object,
        prevFilters: Object,
    },
}


</script>