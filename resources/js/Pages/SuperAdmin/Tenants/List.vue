<template>
    <GenericList :items="tenants" :columns="columns"  title="Proprietari" description="Listă proprietari."
        getRoute="super_admin.dashboard.tenants.index" createRoute="super_admin.dashboard.tenants.create" entityName="proprietar"
        editRouteName="super_admin.dashboard.tenants.show" deleteRouteName="super_admin.dashboard.tenants.destroy" />
</template>

<script>
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';
import GenericList from '../../../Components/GenericList.vue';

export default {
    name: "SuperAdmin/Tenants/List",

    components: {
        DashboardLayout,
        GenericList,
    },

    props: {
        tenants: Array,
    },

    computed: {
        columns() {
            return [
                { name: 'name', label: 'Nume propietar' },
                // { name: 'email', label: 'Email' },
                // { name: 'phone', label: 'Număr de telefon' },
                // { name: 'address', label: 'Adresă' },
                { name: 'type', label: 'Tip' },
                { name: 'tenancy_db_name', label: 'Bază de date' },
                { name: 'domain', label: 'Domeniu' },
                { name: 'status', label: 'Status' },
                { name: 'created_at', label: 'Data creării' },
            ];
        },
    }
}

</script>