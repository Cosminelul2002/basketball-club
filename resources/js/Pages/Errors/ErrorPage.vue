<template>
    <AdminLayout>
        <div class="flex justify-center items-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800">{{ $page.props.code }}</h1>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $page.props.message }}</h2>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../Layouts/AdminLayout.vue';


export default {
    name: 'Errors/ErrorPage',

    components: { AdminLayout },
}


</script>