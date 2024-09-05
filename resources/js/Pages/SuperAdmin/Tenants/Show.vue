<template>
    <DashboardLayout>
        <AttributeList :attributes="attibutes" title="Informații proprietar" subtitle="Detalii personale"
            :initialData="initialData" routeName="super_admin.dashboard.tenants.update" :errors="$attrs.errors" />
    </DashboardLayout>
</template>

<script>
import AttributeList from '../../../Components/AttributeList.vue';
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';


export default {
    name: "SuperAdmin/Tenants/Show",

    components: {
        DashboardLayout,
        AttributeList,
    },

    props: {
        tenant: Object,
        domains: Array,
    },

    computed: {
        attibutes() {
            return [
                { label: 'Nume', value: this.tenant.name, model: 'name', name: 'name' },
                { label: 'Email', value: this.tenant.user.email, model: 'email', name: 'email' },
                { label: 'Număr de telefon', value: this.tenant.phone, model: 'phone', name: 'phone' },
                { label: 'Adresă', value: this.tenant.address, model: 'address', name: 'address' },
                { label: 'Tip', value: this.tenant.type, model: 'type', name: 'type' },
                { label: 'Bază de date', value: this.tenant.tenancy_db_name, model: 'tenancy_db_name', name: 'tenancy_db_name' },
                { label: 'Domeniu', value: this.tenant.domains[0].domain, model: 'domain', name: 'domain' },
                { label: 'Status', value: this.tenant.status, model: 'status', name: 'status' },
                { label: 'Data creării', value: this.tenant.created_at, model: 'created_at', name: 'created_at' },
            ]
        },
        initialData() {
            return {
                id: this.tenant.id,
                name: this.tenant.name,
                email: this.tenant.email,
                phone: this.tenant.phone,
                address: this.tenant.address,
                type: this.tenant.type,
                tenancy_db_name: this.tenant.tenancy_db_name,
                domain: this.tenant.domain,
                status: this.tenant.status,
                created_at: this.tenant.created_at,
            }

        }
    }
}

</script>