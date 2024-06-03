<template>
    <div>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ title }}</h3>
            <p class="mt-1 max-w-2xl text-md leading-6 text-gray-500">{{ subtitle }}</p>
            <dd class="flex justify-end mt-1 text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <span class="ml-4 flex-shrink-0">
                    <button @click="toggleEdit"
                        class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">
                        {{ editing ? 'Salvează' : 'Editează' }}
                    </button>
                </span>
            </dd>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <Attribute v-for="attribute in attributes" :key="attribute.name" :label="attribute.label"
                    :value="attribute.value" v-model="form[attribute.model]" :editing="editing"
                    :error="errors[attribute.name]" :inputType="attribute.inputType" :options="attribute.options"
                    :name="attribute.name" />
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
                                            Salvezi modificarile ?</DialogTitle>
                                    </div>
                                </div>
                                <div class="flex flex-row gap-5 mt-5 sm:mt-6">
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click="update">Da</button>
                                    <button
                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                                        @click="cancel">Nu</button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Attribute from './Attribute.vue';
import { CheckIcon } from '@heroicons/vue/24/outline';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

export default {
    name: 'AttributeList',
    components: { Attribute, CheckIcon, Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot },
    props: {
        attributes: Array,
        title: String,
        subtitle: String,
        initialData: Object,
        routeName: String,
        errors: Object,
    },
    setup(props) {
        const form = useForm({ ...props.initialData });
        const editing = ref(false);
        const open = ref(false);

        const toggleEdit = () => {
            editing.value = !editing.value;
            if (!editing.value) {
                open.value = detectChanges();
            }
        };

        const arraysEqual = (a, b) => {
            if (a.length !== b.length) return false;
            const sortedA = [...a].sort();
            const sortedB = [...b].sort();
            return sortedA.every((value, index) => value === sortedB[index]);
        };

        const detectChanges = () => {
            const changes = Object.keys(props.initialData).filter(key => {
                if (key === 'groups') {
                    return !arraysEqual(form[key], props.initialData[key]);
                }
                return form[key] !== props.initialData[key];
            });

            return changes.length > 0;
        };

        const update = () => {
            form.put(route(props.routeName, props.initialData.id), {
                onSuccess: () => {
                    open.value = false;
                    editing.value = false;
                },
            });
        };

        const cancel = () => {
            open.value = false;
            form.reset();
        };

        return {
            form,
            editing,
            open,
            toggleEdit,
            detectChanges,
            update,
            cancel,
        };
    },
};
</script>

<style scoped>
/* Add any custom styles here if necessary */
</style>