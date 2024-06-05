<template>
    <GenericList 
    :items="staffRoles" 
    :columns="columns" 
    :filters="filters" 
    :prevFilters="prevFilters" 
    title="Roluri Staff"
    description="Lista Rolurilor Staff-ului." 
    getRoute="admin.dashboard.staff-roles.index"
    createRoute="admin.dashboard.staff-roles.create"
    editRouteName="admin.dashboard.staff-roles.show"
    deleteRouteName="admin.dashboard.staff-roles.destroy"
    entityName="rol" />
</template>

<script>
import GenericList from '../../../Components/GenericList.vue';

export default {
    name: 'Admin/StaffRoles/List',

    components: {
        GenericList,
    },

    props: {
        staffRoles: Object,
        prevFilters: Object,
    },

    computed: {
        columns() {
            return [
                { name: 'name', label: 'Nume' },
                { name: 'description', label: 'Descriere' },
                { name: 'created_at', label: 'Data creării' },
                { name: 'updated_at', label: 'Data actualizării' },
            ];
        },
        filters() {
            return [
                { model: 'searchName', label: 'Filtru după nume', type: 'text' },
                { model: 'searchDescription', label: 'Filtru după descriere', type: 'text' },
            ];
        },
    }
}

</script>