<template>
    <div :class="field.colSpan">
        <label :for="field.name" class="block text-sm font-medium leading-6 text-gray-900">
            {{ field.label }}
        </label>
        <div class="mt-2">
            <component v-if="field.type !== 'select'" :is="field.type" :id="field.name" :name="field.name"
                :type="field.inputType" :autocomplete="field.autocomplete" v-model="modelValue" :class="inputClasses"
                :placeholder="field.placeholder" @input="updateValue" />
            <Dropdown v-else :modelValue="modelValue" :options="field.options" :error="error"
                @update:modelValue="updateValue" />
            <span v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</span>
        </div>
    </div>
</template>

<script>
import Dropdown from './Dropdown.vue'

export default {
    name: 'FormInput',
    
    components: {
        Dropdown
    },
    props: {
        field: {
            type: Object,
            required: true,
        },
        modelValue: {
            type: [String, Number, Boolean, Date, Array],
            default: '',
        },
        error: {
            type: String,
            default: '',
        },
    },
    emits: ['update:modelValue'],
    computed: {
        inputClasses() {
            return 'block w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm';
        },
    },
    methods: {
        updateValue(event) {
            const value = event.target ? event.target.value : event;
            this.$emit('update:modelValue', value);
        },
    },
};
</script>

<style scoped>
/* Add any custom styles here if necessary */
</style>