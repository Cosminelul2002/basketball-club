<template>
    <Layout>
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl sm:text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Cunoaște-i pe antrenorii
                        noștri</h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Suntem o echipă dinamică de profesioniști pasionați
                        de baschet și dedicați să obținem cele mai bune rezultate pentru echipa noastră.</p>
                </div>
                <ul role="list"
                    class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-20 sm:grid-cols-2 lg:max-w-4xl lg:gap-x-8 xl:max-w-none">
                    <li v-for="coach in coaches" :key="coach.id" class="flex flex-col gap-6 xl:flex-row">
                        <div class="flex-none rounded-2xl ">
                            <inertia-link :href="route('coaches.show', coach)">
                                <img class="aspect-[4/5] w-52 flex-none rounded-2xl object-cover" :src="coach.image"
                                    alt="" />
                            </inertia-link>
                        </div>
                        <div class="flex-auto">
                            <inertia-link :href="route('coaches.show', coach)">
                                <h3
                                    class="text-lg font-semibold leading-8 tracking-tight text-gray-900 hover:text-slate-500">
                                    {{
                        coach.first_name
                    }} {{ coach.last_name }}</h3>
                            </inertia-link>
                            <p class="text-base leading-7 text-gray-600">{{ coach.role }}</p>
                            <p class="mt-6 text-base leading-7 text-gray-600">{{ coach.description }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';

export default {
    name: 'CoachesShow',

    components: {
        Layout,
    },

    mounted() {
        this.mapImage();
    },

    props: {
        coaches: Array,
    },

    methods: {
        mapImage() {
            this.coaches.map((coach) => {
                coach.image = '../images/' + coach.image;
            })
        }
    }

}

</script>
