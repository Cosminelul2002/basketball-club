<template>
    <GenericList :items="locations" :columns="columns" :filters="filters" :prevFilters="prevFilters" title="Locații"
        description="Listă Locații." getRoute="admin.dashboard.locations.index"
        createRoute="admin.dashboard.locations.create" entityName="locație"
        editRouteName="admin.dashboard.locations.show" deleteRouteName="admin.dashboard.locations.destroy" />
    />
</template>

<script>
import GenericList from '../../../Components/GenericList.vue';

export default {

    name: "Locations/List",

    components: { GenericList },

    computed: {
        columns() {
            return [
                { name: 'address', label: 'Adresă' },
                { name: 'city', label: 'Sector' },
                { name: 'area', label: 'Zonă' },
            ];
        },
        filters() {
            return [
                { model: 'searchAddress', label: 'Filtru după adresă', type: 'text' },
                { model: 'searchCity', label: 'Filtru după sector', type: 'text' },
                { model: 'searchArea', label: 'Filtru după zonă', type: 'text' },
            ];
        },
    },

    props: {
        locations: Object,
        prevFilters: Object,
    },
}

</script>