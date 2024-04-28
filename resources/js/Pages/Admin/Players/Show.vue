<template>
    <AdminLayout>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Informații jucător</h3>
            <p class="mt-1 max-w-2xl text-md leading-6 text-gray-500">Detalii personale</p>
            <!-- <span class="flex justify-end ml-4 flex-shrink-0">
                <button type="button"
                    class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Editează</button>
            </span> -->
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
                        <!-- <input v-if="!editing" v-model="player.first_name" class="flex-grow border-none" readonly> -->
                        <span v-if="!editing" class="flex-grow">{{ player.first_name }}</span>
                        <input v-else v-model="form.editedFirstName" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.first_name">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.first_name }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Prenume</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.last_name }}</span>
                        <input v-else v-model="form.editedLastName" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.last_name">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.last_name }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Data nașterii</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.date_of_birth }}</span>
                        <input v-else v-model="form.editedDateOfBirth" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.date_of_birth">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.date_of_birth }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Grupă de vârstă</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.player_group.name }}</span>
                        <select v-else v-model="form.editedPlayerGroup" class="flex-grow">
                            <option v-for="group in groups" :key="group.id" :value="group.name">{{ group.name }}
                            </option>
                        </select>
                    </dd>
                    <template v-if="$attrs.errors.player_group_id">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.player_group_id }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Nivel</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.skill_level }}</span>
                        <select v-else v-model="form.editedSkillLevel" class="flex-grow">
                            <option v-for="skill_level in skill_levels" :key="skill_level" :value="skill_level">{{
                        skill_level
                    }}</option>
                        </select>
                        <!-- <input v-else v-model="form.editedSkillLevel" class="flex-grow"> -->
                    </dd>
                    <template v-if="$attrs.errors.skill_level">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.skill_level }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Înălțime</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.height }} cm</span>
                        <input v-else v-model="form.editedHeight" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.height">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.height }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Greutate</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.weight }} kg</span>
                        <input v-else v-model="form.editedWeight" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.weight">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.weight }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Nume părinte</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.parent_name }} </span>
                        <input v-else v-model="form.editedParentName" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.parent_name">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.parent_name }}</div>
                    </template>
                </div>
                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md font-medium leading-6 text-gray-900">Număr de telefon părinte</dt>
                    <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span v-if="!editing" class="flex-grow">{{ player.parent_phone }} </span>
                        <input v-else v-model="form.editedParentPhoneNumber" class="flex-grow">
                    </dd>
                    <template v-if="$attrs.errors.parent_phone">
                        <div class="mt-2 text-sm text-red-600">{{ $attrs.errors.parent_phone }}</div>
                    </template>
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
                                        @click="updatePlayer">Da</button>
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

export default {
    name: 'Player/Show',

    components: { AdminLayout },

    props: {
        player: Object,
        groups: Array,
    },

    data() {
        return {
            editing: false,
            open: false,
            skill_levels: ['Începător', 'Intermediar', 'Avansat'],
            form: {
                editedFirstName: this.player.first_name,
                editedLastName: this.player.last_name,
                editedDateOfBirth: this.player.date_of_birth,
                editedPlayerGroup: this.player.player_group.name,
                editedSkillLevel: this.player.skill_level,
                editedHeight: this.player.height,
                editedWeight: this.player.weight,
                editedParentName: this.player.parent_name,
                editedParentPhoneNumber: this.player.parent_phone,
            },
            updatedPlayerData: {
                first_name: '',
                last_name: '',
                date_of_birth: '',
                player_group: '',
                skill_level: '',
                height: '',
                weight: '',
                parent_name: '',
                parent_phone: '',
            }
        };
    },

    methods: {
        toggleEdit() {
            this.editing = !this.editing;
            if (!this.editing) {
                // Check if any changes were made
                const changesDetected =
                    this.form.editedFirstName !== this.player.first_name ||
                    this.form.editedLastName !== this.player.last_name ||
                    this.form.editedDateOfBirth !== this.player.date_of_birth ||
                    this.form.editedPlayerGroup !== this.player.player_group.name ||
                    this.form.editedSkillLevel !== this.player.skill_level ||
                    this.form.editedHeight !== this.player.height ||
                    this.form.editedWeight !== this.player.weight ||
                    this.form.editedParentName !== this.player.parent_name ||
                    this.form.editedParentPhoneNumber !== this.player.parent_phone;

                if (changesDetected) {
                    // Make a request to update the player
                    this.updatedPlayerData.first_name = this.form.editedFirstName;
                    this.updatedPlayerData.last_name = this.form.editedLastName;
                    this.updatedPlayerData.date_of_birth = this.form.editedDateOfBirth;
                    this.updatedPlayerData.player_group = this.form.editedPlayerGroup;
                    this.updatedPlayerData.skill_level = this.form.editedSkillLevel;
                    this.updatedPlayerData.height = this.form.editedHeight;
                    this.updatedPlayerData.weight = this.form.editedWeight;
                    this.updatedPlayerData.parent_name = this.form.editedParentName;
                    this.updatedPlayerData.parent_phone = this.form.editedParentPhoneNumber;

                    this.open = true;
                }
            }
        },

        updatePlayer() {
            this.$inertia.put(route('admin.dashboard.players.update', this.player), this.updatedPlayerData);
            if (this.$attrs.errors) {
                this.editing = true;
            }
            this.open = false;
        },

        cancelUpdate() {
            this.open = false;

            this.form.editedFirstName = this.player.first_name;
            this.form.editedLastName = this.player.last_name;
            this.form.editedDateOfBirth = this.player.date_of_birth;
            this.form.editedPlayerGroup = this.player.player_group.name;
            this.form.editedSkillLevel = this.player.skill_level;
            this.form.editedHeight = this.player.height;
            this.form.editedWeight = this.player.weight;
            this.form.editedParentName = this.player.parent_name;
            this.form.editedParentPhoneNumber = this.player.parent_phone;
        }
    },
}

</script>

<script setup>
import { PaperClipIcon } from '@heroicons/vue/20/solid'
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'

</script>