<template>
    <GenericList :items="staff" :columns="columns" :filters="filters" :prevFilters="prevFilters" title="Staff"
        description="Listă Staff." getRoute="admin.dashboard.staff.index" createRoute="admin.dashboard.staff.create"
        editRouteName="admin.dashboard.staff.show" deleteRouteName="admin.dashboard.staff.destroy" entityName="staff" />
</template>

<script>
import GenericList from '../../../Components/GenericList.vue';


export default {
    name: "Admin/Staff/List",
    components: {
        GenericList
    },
    props: {
        staff: Object,
        salaries: Array,
        roles: Array,
        prevFilters: Object,
    },
    computed: {
        columns() {
            return [
                { name: 'first_name', label: 'Nume' },
                { name: 'last_name', label: 'Prenume' },
                { name: 'email', label: 'Email' },
                { name: 'phone', label: 'Număr de telefon' },
                { name: 'date_of_birth', label: 'Data naștere' },
                {
                    name: 'salary', label: 'Salariu', isTemplate: true, template: (item) => {
                        return item.salary ? item.salary : 'Fără salariu';
                    },
                    isHref: true,
                    href: (item) => {
                        return route('admin.dashboard.salaries.show', item.salary);
                    }
                },
                { name: 'role', label: 'Role', isTemplate: true, template: (item) => {
                    return item.role ? item.role : 'Fără rol';
                
                }},
            ];
        },
        filters() {
            return [
                { model: 'searchName', label: 'Filtru după nume', type: 'text' },
                {
                    model: 'searchSalary', label: 'Filtru după salariu', type: 'select',
                    placeholder: 'Alegeți un salariu', options: this.salaries.map(salary => ({ value: salary.name, label: salary.name }))
                },
                {
                    model: 'searchRole', label: 'Filtru după rol', type: 'select',
                    placeholder: 'Alegeți un rol', options: this.roles.map(role => ({ value: role.name, label: role.name }))
                },
                { model: 'searchYear', label: 'Filtru după an', type: 'text' },
                // { model: 'searchYear', label: 'Filtru după an', type: 'text' },
            ];
        },
    }
}


</script>