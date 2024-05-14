<template>
    <AdminLayout>
        <div class="max-w-2xl mx-auto p-4 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-semibold mb-6">Create Event</h1>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                    <input type="text" id="title" v-model="form.title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea id="description" v-model="form.description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700 font-semibold mb-2">Start Time</label>
                    <input type="datetime-local" id="start_time" v-model="form.start_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 font-semibold mb-2">End Time</label>
                    <input type="datetime-local" id="end_time" v-model="form.end_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="color" class="block text-gray-700 font-semibold mb-2">Color</label>
                    <input type="color" id="color" v-model="form.color"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="is_all_day" class="block text-gray-700 font-semibold mb-2">All Day Event</label>
                    <select id="is_all_day" v-model="form.is_all_day"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                    <input type="text" id="location" v-model="form.location"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
                    <select id="status" v-model="form.status" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        required>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Create
                    Event</button>
            </form>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';

export default {

    name: "Calendar/Create",

    components: { AdminLayout },

    data() {
        return {
            form: {
                title: '',
                description: '',
                start_time: '',
                end_time: '',
                color: '#000000',
                is_all_day: false,
                location: '',
                status: 'scheduled'
            }
        };
    },
    methods: {
        submitForm() {
            // Perform form submission logic here, e.g., make an API call
            console.log(this.form);
            // Example API call
            // axios.post('/api/events', this.form)
            //   .then(response => {
            //     // handle success
            //   })
            //   .catch(error => {
            //     // handle error
            //   });
        }
    }
};
</script>

<style scoped>
/* Add any additional styles here */
</style>