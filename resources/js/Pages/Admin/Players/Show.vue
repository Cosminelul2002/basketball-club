<template>
    <AdminLayout>
        <AttributeList :attributes="attributes" title="Informații jucător" subtitle="Detalii personale"
            :initialData="initialData" routeName="admin.dashboard.players.update" :errors="$attrs.errors" />
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import AttributeList from '../../../Components/AttributeList.vue';

export default {
    name: 'PlayerShow',
    components: { AdminLayout, AttributeList },
    props: {
        player: Object,
        groups: Array,
    },
    computed: {
        attributes() {
            return [
                { label: 'Nume', value: this.player.first_name, model: 'first_name', name: 'first_name' },
                { label: 'Prenume', value: this.player.last_name, model: 'last_name', name: 'last_name' },
                { label: 'Data nașterii', value: this.player.date_of_birth, model: 'date_of_birth', name: 'date_of_birth', inputType: 'date' },
                {
                    label: 'Grupe de vârstă',
                    value: this.groupNames,
                    model: 'groups',
                    name: 'groups',
                    inputType: 'checkbox-group',
                    options: this.groups.map(group => ({ name: group.name, id: group.id })),
                },
                { label: 'Nivel', value: this.player.skill_level, model: 'skill_level', name: 'skill_level', inputType: 'select', options: ['Începător', 'Intermediar', 'Avansat'] },
                { label: 'Înălțime', value: `${this.player.height} cm`, model: 'height', name: 'height', inputType: 'number' },
                { label: 'Greutate', value: `${this.player.weight} kg`, model: 'weight', name: 'weight', inputType: 'number' },
                { label: 'Nume părinte', value: this.player.parent_name, model: 'parent_name', name: 'parent_name' },
                { label: 'Număr de telefon părinte', value: this.player.parent_phone, model: 'parent_phone', name: 'parent_phone', inputType: 'text' },
            ];
        },
        initialData() {
            return {
                id: this.player.id,
                first_name: this.player.first_name,
                last_name: this.player.last_name,
                date_of_birth: this.player.date_of_birth,
                groups: this.player.groups.map(group => group.id),
                skill_level: this.player.skill_level,
                height: this.player.height,
                weight: this.player.weight,
                parent_name: this.player.parent_name,
                parent_phone: this.player.parent_phone,
            };
        },
        groupNames() {
            return this.player.groups ? this.player.groups.map(group => group.name).join(', ') : 'Fără grupă';
        }
    }
};
</script>