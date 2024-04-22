<template>
    <div>
        <label :for="filter.id" class="block text-sm font-medium text-gray-700">{{ filter.label }}</label>
        <template v-if="filter.type === 'text'">
            <input :value="value" @input="updateValue($event.target.value)" :id="filter.id" :name="filter.id"
                type="text"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </template>

        <!-- type select -->
        <template v-else-if="filter.type === 'select'">
            <select :value="value" @change="updateValue($event.target.value)" :id="filter.id" :name="filter.id"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <option value="">{{ filter.placeholder }}</option>
                <option v-for="option in filter.options" :value="option.value" :key="option.value">{{ option.label }}
                </option>
            </select>
        </template>

        <!-- type number -->
        <template v-else-if="filter.type === 'number'">
            <input :value="value" @input="updateValue($event.target.value)" :id="filter.id" :name="filter.id"
                type="number"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </template>

        <!-- price dropdown -->
        <template v-else-if="filter.type === 'price'">
            <div class="mt-1 relative rounded-md shadow-sm">
                <select v-model="value" @change="updateValue($event.target.value)" :id="filter.id" :name="filter.id"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-12 sm:text-sm border-gray-300 rounded-md">
                    <option value="">Selectează prețul</option>
                    <option v-for="priceRange in priceRanges" :value="priceRange.value" :key="priceRange.value">
                        {{ priceRange.label }}
                    </option>
                    <!-- Add more predefined price ranges as needed -->
                </select>
            </div>
        </template>

        <!-- type date -->
        <template v-else-if="filter.type === 'date'">
            <input :value="value" @input="updateValue($event.target.value)" :id="filter.id" :name="filter.id"
                type="date"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </template>
    </div>
</template>

<script>
export default {
    props: {
        filter: {
            type: Object,
            required: true
        },
        value: {
            type: [String, Number, Array],
            default: ''
        },
        onUpdateValue: {
            type: Function,
            required: true
        }
    },

    data() {
        return {
            priceRanges: [
                { value: [0, 10], label: 'Sub 10 RON' },
                { value: [10, 50], label: '10 RON - 50 RON' },
                { value: [50, 100], label: '50 RON - 100 RON' },
                { value: [100, Infinity], label: 'Peste 100 RON' },
                // Add more predefined price ranges as needed
            ]
        }
    },

    methods: {
        updateValue(newValue) {
            this.onUpdateValue(newValue);
        }
    }
};
</script>