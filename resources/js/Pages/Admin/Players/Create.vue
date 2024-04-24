<template>
    <AdminLayout>
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nume</label>
                        <div class="mt-2">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                v-model="form.first_name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.first_name" class="text-red-500 text-sm">{{ errors.first_name
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Prenume</label>
                        <div class="mt-2">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                v-model="form.last_name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.last_name" class="text-red-500 text-sm">{{ errors.last_name
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">Greutate</label>
                        <div class="mt-2">
                            <input type="number" name="weight" id="weight" autocomplete="weight" v-model="form.weight"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.weight" class="text-red-500 text-sm">{{ errors.weight
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="height" class="block text-sm font-medium leading-6 text-gray-900">Înălțime</label>
                        <div class="mt-2">
                            <input type="number" name="height" id="height" autocomplete="height" v-model="form.height"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.height" class="text-red-500 text-sm">{{ errors.height
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="date-of-birth" class="block text-sm font-medium leading-6 text-gray-900">Data de
                            naștere</label>
                        <div class="mt-2">
                            <input type="date" name="date-of-birth" id="date-of-birth" autocomplete="date-of-birth"
                                v-model="form.date_of_birth"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.date_of_birth" class="text-red-500 text-sm">{{ errors.date_of_birth
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Număr de
                            telefon părinte</label>
                        <div class="mt-2">
                            <input id="phone" name="phone" autocomplete="phone" v-model="form.parent_phone"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.parent_phone" class="text-red-500 text-sm">{{ errors.parent_phone
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="parent_name" class="block text-sm font-medium leading-6 text-gray-900">Nume
                            părinte</label>
                        <div class="mt-2">
                            <input name="parent_name" id="parent_name" autocomplete="parent_name"
                                v-model="form.parent_name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <span v-if="errors.parent_name" class="text-red-500 text-sm">{{ errors.parent_name
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Nivel</label>
                        <div class="mt-2">
                            <select id="skill_level" name="skill_level" v-model="form.skill_level"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option v-for="option in skill_level_options" :value="option.value" :key="option.value">
                                    {{ option.label }}</option>
                            </select>
                            <span v-if="errors.skill_level" class="text-red-500 text-sm">{{ errors.skill_level
                                }}</span>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="group" class="block text-sm font-medium leading-6 text-gray-900">Grupă</label>
                        <div class="mt-2">
                            <select id="group" name="group" v-model="form.player_group_id"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option v-for="group in groups" :value="group.id" :key="group.id">{{ group.name }}
                                </option>
                            </select>
                            <span v-if="errors.group_id" class="text-red-500 text-sm">{{ errors.group_id
                                }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Anulează
                </button>
                <button @click="save"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Salvează
                </button>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';

export default {
    name: 'Players/Create',

    components: {
        AdminLayout,
    },

    props: {
        groups: Array,
    },

    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                weight: '',
                height: '',
                date_of_birth: '',
                parent_phone: '',
                parent_name: '',
                skill_level: '',
                player_group_id: '',
            },
            skill_level_options: [
                { value: 'Începător', label: 'Începător' },
                { value: 'Intermediar', label: 'Intermediar' },
                { value: 'Avansat', label: 'Avansat' },
            ],
            errors: {},
        }
    },

    methods: {
        save() {
            this.errors = {};
            if (!this.form.first_name) {
                this.errors.first_name = 'Numele este obligatoriu';
            }
            if (!this.form.last_name) {
                this.errors.last_name = 'Prenumele este obligatoriu';
            }
            if (!this.form.skill_level) {
                this.errors.skill_level = 'Nivelul este obligatoriu';
            }
            if (!this.form.parent_name) {
                this.errors.parent_name = 'Numele părintelui este obligatoriu';
            }
            if (!this.form.parent_phone) {
                this.errors.parent_phone = 'Numărul de telefon este obligatoriu';
            }
            if (this.form.parent_phone && !/^(07)\d{8}$/.test(this.form.parent_phone)) this.errors.parent_phone = 'Numărul de telefon nu este valid.';
            if (!this.form.date_of_birth) {
                this.errors.date_of_birth = 'Data de naștere este obligatorie';
            }
            if (!this.form.height) {
                this.errors.height = 'Înălțimea este obligatorie';
            }
            if (!this.form.weight) {
                this.errors.weight = 'Greutatea este obligatorie';
            }

            if (Object.keys(this.errors).length === 0) {
                this.$inertia.post(route('admin.dashboard.players.store'), this.form);
                this.form = {
                    first_name: null,
                    last_name: null,
                    skill_level: null,
                    date_of_birth: null,
                    parent_phone: null,
                    parent_name: null,
                    weight: null,
                    height: null,
                    player_group_id: null,
                }
            }
        }
    }
}

</script>