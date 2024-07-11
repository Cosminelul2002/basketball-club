<template>
    <DashboardLayout>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Calendar</h1>
                    <p class="mt-2 text-md text-gray-700">Calendar cu evenimentele tale.</p>
                </div>

                <!-- Add Events Button -->
                <div v-if="events.length != 0" class="mt-4 sm:ml-10 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.events.index')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Vezi
                        evenimentele tale</inertia-link>
                </div>


                <div v-if="events.length != 0" class="mt-4 sm:ml-10 sm:mt-0 sm:flex-none">
                    <inertia-link :href="route('admin.dashboard.events.create')"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-md font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Adaugă
                        eveniment nou</inertia-link>
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-hidden sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="calendar-container is-light-mode">
                            <Qalendar :events="events" :config="config" @edit-event="handleEditEvent" />
                        </div>

                        <!-- <div class="is-light-mode">
                            <DatePicker locale="en-US" firstDayOfWeek="sunday" :disable-dates="disableDates"
                                :default-date="new Date(2022, 5, 1)" @updated="handleUpdate" />
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../../Layouts/DashboardLayout.vue';
import { Qalendar } from "qalendar";
import { DatePicker } from "qalendar";

export default {
    name: "Calendar/Show",

    components: { DashboardLayout, Qalendar, DatePicker },

    props: {
        events: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            config: {
                week: {
                    // Takes the value 'sunday' or 'monday'
                    // However, if startsOn is set to 'sunday' and nDays to 5, the week displayed will be Monday - Friday
                    startsOn: 'monday',
                    // Takes the values 5 or 7.
                    nDays: 7,
                    // Scroll to a certain hour on mounting a week. Takes any value from 0 to 23.
                    // This option is not compatible with the 'dayBoundaries'-option, and will simply be ignored if custom day boundaries are set.
                    scrollToHour: 5,
                },
                month: {
                    // Hide leading and trailing dates in the month view (defaults to true when not set)
                    showTrailingAndLeadingDates: false,
                },
                // Takes any valid locale that the browser understands. However, not all locales have been thorougly tested in Qalendar
                // If no locale is set, the preferred browser locale will be used
                locale: 'ro-RO',
                // if not set, the mode defaults to 'week'. The three available options are 'month', 'week' and 'day'
                // Please note, that only day and month modes are available for the calendar in mobile-sized wrappers (~700px wide or less, depending on your root font-size)
                defaultMode: 'month',
                // The silent flag can be added, to disable the development warnings. This will also bring a slight performance boost
                isSilent: true,
                showCurrentTime: true,
            }
        }
    },

    methods: {
        handleUpdate(payload) {
            const { year, month, date } = payload;
        },

        handleEditEvent(event) {
            let targetEvent = this.events.find(e => e.id === event);

            this.$inertia.visit(route('admin.dashboard.events.show', targetEvent));
        },
    },
}

</script>

<style>
@import "qalendar/dist/style.css";

.calendar-container {
    height: 70vh;
    max-width: 100%;
    overflow: hidden;
}

@media (min-width: 768px) {
    .calendar-container {
        height: 76vh;
    }
}
</style>