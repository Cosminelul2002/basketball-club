<template>
    <AdminLayout>
        <div class="max-w-2xl mx-auto p-4 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-semibold mb-6">Creează Eveniment</h1>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Titlu</label>
                    <input type="text" id="title" v-model="form.title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Descriere</label>
                    <textarea id="description" v-model="form.description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700 font-semibold mb-2">Ora de început</label>
                    <input type="datetime-local" id="start_time" v-model="form.start_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 font-semibold mb-2">Ora de sfârșit</label>
                    <input type="datetime-local" id="end_time" v-model="form.end_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="color" class="block text-gray-700 font-semibold mb-2">Culoare</label>
                    <select id="color" v-model="form.color" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="red">Roșu</option>
                        <option value="blue">Albastru</option>
                        <option value="green">Verde</option>
                        <option value="yellow">Galben</option>
                        <option value="purple">Mov</option>
                    </select>
                </div>
                <div class="flex flex-row mb-4 w-12/12">
                    <div class="w-6/12">
                        <label class="block text-gray-700 font-semibold mb-2">Eveniment pe toată ziua</label>
                        <div class="flex items-center">
                            <input type="radio" id="all_day_yes" :value=true v-model="form.is_all_day" class="mr-2">
                            <label for="all_day_yes" class="mr-4">Da</label>
                            <input type="radio" id="all_day_no" :value=false v-model="form.is_all_day" class="mr-2">
                            <label for="all_day_no">Nu</label>
                        </div>
                    </div>
                    <div class="w-6/12">
                        <label class="block text-gray-700 font-semibold mb-2">Adaugă în calendar</label>
                        <div class="flex items-center">
                            <input type="radio" id="in_calendar_yes" :value=true v-model="form.in_calendar"
                                class="mr-2">
                            <label for="in_calendar_yes" class="mr-4">Da</label>
                            <input type="radio" id="in_calendar_no" :value=false v-model="form.in_calendar"
                                class="mr-2">
                            <label for="in_calendar_no">Nu</label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Locație</label>
                    <input type="text" id="location" v-model="form.location"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Stare</label>
                    <select id="status" v-model="form.status" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        required>
                        <option value="scheduled">Programat</option>
                        <option value="completed">Finalizat</option>
                        <option value="cancelled">Anulat</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Creează
                    Eveniment</button>
            </form>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';

export default {
    name: "Admin/Events/Create",

    components: { AdminLayout },

    data() {
        return {
            form: {
                title: '',
                description: '',
                start_time: '',
                end_time: '',
                color: '#000000',
                is_all_day: '',
                in_calendar: '',
                location: '',
                status: 'scheduled'
            }
        };
    },
    methods: {
        submitForm() {
            this.$inertia.post(route('admin.dashboard.events.store'), this.form);
        }
    }
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
