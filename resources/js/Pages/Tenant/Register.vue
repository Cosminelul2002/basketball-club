<template>
    <div class="bg-[#3D52A0]">
        <div class="flex items-center justify-center h-screen">
            <div class="flex justify-center items-center p-10 gap-7 rounded-xl shadow-black shadow-2xl w-4/12 bg-white">
                <div class="flex flex-col gap-7 w-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-start mb-10">
                            <inertia-link :href="route('landing')"
                                class="button bg-gradient-to-br from-blue-400 to-blue-600 text-white !max-w-full font-semibold hover:from-blue-500 hover:to-blue-700">
                                Înapoi la pagina principală
                            </inertia-link>
                        </div>
                        <h1 class="title max-w-max !mb-0">Crează-ți un cont! 👋</h1>
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                        <FormInput v-for="field in formFields" :key="field.name" :field="field"
                            v-model="form[field.model]" :error="errors[field.model]" />
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
import { useForm } from '@inertiajs/vue3';
import Dropdown from '../../Components/Dropdown.vue';
import FormInput from '../../Components/FormInput.vue';

export default {
    name: 'Register',

    components: {
        Dropdown,
        FormInput
    },

    data() {
        return {
            formFields: [
                { name: 'name', label: 'Nume', model: 'name', type: 'input', inputType: 'text', autocomplete: 'given-name', colSpan: 'sm:col-span-3' },
                { name: 'last_name', label: 'Prenume', model: 'last_name', type: 'input', inputType: 'text', autocomplete: 'family-name', colSpan: 'sm:col-span-3' },
                { name: 'email', label: 'Email', model: 'email', type: 'input', inputType: 'email', autocomplete: 'email', colSpan: 'sm:col-span-6' },
                { name: 'type', label: 'Tip', model: 'type', type: 'input', inputType: 'text', autocomplete: 'type', colSpan: 'sm:col-span-6' },
                { name: 'domain', label: 'Domeniu', model: 'domain', type: 'input', inputType: 'text', autocomplete: 'domain', colSpan: 'sm:col-span-6', hasAddon: true, addon: '.localhost' },
                { name: 'password', label: 'Parola', model: 'password', type: 'input', inputType: 'password', autocomplete: 'new-password', colSpan: 'sm:col-span-6' },
                { name: 'confirmedPassword', label: 'Confirmă Parola', model: 'confirmedPassword', type: 'input', inputType: 'password', autocomplete: 'new-password', colSpan: 'sm:col-span-6' },
            ],
            errors: {},
            form: useForm({
                name: null,
                email: null,
                password: null,
                confirmedPassword: null,
                domain: null,
                type: null,
            }),
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
