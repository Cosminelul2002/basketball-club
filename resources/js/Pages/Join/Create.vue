<template>
    <div class="relative bg-white">
        <div class="lg:absolute lg:inset-0 lg:left-1/2">
            <img class="h-64 w-full bg-gray-50 object-cover sm:h-80 lg:absolute lg:h-full" :src="join" alt="" />
        </div>
        <div class="pb-24 pt-16 sm:pb-32 sm:pt-24 lg:mx-auto lg:grid lg:max-w-7xl lg:grid-cols-2 lg:pt-32 h-screen">
            <div class="absolute top-0 left-5 border-t border-gray-900/10 pt-8 cursor-pointer">
                <inertia-link :href="route('landing')"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Acasă</inertia-link>
            </div>
            <div class="px-6 lg:px-8">
                <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Hai să lucrăm împreună!</h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">Vino alături de noi pentru a construi viitorul
                        baschetului. Oferim oportunități incredibile pentru dezvoltare și succes. Hai să facem echipă și să
                        creăm momente memorabile pe terenul de joc!</p>
                    <div class="mt-16">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Nume
                                </label>
                                <div class="mt-2.5">
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        v-model="form.first_name" :class="{ 'border-red-500': errors.first_name }"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <span v-if="errors.first_name" class="text-red-500 text-sm">{{ errors.first_name
                                    }}</span>
                                </div>
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">Prenume
                                </label>
                                <div class="mt-2.5">
                                    <input type="text" name="first-name" id="last_name" autocomplete="given-name"
                                        v-model="form.last_name" :class="{ 'border-red-500': errors.last_name }"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <span v-if="errors.last_name" class="text-red-500 text-sm">{{ errors.last_name
                                    }}</span>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                                <div class="mt-2.5">
                                    <input type="text" name="email" id="email" autocomplete="given-name"
                                        v-model="form.email" :class="{ 'border-red-500': errors.email }"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.email
                                    }}</span>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="age" class="block text-sm font-semibold leading-6 text-gray-900">Data nasterii</label>
                                <div class="mt-2.5">
                                    <input type="text" name="age" id="age" autocomplete="given-name" v-model="form.age"
                                        :class="{ 'border-red-500': errors.age }"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <span v-if="errors.age" class="text-red-500 text-sm">{{ errors.age
                                    }}</span>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="flex justify-between text-sm leading-6">
                                    <label for="phone" class="block font-semibold text-gray-900">Număr de telefon</label>
                                    <p id="phone-description" class="text-gray-400">Optional</p>
                                </div>
                                <div class="mt-2.5">
                                    <input type="text" name="phone" id="phone" autocomplete="given-name"
                                        v-model="form.phone" :class="{ 'border-red-500': errors.phone }"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <span v-if="errors.phone" class="text-red-500 text-sm">{{ errors.phone
                                    }}</span>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="flex justify-between text-sm leading-6">
                                    <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Lasă-ne
                                        un mesaj</label>
                                    <p id="message-description" class="text-gray-400">Max 500 characters</p>
                                </div>
                                <div class="mt-2.5">
                                    <textarea id="message" name="message" rows="4" aria-describedby="message-description"
                                        v-model="form.message"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 flex justify-end border-t border-gray-900/10 pt-8">
                            <button @click="submit"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Trimite</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
            <transition enter-active-class="transform ease-out duration-300 transition"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                <div v-if="show"
                    class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <CheckCircleIcon class="h-6 w-6 text-green-400" aria-hidden="true" />
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">{{ $page.props.message }}</p>
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                <button type="button" @click="show = false"
                                    class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Join/Show',

    mounted() {
        this.$inertia.on('success', () => {
            this.show = true;
            setTimeout(() => {
                this.show = false;
            }, 3500);
        });
    },

    data() {
        return {
            join: 'images/join3.jpg',
            form: {
                first_name: null,
                last_name: null,
                email: null,
                age: null,
                phone: null,
                message: null
            },
            show: false,
            errors: {}
        }
    },

    methods: {
        submit() {
            this.errors = {};
            if (!this.form.first_name) this.errors.first_name = 'Numele este obligatoriu.';
            if (!this.form.last_name) this.errors.last_name = 'Prenumele este obligatoriu.';
            if (!this.form.email) this.errors.email = 'Email-ul este obligatoriu.';
            if (!this.form.age) this.errors.age = 'Vârsta este obligatorie.';
            if (!this.form.phone) this.errors.phone = 'Numărul de telefon este obligatoriu.';
            // validate phone number to be a number of max 10 digits and needs to start with 07
            if (this.form.phone && !/^(07)\d{8}$/.test(this.form.phone)) this.errors.phone = 'Numărul de telefon nu este valid.';

            if (Object.keys(this.errors).length === 0) {
                this.$inertia.post(route('join.store'), this.form);
                // reset form
                this.form = {
                    first_name: null,
                    last_name: null,
                    email: null,
                    age: null,
                    phone: null,
                    message: null
                }
            }
        },
    }
}

</script>


