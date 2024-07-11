<template>

    <DashboardLayout>

    </DashboardLayout>

</template>

<script>
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';


export default {
    name: 'Admin/Salaries/Show',

    components: {
        DashboardLayout
    },

    props: {
        salary: Object
    }
}

</script>