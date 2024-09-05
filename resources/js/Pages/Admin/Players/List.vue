<template>
    <GenericList :items="players" :columns="columns" :filters="filters" :prevFilters="prevFilters" title="Jucători"
        description="Listă Jucători." getRoute="admin.dashboard.players.index"
        createRoute="tenant.admin.dashboard.players.create" entityName="jucător" editRouteName="tenant.admin.dashboard.players.show"
        deleteRouteName="tenant.admin.dashboard.players.destroy" />
</template>

<script>
import GenericList from '../../../Components/GenericList.vue';

export default {
    name: "Players/List",
    components: { GenericList },
    props: {
        players: Object,
        groups: Array,
        prevFilters: Object,
    },
    computed: {
        columns() {
            return [
                { name: 'first_name', label: 'Nume' },
                { name: 'last_name', label: 'Prenume' },
                { name: 'date_of_birth', label: 'Zi de naștere' },
                { name: 'skill_level', label: 'Nivel' },
                {
                    name: 'groups', label: 'Grupă', isTemplate: true, template: (item) => {
                        return item.groups.length
                            ? item.groups.join(', ')
                            : 'Fără grupe';
                    }
                },
                { name: 'parent_name', label: 'Nume părinte' },
                { name: 'parent_phone', label: 'Număr telefon părinte' },
            ];
        },
        filters() {
            return [
                { model: 'searchName', label: 'Filtru după nume', type: 'text' },
                { model: 'searchGroup', label: 'Filtru după grupă', type: 'select', placeholder: 'Alegeți o grupă', options: this.groups.map(group => ({ value: group.name, label: group.name })) },
                {
                    model: 'searchSkill_level', label: 'Filtru după nivel', type: 'select', placeholder: 'Alegeți un nivel', options: [
                        { value: 'Începător', label: 'Începător' },
                        { value: 'Intermediar', label: 'Intermediar' },
                        { value: 'Avansat', label: 'Avansat' },
                    ]
                },
                { model: 'searchYear', label: 'Filtru după an', type: 'text' },
            ];
        },
    },
};
</script>

<style scoped>
/* Add any custom styles here if necessary */
</style>