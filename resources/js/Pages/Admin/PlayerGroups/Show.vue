<template>
    <AdminLayout>
        <h1>{{ playerGroup.name }} aaaaaaaaa</h1>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';


export default {
    name: "PlayerGroups/Show",

    components: { AdminLayout },

    props: {
        playerGroup: Object,
    }
}

</script>