<template>
    <Layout>
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl space-y-16 divide-y divide-gray-100 lg:mx-0 lg:max-w-none">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Contactați-ne</h2>
                            <p class="mt-4 leading-7 text-gray-600">Quam nunc nunc eu sed. Sed rhoncus quis
                                ultricies ac pellentesque.</p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                            <div class="rounded-2xl bg-gray-50 p-10" v-for="coach in coaches">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">{{ coach.first_name }} {{
                                coach.last_name }}</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-600">{{ coach.role }}</p>
                                <dl class="mt-3 space-y-1 text-sm leading-6 text-gray-600">
                                    <div>
                                        <dt class="sr-only">Email</dt>
                                        <dd><a class="font-semibold text-indigo-600" :href="'mailto:' + coach.email">{{
                                coach.email }}</a></dd>
                                    </div>
                                    <div class="mt-1">
                                        <dt class="sr-only">Phone number</dt>
                                        <dd>{{ coach.phone }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Formular de contact</h2>
                            <p class="mt-4 leading-7 text-gray-600">Quam nunc nunc eu sed. Sed rhoncus quis
                                ultricies ac pellentesque.</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 pt-16 lg:grid-cols-3">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Locații</h2>
                            <p class="mt-4 leading-7 text-gray-600">Consequat sunt cillum cillum elit sint. Qui
                                occaecat nisi in ipsum commodo.</p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                            <div class="rounded-2xl bg-gray-50 p-10" v-for="location in locations">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">{{ location.area }}</h3>
                                <dl class="mt-3 space-y-1 text-sm leading-6 text-gray-600">
                                    <div>
                                        <dt class="sr-only">Adresa</dt>
                                        <dd>{{ location.address }}</dd>
                                    </div>
                                    <div class="mt-1">
                                        <dt class="sr-only">Orsaș</dt>
                                        <dd>{{ location.city }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '../../Layouts/Layout.vue';


export default {
    name: "Contact/Show",

    components: { Layout },

    props: {
        coaches: Array,
        locations: Array,
    }
}

</script>