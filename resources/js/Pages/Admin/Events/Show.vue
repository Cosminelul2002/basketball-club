<template>
    <AdminLayout>
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-semibold leading-7 text-gray-900">Informații eveniment</h3>
            <p class="mt-1 max-w-2xl text-md leading-6 text-gray-500">Detalii generale</p>
            <dd class="flex justify-end mt-1 text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                <!-- Calendar Redirect Button -->
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.calendar.index')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Calendar</inertia-link>
                </div>

                <span class="ml-4 flex-shrink-0">
                    <template v-if="editing">
                        <button @click="toggleEdit"
                            class="rounded-md bg-indigo-600 text-white font-medium px-4 py-2 hover:bg-indigo-500">Salvează</button>
                    </template>
                    <template v-else>
                        <button @click="toggleEdit"
                            class="rounded-md bg-indigo-600 text-white font-medium px-4 py-2 hover:bg-indigo-500">Editează</button>
                    </template>
                </span>
            </dd>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Titlul</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ form.editedTitle }}</span>
                        <input v-else v-model="form.editedTitle" class="flex-grow border rounded-md px-2 py-1">
                    </dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Descriere</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ form.editedDescription }}</span>
                        <textarea v-else v-model="form.editedDescription"
                            class="flex-grow border rounded-md px-2 py-1"></textarea>
                    </dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Ora de început</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ form.editedStartTime }}</span>
                        <input type="datetime-local" v-else v-model="form.editedStartTime"
                            class="flex-grow border rounded-md px-2 py-1">
                    </dd>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Ora de sfârșit</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ form.editedEndTime }}</span>
                        <input type="datetime-local" v-else v-model="form.editedEndTime"
                            class="flex-grow border rounded-md px-2 py-1">
                    </dd>
                </div>
            </dl>
        </div>
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel
                                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                <div>
                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                        <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                                            Salvezi modificarile?
                                        </DialogTitle>
                                    </div>
                                </div>
                                <div class="flex flex-row gap-5 mt-5 sm:mt-6">
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click="updateEvent">Da</button>
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-md font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                                        @click="cancelUpdate">Nu</button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout.vue';

export default {
    name: "Admin/Events/Show",
    components: { AdminLayout },
    props: {
        event: Object,
    },
    data() {
        return {
            editing: false,
            open: false,
            form: {
                editedTitle: this.event.title,
                editedDescription: this.event.description,
                editedStartTime: this.event.start_time,
                editedEndTime: this.event.end_time,
            },
            updatedEventData: {
                title: '',
                description: '',
                start_time: '',
                end_time: '',
            },
        };
    },
    methods: {
        toggleEdit() {
            this.editing = !this.editing;
            if (!this.editing) {
                // Check if any changes were made
                const changesDetected =
                    this.form.editedTitle !== this.event.title ||
                    this.form.editedDescription !== this.event.description ||
                    this.form.editedStartTime !== this.event.start_time ||
                    this.form.editedEndTime !== this.event.end_time;
                if (changesDetected) {
                    // Make a request to update the event
                    this.updatedEventData.title = this.form.editedTitle;
                    this.updatedEventData.description = this.form.editedDescription;
                    this.updatedEventData.start_time = this.form.editedStartTime;
                    this.updatedEventData.end_time = this.form.editedEndTime;

                    this.open = true;
                }
            }
        },
        updateEvent() {
            this.$inertia.put(route('admin.dashboard.events.update', this.event.id), this.updatedEventData);
            if (this.$attrs.errors) {
                this.editing = true;
            }
            this.open = false;
        },
        cancelUpdate() {
            this.open = false;

            // reset the form
            this.form = {
                editedTitle: this.event.title,
                editedDescription: this.event.description,
                editedStartTime: this.event.start_time,
                editedEndTime: this.event.end_time,
            };
        }
    },
}
</script>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'
</script>

<style scoped>
/* Add any additional styles here */
</style>
