<template>

    <AdminLayout>

    </AdminLayout>

</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';


export default {
    name: 'Admin/Salaries/Show',

    components: {
        AdminLayout
    },

    props: {
        salary: Object
    }
}

</script>