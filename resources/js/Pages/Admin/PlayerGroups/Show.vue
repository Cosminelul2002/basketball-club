<template>
    <AdminLayout>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Informații locație</h3>
            <p class="mt-1 max-w-2xl text-md leading-6 text-gray-500">Detalii generale</p>
            <dd class="flex justify-end mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <span class="ml-4 flex-shrink-0">
                    <template v-if="editing">
                        <button @click="toggleEdit"
                            class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Salvează</button>
                    </template>
                    <template v-else>
                        <button @click="toggleEdit"
                            class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Editează</button>
                    </template>

                </span>
            </dd>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <!-- Name -->
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Nume</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ playerGroup.name }}</span>
                        <input v-else v-model="form.editedName" class="flex-grow">
                    </dd>
                </div>
                <!-- Description -->
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Descriere</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ playerGroup.description }}</span>
                        <input v-else v-model="form.editedDescription" class="flex-grow">
                    </dd>
                </div>
                <!-- Tax -->
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Taxă</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ playerGroup.tax }}</span>
                        <input v-else v-model="form.editedTax" class="flex-grow">
                    </dd>
                </div>
                <!-- Coaches -->
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Antrenori</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">
                            <ul>
                                <li v-for="coach in playerGroup.coaches" :key="coach.id">{{ coach.first_name }} {{
                        coach.last_name }}</li>
                            </ul>
                        </span>
                        <span v-else class="flex-grow">
                            <template v-for="coach in coaches">
                                <label :for="`coach_${coach.id}`" class="inline-flex items-center mr-4">
                                    <input type="checkbox" :id="`coach_${coach.id}`" :value="coach.id"
                                        v-model="form.selectedCoaches" :checked="isCoachSelected(coach)">
                                    <span class="ml-2">{{ coach.first_name }} {{ coach.last_name }}</span>
                                </label>
                            </template>
                        </span>
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
                                            Salvezi
                                            modificarile ?</DialogTitle>
                                    </div>
                                </div>
                                <div class="flex flex-row gap-5 mt-5 sm:mt-6">
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click="updateLocation">Da</button>
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
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

    name: "Admin/PlayerGroups/Show",

    components: { AdminLayout },

    props: {
        playerGroup: Object,
        coaches: Array,
    },

    data() {
        return {
            editing: false,
            open: false,
            form: {
                editedName: this.playerGroup.name,
                editedDescription: this.playerGroup.description,
                editedTax: this.playerGroup.tax,
                selectedCoaches: this.playerGroup.coaches.map(coach => coach.id),
            },

            updatedPlayerGroupData: {
                name: '',
                description: '',
                tax: '',
                coaches: [],
            },
        };
    },

    methods: {
        toggleEdit() {
            this.editing = !this.editing;
            if (!this.editing) {
                // Check if any changes were made
                const changesDetected =
                    this.form.editedName !== this.playerGroup.name ||
                    this.form.editedDescription !== this.playerGroup.description ||
                    this.form.editedTax !== this.playerGroup.tax ||
                    !this.arraysAreEqual(this.form.selectedCoaches, this.playerGroup.coaches.map(coach => coach.id));
                if (changesDetected) {
                    // Make a request to update the player
                    this.updatedPlayerGroupData.name = this.form.editedName;
                    this.updatedPlayerGroupData.description = this.form.editedDescription;
                    this.updatedPlayerGroupData.tax = this.form.editedTax;
                    this.updatedPlayerGroupData.coaches = this.form.selectedCoaches;

                    this.open = true;
                }
            }
        },

        updateLocation() {
            console.log(this.updatedPlayerGroupData);
            this.$inertia.put(route('admin.dashboard.groups.update', this.playerGroup), this.updatedPlayerGroupData);
            if (this.$attrs.errors) {
                this.editing = true;
            }
            this.open = false;
        },

        cancelUpdate() {
            this.open = false;

            // reset the form
            this.form = {
                editedName: this.playerGroup.name,
                editedDescription: this.playerGroup.description,
                editedTax: this.playerGroup.tax,
                selectedCoaches: [],
            };
        },

        isCoachSelected(coach) {
            return this.playerGroup.coaches.some(c => c.id === coach.id);
        },

        arraysAreEqual(arr1, arr2) {
            if (arr1.length !== arr2.length) return false;
            for (let i = 0; i < arr1.length; i++) {
                if (arr1[i] !== arr2[i]) return false;
            }
            return true;
        },
    },
}

</script>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'

</script>