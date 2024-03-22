<template>
    <AdminLayout>

    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';

export default {

    name: "Locations/List",

    components: { AdminLayout },

    props: {
        locations: Array,
    }

}

</script>