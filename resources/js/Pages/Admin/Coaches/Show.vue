<template>
    <DashboardLayout>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Informații antrenor</h3>
            <p class="mt-1 max-w-2xl text-md leading-6 text-gray-500">Detalii personale</p>
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
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Nume</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ coach.first_name }}</span>
                        <input v-else v-model="form.editedFirstName" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.first_name">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.first_name }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Prenume</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ coach.last_name }}</span>
                        <input v-else v-model="form.editedLastName" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.last_name">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.last_name }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Vârstă</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ coach.date_of_birth }}</span>
                        <input v-else v-model="form.editedDateOfBirth" class="flex-grow" type="date">
                    </dd>
                    <template v-if="$attrs.errors.last_name">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.date_of_birth }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Email</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ coach.email }}</span>
                        <input v-else v-model="form.editedEmail" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.email">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.email }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Telefon</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ coach.phone }}</span>
                        <input v-else v-model="form.editedPhone" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.phone">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.phone }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Descriere</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ coach.description }}</span>
                        <textarea rows="5" v-else v-model="form.editedDescription" class="flex-grow">
                </textarea>
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
                                        @click="updateCoach">Da</button>
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
    </DashboardLayout>
</template>


<script>
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';

export default {
    name: 'Player/Show',

    components: { DashboardLayout },

    props: {
        coach: Object,
        // groups: Array,
    },

    data() {
        return {
            editing: false,
            open: false,
            form: {
                editedFirstName: this.coach.first_name,
                editedLastName: this.coach.last_name,
                editedDateOfBirth: this.coach.date_of_birth,
                editedDescription: this.coach.description,
                editedEmail: this.coach.email,
                editedPhone: this.coach.phone,
            },

            updatedCoachData: {
                first_name: '',
                last_name: '',
                date_of_birth: '',
                description: '',
                email: '',
                phone: '',
            },
        };
    },

    methods: {
        toggleEdit() {
            this.editing = !this.editing;
            if (!this.editing) {
                // Check if any changes were made
                const changesDetected =
                    this.form.editedFirstName !== this.coach.first_name ||
                    this.form.editedLastName !== this.coach.last_name ||
                    this.form.editedDateOfBirth !== this.coach.date_of_birth ||
                    this.form.editedDescription !== this.coach.description ||
                    this.form.editedEmail !== this.coach.email ||
                    this.form.editedPhone !== this.coach.phone;

                if (changesDetected) {
                    // Make a request to update the player
                    this.updatedCoachData.first_name = this.form.editedFirstName;
                    this.updatedCoachData.last_name = this.form.editedLastName;
                    this.updatedCoachData.date_of_birth = this.form.editedDateOfBirth;
                    this.updatedCoachData.description = this.form.editedDescription;
                    this.updatedCoachData.email = this.form.editedEmail;
                    this.updatedCoachData.phone = this.form.editedPhone;

                    this.open = true;
                }
            }
        },

        updateCoach() {
            this.$inertia.put(route('admin.dashboard.coaches.update', this.coach), this.updatedCoachData);
            if (this.$attrs.errors) {
                this.editing = true;
            }
            this.open = false;
        },

        cancelUpdate() {
            this.open = false;

            // reset the form
            this.form = {
                editedFirstName: this.coach.first_name,
                editedLastName: this.coach.last_name,
                editedDateOfBirth: this.coach.date_of_birth,
                editedDescription: this.coach.description,
                editedEmail: this.coach.email,
                editedPhone: this.coach.phone,
            };
        }
    },
}

</script>

<script setup>
import { PaperClipIcon } from '@heroicons/vue/20/solid'
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'

</script>