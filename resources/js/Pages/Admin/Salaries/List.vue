<template>
    <GenericList :items="salaries" :columns="columns" :filters="filters" :prevFilters="prevFilters" title="Salarii"
        description="Lista salariilor din club" entityName="salariu" getRoute="admin.dashboard.salaries.index"
        createRoute="admin.dashboard.salaries.create" editRouteName="admin.dashboard.salaries.show"
        deleteRouteName="admin.dashboard.salaries.destroy" />
</template>

<script>
import GenericList from '../../../Components/GenericList.vue';

export default {

    name: "Admin/Salaries/List",

    components: { GenericList },

    beforeMount() {
        console.log(this.salaries);
        for (let i = 0; i < this.salaries.data.length; i++) {
            this.salaries.data[i].duration_type = this.translateDurationType(this.salaries.data[i].duration_type);
            this.salaries.data[i].type = this.translateSalaryType(this.salaries.data[i].type);
        }
    },

    computed: {

        columns() {
            return [
                { name: 'amount', label: 'Salariu' },
                { name: 'currency', label: 'Moneda' },
                { name: 'duration', label: 'Durată' },
                { name: 'duration_type', label: 'Tip durată' },
                { name: 'type', label: 'Tip salariu' },
                {
                    name: 'start_date', label: 'Data de început', isTemplate: true,
                    template: (item) => {
                        return item.start_date ? item.start_date : 'Nedeterminat';
                    }
                },
                {
                    name: 'end_date', label: 'Data de sfârșit', isTemplate: true,
                    template: (item) => {
                        return item.end_date ? item.end_date : 'Nedeterminat';
                    }
                },
            ];
        },

        filters() {
            return [
                { model: 'amount', label: 'Salariu', type: 'number' },
                {
                    model: 'type', label: 'Tip salariu', type: 'select', placeholder: 'Selectează tipul salariului', options: [
                        { value: 'fixed', label: 'Fix' },
                        { value: 'hourly', label: 'Pe oră' },
                        { value: 'daily', label: 'Zilnic' },
                        { value: 'weekly', label: 'Săptămânal' },
                        { value: 'monthly', label: 'Lunar' },
                        { value: 'commission', label: 'Comision' },
                        { value: 'bonus', label: 'Bonus' },
                        { value: 'other', label: 'Altele' }
                    ]
                },
                {
                    model: 'currency', label: 'Moneda', type: 'select',
                    placeholder: 'Selectează moneda', options: [
                        { value: 'RON', label: 'RON' },
                        { value: 'EUR', label: 'EUR' },
                        { value: 'USD', label: 'USD' },
                    ]
                },
                { model: 'duration', label: 'Durată', type: 'number' },
                {
                    model: 'duration_type', label: 'Tip durată', type: 'select', placeholder: 'Selectează tipul duratei', options: [
                        { value: 'years', label: 'Ani' },
                        { value: 'months', label: 'Luni' },
                        { value: 'weeks', label: 'Săptămâni' },
                        { value: 'days', label: 'Zile' }
                    ]
                },
                // { model: 'start_date', label: 'Data de început a salariului', type: 'date' },
                // { model: 'end_date', label: 'Data de sfârșit a salariului', type: 'date' },
            ];
        },
    },

    props: {
        salaries: Object,
        prevFilters: Object,
    },

    methods: {
        translateDurationType(value) {
            switch (value) {
                case 'years':
                    return 'Ani';
                case 'months':
                    return 'Luni';
                case 'weeks':
                    return 'Săptămâni';
                case 'days':
                    return 'Zile';
                default:
                    return value;
            }
        },

        translateSalaryType(value) {
            switch (value) {
                case 'fixed':
                    return 'Fix';
                case 'hourly':
                    return 'Pe oră';
                case 'daily':
                    return 'Zilnic';
                case 'weekly':
                    return 'Săptămânal';
                case 'monthly':
                    return 'Lunar';
                case 'commission':
                    return 'Comision';
                case 'bonus':
                    return 'Bonus';
                case 'other':
                    return 'Altele';
                default:
                    return value;
            }
        },
    }
};

</script>