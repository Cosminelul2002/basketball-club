<template>
    <Layout>
        <div class="flex items-center justify-center h-screen">
            <div class="text-center">
                <h1 class="text-6xl font-bold text-gray-800">{{ errorCode }}</h1>
                <h2 class="text-2xl font-bold text-gray-800">Oops! Something went wrong.</h2>
                <p class="text-lg text-gray-800">{{ errorMessage }}</p>
                <p class="text-sm text-gray-800">If the problem persists, please contact support.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';

export default {
    name: "PublicErrorPage",

    components: {
        Layout
    },

    props: {
        errorCode: {
            type: Number,
            required: true
        },
        errorMessage: {
            type: String,
            required: true
        }
    },
}

</script>
