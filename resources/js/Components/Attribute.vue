<template>
    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <label :for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
        <dd class="mt-1 flex text-md leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <span v-if="!editing" class="flex-grow">{{ value }}</span>
            <template v-else>
                <template v-if="inputType === 'checkbox-group'">
                    <div class="flex gap-10">
                        <div v-for="option in options" :key="option.id" class="flex items-center">
                            <input type="checkbox" :id="option.id" :value="option.id"
                                :checked="modelValue.includes(option.id)" @change="toggleCheckbox(option.id)"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                            <label :for="option.id" class="ml-2 block text-sm text-gray-900">{{ option.name }}</label>
                        </div>
                    </div>
                </template>
                <input v-if="!options && inputType === 'text'" v-model="modelValue"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    :type="inputType" @input="updateValue" />
                <input v-if="inputType === 'number'" v-model="modelValue"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    :type="inputType" @input="updateValue" />
                <select v-if="options && inputType === 'select'" v-model="modelValue" @input="updateValue"
                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option v-for="option in options" :key="option" :value="option">{{ option }}</option>
                </select>
                <input v-if="inputType === 'date'" v-model="modelValue"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    :type="inputType" @input="updateValue" />
            </template>
        </dd>
        <template v-if="error">
            <div class="mt-2 text-sm text-red-600">{{ error }}</div>
        </template>
    </div>
</template>

<script>
export default {
    name: 'Attribute',
    props: {
        label: String,
        value: [String, Number, Array],
        modelValue: [String, Number, Array],
        editing: Boolean,
        options: Array,
        error: String,
        inputType: {
            type: String,
            default: 'text'
        }
    },
    emits: ['update:modelValue'],
    methods: {
        updateValue(event) {
            const value = event.target ? event.target.value : event;
            this.$emit('update:modelValue', value);
        },
        toggleCheckbox(value) {
            const newValue = this.modelValue.includes(value)
                ? this.modelValue.filter(item => item !== value)
                : [...this.modelValue, value];
            this.$emit('update:modelValue', newValue);
        }
    }
};
</script>