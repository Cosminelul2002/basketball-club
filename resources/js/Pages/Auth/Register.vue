<template>
    <div class="bg-[#3D52A0]">
        <div class="flex items-center justify-center h-screen">
            <div class="flex justify-center items-center p-10 gap-7 rounded-xl shadow-black shadow-2xl w-4/12 bg-white">
                <div class="flex flex-col gap-7 w-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-start mb-10">
                            <inertia-link :href="route('tenant.landing')"
                                class="button bg-gradient-to-br from-blue-400 to-blue-600 text-white !max-w-full font-semibold hover:from-blue-500 hover:to-blue-700">
                                Înapoi la pagina principală
                            </inertia-link>
                        </div>
                        <h1 class="title max-w-max !mb-0">Crează-ți un cont! 👋</h1>
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                        <FormInput v-for="field in formFields" :key="field.name" :field="field"
                            v-model="form[field.model]" :error="errors[field.model]" />
                        <Dropdown class="sm:col-span-6" v-model="form.role" :options="roles" label="Alege rolul"
                            :error="errors.role" />
                    </div>
                    <button @click="submit"
                        class="button bg-gradient-to-br from-blue-400 to-blue-600 text-white !max-w-full font-semibold hover:from-blue-500 hover:to-blue-700">
                        Înregistrează-te
                    </button>
                    <inertia-link :href="route('auth.login')" class="flex justify-center text-gray-500 text-md">
                        Ai un cont deja? Loghează-te aici !
                    </inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Dropdown from '../../Components/Dropdown.vue';
import FormInput from '../../Components/FormInput.vue';
import { useForm } from '@inertiajs/vue3';


export default {
    name: 'Register',

    components: {
        FormInput,
        Dropdown
    },

    data() {
        return {
            formFields: [
                { name: 'name', label: 'Nume', model: 'name', type: 'input', inputType: 'text', autocomplete: 'given-name', colSpan: 'sm:col-span-3' },
                { name: 'last_name', label: 'Prenume', model: 'last_name', type: 'input', inputType: 'text', autocomplete: 'family-name', colSpan: 'sm:col-span-3' },
                { name: 'email', label: 'Email', model: 'email', type: 'input', inputType: 'email', autocomplete: 'email', colSpan: 'sm:col-span-6' },
                { name: 'password', label: 'Parola', model: 'password', type: 'input', inputType: 'password', autocomplete: 'new-password', colSpan: 'sm:col-span-6' },
                { name: 'confirmedPassword', label: 'Confirmă Parola', model: 'confirmedPassword', type: 'input', inputType: 'password', autocomplete: 'new-password', colSpan: 'sm:col-span-6' },
            ],
            roles: [
                { value: 'parent', label: 'Părinte' },
                { value: 'player', label: 'Jucător' },
            ],
            errors: {},
            form: useForm({
                name: null,
                email: null,
                last_name: null,
                password: null,
                role: null,
                confirmedPassword: null
            }),
            register_image: '../images/hero.jpg'
        }
    },

    methods: {
        submit() {
            this.form.post(route('auth.register.post'), {
                onError: (errors) => {
                    this.errors = errors;
                },
                onSuccess: () => {
                    this.form.reset();
                }
            });
        },
    }


}

</script>