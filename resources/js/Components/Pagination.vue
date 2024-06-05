<template>

    <div>
        <component :is="link.url ? 'inertia-link' : 'span'" v-for="link in links" :href="link.url" v-html="link.label"
            class="p-2"
            :class="{ 'text-gray-500': !link.url, 'font-bold': link.active }" />
    </div>

</template>

<script>

export default {
    name: 'Pagination',

    props: {
        links: Array,
    }
}

</script>